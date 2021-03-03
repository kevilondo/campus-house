<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccomodationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accomodations', function (Blueprint $table) {
            $table->id();
            //$table->unsignedBigInteger('user_id')->nullable();
            $table->string('name');
            $table->string('address');
            $table->integer('rent');
            $table->string('room_type');

            /*$table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');*/

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
        Schema::dropIfExists('accomodations');
    }
}
