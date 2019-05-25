<?php require_once(dirname(__FILE__).'/inc/config.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加商品</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/getuploadify.js"></script>
<script type="text/javascript" src="templates/js/checkf.func.js"></script>
<script type="text/javascript" src="templates/js/getjcrop.js"></script>
<script type="text/javascript" src="templates/js/getinfosrc.js"></script>
<script type="text/javascript" src="plugin/colorpicker/colorpicker.js"></script>
<script type="text/javascript" src="plugin/calendar/calendar.js"></script>
<script type="text/javascript" src="editor/kindeditor-min.js"></script>
<script type="text/javascript" src="editor/lang/zh_CN.js"></script>
<script type="text/javascript" src="templates/js/ajax.js"></script>
<script type="text/javascript" src="templates/js/getarea.js"></script>
<script>
 function fenlei(s){
	var ajax_url='pp_ajax.php?s='+s;
  //  alert(ajax_url);
	$.ajax({
    url:ajax_url,
    type:'get',
	data: "data" ,
	dataType:'json',
    success:function(msg){
    $("#hot").html(msg.hot);
	$("#leixing").html(msg.leixing);
	$("#countrys").html(msg.country);
    },
	error:function(){
       alert('error');
    }
	});
}
function huiyuanjq(){
	var price=$("#NewPrice").val();
	var hyjq =$("#hyjq").val();
	var huiyuanmoney= parseInt(price * hyjq/100);
	document.getElementById("JiuQian").value=huiyuanmoney;
	}
function shangjiajq(){
	var price=$("#NewPrice").val();
	var sjjq =$("#sjjq").val();
	var shangjiamoney= parseInt(price * sjjq/100);
	document.getElementById("SJJiuQian").value=shangjiamoney;
	}
</script>
</head>
<body>
<?php
$username=$_SESSION['admin'];
$adminlevel=$_SESSION['adminlevel'];
$r=$dosql->GetOne("select * from pmw_admin where username='$username'");
$live_city=$r['live_city'];
$live_prov=$r['live_prov'];
?>
<div class="formHeader"> <span class="title">添加商品</span> <a href="javascript:location.reload();" class="reload">刷新</a> </div>
<input type="hidden" name="hyjq" id="hyjq" value="<?php echo $cfg_hymoney;?>" />
<input type="hidden" name="sjjq" id="sjjq" value="<?php echo $cfg_sjmoney;?>" />
<form name="form" id="form" method="post" action="product_save.php" onsubmit="return cfm_infolm();">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="formTable">
		<tr>
			<td width="15%" height="40" align="right">商品名称：</td>
			<td colspan="11"><input type="text" name="Title" id="Title" class="input"/></td>
		</tr>
		<tr>
			<td height="40" align="right">上传图片：</td>
			<td colspan="11" valign="middle">
            <input type="text" name="picurl" id="picurl" class="input" />
				<span class="cnote"><span class="grayBtn" onclick="GetUploadify('uploadify','缩略图上传','image','image',1,<?php echo $cfg_max_file_size; ?>,'picurl')">上 传</span> <span class="rePicTxt">
				<input type="checkbox" name="rempic" id="rempic" value="true" />
				远程</span> <span class="cutPicTxt"><a href="javascript:;" onclick="GetJcrop('jcrop','picurl');return false;">裁剪</a></span> </span>（长宽比例 2：1）
           </td>
	  </tr>
        <tr>
			<td height="40" align="right">搜索图片：</td>
			<td colspan="11" valign="middle">
            <input type="text" name="picurl2" id="picurl2" class="input" />
				<span class="cnote"><span class="grayBtn" onclick="GetUploadify('uploadify','缩略图上传','image','image',1,<?php echo $cfg_max_file_size; ?>,'picurl2')">上 传</span> <span class="rePicTxt">
				<input type="checkbox" name="rempic" id="rempic" value="true" />
				远程</span> <span class="cutPicTxt"><a href="javascript:;" onclick="GetJcrop('jcrop','picurl');return false;">裁剪</a></span> </span>（长宽比例 1：1）
           </td>
	  </tr>
        <tr class="nb">
			<td height="124" align="right">组　图：</td>
			<td colspan="11"><fieldset class="picarr">
					<legend>列表</legend>
					<div>最多可以上传<strong>50</strong>张图片<span onclick="GetUploadify('uploadify2','组图上传','image','image',50,<?php echo $cfg_max_file_size; ?>,'picarr','picarr_area')">开始上传</span></div>
					<ul id="picarr_area">
					</ul>
				</fieldset>（长宽比例 2：1）</td>
		</tr>
		<tr>
		  <td height="40" align="right">简　介：</td>
		  <td colspan="11"><textarea style="width: 64.2%; height: 45px;" type="text" name="summary" id="summary" class="input"/></textarea></td>
    </tr>
		<tr>
			<td height="40" align="right">商品现价：</td>
			<td width="18%"><input type="text" name="NewPrice" id="NewPrice" class="input"/></td>
			<td width="6%" align="right">商品原价：</td>
			<td colspan="9"><input style="width:156px;" type="text" name="OldPrice" id="OldPrice" class="input" />
		    &nbsp;&nbsp;&nbsp;&nbsp;商户价格：
		    <input style="width:156px;" type="text" name="shprice" id="shprice" class="input" /></td>
		</tr>
		<tr>
		  <td height="40" align="right">酒钱数：</td>
		  <td><input type="text" readonly="readonly" name="JiuQian" onfocus="huiyuanjq();" id="JiuQian" class="input" /></td>
		  <td align="right"> 推荐指数：</td>
		  <td colspan="9"><input style="width:403px;" type="text" name="RecommendIndex" id="RecommendIndex" class="input" />
		  <div id="pro" style="font-size:12px; color:#ffa8a8;display:inline;">（推荐指数为：1-10之间）</div></td>
	  </tr>

		<tr>
		  <td height="40" align="right">商家酒钱：</td>
		  <td><input type="text" name="SJJiuQian" readonly="readonly" id="SJJiuQian" onfocus="shangjiajq();" class="input"/></td>
		  <td align="right">是否为预约：</td>
		  <td><select name="yuyue" class="input" style="width:80px;" id="yuyue">
		    <!--0 不预约，1 预约-->
		    <option value="1" >是</option>
		    <option value="0" >否</option>
	      </select></td>
          <?php
		  if($adminlevel==1){
		  ?>
		  <td align="right">商品省份：</td>
		  <td><select name="live_prov" style="width:80px;" class="input" id="live_prov" onchange="SelProv(this.value,'live');">
		    <option value="-1">请选择</option>
		    <?php
					$dosql->Execute("SELECT * FROM `#@__cascadedata` WHERE `datagroup`='area' AND level=0 ORDER BY orderid ASC, datavalue ASC");
					while($row = $dosql->GetArray())
					{
						echo '<option value="'.$row['datavalue'].'">'.$row['dataname'].'</option>';
					}
					?>
	      </select></td>
		  <td width="4%" align="right">城市：</td>
		  <td width="6%" id="hot3"><select style="width:80px;" class="input" name="live_city" id="live_city" onchange="SelCity(this.value,'live');">
		    <option value="-1">--</option>
	      </select></td>
          <?php
		  }elseif($adminlevel==2){
		  $s=$dosql->GetOne("select * from `#@__cascadedata` where dataname='$live_prov'");
		  $prov=$s['id'];
		  $l=$dosql->GetOne("select * from `#@__cascadedata` where dataname='$live_city'");
		  $city=$s['id'];
		  ?>
          <td align="right">商品省份：</td>
		  <td><select name="live_prov" style="width:80px;" class="input" id="live_prov">
		     <option value="<?php echo $prov;?>"><?php echo $live_prov;?></option>
	         </select></td>
		  <td width="4%" align="right">商品城市：</td>
		  <td width="6%" id="hot3"><select style="width:80px;" class="input" name="live_city" id="live_city" >
		    <option value="<?php echo $city;?>"><?php echo $live_city;?></option>
	      </select></td>
          <?php }?>
		  <td width="3%" align="right">&nbsp;</td>
		  <td width="7%" id="leixing3">&nbsp;</td>
		  <td width="3%" align="right">&nbsp;</td>
		  <td width="28%"  id="countrys3">&nbsp;</td>
    </tr>
        <tr>
		  <td height="40" align="right">活动类型：</td>
		  <td><select style="width:507px;" name="ActivityType" id="ActivityType" class="input" >
		    <option value="0">无活动</option>
		    <option value="1">限时抢购</option>
		    <option value="2">限时超返</option>
		    <option value="3">热销</option>
		    <option value="4">新品上市</option>
	      </select></td>
		  <td align="right">类型：</td>
		  <td width="7%"><select name="CommodityType" id="CommodityType" class="input"  style="width:80px;">
		    <option value="0">酒品</option>
		    <option value="1">换购产品</option>
	      </select></td>
		  <td width="5%" align="right">商品分类：</td>
		  <td width="6%"><select onchange="fenlei(this.value)" class="input"  style="width:80px;" onblur="tuiji_fan(this.value)" name="CommodityClass" id="CommodityClass">
		    <?php
		$a=0;
		$b=1;
		$dosql->Execute("SELECT * FROM `pmw_maintype` where parentid=0 and checkinfo='true'",$a);
		while($row = $dosql->GetArray($a))
		{
		    $pinpaiid=$row['id'];
			$dosql->Execute("SELECT * FROM `pmw_maintype` where parentid=$pinpaiid and parentstr like '%$pinpaiid%' and checkinfo='true'",$b);
			for($i=0;$i<$dosql->GetTotalRow($b);$i++){
			$show=$dosql->GetArray($b);
		    $Data[$i]=$show;
			}
		?>
		    <option value="<?php echo $Data[0]['id'];?>,<?php echo $Data[1]['id'];?>,<?php echo $Data[2]['id'];?>,<?php echo $row['id'];?>"><?php echo $row['classname'];?></option>
		    <?php
		}
		?>
	      </select></td>
		  <td align="right">品牌：</td>
		  <td id="hot">
		    <select name="pinpai" id="pinpai" class="input" style="width:80px;">
		    <option value="0">热门品牌</option>
			</select>
		   </td>
		  <td align="right">类型：</td>
		  <td id="leixing">
		  <select name="types" id="types" class="input" style="width:80px;">
		    <option value="0">类型</option>
			</select>
			</td>
		  <td align="right">国家：</td>
		  <td  id="countrys"><div style="font-size:12px; color:#ffa8a8;display:inline;">
		    <select name="country" id="country" class="input" style="width:80px;">
		      <option value="0">国家</option>
			</select>
	        </select>
		  </div></td>
    </tr>
		<tr>
		  <td height="40" align="right">首页广告：</td>
		  <td><p>
          <label>
		      <input type="radio" name="gd" value="1" id="gd" />
		      是</label>
          &nbsp;&nbsp;
		    <label>
		      <input name="gd" type="radio" id="gd" value="0" checked="checked" />
		      否</label>
           &nbsp;&nbsp;

		    （首页广告位显示）<br />
	      </p></td>
		  <td align="right">所属账号：</td>
          <?php
		  if($adminlevel==1){
		  ?>
		  <td colspan="4"><select name="username" id="username" class="input"  style="width:80px;">
            <option value="-1">请选择</option>
            <?php
		$dosql->Execute("SELECT * FROM `#@__admin`");
		while($row = $dosql->GetArray())
		{
		?>
		    <option value="<?php echo $row['username'];?>"><?php echo $row['username'];?>（<?php echo $row['live_prov'];?><?php echo $row['live_city'];?>）</option>
		   <?php }?>

	      </select>
		    <span style="font-size: 12px;color: #09f; display: inline;font-weight: bold;">（所属城市和所属账号城市应选择一致）</span></td>
          <?php }else{ ?>
          <td colspan="4"><select name="username" id="username" class="input"  style="width:80px;">
            <option value="<?php echo $username;?>"><?php echo $username;?><?php echo $live_prov;?><?php echo $live_city;?></option>
	      </select>
		    <span style="font-size: 12px;color: #09f; display: inline;font-weight: bold;">（商品所属城市和所属账号城市应选择一致）</span></td>
          <?php }?>
		  <td id="hot4">&nbsp;</td>
		  <td align="right">&nbsp;</td>
		  <td id="leixing4">&nbsp;</td>
		  <td align="right">&nbsp;</td>
		  <td  id="countrys4">&nbsp;</td>
    </tr>
		<tr>
		  <td height="128" align="right">产品参数：</td>
		  <td colspan="11"><textarea name="canshu" id="canshu" class="kindeditor"></textarea>
				<script>
				var editor;
				KindEditor.ready(function(K) {
					editor = K.create('textarea[name="canshu"]', {
						allowFileManager : true,
						width:'1200px',
						height:'120px',
						extraFileUploadParams : {
							sessionid :  '<?php echo session_id(); ?>'
						}
					});
				});
				</script>	</td>
    </tr>
		<tr>
		  <td height="345" align="right">商品详情：</td>
		  <td colspan="11"><textarea name="Details" id="Details" class="kindeditor"></textarea>
				<script>
				var editor;
				KindEditor.ready(function(K) {
					editor = K.create('textarea[name="Details"]', {
						allowFileManager : true,
						width:'1200px',
						height:'365px',
						extraFileUploadParams : {
							sessionid :  '<?php echo session_id(); ?>'
						}
					});
				});
				</script>			<div id="fenlei" style="font-size:12px; color:#ffa8a8;display:inline;"></div></td>
	  </tr>
    <tr>
          <td height="40" align="right">排列排序：</td>
          <td colspan="2"><input type="text" name="orderid" id="orderid" class="inputos" value="<?php echo GetOrderID('commodity'); ?>" /></td>
          <td>&nbsp;</td>
          <td align="right">&nbsp;</td>
          <td>&nbsp;</td>
          <td align="right">&nbsp;</td>
          <td id="hot5">&nbsp;</td>
          <td align="right">&nbsp;</td>
          <td id="leixing5">&nbsp;</td>
          <td align="right">&nbsp;</td>
          <td  id="countrys5">&nbsp;</td>
    </tr>
    <tr>
      <td height="40" align="right">&nbsp;</td>
      <td colspan="2">
        <div class="formSubBtn" style="float:left; margin-left:1px; margin-bottom:20px;">
        <input type="submit" class="submit" value="保存" />
        <input type="button" class="back" value="返回" onclick="history.go(-1);" />
        <input type="hidden" name="action" id="action" value="add" />
        <input type="hidden" name="del" id="del" value="0" />
        <input type="hidden" name="Id" id="Id" value="<?php echo getrandomstring(20);?>" />
        <input type="hidden" name="CreatTime" id="CreatTime" value="<?php echo date("Y-m-d h:i:s");?>" />
      </div></td>
      <td>&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td id="hot6">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td id="leixing6">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td  id="countrys6">&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>
