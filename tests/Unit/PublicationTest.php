<?php

namespace Tests\Unit;

use App\Http\Controllers\SeoController;
use App\Models\articles;
use App\Support\ArticleAuthors;
use App\Support\ScholarlyMetadata;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Routing\Redirector;
use Illuminate\Routing\RouteCollection;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Facade;
use Illuminate\Validation\ValidationException;
use PHPUnit\Framework\TestCase;

class PublicationTest extends TestCase
{
    private $container;
    private $db;

    protected function setUp(): void
    {
        parent::setUp();
        $this->container = new Container;
        Container::setInstance($this->container);
        Facade::setFacadeApplication($this->container);
        $this->db = new Manager($this->container);
        $this->db->addConnection(['driver' => 'sqlite', 'database' => ':memory:']);
        $this->db->bootEloquent();
        $this->container->instance('db', $this->db->getDatabaseManager());
        $this->container->instance('db.schema', $this->db->getConnection()->getSchemaBuilder());
        $url = new UrlGenerator(new RouteCollection, Request::create('https://journal.test'));
        $this->container->instance(\Illuminate\Contracts\Routing\UrlGenerator::class, $url);
        $this->container->instance(\Illuminate\Contracts\Routing\ResponseFactory::class,
            new ResponseFactory($this->createMock(\Illuminate\Contracts\View\Factory::class), new Redirector($url)));
        $validator = new \Illuminate\Validation\Factory(new \Illuminate\Translation\Translator(new \Illuminate\Translation\ArrayLoader, 'en'), $this->container);
        $this->container->instance('validator', $validator);
        Request::macro('validate', function ($rules) use ($validator) { return $validator->make($this->all(), $rules)->validate(); });
        $this->db->getConnection()->getSchemaBuilder()->create('article', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('aname', 1000)->nullable();
            $table->string('designation', 5000)->nullable();
            $table->integer('j_id')->nullable();
            $table->string('slug')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });
        require_once __DIR__ . '/../../database/migrations/2026_09_28_000000_create_article_authors_table.php';
        (new \CreateArticleAuthorsTable)->up();
    }

    protected function tearDown(): void
    {
        Facade::clearResolvedInstances();
        Facade::setFacadeApplication(null);
        Container::setInstance(null);
        Request::flushMacros();
        parent::tearDown();
    }

    private function authors(): array
    {
        return [
            ['first_name' => 'P.', 'last_name' => 'Kanakasabai', 'designation' => 'Professor', 'affiliation' => 'College of Engineering', 'sup_number' => 1],
            ['first_name' => 'Saikat', 'last_name' => 'Banerjee', 'affiliation' => ' College   of Engineering ', 'sup_number' => 2],
            ['first_name' => 'D.', 'last_name' => 'Sridevi', 'affiliation' => 'IT Department', 'sup_number' => 3],
            ['first_name' => 'S.', 'last_name' => 'Sivamani', 'affiliation' => 'College of Engineering', 'sup_number' => 4, 'is_corresponding' => '1'],
        ];
    }

    public function test_create_and_edit_keep_both_representations_in_sync(): void
    {
        $rows = ArticleAuthors::fromRequest(Request::create('/', 'POST', ['authors' => $this->authors()]));
        $article = new articles;
        ArticleAuthors::save($article, $rows);
        $this->assertSame('P. Kanakasabai<sup>1</sup>, Saikat Banerjee<sup>2</sup>, D. Sridevi<sup>3</sup>, S. Sivamani*<sup>4</sup>', $article->fresh()->aname);
        $this->assertSame('<sup>1-2-4*</sup>College of Engineering, <sup>3</sup>IT Department', $article->fresh()->designation);
        $this->assertCount(4, $article->publicationAuthors);
        $this->assertSame('Professor', $article->publicationAuthors[0]->designation);
        ArticleAuthors::save($article, array_slice($rows, 0, 1));
        $this->assertCount(1, $article->fresh()->publicationAuthors);
        $this->assertSame('P. Kanakasabai<sup>1</sup>', $article->fresh()->aname);
    }

    public function test_optional_superscripts_and_safe_display(): void
    {
        $rows = ArticleAuthors::fromRequest(Request::create('/', 'POST', ['authors' => [
            ['first_name' => 'Anne & Jane', 'is_corresponding' => 1],
        ]]));
        $legacy = ArticleAuthors::legacy($rows);
        $this->assertSame('Anne &amp; Jane*', $legacy['aname']);
        $this->assertSame('', $legacy['designation']);
        $this->assertSame('Jane<sup>2</sup>&lt;img src=x onerror=alert(1)&gt;', ArticleAuthors::display('Jane<sup>2</sup><img src=x onerror=alert(1)>'));
        $this->assertStringNotContainsString('<sup onclick', ArticleAuthors::display('<sup onclick="alert(1)">2</sup>'));
    }

    public function test_legacy_edit_does_not_create_or_guess_authors(): void
    {
        $article = new articles;
        $article->aname = 'Doe, Jane, John Smith';
        $article->designation = 'Existing institute';
        $rows = ArticleAuthors::fromRequest(Request::create('/', 'POST', ['aname' => $article->aname]), false);
        $this->assertNull($rows);
        ArticleAuthors::save($article, $rows);
        $this->assertSame('Doe, Jane, John Smith', $article->fresh()->aname);
        $this->assertCount(0, $article->publicationAuthors);
    }

    public function test_save_rolls_back_article_and_authors_if_a_row_fails(): void
    {
        $article = new articles;
        $rows = ArticleAuthors::fromRequest(Request::create('/', 'POST', ['authors' => $this->authors()]));
        ArticleAuthors::save($article, $rows);
        $before = $article->fresh()->aname;
        $rows[1]['position'] = $rows[0]['position'];
        $rows[0]['first_name'] = 'Changed';
        try {
            ArticleAuthors::save($article, $rows);
            $this->fail('Expected unique position violation');
        } catch (\Illuminate\Database\QueryException $exception) {
            $this->assertSame($before, $article->fresh()->aname);
            $this->assertCount(4, $article->fresh()->publicationAuthors);
        }
    }

    public function test_invalid_author_is_rejected(): void
    {
        $this->expectException(ValidationException::class);
        ArticleAuthors::fromRequest(Request::create('/', 'POST', ['authors' => [['first_name' => 'Jane', 'sup_number' => -1]]]));
    }

    public function test_combined_names_cannot_overflow_existing_column(): void
    {
        $this->expectException(ValidationException::class);
        ArticleAuthors::fromRequest(Request::create('/', 'POST', ['authors' => array_fill(0, 10, ['first_name' => str_repeat('a', 150)])]));
    }

    public function test_metadata_uses_separate_authors_without_display_markers(): void
    {
        $article = new articles;
        $rows = ArticleAuthors::fromRequest(Request::create('/', 'POST', ['authors' => $this->authors()]));
        ArticleAuthors::save($article, $rows);
        $article->name = 'Research & results';
        $article->slug = 'research';
        $article->published_date = '2026-09-28';
        $article->file = 'paper.pdf';
        $article->page = '12–19';
        $article->doi = 'https://doi.org/10.1234/example';
        $metadata = ScholarlyMetadata::article($article, (object) ['j_name' => 'Correct Journal', 'slug' => 'correct', 'issn' => '1234-567X'], (object) ['name' => 'Volume 3'], (object) ['name' => 'Issue 2'], $article->publicationAuthors);
        $tags = collect($metadata['tags']);
        $this->assertSame(['P. Kanakasabai', 'Saikat Banerjee', 'D. Sridevi', 'S. Sivamani'], $tags->where('name', 'citation_author')->pluck('content')->values()->all());
        $this->assertSame('College of Engineering', $tags->firstWhere('name', 'citation_author_institution')['content']);
        $this->assertSame('3', $tags->firstWhere('name', 'citation_volume')['content']);
        $this->assertSame('19', $tags->firstWhere('name', 'citation_lastpage')['content']);
        $this->assertSame('https://journal.test/assets/articles/paper.pdf', $metadata['pdf']);
        $this->assertSame('Professor', $metadata['schema']['author'][0]['jobTitle']);
        $this->assertSame('2026-09-28', $metadata['date']);
        $this->assertNull(ScholarlyMetadata::date('2026-02-31'));
        $article->file = 'paper.docx';
        $article->published_date = null;
        $metadata = ScholarlyMetadata::article($article, (object) ['j_name' => 'Journal', 'slug' => 'journal'], null, null, []);
        $this->assertNull($metadata['pdf']);
        $this->assertArrayNotHasKey('datePublished', $metadata['schema']);
    }

    public function test_sitemaps_are_valid_xml_and_exclude_hidden_articles(): void
    {
        $connection = $this->db->getConnection();
        foreach ([
            'CREATE TABLE journals (j_id INTEGER, slug TEXT, active INTEGER)',
            'CREATE TABLE volume (id INTEGER, j_id INTEGER, slug TEXT)',
            'CREATE TABLE issues (id INTEGER, v_id INTEGER, slug TEXT, active INTEGER)',
            'CREATE TABLE custom_pages (path TEXT, status INTEGER, type TEXT)',
        ] as $sql) $connection->statement($sql);
        $connection->table('journals')->insert([['j_id' => 1, 'slug' => 'science', 'active' => 1], ['j_id' => 2, 'slug' => 'hidden', 'active' => 0]]);
        $connection->table('article')->insert([
            ['j_id' => 1, 'slug' => 'a&b', 'status' => 1],
            ['j_id' => 1, 'slug' => 'draft', 'status' => 0],
            ['j_id' => 2, 'slug' => 'hidden', 'status' => 1],
        ]);
        $connection->table('volume')->insert(['id' => 2, 'j_id' => 1, 'slug' => 'volume-1']);
        $connection->table('issues')->insert(['id' => 3, 'v_id' => 2, 'slug' => 'issue-1', 'active' => 1]);
        $controller = new SeoController;
        $index = $controller->sitemap()->getContent();
        $this->assertNotFalse(simplexml_load_string($index));
        $this->assertStringContainsString('sitemaps/articles/1.xml', $index);
        $xml = $controller->section('articles', 1)->getContent();
        $this->assertNotFalse(simplexml_load_string($xml));
        $this->assertStringContainsString('article/a&amp;b', $xml);
        $this->assertStringNotContainsString('draft', $xml);
        $this->assertStringNotContainsString('hidden', $xml);
        $this->assertStringContainsString('archives/science/volume-1/issue-1?i=3&amp;v=2', $controller->section('issues', 1)->getContent());
        $this->assertStringContainsString('Sitemap: https://journal.test/sitemap.xml', $controller->robots()->getContent());
    }
}
