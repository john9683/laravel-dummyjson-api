<?php

namespace App\Interfaces;

interface ImageInterface
{
    /**
     * @param array $product
     * @param string $uri
     * @return void
     */
    public function createImage(array $product, string $uri): void;
}
