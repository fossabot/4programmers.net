<?php

namespace Boduch\Grid\Decorators;

use Boduch\Grid\Cell;

class Url extends Decorator
{
    /**
     * @param Cell $cell
     * @return void
     */
    public function decorate(Cell $cell)
    {
        $url = (string) $cell->getValue();
        // disable auto escape so we can display <a> html tag in cell
        $cell->getColumn()->setEscape(false);

        $cell->setValue(
            $cell->getColumn()->getGrid()->getGridHelper()->getHtmlBuilder()->tag('a', $url, ['href' => $url])
        );
    }
}
