<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddNameToIndexingTable extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('indexing', 'name')) {
            Schema::table('indexing', function (Blueprint $table) {
                $table->string('name')->nullable()->after('id');
            });
        }

        $knownOrganizations = [
            '1780337320.1656930840.jpg' => 'Zenodo',
            '1780337341.1696689526-ISI.png' => 'International Scientific Indexing',
            '1780337383.open-access-rjms.png' => 'Open Access',
            '1780337408.issn.png' => 'International Standard Serial Number (ISSN)',
            '1780337429.academia-edu.jpg' => 'Academia.edu',
            '1780337482.Google-Scholar.png' => 'Google Scholar',
        ];

        foreach ($knownOrganizations as $image => $name) {
            DB::table('indexing')
                ->where('img', $image)
                ->where(function ($query) {
                    $query->whereNull('name')->orWhere('name', '');
                })
                ->update(['name' => $name]);
        }
    }

    public function down()
    {
        if (Schema::hasColumn('indexing', 'name')) {
            Schema::table('indexing', function (Blueprint $table) {
                $table->dropColumn('name');
            });
        }
    }
}
