<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Pluma\Support\Migration\Migration;
use Phinx\Migration\AbstractMigration;

class CreateRoleWidgetTable extends Migration
{
    /**
     * The table name.
     *
     * @var string
     */
    protected $tablename = 'role_widget';

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
            $table->integer('role_id')->unsigned();
            $table->integer('widget_id')->unsigned();

            $table->foreign('role_id')->references('id')->on('roles')
                  ->onUpdate('CASCADE')
                  ->onDelete('CASCADE');
            $table->foreign('widget_id')->references('id')->on('widgets')
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
