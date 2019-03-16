<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecommendController extends Controller
{
    /**
     * レコメンドを行い, その結果を返すAPI
     *
     * リクエスト: 座標のJSONデータ { x: XX, y: YY }
     * レスポンス: リクエストの座標に最も近似する座標に対応する食べ物のJSONデータ
     *
     * @return array
     */
    public function index()
    {
        $request = request();

        // TODO: API作成
        return [ 'status' => 'OK' ];
    }
}
