<?php

namespace Coyote\Http\Controllers\Adm;

use Coyote\View\Twig\TwigLiteral;
use Illuminate\Foundation\Application;
use Illuminate\View\View;

class DashboardController extends BaseController
{
    public function index(): View
    {
        return $this->view('adm.dashboard', [
            'checklist' => [
                $this->directoryWritable('storage/', \storage_path()),
                $this->directoryWritable('uploads/', \public_path()),
                [
                    'label' => 'Redis włączony',
                    'value' => \config('cache.default'),
                ],
                [
                    'label' => new TwigLiteral('PHP - <code>' . \PHP_VERSION . '</code>'),
                    'value' => true,
                ],
                [
                    'label' => new TwigLiteral('Laravel - <code>' . Application::VERSION . '</code>'),
                    'value' => true,
                ],
            ],
        ]);
    }

    public function directoryWritable(string $basePath, string $path): array
    {
        $permission = \decOct(\filePerms($path) & 0777);
        return [
            'label' => new TwigLiteral("Katalog <code>$basePath</code> ma prawa do zapisu - <code>$permission</code>"),
            'value' => \is_writeable(\storage_path()),
        ];
    }
}
