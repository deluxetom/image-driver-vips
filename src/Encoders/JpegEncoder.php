<?php

declare(strict_types=1);

namespace Intervention\Image\Drivers\Vips\Encoders;

use Intervention\Image\Drivers\DriverSpecializedEncoder;
use Intervention\Image\EncodedImage;
use Intervention\Image\Interfaces\ImageInterface;

/**
 * @property int $quality
 */
class JpegEncoder extends DriverSpecializedEncoder
{
    /**
     * {@inheritdoc}
     *
     * @see EncoderInterface::function()
     */
    public function encode(ImageInterface $image): EncodedImage
    {
        $result = $image->core()->native()->writeToBuffer('.jpg', [
            'Q' => $this->quality,
            'interlace' => false,
            'strip' => true,
            'optimize_coding' => true,
        ]);

        return new EncodedImage($result, 'image/jpeg');
    }
}
