<?php

declare(strict_types=1);

namespace Intervention\Image\Drivers\Vips\Tests\Unit;

use Intervention\Image\Drivers\Vips\Core;
use Intervention\Image\Drivers\Vips\Frame;
use Intervention\Image\Drivers\Vips\Tests\BaseTestCase;
use Intervention\Image\Exceptions\AnimationException;
use Jcupitt\Vips\Image as VipsImage;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Core::class)]
class CoreTest extends BaseTestCase
{
    protected Core $core;

    protected function setUp(): void
    {
        $black = VipsImage::black(10, 10);
        $red = $black->newFromImage([255, 0, 0]);
        $green = $black->newFromImage([0, 255, 0]);
        $blue = $black->newFromImage([0, 0, 255]);

        $frames = [$red, $green, $blue];
        $animation = VipsImage::arrayjoin($frames, ['across' => 1]);

        $delay = array_fill(0, count($frames), 300);

        $animation->set("delay", $delay);
        $animation->set("loop", 0);
        $animation->set("page-height", $red->height);
        $animation->set("n-pages", count($frames));

        $this->core = new Core($animation);
    }

    public function testCount(): void
    {
        $this->assertEquals(3, $this->core->count());
    }

    public function testFrame(): void
    {
        $this->assertInstanceOf(Frame::class, $this->core->frame(0));
        $this->assertInstanceOf(Frame::class, $this->core->frame(1));
        $this->assertInstanceOf(Frame::class, $this->core->frame(2));
        $this->expectException(AnimationException::class);
        $this->core->frame(3);
    }

    public function testFrameWithStaticImage(): void
    {
        $black = VipsImage::black(10, 10);
        $this->assertInstanceOf(Frame::class, (new Core($black))->frame(0));
        $this->expectException(AnimationException::class);
        (new Core($black))->frame(1);
    }
}
