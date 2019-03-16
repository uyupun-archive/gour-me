<?php

namespace App\Http\Controllers;

use App\Models\Recommend;
use Illuminate\Http\Request;

class RecommendController extends Controller
{
    /**
     * レコメンドを行い, その結果を返すAPI
     *
     * リクエスト: 座標のJSONデータ { kotteriLevel: XX, gatturiLevel: YY }
     * レスポンス: リクエストの座標に最も近似する座標に対応する食べ物のJSONデータ
     *
     * @return array
     */
    public function index()
    {
        $request = request();

        $recommend = Recommend::first();
        return $recommend;
    }
}
