<?php

use Illuminate\Database\Seeder;
use App\Models\Recommend;

/**
 * こってり度/がっつり度以外のデータを流し込むSeeder
 *
 * Class RecommendScrapingSeeder
 */
class RecommendScrapingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Recommend::truncate();

        for ($i = 1; $i <= 5; $i++) {
            // ページの指定
            $pages = $i === 1 ? '' : "/pg{$i}/";

            // スクレイピング
            $names = $this->scraping('name', $pages);
            $descriptions = $this->scraping('description', $pages);
            $locates = $this->scraping('locate', $pages);

            // DBに挿入
            for ($j = 0; $j < count($names); $j++) {
                if ($this->checkData($names[$j], $descriptions[$j], $locates[$j])) continue;

                Recommend::create([
                    'name'          => $names[$j],
                    'description'   => $descriptions[$j],
                    'locate'        => $locates[$j],
                    'kotteri_level' => 0,
                    'gatturi_level' => 0,
                ]);

                echo "Created: {$names[$j]}\n";
            }
        }
    }

    /**
     * スクレイピングと整形
     *
     * @param $type
     * @param $pages
     * @return array
     */
    protected function scraping($type, $pages)
    {
        // タイプによって取ってくるclassを変える
        if ($type === 'name')               $class = 'list-group-main__ttl-txt';
        else if ($type === 'description')   $class = 'list-group-main__support-txt';
        else                                $class = 'list-group-main__area';

        // 関西のご当地グルメ 人気ランキングを取得
        $html = file_get_contents("https://gurutabi.gnavi.co.jp/i/d07/gl1{$pages}");

        // 整形
        $texts = \phpQuery::newDocument($html)['.list-group-main-list']->find('li')->find('a')->find('div')->find('div')->find('div')->find(".{$class}")->text();
        $texts = explode("\n", $texts);

        // $typeがdescriptionのときのみ, 配列を偶数の要素に絞る(スクレイピング先のサイトによる問題)
        if ($type === 'description') {
            $texts = array_map('current', array_chunk($texts, 2));
        }

        return $texts;
    }

    /**
     * 文字列が空/nullかどうかのチェック
     *
     * @param $name
     * @param $description
     * @param $locate
     * @return bool
     */
    protected function checkData($name, $description, $locate)
    {
        if (empty($name) || empty($description) || empty($locate)) return true;
        return false;
    }
}
