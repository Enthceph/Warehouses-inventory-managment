<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');

            $table->foreignId('role_id')->constrained(
                table: 'roles'
            );

            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });

//        DB::table('users')->insert([
//                'first_name' => 'Test',
//            'last_name' => 'Testovich',
//            'role' => 'Administrator',
//            'email' => 'test@test.com',
//            'password' => 'qwerty',
//        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
