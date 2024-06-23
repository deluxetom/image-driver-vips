<?php

declare(strict_types=1);

namespace Intervention\Image\Drivers\Vips\Decoders;

use Exception;
use Intervention\Image\Exceptions\DecoderException;
use Intervention\Image\Interfaces\ImageInterface;
use Intervention\Image\Interfaces\ColorInterface;
use Jcupitt\Vips;

class BinaryImageDecoder extends NativeObjectDecoder
{
    /**
     * {@inheritdoc}
     *
     * @see DecoderInterface::decode()
     */
    public function decode(mixed $input): ImageInterface|ColorInterface
    {
        if (!is_string($input)) {
            throw new DecoderException('Unable to decode input');
        }

        try {
            $vipsImage = Vips\Image::newFromBuffer($input, $this->stringOptions(), [
                'access' => Vips\Access::SEQUENTIAL,
            ]);
        } catch (Exception) {
            throw new DecoderException('Unable to decode input');
        }

        $image = parent::decode($vipsImage);

        // extract exif data
        // $image->setExif($this->extractExifData($input));

        return $image;
    }
}
