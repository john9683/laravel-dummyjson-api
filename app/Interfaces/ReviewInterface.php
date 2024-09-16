<?php

namespace App\Interfaces;

interface ReviewInterface
{
    /**
     * @param array $product
     * @param array $review
     * @return void
     */
    public function createReview(array $product, array $review): void;
}
