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
        Schema::create('governance_sections', function (Blueprint $table) {
            $table->id();
            $table->string('section_key')->unique(); // maps to GovernanceController::SECTIONS keys
            $table->text('content_th')->nullable();   // rich HTML content in Thai
            $table->text('content_en')->nullable();   // rich HTML content in English
            $table->string('image_path')->nullable(); // org chart or featured image
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
        Schema::dropIfExists('governance_sections');
    }
};
