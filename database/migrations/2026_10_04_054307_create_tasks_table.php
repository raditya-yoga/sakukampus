
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();

            $table->foreignId('requester_id')
                ->constrained('users');

            $table->foreignId('tasker_id')
                ->nullable()
                ->constrained('users');

            $table->foreignId('category_id')
                ->constrained('categories');

            $table->string('title', 150);
            $table->text('description');
            $table->decimal('price', 12, 2);
            $table->string('location_name', 255);
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->timestamp('deadline')->nullable();
            $table->string('status', 30)->default('open');
            $table->timestamp('completed_at')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('requester_id', 'idx_tasks_requester');
            $table->index('tasker_id', 'idx_tasks_tasker');
            $table->index('category_id', 'idx_tasks_category');
            $table->index('status', 'idx_tasks_status');
            $table->index('created_at', 'idx_tasks_created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
