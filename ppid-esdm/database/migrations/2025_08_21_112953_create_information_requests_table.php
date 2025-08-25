<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('information_requests', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->text('address');
            $table->string('occupation');
            $table->string('identity_type');
            $table->string('identity_number');
            $table->string('phone');
            $table->string('identity_scan_path')->nullable();
            $table->text('information_details');
            $table->text('purpose');
            $table->string('copy_method')->nullable();
            $table->string('retrieval_method')->nullable();
            $table->string('status')->default('pending');
            $table->string('ticket_number')->unique()->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('information_requests');
    }
};
