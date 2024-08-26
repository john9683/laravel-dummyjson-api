<?php

use App\Models\Image;
use App\Models\Review;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('category')->nullable();
            $table->decimal('price')->nullable();
            $table->decimal('discount_percentage')->nullable();
            $table->decimal('rating')->nullable();
            $table->integer('stock')->nullable();
            $table->json('tags')->nullable();
            $table->string('brand')->nullable();
            $table->string('sku')->nullable();
            $table->decimal('weight')->nullable();
            $table->json('dimensions')->nullable();
            $table->string('warranty_information')->nullable();
            $table->string('shipping_information')->nullable();
            $table->string('availability_status')->nullable();
            $table->string('return_policy')->nullable();
            $table->integer('minimum_order_quantity')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('barcode')->nullable();
            $table->string('qr_code')->nullable();
            $table->string('thumbnail')->nullable();
        });
    }

    /**
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}

