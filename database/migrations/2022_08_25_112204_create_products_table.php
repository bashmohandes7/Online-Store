<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->float('price')->default(0);
            $table->float('rating')->default(0);
            $table->float('compare_price')->nullable();
            $table->string('image')->nullable();
            $table->json('options')->nullable();
            $table->enum('status', ['active', 'draft', 'archived'])->default('active');
            $table->boolean('featured')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('store_id')->constrained('stores')->cascadeOnDelete();
            $table->foreignId('category_id')->nullable()->constrained('categories')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
