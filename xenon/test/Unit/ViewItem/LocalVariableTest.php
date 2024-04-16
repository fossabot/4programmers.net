<?php
namespace Xenon\Test\Unit\ViewItem;

use PHPUnit\Framework\TestCase;
use Xenon\ForEach_;
use Xenon\If_;
use Xenon\Test\Unit\Fixture;
use Xenon\Text;
use Xenon\Xenon;

class LocalVariableTest extends TestCase
{
    use Fixture;

    /**
     * @test
     */
    public function spaConditionTruthy(): void
    {
        $this->assertHtmlRuntime(
            $this->xenonCondition('truthy'),
            'accepted');
    }

    /**
     * @test
     */
    public function spaConditionFalsy(): void
    {
        $this->assertHtmlRuntime(
            $this->xenonCondition(null),
            '');
    }

    private function xenonCondition(mixed $value): Xenon
    {
        return new Xenon([
            new ForEach_('key', [
                new If_('$item', [new Text('accepted')]),
            ])],
            ['key' => [$value]]);
    }

    /**
     * @test
     */
    public function spaIteration(): void
    {
        $this->assertHtmlRuntime(
            $this->xenonIteration(['one', 'two']),
            'iterated,iterated,');
    }

    private function xenonIteration(array $items): Xenon
    {
        return new Xenon([
            new ForEach_('key', [
                new ForEach_('$item', [
                    new Text('iterated,'),
                ]),
            ])],
            ['key' => [$items]]);
    }
}
