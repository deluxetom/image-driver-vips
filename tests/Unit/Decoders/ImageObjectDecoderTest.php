<?php

declare(strict_types=1);

namespace Intervention\Image\Drivers\Vips\Tests\Unit\Decoders;

use PHPUnit\Framework\Attributes\CoversClass;
use Intervention\Image\Decoders\ImageObjectDecoder;
use Intervention\Image\Drivers\Vips\Tests\BaseTestCase;
use Intervention\Image\Image;

#[CoversClass(ImageObjectDecoder::class)]
final class ImageObjectDecoderTest extends BaseTestCase
{
    public function testDecode(): void
    {
        $decoder = new ImageObjectDecoder();
        $result = $decoder->decode($this->readTestImage('blue.gif'));
        $this->assertInstanceOf(Image::class, $result);
    }
}
