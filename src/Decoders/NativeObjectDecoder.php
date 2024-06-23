<?php

declare(strict_types=1);

namespace Intervention\Image\Drivers\Vips\Decoders;

use Intervention\Image\Drivers\SpecializableDecoder;
use Intervention\Image\Drivers\Vips\Core;
use Intervention\Image\Exceptions\DecoderException;
use Intervention\Image\Image;
use Intervention\Image\Interfaces\ImageInterface;
use Intervention\Image\Interfaces\ColorInterface;
use Intervention\Image\Interfaces\SpecializedInterface;
use Jcupitt\Vips\Image as VipsImage;

class NativeObjectDecoder extends SpecializableDecoder implements SpecializedInterface
{
    /**
     * @param mixed $input
     * @return ImageInterface|ColorInterface
     * @throws DecoderException
     */
    public function decode(mixed $input): ImageInterface|ColorInterface
    {
        if (!is_object($input)) {
            throw new DecoderException('Unable to decode input');
        }

        if (!($input instanceof VipsImage)) {
            throw new DecoderException('Unable to decode input');
        }

        // auto-rotate
        if ($this->driver()->config()->autoOrientation === true) {
            $input = $input->autorot();
        }

        // build image instance
        return new Image(
            $this->driver(),
            new Core($input)
        );
    }

    /**
     * Get options for vips library according to current configuration
     *
     * @return string
     */
    protected function stringOptions(): string
    {
        $options = '';

        if ($this->driver()->config()->decodeAnimation === true) {
            $options = 'n=-1';
        }

        return $options;
    }
}
