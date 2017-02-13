<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="{{asset('resources/views/admin/css/ch-ui.admin.css')}}">
	<link rel="stylesheet" href="{{asset('resources/views/admin/font/css/font-awesome.css')}}">
	<script src="{{asset('resources/views/admin/js/jquery.js')}}"></script>
	<script>
		$(document).ready(function () {
			$('#submit').click(function(){
				var username=$('input[name="username"]').val();
				var password=$('input[name="password"]').val();
				var code=$('input[name="code"]').val();
				if(username==''){
					$('#msg').html('请输入您的用户名！');
					return false;
				}else if(password==''){
					$('#msg').html('请输入您的密码！');
					return false;
				}else if(code==''){
					$('#msg').html('请输入您的验证码！');
					return false;
				}
				var url='{{url('login')}}';
				$.ajax({
					url: url,
					type: 'post',
					data: {'username':username,'password':password,'code':code,'_token':'{{csrf_token()}}' },//token是必须传的,表单跟ajax都必须要提交
					async: true,
					success: function (data) {

							if(data!=1){
								$('#msg').html(data);
							}else{
								window.location.href="{{url('index')}}";
							}


					}
				});
			});
		});
	</script>
</head>
<body style="background:#F3F3F4;">
	<div class="login_box">
		<h1>Blog</h1>
		<h2>欢迎使用博客管理平台</h2>
		<div class="form">

			<p style="color:red" id="msg"></p>


				<ul>
					<li>
					<input type="text" name="username" class="text" />
						<span><i class="fa fa-user"></i></span>
					</li>
					<li>
						<input type="password" name="password" class="text" />
						<span><i class="fa fa-lock"></i></span>
					</li>
					<li>
						<input type="text" class="code" name="code"/>
						<span><i class="fa fa-check-square-o"></i></span>
						<img src="{{url('code')}}" alt="" onclick="this.src='{{url("code")}}?id='+Math.random()" id="img">
					</li>
					<li>
						<input type="submit" value="立即登陆" id="submit"/>
					</li>
				</ul>

			<p><a href="#">返回首页</a> &copy; 2016 Powered by <a href="http://www.365cz.com" target="_blank">http://www.365cz.com</a></p>
		</div>
	</div>
</body>
</html>