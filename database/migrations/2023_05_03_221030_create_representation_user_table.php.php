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
        Schema::create('representation_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('representation_id');
            $table->foreignId('user_id');


            $table->foreign('representation_id')
                  ->references('id')
                  ->on('representations')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('representation_user');
    }
};
