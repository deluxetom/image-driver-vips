<?php

declare(strict_types=1);

namespace Intervention\Image\Drivers\Vips\Decoders;

use Exception;
use Intervention\Image\Drivers\AbstractDecoder;
use Intervention\Image\Drivers\Vips\Core;
use Intervention\Image\Drivers\Vips\Driver;
use Intervention\Image\Exceptions\DecoderException;
use Intervention\Image\Image;
use Intervention\Image\Interfaces\ImageInterface;
use Intervention\Image\Interfaces\ColorInterface;
use Jcupitt\Vips\Image as VipsImage;

class FilePathImageDecoder extends AbstractDecoder
{
    /**
     * {@inheritdoc}
     *
     * @see DecoderInterface::decode()
     */
    public function decode(mixed $input): ImageInterface|ColorInterface
    {
        if (!$this->isFile($input)) {
            throw new DecoderException('Unable to decode input');
        }

        try {
            $vipsImage = VipsImage::newFromFile($input);
        } catch (Exception) {
            throw new DecoderException('Unable to decode input');
        }

        $image = new Image(new Driver(), new Core($vipsImage));

        // set file path on origin
        $image->origin()->setFilePath($input);

        // extract exif data
        // $image->setExif($this->extractExifData($input));

        return $image;
    }
}
