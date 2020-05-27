<?php

class ImageSizeRepository
{
    /**
     * @return ImageSize[]
     */
    public function getImageSizeList(): array
    {
        $raw = Db::getInstance()->select("SELECT * FROM image_size ORDER BY id");

        $dtoList = [];

        foreach ($raw as $item) {
            $imageSize = new ImageSize();
            $imageSize->setId($item['id']);
            $imageSize->setType($item['type']);
            $imageSize->setWidth($item['width']);
            $imageSize->setHeight($item['height']);
            $imageSize->setIsDisabledPc($item['is_disabled_pc']);
            $imageSize->setIsDisabledMobile($item['is_disabled_mobile']);

            $dtoList[] = $imageSize;
        }

        return $dtoList;
    }

    /**
     * @return ImageSize|null
     */
    public function getImageSizeByType(string $type): ?ImageSize
    {
        $raw = Db::getInstance()->selectWithParameters(
            "SELECT * FROM image_size WHERE type=:type",
            [':type' => $type]
        );

        if (!count($raw)) {
            return null;
        }

        $imageSize = new ImageSize();
        $imageSize->setId($raw[0]['id']);
        $imageSize->setType($raw[0]['type']);
        $imageSize->setWidth($raw[0]['width']);
        $imageSize->setHeight($raw[0]['height']);
        $imageSize->setIsDisabledPc($raw[0]['is_disabled_pc']);
        $imageSize->setIsDisabledMobile($raw[0]['is_disabled_mobile']);

        return $imageSize;
    }
}
