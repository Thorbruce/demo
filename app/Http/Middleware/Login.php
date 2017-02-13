<?php
/**
 * Created by PhpStorm.
 * User: zeng
 * Date: 2016/8/4
 * Time: 13:36
 */

namespace App\Http\Middleware;

use Closure;
class Login
{
    public function handle($request, Closure $next)
    {
        if(!session('uid')){
            return redirect('admin.php');
        }
        return $next($request);
    }
}