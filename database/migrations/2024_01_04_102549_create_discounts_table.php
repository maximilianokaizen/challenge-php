<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->collation('utf8mb4_unicode_ci');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->unsignedInteger('priority');
            $table->tinyInteger('active');
            $table->unsignedBigInteger('region_id');
            $table->unsignedBigInteger('brand_id');
            $table->string('access_type_code', 1)->collation('utf8mb4_unicode_ci');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('region_id')->references('id')->on('regions');
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->foreign('access_type_code')->references('code')->on('access_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('discounts');
    }
}
