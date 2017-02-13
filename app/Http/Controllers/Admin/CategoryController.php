<?php
/**
 * Created by PhpStorm.
 * User: zeng
 * Date: 2016/8/5
 * Time: 9:06
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Model\Category;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CategoryController extends CommonController
{
    public function addCategory()
    {
        $pdcate = Category::where('cate_pid', 0)->get();
       // dd($pdcate);
        return view('admin/add', compact('pdcate'));
    }
    public function add(){
        $input=Input::except('_token');

       $a= DB::table('category')->insert($input);
        if($a){
            echo $a;
        }else{
            echo false;
        }
    }
    //分类列表页
    public function index(){
        $C=Category::orderBy('cate_order')->get();
        //$data=$this->getTree($C);
        return view('admin/list',['cate'=>$C]);
    }
    public function changeOrder(){
        $input=Input::all();
        $orderId=$input['orderId'];
        $id=$input['id'];
       $a= DB::table('category')->where('id',$id)->update(['cate_order'=>$orderId]);
        if($a){
            echo $a;
        }
        echo $orderId;
    }
    public function edit($id){
        $category=Category::find($id);
        $pdcate = Category::where('cate_pid', 0)->get();
        return view('admin.edit',compact('category','pdcate'));
    }
    public function editcategory(){
        $input=Input::except('_token');
        $a=DB::table('category')->where('id',$input['id'])->update(['cate_name'=>$input['cate_name'],'cate_title'=>$input['cate_name'],'cate_keywords'=>$input['cate_keywords'],'cate_description'=>$input['cate_description'],'cate_order'=>$input['cate_order'],'cate_pid'=>$input['cate_pid']]);

        if($a){
            echo $a;
        }else{
            echo false;
        }
    }
    public  function delete($id){
        $a=Category::where('id',$id)->delete();
        if($a){
            return redirect('category');
        }
    }
}