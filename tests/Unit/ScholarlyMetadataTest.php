<?php

namespace Tests\Unit;

use App\Support\ScholarlyMetadata;
use Illuminate\Container\Container;
use Illuminate\Http\Request;
use Illuminate\Routing\RouteCollection;
use Illuminate\Routing\UrlGenerator;
use PHPUnit\Framework\TestCase;

class ScholarlyMetadataTest extends TestCase
{
    protected function tearDown(): void
    {
        Container::setInstance(null);
        parent::tearDown();
    }

    private function metadata(array $overrides = []): array
    {
        $container = new Container;
        Container::setInstance($container);
        $container->instance(\Illuminate\Contracts\Routing\UrlGenerator::class, new UrlGenerator(new RouteCollection, Request::create('https://journal.test')));
        return ScholarlyMetadata::article((object) array_merge([
            'name' => 'Research & <em>results</em>', 'slug' => 'research', 'abstract' => '<p>Full abstract</p>',
            'aname' => 'Doe, Jane; John Smith', 'published_date' => '2025-03-04',
            'file' => 'paper.pdf', 'doi' => 'https://doi.org/10.1234/example', 'page' => '12–19',
        ], $overrides), (object) ['j_name' => 'Correct Journal', 'slug' => 'correct', 'issn' => 'Online: 1234-567X'],
            (object) ['name' => '3', 'year' => '2025'], (object) ['name' => '2']);
    }

    public function test_bibliographic_tags_and_schema_match_the_article(): void
    {
        $metadata = $this->metadata();
        $tags = array_column($metadata['tags'], 'content', 'name');
        $authors = array_values(array_column(array_filter($metadata['tags'], function ($tag) {
            return $tag['name'] === 'citation_author';
        }), 'content'));
        $this->assertSame(['Doe, Jane', 'John Smith'], $authors);
        $this->assertSame('Research & results', $tags['citation_title']);
        $this->assertSame('Correct Journal', $tags['citation_journal_title']);
        $this->assertSame('2025/03/04', $tags['citation_publication_date']);
        $this->assertSame('https://journal.test/assets/articles/paper.pdf', $tags['citation_pdf_url']);
        $this->assertSame('10.1234/example', $tags['citation_doi']);
        $this->assertSame('19', $tags['citation_lastpage']);
        $this->assertSame('1234-567X', $tags['citation_issn']);
        $this->assertSame('ScholarlyArticle', $metadata['schema']['@type']);
    }

    public function test_missing_data_is_not_fabricated_and_docx_is_not_advertised_as_pdf(): void
    {
        $metadata = $this->metadata(['published_date' => '', 'file' => 'paper.docx', 'doi' => '', 'page' => '']);
        $tags = array_column($metadata['tags'], 'content', 'name');
        $this->assertSame('2025', $tags['citation_publication_date']);
        $this->assertArrayNotHasKey('citation_pdf_url', $tags);
        $this->assertArrayNotHasKey('citation_doi', $tags);
        $this->assertArrayNotHasKey('citation_firstpage', $tags);
        $this->assertArrayNotHasKey('encoding', $metadata['schema']);
    }
}
