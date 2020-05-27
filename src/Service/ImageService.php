<?php

class ImageService
{
    /**
     * @param string $from
     * @param string $to
     * @param int $setWidth
     * @param int $setHeight
     *
     * @throws ImageException
     */
    public function resize(string $from, string $to, int $setWidth, int $setHeight): void
    {
        try {
            list($width, $height, $type) = @getimagesize($from);

            if ($type == IMAGETYPE_JPEG) {
                $src = imagecreatefromjpeg($from);
            } elseif ($type == IMAGETYPE_GIF) {
                $src = imagecreatefromgif($from);
            } elseif ($type == IMAGETYPE_PNG) {
                $src = imagecreatefrompng($from);
            }
            else {
                throw new RuntimeException('Формат не поддерживается.');
            }

            $r = $width / $height;

            if ($setWidth / $setHeight > $r) {
                $newWidth = $setHeight * $r;
                $newHeight = $setHeight;
            } else {
                $newHeight = $setWidth / $r;
                $newWidth = $setWidth;
            }

            $dst = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

            imagejpeg($dst, $to, 75);
        }
        catch (Exception $e) {
            throw new ImageException("Ошибка изменения размера изображения.", 0, $e);
        }
    }
}
