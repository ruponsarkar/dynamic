<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAuthorIdToManuscriptTable extends Migration
{
    public function up()
    {
        Schema::table('manuscript', function (Blueprint $table) {
            $table->unsignedBigInteger('author_id')->nullable()->after('m_id');
            $table->index('author_id');
        });
    }

    public function down()
    {
        Schema::table('manuscript', function (Blueprint $table) {
            $table->dropIndex(['author_id']);
            $table->dropColumn('author_id');
        });
    }
}
