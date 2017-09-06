<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Pluma\Support\Migration\Migration;
use Phinx\Migration\AbstractMigration;

class CreateCategorablesTable extends Migration
{
    /**
     * The table name.
     *
     * @var string
     */
    protected $tablename = 'categorables';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create($this->tablename, function (Blueprint $table) {
            $table->integer('category_id')->unsigned();
            $table->integer('categorable_id')->unsigned()->nullable();
            $table->string('categorable_type')->nullable();
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
