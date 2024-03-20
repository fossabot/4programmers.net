<?php
namespace Neon\Test\Unit\Navigation\Fixture;

use Neon;
use Neon\Test\BaseFixture\Selector\Selector;
use Neon\Test\BaseFixture\View\ViewDom;
use Neon\View\Navigation;
use Neon\ViewModel;

trait ViewFixture
{
    function navigationView(array $fields): Neon\View
    {
        return new Neon\View('', [
            new Navigation($this->viewModel($fields)),
        ]);
    }

    function text(Neon\View $view, Selector $selector): string
    {
        $dom = new ViewDom($view->html());
        return $dom->find($selector->xPath());
    }

    function texts(Neon\View $view, Selector $selector): array
    {
        $dom = new ViewDom($view->html());
        return $dom->findMany($selector->xPath());
    }

    function viewModel(array $fields): ViewModel\Navigation
    {
        return new ViewModel\Navigation(
            $fields['items'] ?? [],
            $fields['githubUrl'] ?? '',
            $fields['githubName'] ?? '',
            $fields['githubStars'] ?? -1,
            $fields['controls'] ?? [],
        );
    }
}
