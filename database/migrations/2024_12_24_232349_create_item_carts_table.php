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
        Schema::create('item_cards', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('name');
            $table->string('item_type');
            $table->unsignedBigInteger('item_card_category_id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->boolean('does_has_retail_unit');
            $table->unsignedBigInteger('retail_uom_id')->nullable();
            $table->unsignedBigInteger('uom_id');
            $table->decimal('retail_uom_qty_to_parent', 10, 2)->nullable();
            $table->unsignedBigInteger('added_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->boolean('active')->default(true);
            $table->date('date');
            $table->string('company_code');
            $table->string('item_code')->unique();
            $table->string('barcode')->unique();
            $table->decimal('qty', 15, 3)->nullable();
            $table->decimal('qty_retail', 15, 3)->nullable();
            $table->decimal('all_qty_in_retail', 15, 3)->nullable();
            $table->decimal('cost_price', 15, 2)->nullable(); // Added cost_price
            $table->decimal('price', 15, 2)->nullable(); // Added price
            $table->decimal('nos_gomla_price', 15, 2)->nullable(); // Added nos_gomla_price
            $table->decimal('gomla_price', 15, 2)->nullable(); // Added gomla_price
            $table->decimal('cost_price_retail', 15, 2)->nullable(); // Added cost_price_retail
            $table->decimal('price_retail', 15, 2)->nullable(); // Added price_retail
            $table->decimal('nos_gomla_price_retail', 15, 2)->nullable(); // Added nos_gomla_price_retail
            $table->decimal('gomla_price_retail', 15, 2)->nullable(); // Added gomla_price_retail
            $table->boolean('has_fixed_price')->default(false); // Added has_fixed_price
            $table->string('photo')->nullable(); // Added photo field

            $table->timestamps();
            
            // Foreign keys
            $table->foreign('item_card_category_id')->references('id')->on('item_card_categories');
            $table->foreign('parent_id')->references('id')->on('item_cards');
            $table->foreign('retail_uom_id')->references('id')->on('uoms');
            $table->foreign('uom_id')->references('id')->on('uoms');
            $table->foreign('added_by')->references('id')->on('admins');
            $table->foreign('updated_by')->references('id')->on('admins');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_cards');
    }
};
