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
        Schema::create('representations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('show_id');
            $table->datetime('when');
            $table->foreignId('location_id')->nullable();

            $table->foreign('location_id')
                  ->references('id')
                  ->on('locations')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
            $table->foreign('show_id')
                  ->references('id')
                  ->on('shows')
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
        Schema::dropIfExists('representations');
    }
};
