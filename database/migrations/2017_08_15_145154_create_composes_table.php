<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComposesTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('composes', function(Blueprint $table) {
            $table->increments('id');
            $table->string('cn_name',100)->comment('中文名称');
            $table->string('en_name',100)->comment('英文名称');
            $table->integer('order_num')->comment('排序');
            $table->tinyInteger('status')->default(1)->comment('是否有效');
            $table->tinyInteger('is_show')->default(1)->comment('是否显示');
            $table->integer('created_at')->comment('创建时间');
            $table->integer('updated_at')->comment('更新时间');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('composes');
	}

}
