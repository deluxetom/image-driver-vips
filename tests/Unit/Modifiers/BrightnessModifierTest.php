<?php

declare(strict_types=1);

namespace Intervention\Image\Drivers\Vips\Tests\Unit\Modifiers;

use Intervention\Image\Drivers\Vips\Tests\BaseTestCase;
use Intervention\Image\Modifiers\BrightnessModifier;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(\Intervention\Image\Modifiers\BrightnessModifier::class)]
#[CoversClass(\Intervention\Image\Drivers\Vips\Modifiers\BrightnessModifier::class)]
final class BrightnessModifierTest extends BaseTestCase
{
    public function testApply(): void
    {
        $image = $this->readTestImage('trim.png');
        $image->save('brightness1.png');
        $this->assertEquals('00aef0', $image->pickColor(14, 14)->toHex());
        $image->modify(new BrightnessModifier(30));
        $image->save('brightness2.png');
        $this->assertEquals('1eccff', $image->pickColor(14, 14)->toHex());
    }
}
