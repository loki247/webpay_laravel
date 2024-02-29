<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos.payments', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("session_id");
            $table->float("total", 9, 2);
            $table->tinyInteger("status")->default(1)->comment("1: Pendiente, 2: Aprobada");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
