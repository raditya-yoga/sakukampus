
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('task_checkins', function (Blueprint $table) {
            $table->id();

            $table->foreignId('task_id')
                ->constrained('tasks');

            $table->foreignId('user_id')
                ->constrained('users');

            $table->string('checkin_type', 20);
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->string('location_name', 255)->nullable();
            $table->timestamp('checked_in_at')->useCurrent();

            $table->index('task_id', 'idx_checkins_task');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('task_checkins');
    }
};
