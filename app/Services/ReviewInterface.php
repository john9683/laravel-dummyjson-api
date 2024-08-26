<?php

namespace App\Services;

interface ReviewInterface
{
    /**
     * @param array $product
     * @param array $review
     * @return void
     */
    public function createReview(array $product, array $review): void;
}
