<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCourseUserTable extends Migration
{
    /**
     * The table name.
     *
     * @var string
     */
    protected $table = 'course_user';

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
            $table->integer('course_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamp('enrolled_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('dropped_at')->nullable();
            $table->string('status')->nullable();
            $table->foreign('course_id')->references('id')->on('courses');
            $table->foreign('user_id')->references('id')->on('users');
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
