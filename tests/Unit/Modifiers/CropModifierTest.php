<?php

declare(strict_types=1);

namespace Intervention\Image\Drivers\Vips\Tests\Unit\Modifiers;

use Intervention\Image\Drivers\Vips\Modifiers\CropModifier;
use Intervention\Image\Drivers\Vips\Tests\BaseTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(\Intervention\Image\Modifiers\CropModifier::class)]
#[CoversClass(\Intervention\Image\Drivers\Imagick\Modifiers\CropModifier::class)]
final class CropModifierTest extends BaseTestCase
{
    public function testModifyCrop(): void
    {
        $image = $this->readTestImage('blocks.png');
        $image = $image->modify(new CropModifier(200, 200, 0, 0, 'ffffff', 'bottom-right'));
        $image->core()->native()->writeToFile('crop.png');
        $this->assertEquals(200, $image->width());
        $this->assertEquals(200, $image->height());
        $this->assertColor(255, 0, 0, 255, $image->pickColor(5, 5));
        $this->assertColor(255, 0, 0, 255, $image->pickColor(100, 100));
        $this->assertColor(255, 0, 0, 255, $image->pickColor(190, 190));
    }

    public function testModifyCropExtend(): void
    {
        $image = $this->readTestImage('blocks.png');
        $image = $image->modify(new CropModifier(800, 100, -10, -10, 'ff0000', 'top-left'));
        $image->core()->native()->writeToFile('crop.png');
        $this->assertEquals(800, $image->width());
        $this->assertEquals(100, $image->height());
        $this->assertColor(255, 0, 0, 255, $image->pickColor(9, 9));
        $this->assertColor(0, 0, 255, 255, $image->pickColor(16, 16));
        $this->assertColor(0, 0, 255, 255, $image->pickColor(445, 16));
        $this->assertTransparency($image->pickColor(460, 16));
    }
}
