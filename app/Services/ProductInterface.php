<?php

namespace App\Services;

use App\Models\Product;

interface ProductInterface
{
    /**
     * @param array $response
     * @param string $title
     * @return array
     */
    public function filterProduct(array $response, string $title): array;

    /**
     * @param array $productArray
     * @param ImageService $imageService
     * @param ReviewService $reviewService
     * @return Product[]
     */
    public function createProductFromArray(
        array $productArray,
        ImageService $imageService,
        ReviewService $reviewService
    ): array;
}
