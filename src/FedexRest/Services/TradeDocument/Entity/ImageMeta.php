<?php

namespace FedexRest\Services\TradeDocument\Entity;

class ImageMeta
{

    public string $imageType;
    public string $imageIndex;

    public function setImageType(string $imageType): ImageMeta
    {
        $this->imageType = $imageType;
        return $this;
    }

    public function setImageIndex(string $imageIndex): ImageMeta
    {
        $this->imageIndex = $imageIndex;
        return $this;
    }

    public function prepare(): array
    {
        return [
            'imageType' => $this->imageType,
            'imageIndex' => $this->imageIndex,
        ];
    }
}
