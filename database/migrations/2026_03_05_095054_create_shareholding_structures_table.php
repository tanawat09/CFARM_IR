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
        Schema::create('shareholding_structures', function (Blueprint $table) {
            $table->id();
            $table->string('shareholder_name_th');
            $table->string('shareholder_name_en')->nullable();
            $table->unsignedBigInteger('number_of_shares');
            $table->decimal('percentage', 5, 2);
            $table->date('as_of_date')->nullable();
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
        Schema::dropIfExists('shareholding_structures');
    }
};
