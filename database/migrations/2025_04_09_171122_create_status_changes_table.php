<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

// database/migrations/xxxx_xx_xx_create_status_changes_table.php

return new class extends Migration {
    public function up(): void
    {
        Schema::create('status_changes', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(Str::uuid());
            $table->uuid('task_id');
            $table->string('old_status');
            $table->string('new_status');
            $table->timestamp('changed_at')->useCurrent();
            $table->timestamps();

            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('status_changes');
    }
};
