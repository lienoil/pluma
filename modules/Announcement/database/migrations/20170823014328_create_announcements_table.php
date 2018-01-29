<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Phinx\Migration\AbstractMigration;
use Pluma\Support\Migration\Migration;

class CreateAnnouncementsTable extends Migration
{
    /**
     * The table name.
     *
     * @var string
     */
    protected $table = 'announcements';

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
            $table->string('name');
            $table->string('code');
            $table->text('feature')->nullable();
            $table->text('body')->nullable();
            $table->text('delta')->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('category_id')->unsigned()->nullable();
            $table->timestamp('published_at')->default(DB::raw('CURRENT_TIMESTAMP'))->nullable();
            $table->timestamp('expired_at')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate("CASCADE")
                ->onDelete("CASCADE");
            $table->foreign('category_id')->references('id')->on('categories')
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
