<?php

declare(strict_types=1);

namespace Intervention\Image\Drivers\Vips\Modifiers;

use Intervention\Image\Interfaces\ImageInterface;
use Intervention\Image\Interfaces\SpecializedInterface;
use Intervention\Image\Modifiers\PlaceModifier as GenericPlaceModifier;
use Jcupitt\Vips\BlendMode;
use Jcupitt\Vips\Extend;

class PlaceModifier extends GenericPlaceModifier implements SpecializedInterface
{
    public function apply(ImageInterface $image): ImageInterface
    {
        $watermark = $this->driver()->handleInput($this->element);
        $position = $this->getPosition($image, $watermark);
        $imageSize = $image->size()->align($this->position);

        if ($this->opacity < 100) {
            if (!$watermark->core()->native()->hasAlpha()) {
                $watermark->core()->setNative(
                    $watermark->core()->native()->bandjoin_const(255)
                );
            }

            $watermark->core()->setNative(
                $watermark->core()->native()->multiply([
                    1.0,
                    1.0,
                    1.0,
                    $this->opacity / 100,
                ])
            );
        }

        if ($watermark->core()->native()->hasAlpha()) {
            $watermark->core()->setNative(
                $watermark->core()->native()->embed(
                    $position->x(),
                    $position->y(),
                    $imageSize->width(),
                    $imageSize->height(),
                    [
                        'extend' => Extend::BACKGROUND,
                        'background' => [0, 0, 0, 0],
                    ]
                )
            );

            $image->core()->setNative(
                $image->core()->native()->composite2(
                    $watermark->core()->native(),
                    BlendMode::OVER
                )
            );
        } else {
            $image->core()->setNative(
                $image->core()->native()->insert(
                    $watermark->core()->native()->bandjoin_const(255),
                    $position->x(),
                    $position->y()
                )
            );
        }

        return $image;
    }
}
