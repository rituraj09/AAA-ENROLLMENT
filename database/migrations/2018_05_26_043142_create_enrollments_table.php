<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnrollmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('district_id', false, true);
            $table->integer('t_p_a_id', false, true);
            $table->integer('atal_vendor_id', false, true);
            $table->integer('targeted_persons');
            $table->integer('number_of_kits_deployed');
            $table->integer('bpl_scsp_enrolled');
            $table->integer('bpl_district_kiosk_enrolled');

            $table->integer('apl_scsp_enrolled');
            $table->integer('apl_district_kiosk_enrolled');


            $table->integer('minor_scsp_enrolled');
            $table->integer('minor_district_kiosk_enrolled');

            $table->integer('total_enrolled');


            $table->integer('scsp_card_issued');
            $table->integer('district_kiosk_card_issued');

            $table->decimal('fee_collected_from_apl', 10,2);

            $table->timestamps();

            $table->foreign('district_id')->references('id')->on('districts');
            $table->foreign('t_p_a_id')->references('id')->on('t_p_as');
            $table->foreign('atal_vendor_id')->references('id')->on('atal_vendors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enrollments');
    }
}
