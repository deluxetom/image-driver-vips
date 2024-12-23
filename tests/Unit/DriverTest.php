<?php

declare(strict_types=1);

namespace Intervention\Image\Drivers\Vips\Tests\Unit;

use Intervention\Image\Colors\Rgb\Colorspace;
use Intervention\Image\Drivers\Vips\Driver;
use Intervention\Image\Drivers\Vips\Tests\BaseTestCase;
use Intervention\Image\Image;
use Intervention\Image\Interfaces\ColorProcessorInterface;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Driver::class)]
class DriverTest extends BaseTestCase
{
    protected Driver $driver;

    public function setUp(): void
    {
        $this->driver = new Driver();
    }

    public function testId(): void
    {
        $this->assertEquals('vips', $this->driver->id());
    }

    public function testCreateImage(): void
    {
        $image = $this->driver->createImage(3, 2);
        $this->assertInstanceOf(Image::class, $image);
        $this->assertEquals(3, $image->width());
        $this->assertEquals(2, $image->height());
    }

    public function testColorProcessor(): void
    {
        $result = $this->driver->colorProcessor(new Colorspace());
        $this->assertInstanceOf(ColorProcessorInterface::class, $result);
    }
}
