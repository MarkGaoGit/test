<?php include template('header','admin');?>

	<form name="form-validate" method="post">
	<div class="form-box border-bottom-none order-eidt-popup clearfix">
		<?php echo Form::input('textarea','msg','','是否确认订单：','',array('placeholder' => '请填写订单操作日志（选填）')) ?>
	</div>
	<div class="padding text-right ui-dialog-footer">
		<input type="hidden" name="sub_sn" value="<?php echo $_GET['sub_sn'];?>" />
		<input type="submit" class="button bg-main" id="okbtn" value="确定" data-name="dosubmit" data-reset="false"/>
		<input type="button" class="button margin-left bg-gray" id="closebtn" value="取消"  data-reset="false"/>
	</div>
	</form>
</body>
</html>

<script>
	$(function(){
		try {
			var dialog = top.dialog.get(window);
		} catch (e) {
			return;
		}
		
		dialog.title('确认订单');
		dialog.reset();     // 重置对话框位置
		$("form[name='form-validate']").Validform({
			ajaxPost:true,
			dragonfly:true,
			callback:function(ret) {
				message(ret.message);
				if(ret.status == 1) {
					setTimeout(function(){
						dialog.close();
						window.top.main_frame.location.reload();
					}, 1000);
				}
				return false;
			}
		})

		$('#closebtn').on('click', function () {
			dialog.remove();
			return false;
		});

	})
</script>
