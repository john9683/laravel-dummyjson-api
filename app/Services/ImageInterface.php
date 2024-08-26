<?php

namespace App\Services;

interface ImageInterface
{
    /**
     * @param array $product
     * @param string $uri
     * @return void
     */
    public function createImage(array $product, string $uri): void;
}
