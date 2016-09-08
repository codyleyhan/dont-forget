<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->increments('id');
						$table->integer('user_id')->unsigned()->index();
						$table->integer('category_id')->unsigned()->index();
						$table->string('name');
						$table->string('meal_time');
						$table->text('description');
						$table->boolean('in_list')->default(false);
						$table->integer('num_of_people')->nullable();
						$table->integer('prep_time')->unsigned();
						$table->integer('cook_time')->unsigned();
            $table->timestamps();
        });

				Schema::table('recipes', function($table) {
					$table->foreign('user_id')
						->references('id')->on('users')
						->onDelete('cascade');
					$table->foreign('category_id')
						->references('id')->on('categories')
						->onDelete('cascade');
				});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('recipes');
    }
}
