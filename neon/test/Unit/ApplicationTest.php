<?php
namespace Neon\Test\Unit;

use Neon\Test\BaseFixture\Selector\Selector;
use Neon\Test\BaseFixture\View\ViewDom;
use PHPUnit\Framework\TestCase;
use Tests\Unit\BaseFixture;

class ApplicationTest extends TestCase
{
    use BaseFixture\Server\Http;

    /**
     * @test
     */
    public function sectionTitle(): void
    {
        $dom = $this->dom('/events');
        $this->assertSame(
            'Incoming events',
            $dom->find('/html/body//h1/text()'));
    }

    /**
     * @test
     */
    public function navigationItems(): void
    {
        $this->assertSame(
            ['Forum', 'Microblogs', 'Jobs', 'Wiki'],
            $this->findMany('nav', 'ul.menu-items', 'li'));
    }

    /**
     * @test
     */
    public function githubTitle(): void
    {
        $this->assertSame(
            'Coyote',
            $this->find('.github', '.name'));
    }

    /**
     * @test
     */
    public function githubStars(): void
    {
        $this->assertSame(
            '14',
            $this->find('.github', '.stars'));
    }

    /**
     * @test
     */
    public function headerControls(): void
    {
        $this->assertSame(
            ['Create account', 'Login'],
            $this->findMany('ul.controls', 'li'));
    }

    /**
     * @test
     */
    public function favicon(): void
    {
        $this->assertSame(
            '<link rel="shortcut icon" href="https://4programmers.net/img/favicon.png" type="image/png">',
            $this->dom('/events')
                ->html('/html/head/link[@rel="shortcut icon"]'));
    }

    private function findMany(string...$selectors): array
    {
        $selector = new Selector(...$selectors);
        return $this->dom('/events')
            ->findMany($selector->xPath());
    }

    private function find(string...$selectors): string
    {
        $selector = new Selector(...$selectors);
        return $this->dom('/events')->find($selector->xPath());
    }

    private function dom(string $uri): ViewDom
    {
        return new ViewDom($this->server->get($uri)->assertSuccessful()->getContent());
    }
}