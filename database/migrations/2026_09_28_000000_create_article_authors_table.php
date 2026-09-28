<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleAuthorsTable extends Migration
{
    public function up()
    {
        Schema::create('article_authors', function (Blueprint $table) {
            $table->id();
            // The existing article schema is managed outside this repository.
            $table->unsignedBigInteger('article_id')->index();
            $table->unsignedInteger('position');
            $table->string('first_name', 150);
            $table->string('last_name', 150)->nullable();
            $table->string('designation', 255)->nullable();
            $table->text('affiliation')->nullable();
            $table->boolean('is_corresponding')->default(false);
            $table->unsignedInteger('sup_number')->nullable();
            $table->timestamps();
            $table->unique(['article_id', 'position']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('article_authors');
    }
}
