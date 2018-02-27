<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Pluma\Support\Migration\Migration;
use Phinx\Migration\AbstractMigration;

class CreateContentUserTable extends Migration
{
    /**
     * The table name.
     *
     * @var string
     */
    protected $tablename = 'content_user';

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
            $table->integer('user_id')->unsigned();
            $table->integer('content_id')->unsigned();
            $table->integer('course_id')->unsigned();
            $table->string('status')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('content_id')->references('id')->on('contents');
            $table->foreign('course_id')->references('id')->on('courses');
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
