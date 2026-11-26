<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('inquiries')) {
            Schema::table('inquiries', function (Blueprint $t) {
                if (! Schema::hasColumn('inquiries', 'relationship')) {
                    $t->string('relationship')->nullable();
                }
                if (! Schema::hasColumn('inquiries', 'zip')) {
                    $t->string('zip', 10)->nullable();
                }
                if (! Schema::hasColumn('inquiries', 'urgency')) {
                    $t->string('urgency')->nullable();
                }
                if (! Schema::hasColumn('inquiries', 'source')) {
                    $t->string('source')->nullable();
                }
                if (! Schema::hasColumn('inquiries', 'preferred_contact')) {
                    $t->string('preferred_contact')->nullable();
                }
            });
        }

        if (Schema::hasTable('applications')) {
            Schema::table('applications', function (Blueprint $t) {
                if (! Schema::hasColumn('applications', 'resume_path')) {
                    $t->string('resume_path')->nullable();
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('inquiries')) {
            Schema::table('inquiries', function (Blueprint $t) {
                $columns = array_values(array_filter(
                    ['relationship', 'zip', 'urgency', 'source', 'preferred_contact'],
                    fn (string $column) => Schema::hasColumn('inquiries', $column)
                ));

                if (! empty($columns)) {
                    $t->dropColumn($columns);
                }
            });
        }

        if (Schema::hasTable('applications') && Schema::hasColumn('applications', 'resume_path')) {
            Schema::table('applications', function (Blueprint $t) {
                $t->dropColumn('resume_path');
            });
        }
    }
};
