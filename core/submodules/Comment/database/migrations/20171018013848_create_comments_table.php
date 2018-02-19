<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Pluma\Support\Migration\Migration;
use Phinx\Migration\AbstractMigration;

class CreateCommentsTable extends Migration
{
    /**
     * The table name.
     *
     * @var string
     */
    protected $tablename = 'comments';

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
            $table->integer('parent_id')->unsigned()->nullable();
            $table->text('body')->nullable();
            $table->text('delta')->nullable();
            $table->boolean('approved')->default(true)->nullable();
            $table->integer('upvotes')->default(0)->nullable();
            $table->integer('downvotes')->default(0)->nullable();

            $table->integer('commentable_id')->nullable();
            $table->string('commentable_type')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')
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
        $this->schema->dropIfExists($this->tablename);
    }
}
