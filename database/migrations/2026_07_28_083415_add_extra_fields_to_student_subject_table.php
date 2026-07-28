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
        Schema::table('student_subject', function (Blueprint $table) {
            $table->date('enrolled_at')->nullable();
            $table->string('status')->default('active');
            $table->decimal('final_mark', 5, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_subject', function (Blueprint $table) {
            $table->dropColumn([
                'enrolled_at',
                'status',
                'final_mark',
            ]);
        });
    }
};
