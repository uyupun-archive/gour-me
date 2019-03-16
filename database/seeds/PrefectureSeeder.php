<?php

use Illuminate\Database\Seeder;
use App\Models\Prefecture;
use GuzzleHttp\Client as Guzzle;

class PrefectureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function run()
    {
        $prefectures = json_decode((new Guzzle())->request('GET', 'https://opendata.resas-portal.go.jp/api/v1/prefectures', [
            'headers' => [
                'Accept' => 'application/json',
                'X-API-KEY' => env('X_API_KEY'),
            ]
        ])->getBody())->result;

        foreach ($prefectures as $prefecture) {
            Prefecture::create([
                'name' => $prefecture->prefName,
            ]);
        }
    }
}
