<?php

namespace Tests\Unit;

use App\Http\Controllers\SeoController;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Routing\RouteCollection;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Facade;
use PHPUnit\Framework\TestCase;

class SitemapTest extends TestCase
{
    public function test_sitemap_is_valid_xml_and_excludes_inactive_records(): void
    {
        $container = new Container;
        Container::setInstance($container);
        Facade::setFacadeApplication($container);
        $db = new Manager($container);
        $db->addConnection(['driver' => 'sqlite', 'database' => ':memory:']);
        $container->instance('db', $db->getDatabaseManager());
        $url = new UrlGenerator(new RouteCollection, Request::create('https://journal.test'));
        $container->instance(\Illuminate\Contracts\Routing\UrlGenerator::class, $url);
        $container->instance(\Illuminate\Contracts\Routing\ResponseFactory::class,
            new ResponseFactory($this->createMock(\Illuminate\Contracts\View\Factory::class), new Redirector($url)));
        $connection = $db->getConnection();
        foreach ([
            'CREATE TABLE journals (j_id INTEGER, slug TEXT, active INTEGER)',
            'CREATE TABLE volume (id INTEGER, j_id INTEGER, slug TEXT)',
            'CREATE TABLE issues (id INTEGER, v_id INTEGER, slug TEXT, active INTEGER)',
            'CREATE TABLE article (j_id INTEGER, slug TEXT, status INTEGER)',
            'CREATE TABLE custom_pages (path TEXT, status INTEGER, type TEXT)',
        ] as $sql) $connection->statement($sql);
        $connection->table('journals')->insert([
            ['j_id' => 1, 'slug' => 'science', 'active' => 1],
            ['j_id' => 2, 'slug' => 'hidden-journal', 'active' => 0],
        ]);
        $connection->table('volume')->insert(['id' => 1, 'j_id' => 1, 'slug' => 'volume-1']);
        $connection->table('issues')->insert(['id' => 1, 'v_id' => 1, 'slug' => 'issue-1', 'active' => 1]);
        $connection->table('article')->insert([
            ['j_id' => 1, 'slug' => 'a&b', 'status' => 1],
            ['j_id' => 1, 'slug' => 'draft', 'status' => 0],
            ['j_id' => 2, 'slug' => 'hidden-paper', 'status' => 1],
        ]);
        try {
            $response = (new SeoController)->sitemap();
            ob_start();
            $response->sendContent();
            $xml = ob_get_clean();
            $this->assertNotFalse(simplexml_load_string($xml));
            $this->assertStringContainsString('https://journal.test/article/a&amp;b', $xml);
            $this->assertStringContainsString('https://journal.test/archives/science/volume-1/issue-1', $xml);
            $this->assertStringNotContainsString('draft', $xml);
            $this->assertStringNotContainsString('hidden-', $xml);
            $this->assertStringContainsString('Sitemap: https://journal.test/sitemap.xml', (new SeoController)->robots()->getContent());
        } finally {
            Facade::clearResolvedInstances();
            Facade::setFacadeApplication(null);
            Container::setInstance(null);
        }
    }
}
