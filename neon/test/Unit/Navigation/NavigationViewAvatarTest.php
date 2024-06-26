<?php
namespace Neon\Test\Unit\Navigation;

use Neon\Application;
use Neon\Test\BaseFixture\Domain\TestApplication;
use Neon\Test\BaseFixture\Selector\Selector;
use Neon\Test\BaseFixture\View\ViewDom;
use Neon\Test\Unit\Navigation\Fixture\LoggedInUser;
use PHPUnit\Framework\TestCase;

class NavigationViewAvatarTest extends TestCase
{
    /**
     * @test
     */
    public function userShouldSeeHisAvatar(): void
    {
        $this->assertSame(
            'face.png',
            $this->renderedAvatarUrl(LoggedInUser::withAvatar('face.png')));
    }

    /**
     * @test
     */
    public function userShouldSeePlaceholderAvatar(): void
    {
        $this->assertSame(
            '/neon/avatarPlaceholder.png',
            $this->renderedAvatarUrl(LoggedInUser::withoutAvatar()));
    }

    /**
     * @test
     */
    public function guestShouldNotSeeAvatar(): void
    {
        $this->assertFalse($this->isAvatarRendered(LoggedInUser::guest()));
    }

    private function isAvatarRendered(LoggedInUser $visitor): bool
    {
        $application = TestApplication::application(visitor:$visitor);
        $dom = new ViewDom($application->html(''));
        return $dom->exists('//header//img[@id="userAvatar"]');
    }

    private function renderedAvatarUrl(LoggedInUser $visitor): string
    {
        $application = TestApplication::application(visitor:$visitor);
        return $this->text($application, new Selector('header', '#userAvatar', '@src'));
    }

    private function text(Application $application, Selector $selector): string
    {
        $dom = new ViewDom($application->html(''));
        return $dom->findString($selector->xPath());
    }
}
