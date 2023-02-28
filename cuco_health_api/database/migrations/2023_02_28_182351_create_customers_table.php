<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('cpf');
            $table->string('birthdate');
            $table->string('phone_number')->nullable();
            $table->timestamps();
        });

        DB::table('customers')->insert(
            [
                'name' => 'Maria Gomes Silva', 
                'cpf' => '132457254-98', 
                'birthdate' => '1989/02/21',
                'phone_number'=> '11 95647-1221'
            ]
        );

        DB::table('customers')->insert(
            [
                'name' => 'Claudio Gomes', 
                'cpf' => '132454578-98', 
                'birthdate' => '1978/04/21',
                'phone_number'=> '11 91127-6561'
            ]
        );

        DB::table('customers')->insert(
            [
                'name' => 'Alfredo Meneghaz de Freitas', 
                'cpf' => '457964478-12', 
                'birthdate' => '1965/04/23',
                'phone_number'=> '11 91345-7878'
            ]
        );

        DB::table('customers')->insert(
            [
                'name' => 'Thiago Gomes da Costa', 
                'cpf' => '122455788-12', 
                'birthdate' => '1992/12/02',
                'phone_number'=> '11 99898-1224'
            ]
        );

        DB::table('customers')->insert(
            [
                'name' => 'Mauro de Andrade', 
                'cpf' => '454965214-08', 
                'birthdate' => '1988/07/12',
                'phone_number'=> '11 91258-0012'
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
