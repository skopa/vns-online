<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->increments('id');
            $table->string('link');
            $table->string('comment')->nullable();
            $table->boolean('is_enabled')->default(0);
            $table->unsignedInteger('visits_count')->default(0);
            $table->unsignedInteger('visit_time_line_id');
            $table->foreign('visit_time_line_id')
                ->references('id')
                ->on('visit_time_lines');
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
        Schema::dropIfExists('links');
    }
}
