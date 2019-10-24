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
            $table->integer('user_id'); // Owner
            $table->integer('type_id'); // DPS, Sanchaypatra
            $table->integer('organization_id'); // DBBL, BD Bank, EBL
            $table->decimal('amount');
            $table->integer('duration')->comment('Year');
            $table->date('start_date');
            $table->date('mature_date');
            $table->integer('status_id')->default(1); // 1 = Running, 0 = Matured
            $table->integer('has_withdrawn')->default(0); // 1 = Yes, 0 = No
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
