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
        Schema::create('tbproject', function (Blueprint $table) {
            $table->id('projectid')->autoIncrement();
            $table->tinyInteger('category');
            $table->foreignId('pic');
            $table->foreignId('materialid');
            $table->date('target');
            $table->decimal('progres', 5, 2);
            $table->string('remark')->nullable();
            $table->tinyInteger('status');
            $table->integer('qtytotal');
            $table->integer('qtyprogress');
            $table->decimal('materialprogress', 5, 2);
            $table->string('opadd', 50)->nullable();
            $table->string('pcadd', 20)->nullable();
            $table->timestamp('tgladd');
            $table->string('opedit', 50)->nullable();
            $table->string('pcedit', 20)->nullable();
            $table->timestamp('tgledit');
            $table->boolean('dlt')->default('0')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbproject');
    }
};
