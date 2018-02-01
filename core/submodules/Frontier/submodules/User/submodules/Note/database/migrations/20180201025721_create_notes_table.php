<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Pluma\Support\Migration\Migration;
use Phinx\Migration\AbstractMigration;

class CreateNotesTable extends Migration
{
    /**
     * The table name.
     *
     * @var string
     */
    protected $table = 'notes';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ($this->schema->hasTable($this->table)) {
            return;
        }

        $this->schema->create($this->table, function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->text('text');
            $table->datetime('reminded_at');
            $table->integer('user_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
                  ->onDelete('CASCADE')
                  ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists($this->table);
    }
}
