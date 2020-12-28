<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Project;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->string('host_url', 100)->nullable();
            $table->longText('description')->nullable();
            $table->foreignId('customer_id');
            $table->enum('status', Project::getAvailablesStatuses());
            $table->timestamps();

        /*    $table->foreign('customer_id')
                  ->references('id')->on('customers')
                  ->onDelete('CASCADE');  */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
