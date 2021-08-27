<?php


namespace Source\Support;


use CoffeeCode\Cropper\Cropper;

/**
 * Class Thumb
 * @package Source\Support
 */
class Thumb
{
    /**
     * @var Cropper
     */
    private Cropper $cropper;
    /**
     * @var string
     */
    private string $uploadPath;

    /**
     * Thumb constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->cropper = new Cropper(CONF_IMAGE_CACHE, CONF_IMAGE_QUALITY["jpg"], CONF_IMAGE_QUALITY["png"]);
        $this->uploadPath = CONF_UPLOAD_DIR;
    }

    /**
     * @param string $image
     * @param int $width
     * @param int $height
     * @return string
     */
    public function make(string $image, int $width, int $height = null): string
    {
        return $this->cropper->make("{$this->uploadPath}/{$image}", $width, $height);
    }

    /**
     * @param string|null $image
     */
    public function flush(string $image = null): void
    {
        if($image){
            $this->cropper->flush("{$this->uploadPath}/{$image}");
            return;
        }

        $this->cropper->flush();
    }

    /**
     * @return Cropper
     */
    public function getCropper(): Cropper
    {
        return $this->cropper;
    }
}
