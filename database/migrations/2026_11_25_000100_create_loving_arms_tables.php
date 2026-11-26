<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inquiries', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('phone', 40)->nullable();
            $t->string('email');
            $t->string('topic');
            $t->text('message');
            $t->string('status', 30)->default('new')->index();
            $t->timestamps();
        });

        Schema::create('applications', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('email');
            $t->string('phone', 40);
            $t->string('role_applied');
            $t->string('city')->nullable();
            $t->unsignedTinyInteger('years_experience')->default(0);
            $t->text('availability');
            $t->text('credentials');
            $t->text('references_info');
            $t->text('message')->nullable();
            $t->string('status', 30)->default('new')->index();
            $t->timestamps();
        });

        Schema::create('staffing_requests', function (Blueprint $t) {
            $t->id();
            $t->string('facility_name');
            $t->string('facility_type');
            $t->string('contact_name');
            $t->string('email');
            $t->string('phone', 40);
            $t->string('roles_needed');
            $t->text('shifts_needed');
            $t->date('start_date')->nullable();
            $t->text('message')->nullable();
            $t->string('status', 30)->default('new')->index();
            $t->timestamps();
        });

        Schema::create('notes', function (Blueprint $t) {
            $t->id();
            $t->morphs('noteable');
            $t->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $t->text('body');
            $t->timestamps();
        });

        Schema::create('clients', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('phone', 40)->nullable();
            $t->string('address')->nullable();
            $t->string('city', 100)->nullable();
            $t->string('county', 30)->nullable();
            $t->text('care_notes')->nullable();
            $t->boolean('is_active')->default(true);
            $t->timestamps();
        });

        Schema::create('caregivers', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('role', 30)->default('CNA');
            $t->string('phone', 40)->nullable();
            $t->string('email')->nullable();
            $t->boolean('is_active')->default(true);
            $t->foreignId('application_id')->nullable()->constrained('applications')->nullOnDelete();
            $t->timestamps();
        });

        Schema::create('shifts', function (Blueprint $t) {
            $t->id();
            $t->foreignId('client_id')->nullable()->constrained()->nullOnDelete();
            $t->foreignId('caregiver_id')->nullable()->constrained()->nullOnDelete();
            $t->string('location')->nullable();
            $t->dateTime('starts_at')->index();
            $t->dateTime('ends_at');
            $t->string('status', 30)->default('scheduled')->index();
            $t->text('notes')->nullable();
            $t->timestamps();
        });
    }

    public function down(): void
    {
        foreach (['shifts', 'caregivers', 'clients', 'notes', 'staffing_requests', 'applications', 'inquiries'] as $table) {
            Schema::dropIfExists($table);
        }
    }
};
