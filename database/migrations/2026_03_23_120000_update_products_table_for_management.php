<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'category_id')) {
                $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            }

            if (!Schema::hasColumn('products', 'sku')) {
                $table->string('sku')->nullable();
            }

            if (!Schema::hasColumn('products', 'sale_price')) {
                $table->decimal('sale_price', 12, 2)->nullable();
            }

            if (!Schema::hasColumn('products', 'description')) {
                $table->text('description')->nullable();
            }

            if (!Schema::hasColumn('products', 'image')) {
                $table->string('image')->nullable();
            }

            if (!Schema::hasColumn('products', 'is_active')) {
                $table->boolean('is_active')->default(true);
            }

            if (!Schema::hasColumn('products', 'is_delete')) {
                $table->boolean('is_delete')->default(false);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'category_id')) {
                $table->dropConstrainedForeignId('category_id');
            }

            $dropColumns = [];
            foreach (['sku', 'sale_price', 'description', 'image', 'is_active', 'is_delete'] as $column) {
                if (Schema::hasColumn('products', $column)) {
                    $dropColumns[] = $column;
                }
            }

            if (!empty($dropColumns)) {
                $table->dropColumn($dropColumns);
            }
        });
    }
};
