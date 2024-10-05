<?php

declare(strict_types=1);

namespace Intervention\Image\Drivers\Vips\Tests\Unit;

use Intervention\Image\Colors\Rgb\Channels\Alpha;
use Intervention\Image\Colors\Rgb\Channels\Blue;
use Intervention\Image\Colors\Rgb\Channels\Green;
use Intervention\Image\Colors\Rgb\Channels\Red;
use Intervention\Image\Colors\Rgb\Color;
use Intervention\Image\Colors\Rgb\Colorspace;
use Intervention\Image\Drivers\Vips\ColorProcessor;
use PHPUnit\Framework\TestCase;

final class ColorProcessorTest extends TestCase
{
    public function testColorToNative(): void
    {
        $processor = new ColorProcessor(new Colorspace());
        $result = $processor->colorToNative(new Color(255, 55, 0, 255));
        $this->assertEquals([255, 55, 0, 255], $result);
    }

    public function testNativeToColor(): void
    {
        $processor = new ColorProcessor(new Colorspace());
        $color = $processor->nativeToColor([255, 55, 0, 255]);
        $this->assertInstanceOf(Color::class, $color);
        $this->assertEquals(255, $color->channel(Red::class)->value());
        $this->assertEquals(55, $color->channel(Green::class)->value());
        $this->assertEquals(0, $color->channel(Blue::class)->value());
        $this->assertEquals(255, $color->channel(Alpha::class)->value());
    }
}
