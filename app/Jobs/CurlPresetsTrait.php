<?php
/**
 * Created by PhpStorm.
 * User: Stepan
 * Date: 12.02.2018
 * Time: 11:20
 */

namespace App\Jobs;


use Curl\Curl;

trait CurlPresetsTrait
{
    protected function preset(Curl $curl)
    {
        $this->setHeaders($curl);
        $this->setOpts($curl);
    }

    private function setHeaders(Curl $curl)
    {
        $curl->setHeader('User-Agent',
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.119 Safari/537.36 OPR/51.0.2830.26');
    }

    private function setOpts(Curl $curl)
    {
        $curl->setOpt(CURLOPT_FOLLOWLOCATION, true);
    }
}