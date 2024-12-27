<?php

declare(strict_types=1);

namespace Intervention\Image\Drivers\Vips\Tests\Unit\Modifiers;

use Intervention\Image\Drivers\Vips\Tests\BaseTestCase;
use Intervention\Image\Modifiers\PixelateModifier;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(PixelateModifier::class)]
#[CoversClass(\Intervention\Image\Drivers\Vips\Modifiers\PixelateModifier::class)]
final class PixelateModifierTest extends BaseTestCase
{
    public function testModify(): void
    {
        $image = $this->readTestImage('trim.png');
        $this->assertEquals('00aef0', $image->pickColor(0, 0)->toHex());
        $this->assertEquals('00aef0', $image->pickColor(14, 14)->toHex());
        $image->modify(new PixelateModifier(10));

        list($r, $g, $b) = $image->pickColor(0, 0)->toArray();
        $this->assertEquals(0, $r);
        $this->assertEquals(174, $g);
        $this->assertEquals(241, $b);

        list($r, $g, $b) = $image->pickColor(14, 14)->toArray();
        $this->assertEquals(104, $r);
        $this->assertEquals(171, $g);
        $this->assertEquals(143, $b);
    }
}
