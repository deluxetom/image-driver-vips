<?php

declare(strict_types=1);

namespace Intervention\Image\Drivers\Vips\Analyzers;

use Intervention\Image\Analyzers\PixelColorAnalyzer as GenericPixelColorAnalyzer;
use Intervention\Image\Interfaces\ColorInterface;
use Intervention\Image\Interfaces\ColorspaceInterface;
use Intervention\Image\Interfaces\ImageInterface;
use Intervention\Image\Interfaces\SpecializedInterface;
use Jcupitt\Vips\Image as VipsImage;

class PixelColorAnalyzer extends GenericPixelColorAnalyzer implements SpecializedInterface
{
    public function analyze(ImageInterface $image): mixed
    {
        // $color = $this->colorAt(
        //     $image->colorspace(),
        //     $image->core()->frame($this->frame_key)->native()
        // );

        // $res = $image->core()->native()->getpoint($this->x, $this->y);

        return $this->colorAt(
            $image->colorspace(),
            // $image->core()->frame($this->frame_key)->native()
            $image->core()->native()
        );
    }

    /**
     * @throws ColorException
     */
    protected function colorAt(ColorspaceInterface $colorspace, VipsImage $vipsImage): ColorInterface
    {
        return $this->driver()
            ->colorProcessor($colorspace)
            ->nativeToColor(
                array_map(
                    fn ($value) => (int) $value,
                    $vipsImage->getpoint($this->x, $this->y)
                )
            );
    }
}
