
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('task_status_histories', function (Blueprint $table) {
            $table->id();

            $table->foreignId('task_id')
                ->constrained('tasks');

            $table->foreignId('changed_by')
                ->constrained('users');

            $table->string('old_status', 30)->nullable();
            $table->string('new_status', 30);
            $table->text('notes')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->index('task_id', 'idx_history_task');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('task_status_histories');
    }
};
