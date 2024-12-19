<?php

declare(strict_types=1);

namespace Intervention\Image\Drivers\Vips\Tests\Unit\Modifiers;

use Intervention\Image\Drivers\Vips\Tests\BaseTestCase;
use Intervention\Image\Modifiers\BlurModifier;
use Intervention\Image\Modifiers\ResizeModifier;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(\Intervention\Image\Drivers\ResizeModifier::class)]
#[CoversClass(\Intervention\Image\Drivers\Imagick\Modifiers\ResizeModifier::class)]
final class ResizeModifierTest extends BaseTestCase
{
    public function testColorChange(): void
    {
        $image = $this->readTestImage('blocks.png');
        $this->assertEquals(640, $image->width());
        $this->assertEquals(480, $image->height());
        $image->modify(new ResizeModifier(200, 100));
        $this->assertEquals(200, $image->width());
        $this->assertEquals(100, $image->height());
        $this->assertColor(255, 0, 0, 255, $image->pickColor(150, 70));
    }
}