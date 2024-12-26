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
    Schema::create('stores', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->boolean('active');
        $table->date('date');
        $table->string('company_code');
        
        $table->foreignId('added_by')->nullable()->constrained('admins')->onDelete('set null');
        $table->foreignId('updated_by')->nullable()->constrained('admins')->onDelete('set null');
        
        $table->string('phone');
        $table->string('address');
        $table->timestamps();
        
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
    }
};
