@extends('admin/common/top')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{URL('info')}}">首页</a> &raquo; <a href="{{url('category')}}">文章管理</a> &raquo; 文章列表
    </div>
    <!--面包屑导航 结束-->

	<!--结果页快捷搜索框 开始-->
	<div class="search_wrap">

            <table class="search_tab">
                <tr>
                    <th width="120">选择分类:</th>
                    <td>
                        <select onchange="javascript:location.href=this.value;">
                            <option value="">全部</option>
                            <option value="http://www.baidu.com">百度</option>
                            <option value="http://www.sina.com">新浪</option>
                        </select>
                    </td>
                    <th width="70">关键字:</th>
                    <td><input type="text" name="keywords" placeholder="关键字"></td>
                    <td><input type="submit" name="sub" value="查询"></td>
                </tr>
            </table>
        </form>
    </div>
    <!--结果页快捷搜索框 结束-->

    <!--搜索结果页面 列表 开始-->

        <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('article/index')}}"><i class="fa fa-plus"></i>添加文章</a>
                    <a href="{{url('article/list')}}"><i class="fa fa-recycle"></i>全部文章</a>

                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>

                        <th class="tc">ID</th>
                        <th class="tc">标题</th>
                        <th class="tc">作者</th>
                        <th class="tc">分类名称</th>
                        <th class="tc">关键词</th>
                        <th class="tc">点击</th>
                        <th class="tc">发布时间</th>
                        <th class="tc">修改</th>
                    </tr>
                    @foreach($article as $v)
                    <tr>
                        <td class="tc">
                            {{$v->id}}
                        </td>
                        <td class="tc" id="c">{{$v->art_title}}</td>
                        <td class="tc" id="c">{{$v->art_editor}}</td>
                        <td class="tc">
                            {{$v->cate_name}}
                        </td>
                        <td class="tc">{{$v->art_description}}</td>
                        <td class="tc">{{$v->art_view}}</td>
                        <td class="tc">{{date('Y-m-d  H:i:s',$v->art_time)}}</td>
                        <td >
                            <a href="{{url('article/edit/'.$v->id)}}">修改</a>
                            <a href="{{url('article/delete/'.$v->id)}}">删除</a>
                        </td>
                    </tr>
                @endforeach


                </table>


<div class="page_nav">
{{--<div>--}}
{{--<a class="first" href="/wysls/index.php/Admin/Tag/index/p/1.html">第一页</a> --}}
{{--<a class="prev" href="/wysls/index.php/Admin/Tag/index/p/7.html">上一页</a> --}}
{{--<a class="num" href="/wysls/index.php/Admin/Tag/index/p/6.html">6</a>--}}
{{--<a class="num" href="/wysls/index.php/Admin/Tag/index/p/7.html">7</a>--}}
{{--<span class="current">8</span>--}}
{{--<a class="num" href="/wysls/index.php/Admin/Tag/index/p/9.html">9</a>--}}
{{--<a class="num" href="/wysls/index.php/Admin/Tag/index/p/10.html">10</a> --}}
{{--<a class="next" href="/wysls/index.php/Admin/Tag/index/p/9.html">下一页</a> --}}
{{--<a class="end" href="/wysls/index.php/Admin/Tag/index/p/11.html">最后一页</a> --}}
{{--<span class="rows">11 条记录</span>--}}
{{--</div>--}}
</div>

                <div class="page_list">
                    {{$article->links()}}
                </div>


        </div>
            <style>
                .result_content ul li span {
                    font-size: 15px;
                    padding: 6px 12px;
                }
            </style>
    <!--搜索结果页面 列表 结束-->
<script>

        function changeorder(id) {
            var orderId = $('#order_id').val();
            var url = '{{url("changeorder")}}';
            {{--$.post(url, {'orderId': orderId, 'id': id, '_token': '{{csrf_token()}}'}, function (data) {--}}
                  {{--if(data=='1'){--}}
                       {{--window.location.href="{{url('category')}}";--}}
                  {{--}--}}
                {{--alert(data);--}}

            {{--})--}}
            alert(orderId);

        }

</script>
@endsection