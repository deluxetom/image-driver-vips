<?php

declare(strict_types=1);

namespace Intervention\Image\Drivers\Vips;

use Intervention\Image\Drivers\AbstractDriver;
use Intervention\Image\Exceptions\DriverException;
use Intervention\Image\Interfaces\ImageInterface;
use Intervention\Image\Interfaces\ColorInterface;
use Intervention\Image\Interfaces\ColorspaceInterface;
use Intervention\Image\Interfaces\ColorProcessorInterface;
use Intervention\Image\Interfaces\FontProcessorInterface;

class Driver extends AbstractDriver
{
    /**
     * {@inheritdoc}
     *
     * @see DriverInterface::id()
     */
    public function id(): string
    {
        return 'vips';
    }

    /**
     * {@inheritdoc}
     *
     * @see DriverInterface::createImage()
     */
    public function createImage(int $width, int $height): ImageInterface
    {
    }

    /**
     * {@inheritdoc}
     *
     * @see DriverInterface::createAnimation()
     */
    public function createAnimation(callable $init): ImageInterface
    {
    }

    /**
     * {@inheritdoc}
     *
     * @see DriverInterface::handleInput()
     */
    public function handleInput(mixed $input, array $decoders = []): ImageInterface|ColorInterface
    {
        return (new InputHandler($this->specializeMultiple($decoders)))->handle($input);
    }

    /**
     * {@inheritdoc}
     *
     * @see DriverInterface::colorProcessor()
     */
    public function colorProcessor(ColorspaceInterface $colorspace): ColorProcessorInterface
    {
    }

    /**
     * {@inheritdoc}
     *
     * @see DriverInterface::fontProcessor()
     */
    public function fontProcessor(): FontProcessorInterface
    {
    }

    /**
     * {@inheritdoc}
     *
     * @see DriverInterface::checkHealth()
     */
    public function checkHealth(): void
    {
        if (!extension_loaded('ffi') && !extension_loaded('vips')) {
            throw new DriverException(
                'PHP extension FFI or VIPS must be enabled to use this driver.'
            );
        }
    }
}
