<?php

declare(strict_types=1);

namespace Intervention\Image\Drivers\Vips;

use Intervention\Image\Drivers\AbstractInputHandler;
use Intervention\Image\Drivers\Vips\Decoders\FilePathImageDecoder;

class InputHandler extends AbstractInputHandler
{
    protected array $decoders = [
        FilePathImageDecoder::class,
    ];
}
