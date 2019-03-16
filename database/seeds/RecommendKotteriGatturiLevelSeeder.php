<?php

use Illuminate\Database\Seeder;
use App\Models\Recommend;

/**
 * こってり度/がっつり度のデータを流し込むSeeder
 *
 * Class RecommendKotteriGatturiLevelSeeder
 */
class RecommendKotteriGatturiLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // こってり度/がっつり度のJSONデータ取得
        $saltyJson = $this->fetchJson('salty');
        $kazukichiJson = $this->fetchJson('kazukichi');
        $kakimotoJson = $this->fetchJson('kakimoto');
        $takashiJson = $this->fetchJson('takashi');

        // DBに挿入
        for ($j = 0; $j < count($saltyJson); $j++) {
            $kotteriLevelAvg = $this->getAvg([$saltyJson[$j]->kotteriLevel, $kazukichiJson[$j]->kotteriLevel, $kakimotoJson[$j]->kotteriLevel, $takashiJson[$j]->kotteriLevel]);
            $gatturiLevelAvg = $this->getAvg([$saltyJson[$j]->gatturiLevel, $kazukichiJson[$j]->gatturiLevel, $kakimotoJson[$j]->gatturiLevel, $takashiJson[$j]->kotteriLevel]);

            Recommend::where('id', $j + 1)->update([
                'kotteri_level' => $kotteriLevelAvg,
                'gatturi_level' => $gatturiLevelAvg,
            ]);

            echo "Created: {$kotteriLevelAvg}, {$gatturiLevelAvg}\n";
        }
    }

    /**
     * database/jsonディレクトリからJSONデータを取得する
     *
     * @param $fileName
     * @return bool|false|mixed|string|string[]|null
     */
    protected function fetchJson($fileName)
    {
        $json =  file_get_contents(__DIR__ . "/../jsons/{$fileName}.json");
        $json = mb_convert_encoding($json, 'UTF-8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
        $json = json_decode($json);

        return $json;
    }

    /**
     * 平均値の計算
     *
     * @param $levels
     * @return float
     */
    protected function getAvg($levels)
    {
        $sum = 0;
        foreach ($levels as $level) $sum += $level;
        $avg = round($sum / count($levels), 0);
        return $avg;
    }
}
