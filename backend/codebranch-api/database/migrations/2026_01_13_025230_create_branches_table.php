<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('branches', function (Blueprint $table) {
        $table->id();
        // Links the CodeBlock to the User
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        
        $table->string('title');
        $table->text('intent');        // What problem this solves
        $table->text('description')->nullable(); // Optional extra context
        $table->string('language');    // e.g., 'javascript', 'php', 'python'
        $table->longText('code');      // The actual code content
        
        $table->timestamps();          // Adds created_at and updated_at
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
