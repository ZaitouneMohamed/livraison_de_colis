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
        Schema::create('colis', function (Blueprint $table) {
            $table->id();
            $table->string('destinataire');
            $table->string('telephone');
            $table->string('ville');
            $table->string('prix');
            $table->string('adresse');
            $table->string('products');
            $table->string('note')->nullable();
            $table->integer("user_id")->unsigned();
            $table->integer("livraison_id")->unsigned()->nullable();
            $table->integer("B_ram_id")->unsigned()->nullable();
            $table->integer("B_dis_id")->unsigned()->nullable();
            $table->integer("B_pay_id")->unsigned()->nullable();
            $table->integer("B_ret_id")->unsigned()->nullable();
            $table->integer("order_id")->unsigned()->nullable();
            $table->string("statue")->default("nouveau");
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
        Schema::dropIfExists('colis');
    }
};
