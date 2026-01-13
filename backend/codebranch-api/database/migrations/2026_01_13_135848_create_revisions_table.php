<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('revisions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('branch_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('title')->nullable(); // e.g. "Added error handling"
            $table->longText('code');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('revisions');
    }
};
