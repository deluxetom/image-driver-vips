<?php

declare(strict_types=1);

namespace Intervention\Image\Drivers\Vips\Modifiers;

use Intervention\Image\Drivers\DriverSpecialized;
use Intervention\Image\Interfaces\ImageInterface;
use Intervention\Image\Interfaces\ModifierInterface;
use Intervention\Image\Interfaces\SizeInterface;

/**
 * @property null|int $width
 * @property null|int $height
 */
class ResizeModifier extends DriverSpecialized implements ModifierInterface
{
    /**
     * {@inheritdoc}
     *
     * @see ModifierInterface::apply()
     */
    public function apply(ImageInterface $image): ImageInterface
    {
        $resizeTo = $this->getAdjustedSize($image);

        $image->core()->setNative(
            $image->core()->native()->thumbnail_image($resizeTo->width(), [
                'height' => $resizeTo->height(),
                'size'   => 'force',
            ])
        );

        return $image;
    }

    /**
     * @throws RuntimeException
     */
    protected function getAdjustedSize(ImageInterface $image): SizeInterface
    {
        return $image->size()->resize($this->width, $this->height);
    }
}
