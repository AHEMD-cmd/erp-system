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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('account_type_id')->constrained('account_types')->onDelete('cascade');
            $table->string('parent_account_number')->nullable();
            $table->string('account_number')->unique();
            $table->decimal('start_balance', 15, 2)->default(0);
            $table->decimal('current_balance', 15, 2)->nullable()->default(0);
            $table->unsignedBigInteger('other_table_FK')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('added_by')->nullable()->constrained('admins')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('admins')->onDelete('set null');
            $table->string('company_code');
            $table->date('date')->nullable();
            $table->boolean('active')->default(true);
            $table->boolean('is_parent')->default(false);
            $table->enum('start_balance_status', ['متزن', 'دائن', 'مدين'])->default('متزن');
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
        Schema::dropIfExists('accounts');
    }
};
