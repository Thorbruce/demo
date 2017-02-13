@extends('admin/common/top')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">商品管理</a> &raquo; 添加商品
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
                <input type="hidden" name="id" value="{{$article->id}}">
                <tbody>
                    <tr>
                        <th width="120"><i class="require">*</i>分类：</th>
                        <td>
                            <select name="cate_id">
                                @foreach($cate as $v)
                                <option value="{{$v->id}}" @if($article->cate_id==$v->id) selected @endif>{{$v->cate_name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>文章标题：</th>
                        <td>
                            <input type="text" class="lg" name="art_title" value="{{$article->art_title}}">
                            <p>标题可以写30个字</p>
                        </td>
                    </tr>
                    <tr>
                        <th>作者：</th>
                        <td>
                            <input type="text" name="art_editor" value="{{$article->art_title}}">
                            <span><i class="fa fa-exclamation-circle yellow"></i>这里是默认长度</span>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>关键字：</th>
                        <td>
                            <input type="text" class="sm" name="art_tag" value="{{$article->art_tag}}">
                            {{--<span><i class="fa fa-exclamation-circle yellow"></i>这里是短文本长度</span>--}}
                        </td>
                    </tr>
                    <tr>
                        <script src="{{asset('resources/views/admin/js/uploadify/jquery.uploadify.min.js')}}"></script>
                        <link rel="stylesheet" type="text/css" href="{{asset('resources/views/admin/js/uploadify/uploadify.css')}}">
                        <th><i class="require">*</i>缩略图：</th>
                        <td>
                            <div id="queue"></div><input type="file" name="file_upload" id="file_upload" multiple="true"></td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>图片：</th>
                        <td>
                            <img src=""  id="img">
                        </td>
                    </tr>
                    <tr>
                        <th>描述：</th>
                        <td>
                            <textarea name="art_description" >{{$article->art_tag}}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>文章内容：</th>
                        <td>
                            <script src="{{asset('resources/views/admin/js/UEDitor/ueditor.config.js')}}"></script>
                            <script src="{{asset('resources/views/admin/js/UEDitor/ueditor.all.min.js')}}"></script>
                            <script src="{{asset('resources/views/admin/js/UEDitor/lang/zh-cn/zh-cn.js')}}"></script>
                            <script id="editor" type="text/plain" name="art_content" style="width:800px;height:300px;">{!! $article->art_content !!}</script>
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
<script type="text/javascript">
    var ue = UE.getEditor('editor');
    //图片上传，uploadify插件
    <?php $timestamp = time();?>
		$(function() {
        $('#file_upload').uploadify({
            'formData'     : {
                'timestamp' : '<?php echo $timestamp;?>',
                '_token'     : '{{csrf_token()}}'
            },
           // 'buttonImage' : '{{asset("resources/views/admin/js/uploadify/uploadify/browse-btn.png")}}',
            'buttonText':'图片上传',
            'swf'      : '{{asset('resources/views/admin/js/uploadify/uploadify.swf')}}',
            'uploader' : '{{url("upload")}}',
            'onUploadSuccess' : function(file, data, response) {
               $('#img').attr('src','/'+data);
            }
        });
    });

    //文章编辑ajax
    $('#submit').click(function(){
        var id=$('input[name="id"]').val();
        var art_content=ue.getContent();
        var  cate_id=$('select[name="cate_id"]').val();
        var  art_title=$('input[name="art_title"]').val();
        var  art_editor=$('input[name="art_editor"]').val();
        var  art_tag=$('input[name="art_tag"]').val();
        var art_description=$('textarea[name="art_description"]').val();
        var img=$("#img").attr('src');
        date={'id':id,'cate_id':cate_id,'art_title':art_title,'art_editor':art_editor,'art_tag':art_tag,'art_content':art_content,'art_thumb':img,'art_description':art_description,'_token':'{{csrf_token()}}'};
        var url='{{url("editArticle")}}';

        $.post(url,date,function(data){
            if(data=='1'){
                alert('修改文章成功');
                window.location.href="{{url('article/list')}}";
            }else{
                alert('修改文章失败');
            }
        });

    });
</script>
@endsection

