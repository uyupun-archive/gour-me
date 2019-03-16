<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * レコメンドデータテーブル
 *
 * Class CreateRecommendsTable
 */
class CreateRecommendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recommends', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('食べ物の名前');
            $table->text('description')->comment('食べ物の説明');
//            $table->text('img')->comment('画像のパス');
            $table->unsignedInteger('prefecture')->comment('都道府県');
            $table->unsignedInteger('kotteri_level')->comment('こってり度');
            $table->unsignedInteger('gatturi_level')->comment('がっつり度');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recommends');
    }
}
