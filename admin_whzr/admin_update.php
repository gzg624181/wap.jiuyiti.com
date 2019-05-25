<?php require_once(dirname(__FILE__).'/inc/config.inc.php');IsModelPriv('admin'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改管理员</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/checkf.func.js"></script>
<script type="text/javascript" src="templates/js/getarea.js"></script>
</head>
<body>
<?php
$row = $dosql->GetOne("SELECT * FROM `#@__admin` WHERE `id`=$id");
$adminlevel= $_SESSION['adminlevel'];
?>
<div class="formHeader"> <span class="title">修改管理员</span> <a href="javascript:location.reload();" class="reload">刷新</a> </div>
<form name="form" id="form" method="post" action="admin_save.php" onsubmit="return cfm_upadmin();">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="formTable">
		<tr>
			<td width="25%" height="40" align="right">用户名：</td>
			<td width="75%"><strong><?php echo $row['username']; ?></strong></td>
		</tr>
		<tr>
			<td height="40" align="right">旧密码：</td>
			<td><input type="password" name="oldpwd" id="oldpwd" class="input" maxlength="16" />
				<span class="maroon">*</span><span class="cnote">若不修改密码请留空</span></td>
		</tr>
		<tr>
			<td height="40" align="right">新密码：</td>
			<td><input type="password" name="password" id="password" class="input" maxlength="16" />
				<span class="maroon">*</span><span class="cnote">6-16个字符组成，区分大小写</span></td>
		</tr>
		<tr>
			<td height="40" align="right">确　认：</td>
			<td><input type="password"  name="repassword" id="repassword" class="input" maxlength="16" />
				<span class="maroon">*</span></td>
		</tr>
		<tr>
		  <td height="40" align="right" >酒　钱：</td>
		  <td>
          
          <input  name="jiuqian" type="text" class="input" id="jiuqian" <?php if($adminlevel!=1){ echo "readonly='readonly'";}?> value="<?php echo $row['jiuqian']; ?>" maxlength="16" />
          
	      <span class="maroon">*</span></td>
	  </tr>
		<tr>
			<td height="40" align="right" >提　问：</td>
			<td><select name="question" id="question"  class="input" style="width:285px;">
				<?php
				$question = array('无安全提问',
								  '母亲的名字',
								  '爷爷的名字',
								  '父亲出生的城市',
								  '你其中一位老师的名字',
								  '你个人计算机的型号',
								  '你最喜欢的餐馆名称',
								  '驾驶执照最后四位数字');

				foreach($question as $k=>$v)
				{
					if($row['question'] == $k)
						$selected = 'selected="selected"';
					else
						$selected = '';

					echo "<option value=\"$k\" $selected>$v</option>";									
				}
				?>
				</select></td>
		</tr>
		<tr>
			<td height="40" align="right">回　答：</td>
			<td><input type="text" name="answer" id="answer" class="input" value="<?php echo $row['answer']; ?>" /></td>
		</tr>
		<?php 
		if($adminlevel==1){
		?>
		<tr>
		  <td height="40" align="right">用户省份：</td>
		  <td><select name="live_prov" id="live_prov" style="width:118px;" class="input" onchange="SelProv(this.value,'live');">
					<option value="-1">请选择</option>
					<?php
					$dosql->Execute("SELECT * FROM `#@__cascadedata` WHERE `datagroup`='area' AND level=0 ORDER BY orderid ASC, datavalue ASC");
					while($row2 = $dosql->GetArray())
					{
						if($row['live_prov'] === $row2['dataname'])
							$selected = 'selected="selected"';
						else
							$selected = '';

						echo '<option value="'.$row2['datavalue'].'" '.$selected.'>'.$row2['dataname'].'</option>';
					}
					?>
				</select> &nbsp;&nbsp;城市：<select style="width:118px;" class="input" name="live_city" id="live_city"  onchange="SelCity(this.value,'live');">
		 <option value="-1">--</option>
					<?php
					$dosql->Execute("SELECT * FROM `#@__cascadedata` WHERE `datagroup`='area' AND level=1 AND datavalue>".$row['prov']." AND datavalue<".($row['prov'] + 500)." ORDER BY orderid ASC, datavalue ASC");
					while($row2 = $dosql->GetArray())
					{
						if($row['live_city'] === $row2['dataname'])
							$selected = 'selected="selected"';
						else
							$selected = '';

						echo '<option value="'.$row2['datavalue'].'" '.$selected.'>'.$row2['dataname'].'</option>';
					}
					?>
	      </select></td>
	  </tr>
		<?php }else{ ?>
	  <tr>
		  <td height="40" align="right">用户省份：</td>
		  <td><select name="live_prov" id="live_prov" style="width:118px;" class="input">
					<option value="<?php echo $row['prov'];?>"><?php echo $row['live_prov'];?></option>
			 </select> &nbsp;&nbsp;城市：<select style="width:118px;" class="input" name="live_city" id="live_city">
		          <option value="<?php echo $row['city'];?>"><?php echo $row['live_city'];?></option>
	      </select></td>
	  </tr>
	    <?php }?>
        <?php 
		if($adminlevel==1){
		?>
		<tr>
			<td height="40" align="right">联系人：</td>
			<td><input type="text"  name="nickname" id="nickname" class="input" value="<?php echo $row['nickname']; ?>" />
		    <span class="maroon">*</span></td>
		</tr>
		<tr>
		  <td height="40" align="right">联系电话：</td>
		  <td><input type="text"  name="phone" id="phone" class="input" value="<?php echo $row['phone']; ?>" />
          <span class="maroon">*</span></td>
	  </tr>
      <?php }?>
		<tr>
			<td height="40" align="right">管理组：</td>
			<td>
			<select name="levelname" id="levelname" class="input" style="width:285px;">
				<?php
				if($cfg_adminlevel==1){
				$dosql->Execute("SELECT * FROM `#@__admingroup` WHERE `checkinfo`='true' ORDER BY `id` ASC");
				while($row2 = $dosql->GetArray())
				{

					if($row['levelname'] == $row2['id'])
						$selected = 'selected="selected"';
					else
						$selected = '';


				echo '<option value="'.$row2['id'].'" '.$selected.'>'.$row2['groupname'].'</option>';
					
				}
				}else{
				$row3=$dosql->GetOne("SELECT * FROM `#@__admingroup` WHERE `checkinfo`='true' and id=$adminlevel");
				echo '<option value="'.$row3['id'].'" '.$selected.'>'.$row3['groupname'].'</option>';	
				}
				
				?>
				</select>
				</td>
		</tr>
		<?php
		if($_SESSION['adminlevel']==1){
		?>
		<tr>
			<td height="40" align="right">审　核：</td>
			<td><input type="radio" name="checkadmin" value="true" <?php if($row['checkadmin'] == 'true') echo 'checked="checked"'; ?> />
				已审核&nbsp;
				<input type="radio" name="checkadmin" value="false" <?php if($row['checkadmin'] == 'false') echo 'checked="checked"'; ?> />
				未审核</td>
		</tr>
		<?php }?>
		<tr>
			<td height="40" align="right">登录时间：</td>
			<td><?php echo GetDateTime($row['logintime']); ?></td>
		</tr>
		<tr class="nb">
			<td height="40" align="right">登录IP：</td>
			<td><?php echo $row['loginip']; ?></td>
		</tr>
	</table>
	<div class="formSubBtn">
		<input type="submit" class="submit" value="提交" />
		<input type="button" class="back" value="返回" onclick="history.go(-1)"  />
		<input type="hidden" name="action" id="action" value="update" />
		<input type="hidden" name="level" id="level" value="<?php echo $adminlevel; ?>" />
        <input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
	</div>
</form>
</body>
</html>