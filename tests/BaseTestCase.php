<?php

declare(strict_types=1);

namespace Intervention\Image\Drivers\Vips\Tests;

use PHPUnit\Framework\TestCase;

abstract class BaseTestCase extends TestCase
{
    public static function getTestResourcePath($filename = 'test.jpg'): string
    {
        return sprintf('%s/resources/%s', __DIR__, $filename);
    }

    public static function getTestResourceData($filename = 'test.jpg'): string
    {
        return file_get_contents(self::getTestResourcePath($filename));
    }
}
