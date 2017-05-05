<?php

<<<<<<< HEAD
use Illuminate\Support\Facades\Schema;
=======
>>>>>>> f87259c8f0a22fc60bf3c85dc0ec1809fb92c25c
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasswordResetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
<<<<<<< HEAD
            $table->string('token');
            $table->timestamp('created_at')->nullable();
=======
            $table->string('token')->index();
            $table->timestamp('created_at');
>>>>>>> f87259c8f0a22fc60bf3c85dc0ec1809fb92c25c
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
<<<<<<< HEAD
        Schema::dropIfExists('password_resets');
=======
        Schema::drop('password_resets');
>>>>>>> f87259c8f0a22fc60bf3c85dc0ec1809fb92c25c
    }
}
