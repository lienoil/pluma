<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Pluma\Support\Migration\Migration;
use Phinx\Migration\AbstractMigration;

class CreateMenusTable extends Migration
{
    /**
     * The table name.
     *
     * @var string
     */
    protected $tablename = 'menus';

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
            // $table->increments('id');
            $table->string('title');
            $table->string('code');
            $table->string('location');
            $table->string('icon')->nullable();
            $table->string('slug')->nullable()->default("");
            $table->string('key')->unique();
            $table->integer('page_id')->unsigned()->nullable();
            $table->integer('sort')->unsigned()->default(0);
            $table->string('parent')->nullable();
            $table->integer('lft')->unsigned()->nullable();
            $table->integer('rgt')->unsigned()->nullable();
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
        $this->schema->dropIfExists($this->tablename);
    }
}
