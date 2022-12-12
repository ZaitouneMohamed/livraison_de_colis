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
            $table->integer("livreur_id")->unsigned()->nullable();
            $table->integer("admin_id")->unsigned()->nullable();
            $table->string("statue")->default("nouveau");
            $table->time("admin_at")->nullable();
            $table->time("livreur_at")->nullable();
            $table->time("ramasser_at")->nullable();
            $table->time("emballe_at")->nullable();
            $table->time("encours_at")->nullable();
            $table->time("livrée_at")->nullable();
            $table->time("anuller_at")->nullable();
            $table->time("retourner_at")->nullable();
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
