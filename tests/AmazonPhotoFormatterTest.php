<?php
require_once dirname(__FILE__) . '/../src/AmazonPhotoFormatter.php';

use AmazonPhotoFormatter\AmazonPhotoFormatter;

class AmazonPhotoFormatterTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @expectedException InvalidArgumentException
     */
    public function test_construct_invalid_argument()
    {
        new AmazonPhotoFormatter('a');
    }

    public function test_construct()
    {
        $dir = dirname(__FILE__);
        $amazonPhotoFormatter = $this->getMockBuilder(AmazonPhotoFormatter::class)
            ->setConstructorArgs([$dir])
            ->setMethods(null)
            ->getMock();
        $currentDir = $amazonPhotoFormatter->getCurrentDir();
        $this->assertEquals($dir, $currentDir);
    }

    public function test_format()
    {
        $amazonPhotoFormatter = $this->createPartialMock(AmazonPhotoFormatter::class, ['createFormatDir', 'formatPictures']);
        $amazonPhotoFormatter->expects($this->once())->method('createFormatDir');
        $amazonPhotoFormatter->expects($this->once())->method('formatPictures');
        $amazonPhotoFormatter->format();
    }
}