<?php
/**
 * Created by PhpStorm.
 * User: zeng
 * Date: 2016/7/31
 * Time: 15:49
 */

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index(){
        $pdo=DB::connection()->getPdo();
        dd($pdo);
    }
}