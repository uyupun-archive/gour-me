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
        $response = $this->getRecommendResponse($request, $recommends);

        return response($response, 200);
    }

    /**
     * リクエストのこってり度とがっつり度とDBのこってり度とがっつり度の差が最小のものを求める(近似値)
     *
     * @param $request
     * @param $recommends
     * @return \stdClass
     */
    protected function getRecommendResponse($request, $recommends)
    {
        $response = new \stdClass();

        $minDiffKotteriLevel = 100;
        $minDiffGatturiLevel = 100;
        foreach ($recommends as $recommend) {
            // 絶対値を求める
            $absKotteriLevel = abs($request->kotteriLevel - $recommend->kotteri_level);
            $absGatturiLevel = abs($request->gatturiLevel - $recommend->gatturi_level);

            // レスポンスの書き換え
            if ($minDiffKotteriLevel > $absKotteriLevel &&
                $minDiffGatturiLevel > $absGatturiLevel) {
                $minDiffKotteriLevel = $absKotteriLevel;
                $minDiffGatturiLevel = $absGatturiLevel;

                $response = $recommend;
            }
        }

        return $response;
    }
}
