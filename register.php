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
<body>
<div class="container met-head">

			<div class="row">
				<div class="col-xs-6 col-sm-6 logo">
	<ul class="list-none">
		<li><a href="/" class="met-logo"><img title="武汉酒易提" src="templates/default/images/1502087410.png" /></a></li>

		<li>商户会员注册</li>

	</ul>
				</div>

				<div class="col-xs-6 col-sm-6 user-info">
					<ol class="breadcrumb pull-right">
					  <li><a href="/" title="返回首页">返回首页</a></li>
				  </ol>
				</div>
			</div>

</div>

<div class="register_index met-member">
	<div class="container">
		<form class="form-register met-form" method="post" action="productshow_save.php">

			<div class="form-group met-more text-muted">
				<hr />
				<span>请填下以下联系信息，申请成为酒易提商户自提点</span>
			</div>

			<div class="form-group met-form-choice">
				<div class="row">
					<div class="met-form-file-title col-md-3">联系人</div>
					<div class="col-md-9">
						<input type="text" id="Linkman" name="Linkman" class="form-control" value=""  placeholder="联系人">
					</div>
				</div>
			</div>

			<div class="form-group met-form-choice">
				<div class="row">
					<div class="met-form-file-title col-md-3">联系电话</div>
					<div class="col-md-9">
						<input type="text" name="Phone" id="Phone" class="form-control" value=""  placeholder="联系电话">
					</div>
				</div>
			</div>

			<div class="form-group met-form-choice">
				<div class="row">
					<div class="met-form-file-title col-md-3">联系地址</div>
					<div class="col-md-9">
						<input type="text" name="CommercialSite" id="CommercialSite" class="form-control" value=""  placeholder="联系地址">
					</div>
				</div>
			</div>


			<div class="form-group met-form-choice">
				<div class="row">
					<div class="met-form-file-title col-md-3">商户名称</div>
					<div class="col-md-9">
						<input type="text" name="CommercialName" class="form-control" value=""  placeholder="商户名称">
					</div>
				</div>
			</div>

      <div class="form-group met-form-choice">
        <div class="row">
          <div class="met-form-file-title col-md-3">留言内容</div>
          <div class="col-md-9">
            <textarea style="width: 100%; height: 80px;" type="text" name="joinmessage" id="joinmessage" class="form-control"/></textarea>
          </div>
        </div>
      </div>
			<button class="btn btn-lg btn-primary btn-block" type="submit">立即注册</button>
      <input type="hidden" name="action" id="action" value="add_business">
      <input type="hidden" name="CreatTime" id="CreatTime" value="<?php echo date("Y-m-d H:i:s",time());?>">
			<div class="login_link"><a href="login-1-1.html">已有账号？</a></div>
		</form>
	</div>
</div>
<?php include("footer.php");?>
</body>
</html>
