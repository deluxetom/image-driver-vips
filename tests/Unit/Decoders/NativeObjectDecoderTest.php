<?php

declare(strict_types=1);

namespace Intervention\Image\Drivers\Vips\Tests\Unit\Decoders;

use Intervention\Image\Drivers\Vips\Decoders\NativeObjectDecoder;
use Intervention\Image\Drivers\Vips\Driver;
use Intervention\Image\Image;
use Jcupitt\Vips\Image as VipsImage;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(NativeObjectDecoder::class)]
class NativeObjectDecoderTest extends TestCase
{
    protected NativeObjectDecoder $decoder;

    protected function setUp(): void
    {
        $this->decoder = new NativeObjectDecoder();
        $this->decoder->setDriver(new Driver());
    }

    public function testDecode(): void
    {
        $native = VipsImage::black(3, 2);
        $result = $this->decoder->decode($native);
        $this->assertInstanceOf(Image::class, $result);
        $this->assertEquals(3, $result->width());
        $this->assertEquals(2, $result->height());
    }
}
