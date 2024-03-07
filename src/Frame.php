<?php

declare(strict_types=1);

namespace Intervention\Image\Drivers\Vips;

use Intervention\Image\Geometry\Rectangle;
use Intervention\Image\Image;
use Intervention\Image\Interfaces\DriverInterface;
use Intervention\Image\Interfaces\FrameInterface;
use Intervention\Image\Interfaces\ImageInterface;
use Intervention\Image\Interfaces\SizeInterface;
use Jcupitt\Vips\Image as VipsImage;

class Frame implements FrameInterface
{
    public function __construct(protected VipsImage $vipsImage)
    {
    }

    public function native(): mixed
    {
        return $this->vipsImage;
    }

    public function setNative($native): FrameInterface
    {
        $this->vipsImage = $native;

        return $this;
    }

    public function toImage(DriverInterface $driver): ImageInterface
    {
        return new Image($driver, new Core($this->native()));
    }

    public function size(): SizeInterface
    {
        return new Rectangle($this->vipsImage->width, $this->vipsImage->height);
    }

    public function delay(): float
    {
        return 0;
    }

    public function setDelay(float $delay): FrameInterface
    {
        return $this;
    }

    public function dispose(): int
    {
        return 0;
    }

    public function setDispose(int $dispose): FrameInterface
    {
        return $this;
    }

    public function setOffset(int $left, int $top): FrameInterface
    {
        return $this;
    }

    public function offsetLeft(): int
    {
        return 0;
    }

    public function setOffsetLeft(int $offset): FrameInterface
    {
        return $this;
    }

    public function offsetTop(): int
    {
        return 0;
    }

    public function setOffsetTop(int $offset): FrameInterface
    {
        return $this;
    }
}
