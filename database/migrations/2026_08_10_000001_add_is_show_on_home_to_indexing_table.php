<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('indexing', 'isShowOnHome')) {
            Schema::table('indexing', function (Blueprint $table) {
                $table->boolean('isShowOnHome')->default(0)->after('img');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('indexing', 'isShowOnHome')) {
            Schema::table('indexing', function (Blueprint $table) {
                $table->dropColumn('isShowOnHome');
            });
        }
    }
};
