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
		Schema::create('vehicles', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->foreignId('brand_id')->constrained();
            $table->foreignId('type_id')->constrained();
            $table->text('transmission');
			$table->integer('price')->default(0);
            $table->integer('capacity');
            $table->text('features');
            $table->integer('year');
            $table->double('star')->default(0);
            $table->integer('review')->default(0);
			$table->softDeletes();
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
		Schema::dropIfExists('items');
	}
};
