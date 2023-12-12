<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()  //where we create the table and add col ..
    {
        Schema::create('todos', function (Blueprint $table) {
            $table->id();
            $table->longText('title');
            $table->boolean('is_completed')->default(0); // 0=not completed and 1 =  completed.

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
        Schema::dropIfExists('todos');
    }
}
