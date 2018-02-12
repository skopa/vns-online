<?php
/**
 * Created by PhpStorm.
 * User: Stepan
 * Date: 11.02.2018
 * Time: 23:47
 */

class Test
{
    public static function sendMessage()
    {
        'http://vns.lpnu.ua/lib/ajax/service.php?sesskey=WMBlPVhZgL&info=core_message_send_instant_messages';

        $user = \App\User::find(1);

        $curl = new \Curl\Curl();
        $curl->setOpt(CURLOPT_FOLLOWLOCATION, true);
        $curl->setHeader('User-Agent', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.119 Safari/537.36 OPR/51.0.2830.26');

        $curl->setCookieFile(storage_path($user->cookies_file));
        $curl->setCookieJar(storage_path($user->cookies_file));
    }
}