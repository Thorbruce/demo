<?php

/**
 * User: zeng
 * Date: 2016/7/31
 * Time: 16:01
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\CommonController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

require_once ('resources/org/code/Code.class.php');
class LoginController extends CommonController
{


    public function toLogin(){
//        $user=DB::table('users')->get();
//        dd($user);
        //DB::table('users')->insert(array('user_name'=>'小曾','user_pass'=>md5('123456')));
        return view('admin/login');
    }
    public function index(){
        $user=DB::table('users')->where('id',session('uid'))->first();
        return view('admin/index',['admin'=>$user->user_name]);
    }
    //生成验证码
    public function code(){
        $code=new \Code();
        $code->make();
    }
    //登录ajax
    public function login(){
        $input=Input::all();    //类似于tp的I方法
        $code=new \Code();
        $_code=$code->get();
        if(!$input){
            echo '不是POST提交过来的数据';
        }else if(strtoupper($input['code'])!=$_code){
            echo '验证码不对';
        }else{
            $username=$input['username'];
            $password=$input['password'];
            $user=DB::table('users')->where('user_name',$username)->first();
            if($user->user_pass!=md5($password)){
                echo '密码不正确';
            }elseif(!$user){
                 echo '不存在该用户';
            }else{
                session(['uid'=>$user->id]);
                echo 1;
            }

        }

    }
    //退出登录
    public function loginOut(){
        session(['uid'=>null]);
        return view('admin/login');
    }
    public function editPsd(){
        return view('admin/pass');
    }
    public function info(){
        return view('admin/info');
    }
    //修改密码ajax
    public function password(){
        $input=Input::all();
        $user=DB::table('users')->where('id',session('uid'))->first();
        if(md5($input['oldPwd'])!=$user->user_pass){
            echo '1';   //旧密码不对
        }else if($input['newPwd']!=$input['surePwd']){
            echo '2';   //新旧密码不对
        }else{
            $password=md5($input['newPwd']);
            $a=DB::table('users')->where('id',session('uid'))->update(['user_pass'=>$password]);
            if($a){
                echo '3';//修改密码成功
            }
        }
    }


}