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
        Schema::create('revenue_structures', function (Blueprint $table) {
            $table->id();
            $table->string('title_th');
            $table->string('title_en')->nullable();
            $table->text('description_th')->nullable();
            $table->text('description_en')->nullable();
            $table->integer('percentage')->default(0);
            $table->string('icon_class')->nullable();
            $table->string('color')->nullable();
            $table->integer('order')->default(0);
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
        Schema::dropIfExists('revenue_structures');
    }
};
