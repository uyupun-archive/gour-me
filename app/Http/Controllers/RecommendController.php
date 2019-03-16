<?php

namespace App\Http\Controllers;

use App\Models\Recommend;
use Illuminate\Http\Request;
use Validator;

class RecommendController extends Controller
{
    /**
     * レコメンドを行い, その結果を返すAPI
     *
     * リクエスト: 座標のJSONデータ { kotteriLevel: XX, gatturiLevel: YY }
     * レスポンス: リクエストの座標に最も近似する座標に対応する食べ物のJSONデータ
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function index()
    {
        $request = request();

        // バリデーション
        $validator = Validator::make($request->all(), [
            'kotteriLevel' => [ 'bail', 'required', 'integer', 'min:0', 'max:100', ],
            'gatturiLevel' => [ 'bail', 'required', 'integer', 'min:0', 'max:100', ],
        ]);
        if ($validator->fails()) return response([], 400);

        $recommends = Recommend::all();
        $response = new \stdClass();

        // リクエストのこってり度とがっつり度とDBのこってり度とがっつり度の差が最小のものを求める(近似値)
        $minDiffKotteriLevel = 100;
        $minDiffGatturiLevel = 100;
        foreach ($recommends as $recommend) {
            $absKotteriLevel = abs($request->kotteriLevel - $recommend->kotteri_level);
            $absGatturiLevel = abs($request->gatturiLevel - $recommend->gatturi_level);

            // こってり度/がっつり度の両方を書き換えるケース
            if ($minDiffKotteriLevel > $absKotteriLevel &&
                $minDiffGatturiLevel > $absGatturiLevel) {
                $minDiffKotteriLevel = $absKotteriLevel;
                $minDiffGatturiLevel = $absGatturiLevel;

                $response = $recommend;
            }
        }

        return response($response, 200);
    }
}
