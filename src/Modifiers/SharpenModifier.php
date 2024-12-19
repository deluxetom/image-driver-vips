<?php

declare(strict_types=1);

namespace Intervention\Image\Drivers\Vips\Modifiers;

use Intervention\Image\Interfaces\ImageInterface;
use Intervention\Image\Interfaces\SpecializedInterface;
use Intervention\Image\Modifiers\SharpenModifier as GenericSharpenModifier;
use Jcupitt\Vips\Image as VipsImage;

class SharpenModifier extends GenericSharpenModifier implements SpecializedInterface
{
    /**
     * {@inheritdoc}
     *
     * @see ModifierInterface::apply()
     */
    public function apply(ImageInterface $image): ImageInterface
    {
        $image->core()->setNative(
            $image->core()->native()->conv($this->getUnsharpMask())
        );

        return $image;
    }

    private function getUnsharpMask(): VipsImage
    {
        $min = $this->amount >= 10 ? $this->amount * -0.01 : 0;
        $max = $this->amount * -0.025;
        $abs = ((4 * $min + 4 * $max) * -1) + 1;

        return VipsImage::newFromArray([
            [$min, $max, $min],
            [$max, $abs, $max],
            [$min, $max, $min],
        ], 1, 0);
    }
}
