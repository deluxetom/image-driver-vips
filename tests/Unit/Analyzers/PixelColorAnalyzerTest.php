<?php

declare(strict_types=1);

namespace Intervention\Image\Drivers\Vips\Tests\Unit\Analyzers;

use Intervention\Image\Drivers\Vips\Analyzers\PixelColorAnalyzer;
use Intervention\Image\Drivers\Vips\Driver;
use Intervention\Image\Drivers\Vips\Tests\BaseTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Intervention\Image\Interfaces\ColorInterface;

#[CoversClass(PixelColorAnalyzer::class)]
final class PixelColorAnalyzerTest extends BaseTestCase
{
    public function testAnalyze(): void
    {
        $image = $this->readTestImage('tile.png');
        $analyzer = new PixelColorAnalyzer(0, 0);
        $analyzer->setDriver(new Driver());
        $result = $analyzer->analyze($image);
        $this->assertInstanceOf(ColorInterface::class, $result);
        $this->assertEquals('b4e000', $result->toHex());
    }
}