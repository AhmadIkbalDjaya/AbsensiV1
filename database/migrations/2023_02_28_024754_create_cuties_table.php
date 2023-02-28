<?php

use App\Models\Employee;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuties', function (Blueprint $table) {
            $table->id();
            $table->ForeignIdFor(Employee::class);
            $table->date('cuty_start');
            $table->date('cuty_end');
            $table->date('date_work');
            $table->integer('cuty_total')->unsigned();
            $table->string('cuty_description');
            $table->integer('cuty_status')->unsigned()->nullable();
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
        Schema::dropIfExists('cuties');
    }
};
