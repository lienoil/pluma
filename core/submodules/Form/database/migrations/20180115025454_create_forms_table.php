<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Pluma\Support\Migration\Migration;
use Phinx\Migration\AbstractMigration;

class CreateFormsTable extends Migration
{
    /**
     * The table name.
     *
     * @var string
     */
    protected $tablename = 'forms';

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
            $table->string('name');
            $table->string('code')->unique();
            $table->string('action')->nullable();
            $table->string('method')->nullable();
            $table->string('type')->nullable();
            $table->text('attributes')->nullable();
            $table->text('body')->nullable();
            $table->text('delta')->nullable();
            $table->string('template')->nullable();
            $table->text('success_message')->nullable();
            $table->text('error_message')->nullable();
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

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
