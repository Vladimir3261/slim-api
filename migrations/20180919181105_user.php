<?php


use \Application\Migration\Migration;

class User extends Migration
{
    public function up()
    {
        $this->schema->create('users', function (Illuminate\Database\Schema\Blueprint $table) {
            // Auto-increment id
            $table->increments('id');
            $table->string('email');
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('age');
            $table->char('token', 32);
            // Required for Eloquent's created_at and updated_at columns
            $table->timestamps();
        });
    }

    public function down()
    {
        $this->schema->drop('users');
    }
}
