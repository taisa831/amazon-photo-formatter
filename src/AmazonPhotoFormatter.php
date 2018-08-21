<?php
namespace amazonphotoformatter;

class AmazonPhotoFormatter
{
    private $currentDir;

    public function __construct($currentDir)
    {
        if (is_dir($currentDir) === false) throw new \InvalidArgumentException();
        $this->setCurrentDir($currentDir);
    }

    public function format()
    {
        $this->createFormatDir();
        $this->formatPictures();
    }

    public function createFormatDir()
    {
        if (file_exists('format') === false) {
            mkdir('format');
        }
    }

    public function formatPictures()
    {
        foreach(glob($this->getCurrentDir() . '/{*.jpeg,*.jpg}', GLOB_BRACE) as $fileName) {

            if (is_file($fileName) === false) continue;

            $photoImg = file_get_contents($fileName);
            $ext = substr($fileName, strrpos($fileName, '.') + 1);
            $exif = @exif_read_data($fileName);

            $dateTime = new \DateTime($exif['DateTimeOriginal']);
            $formatFileName = $dateTime->format('Y-m-d_H-i-s');

            file_put_contents('./format/' . $formatFileName . '.' . $ext, $photoImg);
        }
    }

    /**
     * @return mixed
     */
    public function getCurrentDir()
    {
        return $this->currentDir;
    }

    /**
     * @param mixed $currentDir
     */
    public function setCurrentDir($currentDir)
    {
        $this->currentDir = $currentDir;
    }
}