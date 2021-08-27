<?php


namespace Source\Support;


use CoffeeCode\Uploader\File;
use CoffeeCode\Uploader\Image;
use CoffeeCode\Uploader\Media;
use Source\Core\Message;

class Upload
{
    private Message $message;

    public function __construct()
    {
        $this->message = new Message();
    }

    public function image(array $image, string $name, int $width = CONF_IMAGE_SIZE): ?string
    {
        $upload = new Image(CONF_UPLOAD_DIR, CONF_UPLOAD_IMAGE_DIR);

        if (empty($image["type"]) || !in_array($image["type"], $upload::isAllowed())) {
            $this->message->error("Não é uma imagem válida.");
            return null;
        }

        try {

            $upload = $upload->upload($image, $name, $width);

        } catch (\Exception $e) {
            $this->message->error($e->getMessage());
            return null;
        }

        return $upload;
    }

    public function file(array $file, string $name): ?string
    {
        $upload = new File(CONF_UPLOAD_DIR, CONF_UPLOAD_FILE_DIR);

        if (empty($file["type"]) || !in_array($file["type"], $upload::isAllowed())) {
            $this->message->error("Não é um arquivo válido.");
            return null;
        }

        try {

            $upload = $upload->upload($file, $name);

        } catch (\Exception $e) {
            $this->message->error($e->getMessage());
            return null;
        }

        return $upload;
    }

    public function media(array $media, string $name): ?string
    {
        $upload = new Media(CONF_UPLOAD_DIR, CONF_UPLOAD_MEDIA_DIR);

        if (empty($media["type"]) || !in_array($media["type"], $upload::isAllowed())) {
            $this->message->error("Não é um arquivo de midia válido.");
            return null;
        }

        try {

            $upload = $upload->upload($media, $name);

        } catch (\Exception $e) {
            $this->message->error($e->getMessage());
            return null;
        }

        return $upload;
    }

    public function remove(string $filePath): bool
    {
        if (!file_exists($filePath) || !is_file($filePath)) {
            $this->message->error("Arquivo não encontrado");
            return false;
        }

        unlink($filePath);
        return true;
    }

    /**
     * @return Message
     */
    public function getMessage(): Message
    {
        return $this->message;
    }

}
