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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // ['incoming','outgoing']
            $table->boolean('is_completed'); // ['completed','pending']
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('contract_id')->constrained('contracts');
            $table->foreignId('from_id')->constrained('stakeholders');
            $table->foreignId('to_id')->constrained('stakeholders');
            $table->string('title');
            $table->string('ref')->nullable();
            $table->date('date')->nullable();
            $table->text('content')->nullable();
            $table->text('hyperlink')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
