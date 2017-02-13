@extends('admin/common/top')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{URL('info')}}">首页</a> &raquo; <a href="{{url('category')}}">分类管理</a> &raquo; 修改分类
    </div>
    <!--面包屑导航 结束-->

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
            <h3>快捷操作</h3>
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="#"><i class="fa fa-plus"></i>新增文章</a>
                <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
                <a href="#"><i class="fa fa-refresh"></i>更新排序</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">

            <table class="add_tab">
                <tbody>
                    <tr>
                        <th width="120"><i class="require">*</i>分类：</th>
                        <td>
                            <select name="cate_pid">
                                <option value="0" @if($category->cate_pid==0) selected @endif>==顶级分类==</option>
                                @foreach($pdcate as $k)
                                <option value="{{$k->id}}"  @if($category->cate_pid==$k->id) selected @endif>{{$k->cate_name}}</option>
                                 @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>分类名称：</th>
                        <td>
                            <input type="text" class="cate_name" name="cate_name" value="{{$category->cate_name}}">
                            <span id="fa cate_name"><i class="fa fa-exclamation-cate_name yellow"></i></span>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>标题：</th>
                        <td>
                            <input type="text" class="lg" name="cate_title" value="{{$category->cate_title}}">
                            <p class="cate_title">标题可以写30个字</p>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>排序：</th>
                        <td>
                            <input type="text" class="sm" name="cate_order" value="{{$category->cate_order}}">
                            <span><i class="fa fa_cate_order_circle yellow"></i></span>
                        </td>
                    </tr>
                    <tr>
                        <th>关键字：</th>
                        <td>
                            <textarea name="cate_keywords">{{$category->cate_keywords}}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>描述：</th>
                        <td>
                            <textarea class="lg" name="cate_description">{{$category->cate_description}}</textarea>
                            <p>标题可以写30个字</p>
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <input type="submit" value="提交" id="submit">
                            <input type="button" class="back" onclick="history.go(-1)" value="返回">
                        </td>
                    </tr>
                </tbody>
            </table>

    </div>
<script>
    $(function(){
        $('#submit').click(function(){
            var pid=$('select[name="cate_pid"]').val();
            var name=$('input[name="cate_name"]').val();
            var title=$('input[name="cate_title"]').val();
            var order=$('input[name="cate_order"]').val();
            var keywords=$('textarea[name="cate_keywords"]').val();
            var description=$('textarea[name="cate_description"]').val();
            if(name==''||title==''||order==''){
                if(name==''){
                    $('.fa-exclamation-cate_name').html('分类名称不能为空');

                }else{
                    $('.fa-exclamation-cate_name').html('');
                }
                if(title==''){
                    $('.cate_title').css('color','red').html('分类标题不能为空');

                }else{
                    $('.cate_title').html('');
                }
                if(order==''){
                    $('.fa_cate_order_circle').html('排序不能为空');
                }else{
                    $('.fa_cate_order_circle').html('');
                }
                return false;
            }
            var url="{{url('editcategory')}}";
            /*  $.post(url,{'pid':pid,'name':name,'titel':titel,'order':order,'keywords':keywords,'description':description,'_token':'{{csrf_field()}}'}, function (data) {
             alert(data);
             });
             */
            $.post(url,{'cate_pid':pid,'id':'{{$category->id}}','cate_name':name,'cate_title':title,'cate_order':order,'cate_keywords':keywords,'cate_description':description,'_token':'{{csrf_token()}}'}, function (data) {
                if(data=='1'){
                    alert('修改分类成功');
                    window.location.href="{{url('category')}}";
                }else{
                    alert('修改分类失败');
                }
            });

        });
    })
</script>
@endsection