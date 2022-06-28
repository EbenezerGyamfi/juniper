<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('personal_phone_one');
            $table->string('personal_phone_two')->nullable();
            $table->string('email');
            $table->enum('gender',['male','female'])->default('male');
            $table->date('dob');
            $table->string('temporal_image');
            $table->string('permanent_image');
            $table->string('marital_status');
            $table->enum('educational_level',['Basic','Secondary','Graduate','Others'])->default('Basic');
            $table->string('address');
            $table->enum('region',['Ashanti','Bono','Bono East','Ahafo','Central','East','Greater Accra','Northern','Savannah','North East','Upper East','	Upper West','Volta','Oti','Western','Western North']);
            $table->string('city');
            $table->string('area');
            $table->string('nearest_landmark');
            $table->string('upload_card');
            $table->string('company_name');
            $table->string('company_location');
            $table->string('company_landmark');
            $table->string('company_phone');
            $table->string('job_position');
            $table->string('company_city');
            $table->enum('monthly_income',['100-1000','1000-10000','10000-100000'])->default('100-1000');
            $table->string('company_designation');
            $table->string('emergency_name');
            $table->string('emaergency_phone');
            $table->string('emergency_relationship');
            $table->string('wallet_network');
            $table->string('wallet_holder_name');
            $table->string('wallet_number');
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
        Schema::dropIfExists('customers');
    }
};
