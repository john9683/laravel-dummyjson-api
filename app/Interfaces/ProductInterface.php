<?php

namespace App\Interfaces;

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
     * @param ImageInterface $imageService
     * @param ReviewInterface $reviewService
     * @return Product[]
     */
    public function createProductFromArray(
        array $productArray,
        ImageInterface $imageService,
        ReviewInterface $reviewService
    ): array;

    /**
     * @param int $productId
     * @return void
     */
    public function deleteProductIfExist(int $productId): void;

    /**
     * @param array $attributes
     * @return Product
     */
    public function createProduct(array $attributes): Product;
}
