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
        Schema::table('governance_documents', function (Blueprint $table) {
            $table->string('category')->nullable()->after('title_en');
            $table->integer('display_order')->default(0)->after('effective_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('governance_documents', function (Blueprint $table) {
            $table->dropColumn(['category', 'display_order']);
        });
    }
};
