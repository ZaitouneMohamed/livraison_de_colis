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
            $table->string("total")->nullable();
            $table->string('note')->nullable();
            $table->integer("user_id")->unsigned();
            $table->integer("B_liv_id")->unsigned()->nullable();
            $table->integer("B_ram_id")->unsigned()->nullable();
            $table->integer("B_dis_id")->unsigned()->nullable();
            $table->integer("B_pay_id")->unsigned()->nullable();
            $table->integer("B_ret_id")->unsigned()->nullable();
            $table->integer("livreur_id")->unsigned()->nullable();
            $table->integer("admin_id")->unsigned()->nullable();
            $table->integer("order_id")->unsigned()->nullable();
            $table->string("statue")->default("nouveau");
            $table->string("admin_at")->nullable();
            $table->string("livreur_at")->nullable();
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
