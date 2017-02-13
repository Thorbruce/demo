@extends('admin/common/top')
@section('content')
    <!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; 修改密码
</div>
<!--面包屑导航 结束-->

<!--结果集标题与导航组件 开始-->
<div class="result_wrap">
    <div class="result_title">
        <h3>修改密码</h3>
    </div>
</div>
<!--结果集标题与导航组件 结束-->

<div class="result_wrap">

        <table class="add_tab">
            <tbody>
            <tr>
                <th width="120"><i class="require">*</i>原密码：</th>
                <td>
                    <input type="password" name="oldPwd"> </i><span class="" id="_oldPwd_err" >请输入旧密码</span>
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>新密码：</th>
                <td>
                    <input type="password" name="newPwd"> </i><span class="" id="_newPwd_err" >新密码6-20位</span>
                </td>
                
            </tr>
            <tr>
                <th><i class="require">*</i>确认密码：</th>
                <td>
                    <input type="password" name="surePwd"> </i><span class="" id="_surePwd_err" >请再次确认密码</span>
                </td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <a href="javascript:void(0)" style="" id="save-info">保存</a>
                    <!-- <input type="submit" value="提交"> -->
                </td>
            </tr>
            </tbody>
        </table>
</div>
<script>
    $(function () {
        $('#save-info').click(function () {
            var oldPwd=$('input[name="oldPwd"]').val();
            var newPwd=$('input[name="newPwd"]').val();
            var surePwd=$('input[name="surePwd"]').val();
                if(oldPwd==''||newPwd==''||surePwd==''){
                    if(oldPwd==''){
                        $('#_oldPwd_err').css("color","red").html('旧密码不能为空');
                    }else{
                        $('#_oldPwd_err').html('');
                    }
                    if(newPwd==''){
                        $('#_newPwd_err').css("color","red").html('新密码不能为空');
                    }else{
                        $('#_newPwd_err').html('');
                    }

                    if(surePwd==''){
                        $('#_surePwd_err').css("color","red").html('再次确认密码不能为空');
                    }else{
                        $('#_surePwd_err').html('');
                    }
                    return false;
                }else{
                    $('#_oldPwd_err').html('');
                    $('#_newPwd_err').html('');
                    $('#_surePwd_err').html('');
                    if(newPwd!=surePwd){
                        $('#_newPwd_err').css("color","red").html('新旧密码不一致');
                        return false;
                    }
                }
            var url='{{url("password")}}';
            $.ajax({
                url: url,
                type: 'post',
                data: {'oldPwd':oldPwd,'newPwd':newPwd,'surePwd':surePwd,'_token':'{{csrf_token()}}' },//token是必须传的,表单跟ajax都必须要提交
                async: true,
                success: function (data) {

                   if(data=='1'){
                       $('#_oldPwd_err').css("color","red").html('旧密码不对');
                   }else if(data=='2'){
                        $('#_newPwd_err').css("color","red").html('两次输入新密码不正确');
                    }else if(data=='3'){
                        alert('修改成功');
                       window.location.href="{{url('info')}}";
                   }



                }
            });


        });
    });
</script>
@endsection
