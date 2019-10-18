<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSavingsTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('savings_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('type_id');
            $table->integer('organization_id');
            $table->decimal('amount');
            $table->integer('duration')->comment('Year');
            $table->date('start_date')->useCurrent();
            $table->date('mature_date');
            $table->integer('status_id');
            $table->integer('has_withdrawn');
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
        Schema::dropIfExists('savings_transactions');
    }
}
