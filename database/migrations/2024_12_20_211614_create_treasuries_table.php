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
        Schema::create('treasuries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('is_master')->default(0);
            $table->boolean('active')->default(0);
            $table->integer('last_isal_exchange');
            $table->integer('last_isal_collect');
            $table->integer('added_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('company_code')->nullable();
            $table->date('date');
            $table->unsignedBigInteger('parent_id')->nullable(); 
            $table->timestamps();

            
            $table->foreign('parent_id')->references('id')->on('treasuries')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('treasuries');
    }
};
