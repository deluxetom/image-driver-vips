<?php

declare(strict_types=1);

namespace Intervention\Image\Drivers\Vips\Analyzers;

use Intervention\Image\Drivers\DriverSpecialized;
use Intervention\Image\Interfaces\ImageInterface;
use Intervention\Image\Colors\Cmyk\Colorspace as CmykColorspace;
use Intervention\Image\Colors\Rgb\Colorspace as RgbColorspace;
use Intervention\Image\Interfaces\AnalyzerInterface;

class ColorspaceAnalyzer extends DriverSpecialized implements AnalyzerInterface
{
    public function analyze(ImageInterface $image): mixed
    {
        return new RgbColorspace();
    }
}
