<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('showtime_id');
            $table->integer('reservation_id');
            $table->string('fullname',100);
            $table->string('idnumber',100);
            $table->string('phone',100);
            $table->string('email',100);
            $table->string('seat',100);
            $table->string('price',100);
            $table->text('price_detail');
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
        Schema::dropIfExists('sales');
    }
}
