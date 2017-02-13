<?php
/**
 * User: zeng
 * Date: 2016/8/5
 * Time: 8:50
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Model\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class ArticleController extends CommonController
{
 public function index(){
     $cate=Category::all();
     return view('admin.addarticle',['cate'=>$cate]);
 }
    public function add(){
        $input=Input::except('_token');
        $input['art_time']=time();
        $a= DB::table('article')->insert($input);
        if($a){
            echo $a;
        }else{
            echo false;
        }
    }
    public function list2(){
        $article=DB::table('Article')->join('category','article.cate_id','=','category.id')->select('article.id','article.art_title','article.art_tag','article.art_description','article.art_time','article.art_editor','article.art_view','category.cate_name')->orderBy('article.id','desc')->paginate(10);
        return view('admin.articlelist',['article'=>$article]);
    }
    public function edit($id){
        $cate=Category::all();
        $article=DB::table('article')->find($id);
        return view('admin.editarticle',compact('cate','article'));
    }
    public  function  editArticle(){
        $input=Input::except('_token');
        $a=DB::table('article')->where('id',$input['id'])->update(['art_title'=>$input['art_title'],'art_tag'=>$input['art_tag'],'art_description'=>$input['art_description'],'art_content'=>$input['art_content'],'art_editor'=>$input['art_editor'],'cate_id'=>$input['cate_id']]);
        if($a){
            echo $a;
        }else{
            echo false;
        }
    }
    public function delete($id){
        $a=DB::table('article')->where('id',$id)->delete();
        if($a){
            return redirect('article/list');
        }
    }

}