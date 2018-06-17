<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonsTable extends Migration
{
    /**
     * The table name.
     *
     * @var string
     */
    protected $table = 'lessons';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->table)) {
            return;
        }

        Schema::create($this->table, function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('code')->unique();
            $table->text('feature')->nullable();
            $table->text('body')->nullable();
            $table->integer('sort')->default(0);
            $table->integer('course_id')->unsigned()->nullable();
            $table->integer('lessonable_id')->unsigned()->nullable();
            $table->string('lessonable_type')->nullable();
            $table->timestamps();

            $table->foreign('course_id')
                  ->references('id')
                  ->on('courses')
                  ->onUpdate('CASCADE')
                  ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}
