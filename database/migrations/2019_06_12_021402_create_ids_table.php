<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ids', function (Blueprint $table) {
            $table->increments('id');
            $table->string('empid');
            $table->string('type');
            $table->string('lastName');
            $table->string('firstName');
            $table->string('mi');
            $table->string('address');
            $table->bigInteger('contactno')->nullable();
            $table->string('designation');
            $table->date('bday');
            
            $table->string('contactPerson');
            $table->bigInteger('cpc');
            $table->string('cpa');
            
            $table->string('tin')->nullable();
            $table->string('sss')->nullable();
            $table->string('philhealth')->nullable();
            $table->string('pagibig')->nullable();

            $table->string('school')->nullable();
            $table->integer('hrs')->nullable();
            $table->string('adv')->nullable();
            $table->bigInteger('advcontact')->nullable();
            
            $table->string('photo');
            $table->string('sign')->nullable();
            $table->string('qrcode');

            $table->string('status')->default('Pending');
            $table->string('expiration');
            // $table->string('idno')->nullable();
            // $table->string('Last_Name');
            // $table->string('First_Name');
            // $table->string('M_I')->nullable()->default('');
            // $table->string('Address')->nullable();
            // $table->string('Contact')->nullable();
            // $table->string('Birth_Date');
            // $table->string('Contact_Person')->nullable();
            // $table->string('CPA')->nullable();
            // $table->string('CPC')->nullable();
            // $table->string('designation');
            // $table->string('desig')->nullable();
            // $table->string('TinNo')->nullable()->default('N/A');
            // $table->string('SSSNo')->nullable()->default('N/A');
            // $table->string('PhilHealthNo')->nullable()->default('N/A');
            // $table->string('PagibigNo')->nullable()->default('N/A');
            // $table->string('school')->nullable()->default('N/A');
            // $table->string('hrs')->nullable()->default('N/A');
            // $table->string('adv')->nullable()->default('N/A');
            // $table->string('advcontact')->nullable()->default('N/A');
            // $table->string('picture');
            // $table->string('C_Date')->nullable();
            // $table->string('E_Date')->nullable();
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
        Schema::dropIfExists('ids');
    }
}
