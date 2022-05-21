<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CategoryRelatioship extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->id();
            $table->renameColumn('parent_id', 'category_id');
            $table->unsignedBigInteger('category_id')->change();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('categories', function (Blueprint $table) {            
            $table->renameColumn('category_id','parent_id');
            $table->integer('category_id')->change();          
        });
    }
}
