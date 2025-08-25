<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('objection_requests_v2', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('identity_type');
            $table->string('identity_number');
            $table->string('identity_scan_path')->nullable();
            $table->string('phone');
            $table->text('reason');
            $table->text('additional_info')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('objection_requests_v2');
    }
};
