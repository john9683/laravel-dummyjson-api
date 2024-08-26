<?php

namespace App\Services;

use App\Models\Image;

class ImageService implements ImageInterface
{
    /**
     * @param array $product
     * @param string $uri
     * @return void
     */
    public function createImage(array $product, string $uri): void
    {
        $image = new Image([
            'product_id' => $product['id'],
            'uri' => $uri,
        ]);

        $image->save();
    }
}
