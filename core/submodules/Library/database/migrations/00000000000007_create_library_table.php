<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Pluma\Support\Migration\Migration;
use Phinx\Migration\AbstractMigration;

class CreateLibraryTable extends Migration
{
    /**
     * The table name.
     *
     * @var string
     */
    protected $tablename = 'library';

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
            $table->string('originalname');
            $table->string('filename')->unique()->nullable();
            $table->text('pathname')->nullable();
            $table->integer('size')->nullable();
            $table->string('mimetype')->nullable();
            $table->string('type')->nullable();
            $table->text('description')->nullable();
            $table->text('thumbnail')->nullable();
            $table->text('url')->nullable();
            $table->integer('catalogue_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('catalogue_id')->references('id')->on('catalogues');
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
