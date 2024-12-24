<?php

declare(strict_types=1);

namespace Intervention\Image\Drivers\Vips\Modifiers;

use Intervention\Image\Interfaces\ImageInterface;
use Intervention\Image\Interfaces\SpecializedInterface;
use Intervention\Image\Modifiers\PixelateModifier as GenericPixelateModifier;
use Jcupitt\Vips\Kernel;

class PixelateModifier extends GenericPixelateModifier implements SpecializedInterface
{
    public function apply(ImageInterface $image): ImageInterface
    {
        $image->core()->setNative(
            $image->core()->native()
                ->resize(1 / $this->size)
                ->resize($this->size, ['kernel' => Kernel::NEAREST])
                ->crop(0, 0, $image->width(), $image->height())
        );

        return $image;
    }
}
