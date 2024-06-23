<?php

declare(strict_types=1);

namespace Intervention\Image\Drivers\Vips;

use Intervention\Image\Interfaces\CollectionInterface;
use Intervention\Image\Interfaces\CoreInterface;
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

    /**
     * {@inheritdoc}
     *
     * @see CoreInterface::native()
     */
    public function native(): mixed
    {
        return $this->vipsImage;
    }

    /**
     * {@inheritdoc}
     *
     * @see CoreInterface::setNative()
     */
    public function setNative(mixed $native): CoreInterface
    {
        $this->vipsImage = $native;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @see CoreInterface::count()
     */
    public function count(): int
    {
        return $this->vipsImage->getType('n-pages') === 0 ? 1 : $this->vipsImage->get('n-pages');
    }

    /**
     * {@inheritdoc}
     *
     * @see CoreInterface::frame()
     */
    public function frame(int $position): FrameInterface
    {
        // $images[] = $image->extract_area(0, $i * $pageHeight, $image->width, $pageHeight);
        // $image->extract_area(0, $i * $pageHeight, $image->width, $pageHeight);

    }

    public function add(FrameInterface $frame): CoreInterface
    {
    }

    public function loops(): int
    {
    }

    public function setLoops(int $loops): CoreInterface
    {
    }

    public function first(): FrameInterface
    {
    }

    public function last(): FrameInterface
    {
    }

    public function has(int|string $key): bool
    {
    }

    public function push($item): CollectionInterface
    {
    }

    public function get(int|string $key, $default = null): mixed
    {
    }

    public function getAtPosition(int $key = 0, $default = null): mixed
    {
    }

    public function empty(): CollectionInterface
    {
    }

    public function toArray(): array
    {
    }

    public function slice(int $offset, ?int $length = 0): CollectionInterface
    {
    }

    public function getIterator(): Traversable
    {
    }
}
