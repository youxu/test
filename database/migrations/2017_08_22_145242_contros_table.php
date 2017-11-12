<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ControsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('controller', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('compose_id')->comment('组件ID');
            $table->integer('controller_id')->default('0')->comment('控制器ID');
            $table->string('func_name',40)->comment('类或方法代码名称');
            $table->string('func_name_cn',40)->comment('类或方法注释');
            $table->tinyInteger('is_menu')->default('0')->comment('是否为栏目');
            $table->tinyInteger('is_right')->default('1')->comment('是否为权限');
            $table->integer('order_num')->default('0')->comment('排序');
            $table->string('icon',40)->comment('图标');
            $table->integer('permission_id')->comment('权限id');
            $table->string('active',255)->comment('菜单高亮地址');
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
		Schema::drop('controller');
	}

}
