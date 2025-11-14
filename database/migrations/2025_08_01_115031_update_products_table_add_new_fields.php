<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
    Schema::table('products', function (Blueprint $table) {
        $table->text('boxcontent')->nullable();
        $table->text('preorder')->nullable();
        $table->text('standardgrade')->nullable();

        $table->unsignedBigInteger('series_id')->nullable();
        $table->unsignedBigInteger('product_type_id')->nullable();
        $table->unsignedBigInteger('featuredin_id')->nullable();
        $table->unsignedBigInteger('character_id')->nullable();
        $table->unsignedBigInteger('company_id')->nullable();
        $table->unsignedBigInteger('scale_id')->nullable();
        $table->unsignedBigInteger('size_id')->nullable();
    });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['boxcontent', 'preorder', 'standardgrade']);
            $table->dropForeign(['series_id']);
            $table->dropForeign(['product_type_id']);
            $table->dropForeign(['featuredin_id']);
            $table->dropForeign(['character_id']);
            $table->dropForeign(['company_id']);
            $table->dropForeign(['scale_id']);
            $table->dropForeign(['size_id']);
            $table->dropColumn([
                'series_id', 'product_type_id', 'featuredin_id', 
                'character_id', 'company_id', 'scale_id', 'size_id'
            ]);
        });
    }
};
