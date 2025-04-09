<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;


// database/migrations/xxxx_xx_xx_create_tasks_table.php

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(Str::uuid());
            $table->uuid('manager_id');
            $table->uuid('employee_id');
            $table->tinyInteger('rating')->nullable();
            $table->text('review')->nullable();
            $table->text('task_detail');
            $table->string('status'); // e.g. pending, in_progress, completed
            $table->date('predicted_due_date')->nullable();
            $table->date('actual_completion_date')->nullable();
            $table->timestamps();

            $table->foreign('manager_id')->references('id')->on('managers')->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
