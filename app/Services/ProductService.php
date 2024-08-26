<?php

namespace App\Services;

use App\Models\Product;

class ProductService implements ProductInterface
{
    /**
     * @param array $response
     * @param string $title
     * @return array
     */
    public function filterProduct(array $response, string $title): array
    {
        $response = json_decode(json_encode($response["products"]), true);

        $productsArray = [];
        foreach ($response as $product) {
            if (str_contains($product['title'], $title)) {
                $productsArray[] = $product;
            }
        }
        return $productsArray;
    }

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
    ): array {
        $productObjectArray = [];

        foreach ($productArray as $product) {
            $this->deleteProductIfExist($product['id']);

            $productObject = $this->createProduct($product);
            $productObjectArray[] = $productObject;

            foreach ($product['images'] as $uri => $value) {
                $imageService->createImage($product, $value);
            }

            foreach ($product['reviews'] as $review) {
                $reviewService->createReview($product, $review);
            }
        }

        return $productObjectArray;
    }

    /**
     * @param int $productId
     * @return void
     */
    private function deleteProductIfExist(int $productId): void
    {
        $productExist = Product::find($productId);

        if ($productExist) {

            foreach($productExist->images as $image) {
                $image->delete();
            }

            foreach( $productExist->reviews as $review) {
                $review->delete();
            }

            $productExist->delete();
        }
    }

    /**
     * @param array $attributes
     * @return Product
     */
    private function createProduct(array $attributes): Product
    {
        $product = new Product([
            'id' => $attributes['id'],
            'title' => $attributes['title'],
            'description' =>  $attributes['description'],
            'category' =>  $attributes['category'],
            'price' =>  $attributes['price'],
            'discount_percentage' =>  $attributes['discountPercentage'],
            'rating' =>  $attributes['rating'],
            'stock' =>  $attributes['stock'],
            'tags' =>  json_encode($attributes['tags']),
            'brand' =>  $attributes['brand'],
            'sku' =>  $attributes['sku'],
            'weight' =>  $attributes['weight'],
            'dimensions' =>  json_encode($attributes['dimensions']),
            'warranty_information' =>  $attributes['warrantyInformation'],
            'shipping_information' =>  $attributes['shippingInformation'],
            'availability_status' =>  $attributes['availabilityStatus'],
            'return_policy' =>  $attributes['returnPolicy'],
            'minimum_order_quantity' =>  $attributes['minimumOrderQuantity'],
            'created_at' =>  $attributes['meta']['createdAt'],
            'updated_at' =>  $attributes['meta']['updatedAt'],
            'barcode' =>  $attributes['meta']['barcode'],
            'qr_code' =>  $attributes['meta']['qrCode'],
            'thumbnail' =>  $attributes['thumbnail'],
        ]);

        $product->save();

        return $product;
    }
}
