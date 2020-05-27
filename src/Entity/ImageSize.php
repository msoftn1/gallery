<?php

class ImageSize
{
    private int $id;
    private string $type;
    private int $width;
    private int $height;
    private bool $isDisabledPc;
    private bool $isDisabledMobile;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @param int $width
     */
    public function setWidth(int $width): void
    {
        $this->width = $width;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @param int $height
     */
    public function setHeight(int $height): void
    {
        $this->height = $height;
    }

    /**
     * @return bool
     */
    public function isDisabledPc(): bool
    {
        return $this->isDisabledPc;
    }

    /**
     * @param bool $isDisabledPc
     */
    public function setIsDisabledPc(bool $isDisabledPc): void
    {
        $this->isDisabledPc = $isDisabledPc;
    }

    /**
     * @return bool
     */
    public function isDisabledMobile(): bool
    {
        return $this->isDisabledMobile;
    }

    /**
     * @param bool $isDisabledMobile
     */
    public function setIsDisabledMobile(bool $isDisabledMobile): void
    {
        $this->isDisabledMobile = $isDisabledMobile;
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'width' => $this->width,
            'height' => $this->height,
            'is_disabled_pc' => $this->isDisabledPc,
            'is_disabled_mobile' => $this->isDisabledMobile,
        ];
    }
}
