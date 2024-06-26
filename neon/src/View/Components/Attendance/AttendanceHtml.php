<?php
namespace Neon\View\Components\Attendance;

use Neon\View\Html\Item;
use Neon\View\Html\Render;
use Neon\View\Html\Tag;
use Neon\View\Theme;

readonly class AttendanceHtml implements Item
{
    public function __construct(private Attendance $vm, private Theme $theme)
    {
    }

    public function render(Render $h): array
    {
        $title = 'text-[#a2b7a0] text-xs';
        $number = 'text-[#f2f2f2] text-2xl leading-5 font-semibold mt-1';
        $separator = 'border-r border-white border-opacity-20';

        return [
            $h->tag('div', [
                'class' => 'flex align-center bg-black rounded-lg py-[30px] mb-8',
                'id'    => 'attendance',
            ], [
                $h->tag('div', ['class' => "z-[3] px-6 w-1/2 $separator"], [
                    $h->tag('div', ['class' => $title, 'id' => 'totalTitle'], [$this->vm->totalUsersTitle]),
                    $h->tag('div', ['class' => $number, 'id' => 'totalAmount'], [$this->vm->totalUsers]),
                ]),

                $h->tag('div', ['class' => 'z-[3] px-6 w-1/2'], [
                    $h->tag('div', ['class' => 'flex items-center'], [
                        $this->diode($h),
                        $h->tag('div', ['class' => "$title ml-1", 'id' => 'onlineTitle'], [$this->vm->onlineUsersTitle]),
                    ]),
                    $h->tag('div', ['class' => $number, 'id' => 'onlineAmount'], [$this->vm->onlineUsers]),
                ]),

                $this->bottomCenterHighlight($h),
            ]),
        ];
    }

    private function diode(Render $h): Tag
    {
        return $h->tag('div', ['class' => 'size-2 bg-[#80ff00] rounded'], []);
    }

    private function bottomCenterHighlight(Render $h): Tag
    {
        return $h->tag('div', [
            'class'       => "absolute top-6 z-[2] {$this->theme->attendanceHighlightBackground}",
            'style'       => \implode('', [
                'width:580px;',
                'height:580px;',
                'border-radius:580px;',
                'filter:blur(50px);',
                ...$this->highlightPosition(),
            ]),
            'parentClass' => 'relative overflow-hidden',
        ], []);
    }

    private function highlightPosition(): array
    {
        if ($this->theme->dark) {
            return [
                'right:50%;',
                'top:50%;',
                'transform:translateY(-25%)',
            ];
        }
        return [
            'left:50%;',
            'transform:translateX(-50%)',
        ];
    }
}
