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
            Schema::table('settings', function (Blueprint $table) {
                $table->unsignedBigInteger('customer_parent_account_number')->nullable(); // Add the column
                $table->foreign('customer_parent_account_number') // Add the foreign key constraint
                    ->references('parent_account_number') // Reference the 'parent_account_number' field
                    ->on('accounts')
                    ->onDelete('set null') // Optional: handle deletion of referenced accounts
                    ->onUpdate('cascade'); // Optional: handle updates of referenced accounts
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropForeign(['customer_parent_account_number']); // Drop the foreign key constraint
            $table->dropColumn('customer_parent_account_number'); // Drop the column
        });
    }
};
