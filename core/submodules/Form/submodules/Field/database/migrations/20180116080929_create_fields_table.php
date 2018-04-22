<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Pluma\Support\Migration\Migration;
use Phinx\Migration\AbstractMigration;

class CreateFieldsTable extends Migration
{
    /**
     * The table name.
     *
     * @var string
     */
    protected $tablename = 'fields';

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
            $table->text('label')->nullable();
            $table->integer('sort')->nullable();
            $table->text('value')->nullable();
            $table->integer('points')->default(1);
            $table->text('attribute')->nullable();
            $table->integer('fieldtype_id')->unsigned();
            $table->integer('form_id')->unsigned();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('fieldtype_id')->references('id')
                ->on('fieldtypes')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table->foreign('form_id')->references('id')
                ->on('forms')
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
