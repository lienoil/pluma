<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Phinx\Migration\AbstractMigration;
use Pluma\Support\Migration\Migration;

class CreateCourseUserTable extends Migration
{
    /**
     * The table name.
     *
     * @var string
     */
    protected $tablename = 'course_user';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ($this->schema->hasTable($this->tablename)) {
            return;
        }

        $this->schema->create($this->tablename, function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamp('enrolled_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('dropped_at')->nullable();
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
        $this->schema->dropIfExists($this->tablename);
    }
}
