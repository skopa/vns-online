<?php
/**
 * Created by PhpStorm.
 * User: Stepan
 * Date: 12.02.2018
 * Time: 11:26
 */

namespace App\Jobs;


trait Urls
{
    protected $pingUrl = 'http://vns.lpnu.ua/local/intelliboard/ajax.php';
    protected $loginUrl = 'http://vns.lpnu.ua/login/index.php';
}