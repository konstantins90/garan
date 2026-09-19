<?php

declare(strict_types=1);

namespace Smetana\Garant\Model\Label;

class LabelData
{
    public function __construct(
        private readonly float $duration,
        private readonly string $brand,
        private readonly string $modelId,
        private readonly int $productId
    ) {
    }

    public function getDuration(): float
    {
        return $this->duration;
    }

    public function getDurationDisplay(): string
    {
        if (abs($this->duration - round($this->duration)) < 0.001) {
            return (string)(int)round($this->duration);
        }

        return number_format($this->duration, 1, ',', '');
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function getModelId(): string
    {
        return $this->modelId;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function toArray(): array
    {
        return [
            'duration' => $this->duration,
            'duration_display' => $this->getDurationDisplay(),
            'brand' => $this->brand,
            'model_id' => $this->modelId,
            'product_id' => $this->productId,
        ];
    }
}
