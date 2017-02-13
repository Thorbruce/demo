@extends('admin/common/top')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{URL('info')}}">首页</a> &raquo; <a href="{{url('category')}}">分类管理</a> &raquo; 分类列表
    </div>
    <!--面包屑导航 结束-->

	<!--结果页快捷搜索框 开始-->
	<div class="search_wrap">
        <form action="" method="post">
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
                    <a href="{{url('addcategory')}}"><i class="fa fa-plus"></i>添加分类</a>
                    <a href="{{url('category')}}"><i class="fa fa-recycle"></i>全部分类</a>

                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc" width="5%"><input type="checkbox" name=""></th>
                        <th class="tc">排序</th>
                        <th class="tc">ID</th>
                        <th>分类名称</th>
                        <th>标题</th>
                        <th>点击</th>
                        <th>操作</th>
                    </tr>
                    @foreach($cate as $k)
                    <tr>
                        <td class="tc"><input type="checkbox" name="id[]" value="{{$k['id']}}" ></td>
                        <td class="tc">
                            <input type="text" name="ord" value="{{$k['cate_order']}}"  onchange="changeorder({{$k['id']}})" id="order_id">
                        </td>
                        <td class="tc" id="c">{{$k['id']}}</td>
                        <td>
                            <a href="#">{{$k['cate_name']}}</a>
                        </td>
                        <td>{{$k['cate_title']}}</td>
                        <td>2</td>
                        <td>
                            <a href="{{url('category/'.$k->id.'/edit')}}">修改</a>
                            <a href="{{url('delete/'.$k->id)}}">删除</a>
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




        </div>

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