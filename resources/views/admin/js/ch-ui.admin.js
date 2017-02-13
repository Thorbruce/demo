/* 
* @Author: ChenHua <276004561@qq.com>
* @Date:   2015-09-14 21:11:36
* @Last Modified by:   ChenHua
* @Last Modified time: 2015-11-21 16:01:10
*/

//静止使用框架引用页面
// if(top != self){  
//     top.location.href=self.location.href;
// }

//左侧点击事件
$(function(){
	$('.sub_menu').find('li').click(function(){
		$(this).parents('.menu_box').find('li').removeClass('on');
		$(this).addClass('on');
	});
})

//左侧点击弹开子菜单
$(function(){
	$('.menu_box').find('ul').find('li').eq(0).find('.sub_menu').show();
	$('.menu_box').find('ul').find('li').find('h3').click(function(){
		$(this).parent('li').find('.sub_menu').slideToggle();
	});
})

//tab面板切换
$(function(){
	$('.tab_content').eq(0).show();
	$('.tab_title li').click(function() {
		var index = $(this).index();
		$(this).addClass('active').siblings('li').removeClass('active');
		$('.tab_content').eq(index).show().siblings('.tab_content').hide();
	});
});

//列表页点击全选按钮
$(function(){
	$('.list_tab').find('tr').find('[type=checkbox]').click(function(){
		$('.list_tab').find('td').find('[type=checkbox]').prop('checked',$(this).prop('checked'));
	});
})

//删除图片列表
function del_pic(obj){
	$(obj).parents('li').remove();
}

//添加图片上传框
function pic_plus(obj){
	var li = $(obj).parents('li').eq(0);
	var input = li.clone();
	input.find('span').attr('onclick','pic_minus(this)');
	input.find('span i').removeClass('fa-plus-circle').addClass('fa-minus-circle');
	input.insertAfter(li);
}

//删除图片上传框
function pic_minus(obj){
	$(obj).parents('li').remove();
}


function errorMessage(id,msg){
	_em = typeof(id)=='object' ? id : $('#_'+id+'_err');
	if(msg){
		_em.html(msg);
		_em.removeClass('success');
		_em.addClass('error')
	}else{
		_em.html('');
		_em.removeClass('error')
	}
}

$("#save-info").live("click",function(){
	var self = $(this);
	if($(this).hasClass("btn-disable")) return ;

	//原密码
	var oldPwd = $('input[name=oldPwd]').val();
	if($.trim(oldPwd) == ''){
		errorMessage('oldPwd','原密码不能为空');
		return;
	}
	var p = /^[\w]{6,16}$/gi;
	if(!p.test(oldPwd)){
		errorMessage('oldPwd','密码为6-16位字符或数字、字母,区分大小写');
		return;
	}
	errorMessage('oldPwd');

	//新密码
	var newPwd = $('input[name=newPwd]').val();

	if($.trim(newPwd) == ''){
		errorMessage('newPwd','新密码不能为空');
		return;
	}
	var p2 = /^[\w]{6,16}$/gi;
	if(!p2.test(newPwd)){
		errorMessage('newPwd','密码为6-16位字符或数字、字母,区分大小写');
		return;
	}
	errorMessage('newPwd');

	//确认密码
	var surePwd = $('input[name=surePwd]').val();
	if($.trim(surePwd) == ''){
		errorMessage('surePwd','确认密码不能为空');
		return;
	}
	if(surePwd != newPwd){
		errorMessage('surePwd','两次密码不一致，请重新输入');
		return;
	}
	errorMessage('surePwd');

	self.addClass("btn-disable");
	self.text("保存中...");
	var token = $('input[name=_token]').val();
	$.post("/laravel2/admin/changePwd",{'_token':token,'oldPwd':oldPwd,'newPwd':newPwd,},function(data){
		self.removeClass("btn-disable");
		self.text("保存");
		if(data.code == 1) {
			alert(data.msg);
		}else{
			alert(data.msg);
		}
	})

})
