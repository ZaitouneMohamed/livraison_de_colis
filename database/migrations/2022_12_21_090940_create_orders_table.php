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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string("place_now")->nullable();
            $table->string("statue")->nullable();
            $table->string("ramasser_at")->nullable();
            $table->string("emballe_at")->nullable();
            $table->string("encours_at")->nullable();
            $table->string("livrée_at")->nullable();
            $table->string("anuller_at")->nullable();
            $table->string("retourner_at")->nullable();
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
        Schema::dropIfExists('orders');
    }
};
