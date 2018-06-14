<?php
/**
 * Created by PhpStorm.
 * User: conghoan
 * Date: 6/13/18
 * Time: 06:07
 */

namespace Joan\ImageChecker;
class ImageChecker
{
    private $path;
    private $tmp_path = '';
    public  $version;

    function __construct($source)
    {
        $this->path = $this->getFile($source);
        $this->setVersion();
    }

    public function detect()
    {
        if ($this->isGif()) {
            return 'gif';
        } elseif ($this->isPNG()) {
            return 'png';
        } else {
            return '';
        }
    }

    public function getFile($source)
    {
        //Neu la file o local
        if (is_file($source)) {
            return $source;
        } else {
            return $this->download($source);
        }
    }

    public function download($source)
    {
        try {
            $dir      = __DIR__ . '/../tmp';
            $basename = pathinfo($source, PATHINFO_BASENAME);
            $path     = $dir . '/' . $basename;
            file_put_contents($path, file_get_contents($source));
            $this->tmp_path = $path;
            return $path;
        } catch (\Exception $exception) {
            throw new \Exception('Can not download file from ' . $source);
        }
    }

    public function setVersion()
    {
        $image_file = $this->path;
        if (!$fp = fopen($image_file, 'rb')) return 0;

        if (!$data = fread($fp, 20)) return 0;

        $header_format = 'A6version';

        $header        = unpack($header_format, $data);
        $ver           = $header['version'];
        $this->version = $ver;
    }

    // Các hàm check định dạng file
    // https://digital-forensics.sans.org/media/hex_file_and_regex_cheat_sheet.pdf

    public function isGif()
    {

        return ($this->version == 'GIF87a' || $this->version == 'GIF89a') ? true : false;
    }

    public function isPng()
    {
        if (strpos($this->version, 'PNG') !== false) {
            return true;
        }
        return false;
    }

    public function __destruct()
    {
        if (is_file($this->tmp_path)) {
            @unlink($this->tmp_path);
        }
    }

}