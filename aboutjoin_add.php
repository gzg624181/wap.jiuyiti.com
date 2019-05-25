<?php	
require_once(dirname(__FILE__).'/include/config.inc.php');


//应聘内容
if(isset($action) and $action=='add')
{
	if($name=="" || $tel=="" || $jingli=="" ){
	ShowMsg('填写内容不能为空!');
	exit();	
	}
	
	
		$name = htmlspecialchars($name);
		$birth  = htmlspecialchars($birth);
		$jiguan  = htmlspecialchars($jiguan);
		$xueli = htmlspecialchars($xueli);
		$zhuanye  = htmlspecialchars($zhuanye);
		$address  = htmlspecialchars($address);
		$regtime = date("Y-m-d",time());
		$ip       = gethostbyname($_SERVER['REMOTE_ADDR']);
	
	
		$sql = "INSERT INTO `#@__join` (name, sex, jiguan, birth, tel, youbian, email, xueli, zhuanye, school,address,jingli,regtime,zhiwei,ip) VALUES ('$name', $sex, '$jiguan', '$birth', '$tel', '$youbian', '$email', '$xueli', '$zhuanye', '$school','$address','$jingli','$regtime','$title','$ip')";
		if($dosql->ExecNoneQuery($sql))
		{
			ShowMsg('在线应聘成功！','aboutjoin-15-1.html');
			exit();
		}
	
}

?>
<link rel="stylesheet" href="templates/default/style/metinfo.css">
<link rel="stylesheet" href="templates/default/style/font-awesome-4.3.0/css/font-awesome.css">
<link rel="stylesheet" href="templates/default/style/font-awesome-4.3.0/css/font-awesome.min.css"> 
<script src="templates/default/js/shop_lang_cn.js"></script>
<script src="templates/default/js/metinfo.js"></script>
<script src="templates/default/js/shop_v3.js"></script>
<script type="text/javascript" src="layer/layer.js"></script>
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
 
 <form enctype="multipart/form-data" method="POST" class="met-form fv-form fv-form-bootstrap" action="aboutjoin_add.php" novalidate="novalidate">
 <button type="submit" class="fv-hidden-submit" style="display: none; width: 0px; height: 0px;"></button>
<div class="modal-body padding-bottom-0" style="display: block;">
	<div class="form-group">
					<div>
	<input name="name" id="name" class="form-control" placeholder="姓名 " data-fv-notempty="true" data-fv-message="不能为空" data-fv-field="para18" type="text">
					</div>
				</div>

				<div class="form-group">


					<div>
						
								<div class="radio-custom radio-primary">
									<input name="sex" checked="" value="1" id="sex" type="radio">
									<label for="para19_1">先生</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<input name="sex" value="0" id="sex" type="radio">
									<label for="para19_2">女士</label>
								</div>
					</div>
				</div>

				<div class="form-group">

					<div>
						<input name="birth" id="birth" class="form-control" placeholder="出生年月 " type="text">
					</div>
				</div>

				<div class="form-group">

					<div>
						<input name="jiguan" id="jiguan" class="form-control" placeholder="籍贯 " type="text">
					</div>
				</div>

				<div class="form-group">

					<div>
						<input name="tel" id="tel" class="form-control" placeholder="联系电话 " type="text">
					</div>
				</div>

				<div class="form-group">

					<div>
						<input name="youbian" id="youbian" class="form-control" placeholder="邮编 " type="text">
					</div>
				</div>

				<div class="form-group">

					<div>
						<input name="email" id="email" class="form-control" placeholder="E–mail "  type="text">
					</div>
				</div>

				<div class="form-group">

					<div>
						<input name="xueli" id="xueli" class="form-control" placeholder="学历 " type="text">
					</div>
				</div>

				<div class="form-group">

					<div>
						<input name="zhuanye" id="zhuanye" class="form-control" placeholder="专业 " type="text">
					</div>
				</div>

				<div class="form-group">

					<div>
						<input name="school" id="school" class="form-control" placeholder="学校 " type="text">
					</div>
				</div>

				<div class="form-group">

					<div>
						<input name="address" id="address" class="form-control" placeholder="通讯地址 " type="text">
					</div>
				</div>


				<div class="form-group">

					<div>
						<textarea name="jingli" id="jingli" class="form-control" placeholder="工作经历 " rows="2"></textarea>
					</div>
				</div>
				</div>
                <div class="modal-footer text-left">
                    <button type="submit" class="btn btn-primary btn-squared">提交</button>
					<input type="hidden" name="action" id="action" value="add">
					<input type="hidden" name="title" id="title" value="<?php echo $title;?>">
                    <button type="button" class="btn btn-default btn-squared" data-dismiss="modal">取消</button>
                </div>
            </form>
        