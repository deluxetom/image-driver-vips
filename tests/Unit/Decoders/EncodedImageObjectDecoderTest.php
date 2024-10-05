<?php

declare(strict_types=1);

namespace Intervention\Image\Drivers\Vips\Tests\Unit\Decoders;

use Intervention\Image\Drivers\Vips\Decoders\EncodedImageObjectDecoder;
use Intervention\Image\Drivers\Vips\Driver;
use Intervention\Image\Drivers\Vips\Tests\BaseTestCase;
use Intervention\Image\EncodedImage;
use Intervention\Image\Image;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(EncodedImageObjectDecoder::class)]
class EncodedImageObjectDecoderTest extends BaseTestCase
{
    protected EncodedImageObjectDecoder $decoder;

    protected function setUp(): void
    {
        $this->decoder = new EncodedImageObjectDecoder();
        $this->decoder->setDriver(new Driver());
    }

    public function testDecode(): void
    {
        $result = $this->decoder->decode(new EncodedImage($this->getTestResourceData()));
        $this->assertInstanceOf(Image::class, $result);
    }
}
