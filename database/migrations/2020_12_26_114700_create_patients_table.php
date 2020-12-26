<?php

use App\Patient;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pc_number');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('other_names');
            $table->enum('sex', [Patient::SEX_MALE, Patient::SEX_FEMALE, Patient::SEX_OTHER])->default(Patient::SEX_FEMALE);
            $table->dateTime('dob')->default(now());
            $table->string('residence');
            $table->string('phone');
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
        Schema::dropIfExists('patients');
    }
}
