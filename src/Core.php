<?php

declare(strict_types=1);

namespace Intervention\Image\Drivers\Vips;

use ArrayIterator;
use Intervention\Image\Interfaces\CoreInterface;
use Intervention\Image\Interfaces\CollectionInterface;
use Intervention\Image\Interfaces\FrameInterface;
use IteratorAggregate;
use Jcupitt\Vips\Image as VipsImage;
use Traversable;

class Core implements CoreInterface, IteratorAggregate
{
    /**
     * Create new core instance
     *
     * @param VipsImage $vipsImage
     * @return void
     */
    public function __construct(protected VipsImage $vipsImage)
    {
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->toArray());
    }

    public function native(): mixed
    {
        return $this->vipsImage;
    }

    public function setNative(mixed $native): CoreInterface
    {
        $this->vipsImage = $native;

        return $this;
    }

    public function count(): int
    {
        return 1;
    }

    public function frame(int $position): FrameInterface
    {
        return $this->first();
    }

    public function add(FrameInterface $frame): CoreInterface
    {
    }

    public function loops(): int
    {
        return 0;
    }

    public function setLoops(int $loops): CoreInterface
    {
        return $this;
    }

    public function first(): FrameInterface
    {
        return new Frame($this->vipsImage);
    }

    public function has(int|string $key): bool
    {
        return (string) $key === '0';
    }

    public function push($item): CollectionInterface
    {
    }

    public function get(int|string $key, $default = null): mixed
    {
        return $this->has($key) ? $this->frame($key) : $default;
    }

    public function getAtPosition(int $key = 0, $default = null): mixed
    {
    }

    public function last(): FrameInterface
    {
        return $this->first();
    }

    public function empty(): CollectionInterface
    {
    }

    public function toArray(): array
    {
        $frames = [];

        foreach ($this as $frame) {
            $frames[] = $frame;
        }

        return $frames;
    }

    public function slice(int $offset, ?int $length = 0): CollectionInterface
    {
    }
}
