<?php require_once(dirname(__FILE__).'/include/config.inc.php');
$cid = empty($cid) ? 1 : intval($cid);
 ?>
<!DOCTYPE HTML>
<html>
<head>
<meta name="renderer" content="webkit">
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<?php echo GetHeader(); ?>
<link rel="stylesheet" type="text/css" href="templates/default/style/metinfo.new.css" />
<link rel="stylesheet" href="templates/default/style/metinfo.css">
<link rel="stylesheet" href="templates/default/style/font-awesome-4.3.0/css/font-awesome.css">
<link rel="stylesheet" href="templates/default/style/font-awesome-4.3.0/css/font-awesome.min.css">
</head>
<script>
  function forget(){
    alert("请联系管理员qq546963097或微信小程序客服获取密码！");
  }
</script>
<body>
<div class="container met-head">

			<div class="row">
				<div class="col-xs-6 col-sm-6 logo">
	<ul class="list-none">
		<li><a href="/" class="met-logo">
		<img title="武汉酒易提" src="templates/default/images/1502087410.png" /></a></li>

		<li>会员登录</li>

	</ul>
				</div>

				<div class="col-xs-6 col-sm-6 user-info">
					<ol class="breadcrumb pull-right">

					  <li><a href="/" title="返回首页">返回首页</a></li>
					</ol>
				</div>
			</div>

</div>

<div class="login_index met-member">
	<div class="container">
		<form method="post" action="save.php">
			<div class="form-group">
				<input type="text" style="width:100%; border-radius:3px;" name="username" required class="form-control" placeholder="用户名"
				data-bv-notempty="true"
				data-bv-notempty-message="此项不能为空"
				>
			</div>
			<div class="form-group">
				<input type="password" style="width:100%;border-radius:3px;" name="password" required class="form-control" placeholder="密码"
				data-bv-notempty="true"
				data-bv-notempty-message="此项不能为空"
				>
			</div>

			<div class="login_link"><a style="cursor:pointer;" onclick="return forget();">忘记密码？</a></div>
		    <input type="hidden" value="login" name="action">
			<button class="btn btn-lg btn-primary btn-block" type="submit" style="border-radius:3px;">登录</button>
			<a class="btn btn-lg btn-info btn-block" style="border-radius:3px;" href="register-1-1.html">没有账号？现在去注册</a>

		</form>
	</div>
</div>

<?php include("footer.php");?>
</body>
</html>
