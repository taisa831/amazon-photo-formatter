<?php
require_once dirname(__FILE__) . '/../src/AmazonPhotoFormatter.php';

use amazonphotoformatter\AmazonPhotoFormatter;

class AmazonPhotoFormatterTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @expectedException InvalidArgumentException
     */
    public function test_construct_invalidargument()
    {
        $dir = 'text';
        Phake::partialMock(AmazonPhotoFormatter::class, $dir);
    }

    public function test_construct()
    {
        $dir = dirname(__FILE__);
        $amazonPhotoFormatter = Phake::partialMock(AmazonPhotoFormatter::class, $dir);
        Phake::verify($amazonPhotoFormatter, Phake::times(1))->setCurrentDir($dir);
        $currentDir = $amazonPhotoFormatter->getCurrentDir();
        $this->assertEquals($dir, $currentDir);
    }

    public function test_format()
    {
        $dir = dirname(__FILE__);
        $amazonPhotoFormatter = Phake::partialMock(AmazonPhotoFormatter::class, $dir);
        $amazonPhotoFormatter->format();

        Phake::verify($amazonPhotoFormatter, Phake::times(1))->createFormatDir();
        Phake::verify($amazonPhotoFormatter, Phake::times(1))->formatPictures();
    }
}