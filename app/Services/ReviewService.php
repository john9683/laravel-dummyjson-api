<?php

namespace App\Services;

use App\Interfaces\ReviewInterface;
use App\Models\Review;

class ReviewService implements ReviewInterface
{
    /**
     * @param array $product
     * @param array $review
     * @return void
     */
    public function createReview(array $product, array $review): void
    {
        $review = new Review([
            'product_id' => $product['id'],
            'rating' => $review['rating'],
            'comment' => $review['comment'],
            'reviewer_name' => $review['reviewerName'],
            'reviewer_email' => $review['reviewerEmail'],
            'date' => $review['date'],
        ]);
        $review->save();
    }
}
