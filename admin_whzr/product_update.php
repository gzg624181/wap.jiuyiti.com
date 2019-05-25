<?php require_once(dirname(__FILE__).'/inc/config.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改商品详情</title>
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
<script type="text/javascript" src="layer/layer.js"></script>
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
function ti(v){
  //	alert(v);
  	if(v =="")
	{
	var ajax_url='product_ajax.php';
  // alert(ajax_url);
	$.ajax({
    url:ajax_url,
    type:'get',
	data: "data" ,
	dataType:'html',
    success:function(data){
     document.getElementById("pro").innerHTML = data;
    } ,
	error:function(){
       alert('error');
    }
	});
	}
   document.getElementById('RecommendIndex').focus();
   return false;
	}
layer.ready(function(){ //为了layer.ext.js加载完毕再执行
   layer.photos({
    photos: '#layer-photos-demo',
	//area:['500px','300px'],  //图片的宽度和高度
    shift: 0 ,//0-6的选择，指定弹出图片动画类型，默认随机
	closeBtn:1,
	offset:'100px',  //离上方的距离
	shadeClose:true
  });
});
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
$row = $dosql->GetOne("SELECT * FROM `commodity` WHERE `Id`='$id'");
$pid=$row['CommodityClass'];
		switch($row['CommodityClass'])
			{
				case '1':
					$CommodityClass = '白酒';
					break;
				case '18':
					$CommodityClass = '红酒';
					break;
				case '39':
					$CommodityClass = '洋酒';
					break;
				case '56':
					$CommodityClass = '啤酒';
					break;
				case '72':
					$CommodityClass = '酒具';
					break;
				default:
				   $CommodityClass = '暂无分类';
			}
?>
<div class="formHeader">商品详情<a href="javascript:location.reload();" class="reload">刷新</a> </div>
<input type="hidden" name="hyjq" id="hyjq" value="<?php echo $cfg_hymoney;?>" />
<input type="hidden" name="sjjq" id="sjjq" value="<?php echo $cfg_sjmoney;?>" />
<form name="form" id="form" method="post" action="product_save.php" onsubmit="return cfm_infolm();">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="formTable">
		<tr>
			<td width="6%" height="40" align="right">商品名称：</td>
			<td colspan="11"><input style="width:370px;" type="text" name="Title" id="Title" class="input" value="<?php echo $row['Title']; ?>" /></td>
		</tr>
		<tr>
			<td height="82" align="right">上传图片：</td>
			<td colspan="11" valign="middle">
            <div id="layer-photos-demo" class="layer-photos-demo">
     <img  width="100" height="50" style="cursor:pointer; padding:5px;border-radius:3px;" layer-src="../<?php echo $row['Images']; ?>"  src="../<?php echo $row['Images']; ?>" alt="<?php echo $row['Title']; ?>" />
       </div>
          <input style="margin-top:5px;" type="text" name="picurl" id="picurl" class="input" value="<?php echo $row['Images']; ?>" />
				<span class="cnote"><span class="grayBtn" onclick="GetUploadify('uploadify','缩略图上传','image','image',1,<?php echo $cfg_max_file_size; ?>,'picurl')">上 传</span> <span class="rePicTxt">
				<input type="checkbox" name="rempic" id="rempic" value="true" />
				远程</span> <span class="cutPicTxt"><a href="javascript:;" onclick="GetJcrop('jcrop','picurl');return false;">裁剪</a></span> </span></td>
	  </tr>
      <tr>
			<td height="40" align="right">搜索图片：</td>
			<td colspan="11" valign="middle">
             <div id="layer-photos-demo" class="layer-photos-demo">
     <img  width="100" height="50" style="cursor:pointer" layer-src="../<?php echo $row['picurl2']; ?>"  src="../<?php echo $row['picurl2']; ?>" alt="<?php echo $row['Title']; ?>" />
       </div>
            <input type="text" name="picurl2" id="picurl2" class="input"  value="<?php echo $row['picurl2']; ?>"/>
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
						<?php

					if($row['picarr'] != '')
					{
						$picarr = json_decode($row['picarr']);
						foreach($picarr as $v)
						{
							$v = explode(',', $v);
							echo '<li rel="'.$v[0].'"><input type="hidden" name="picarr[]" value="'.$v[0].'"><img src="../'.$v[0].'" width="100" height="120" ><a href="javascript:void(0);" onclick="ClearPicArr(\''.$v[0].'\')">删除</a></li>';
						}
					}
					?>
					</ul>
				</fieldset>（长宽比例 2：1）</td>
		</tr>

        <tr>
		  <td height="40" align="right">简　介：</td>
		  <td colspan="11"><textarea style="width: 64.2%; height: 45px;" type="text" name="summary" id="summary" class="input"/><?php echo $row['summary']; ?></textarea></td>
    </tr>
		<tr>
			<td height="40" align="right">商品现价：</td>
			<td width="18%"><input type="text" name="NewPrice" id="NewPrice" class="input" value="<?php echo $row['NewPrice']; ?>" /></td>
			<td width="7%" align="right">商品原价：</td>
			<td colspan="9"><input style="width:156px;" type="text" name="OldPrice" id="OldPrice" class="input" value="<?php echo $row['OldPrice']; ?>" />
			  &nbsp;&nbsp;&nbsp;&nbsp;商户价格：&nbsp;&nbsp;&nbsp;
            <input type="text" style="width:156px;" name="shprice" id="shprice" class="input"  value="<?php echo $row['shprice']; ?>"/></td>
		</tr>
		<tr>
		  <td height="40" align="right">会员酒钱数：</td>
		  <td><input type="text" name="JiuQian" id="JiuQian" onfocus="huiyuanjq();" class="input" value="<?php echo $row['JiuQian']; ?>" /></td>
		  <td align="right"> 推荐指数：</td>
		  <td colspan="9"><input style="width:156px;" type="text"  name="RecommendIndex" id="RecommendIndex" class="input" value="<?php echo $row['RecommendIndex']; ?>" />
          <?php
		    $commodityid_id=$row['Id'];
			$thisyear=date("Y",time());
			$thismonth=date("m",time());
			$s=$dosql->GetOne("select * from commodity_month_nums where commodityid_id='$commodityid_id' and year=$thisyear and month=$thismonth");
			if(is_array($s)){
			$month_nums=$s['month_nums'];
			$new_nums=$s['new_nums'];
			}else{
			$month_nums= 0;
			$new_nums=0;
				}

		  ?>
		  <div id="pro" style="font-size:12px; display:inline;">&nbsp;&nbsp;&nbsp;&nbsp;实际月销量：
              <input style="width:100px; text-align:center" readonly="readonly" type="text" name="month_nums" id="month_nums" class="input"  value="<?php echo $month_nums?>"/>
		  新增月销量：<input style="width:100px; text-align:center" type="text" name="new_nums" id="new_nums" class="input"  value="<?php echo $new_nums?>" /></div></td>
	  </tr>
        <tr>
		  <td height="40" align="right">商家酒钱：</td>
		  <td><input type="text" name="SJJiuQian" id="SJJiuQian"  onfocus="shangjiajq();" class="input" value="<?php echo $row['SJJiuQian']; ?>" /></td>
		  <td align="right">预约商品：</td>
		  <td><select name="yuyue"  class="input" style="width:80px;" id="yuyue"><!--0 不预约，1 预约-->
		    <?php $yuyue=$row['yuyue'];?>
		    <option value="1" <?php if($yuyue==1){echo "selected='selected'";}?>>是</option>
		    <option value="0" <?php if($yuyue==0){echo "selected='selected'";}?>>否</option>
	      </select></td>
		  <td align="right">省份：</td>
		  <td><select name="live_prov" id="live_prov" style="width:80px;" class="input" onchange="SelProv(this.value,'live');">
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
				</select></td>
		  <td width="4%" align="right">城市：</td>
		  <td width="5%" id="hot3"><select style="width:80px;" class="input" name="live_city" id="live_city"  onchange="SelCity(this.value,'live');">
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
	      </select>
          </td>
		  <td width="3%" align="right">&nbsp;</td>
		  <td width="5%" id="leixing3">&nbsp;</td>
		  <td width="3%" align="right">&nbsp;</td>
		  <td width="35%"  id="countrys3">&nbsp;</td>
    </tr>
		<tr>
		  <td height="40" align="right">活动类型：</td>
		  <td><select style="width:507px;" name="ActivityType" id="ActivityType"  class="input"  style="width:286px;">
		  <?php $ActivityType=$row['ActivityType'];?>
		      <option value="0" <?php if($ActivityType==0){echo "selected='selected'";}?>>无活动</option>
              <option value="1" <?php if($ActivityType==1){echo "selected='selected'";}?>>限时抢购</option>
              <option value="2" <?php if($ActivityType==2){echo "selected='selected'";}?>>限时超返</option>
              <option value="3" <?php if($ActivityType==3){echo "selected='selected'";}?>>热销</option>
              <option value="4" <?php if($ActivityType==4){echo "selected='selected'";}?>>新品上市</option>
		  </select></td>
		  <td align="right">商品类型：</td>
		  <td width="5%"><select name="CommodityType" id="CommodityType"  class="input" style="width:80px;"><?php $CommodityType=$row['CommodityType'];?>
		   <option value="0" <?php if($CommodityType==0){echo "selected='selected'";}?>>酒品</option>
           <option value="1" <?php if($CommodityType==1){echo "selected='selected'";}?>>换购产品</option>
	      </select></td>
		  <td width="4%" align="right">分类：</td>
		  <td width="5%"><select onchange="fenlei(this.value)" class="input"  style="width:80px;" onblur="tuiji_fan(this.value)"  name="CommodityClass" id="CommodityClass">
          <?php
		$a=0;
		$b=1;
		$dosql->Execute("SELECT * FROM `pmw_maintype` where parentid=0 and checkinfo='true'",$a);
		while($r = $dosql->GetArray($a))
		{
		    $pinpaiid=$r['id'];
			$dosql->Execute("SELECT * FROM `pmw_maintype` where parentid=$pinpaiid and parentstr like '%$pinpaiid%' and checkinfo='true'",$b);
			for($i=0;$i<$dosql->GetTotalRow($b);$i++){
			$show=$dosql->GetArray($b);
		    $Data[$i]=$show;
			}
		?>
	<option value="<?php echo $Data[0]['id'];?>,<?php echo $Data[1]['id'];?>,<?php echo $Data[2]['id'];?>,<?php echo $r['id'];?>" <?php if($CommodityClass==$r['classname']){echo "selected='selected'";}?>><?php echo $r['classname']; ?></option>
		    <?php
		}
		?>
	      </select></td>
		  <td width="4%" align="right">品牌：</td>
		  <td width="5%" id="hot">
          <select name="pinpai" id="pinpai" class="input"  style="width:80px;">
          <?php
		  $a=0;
		  $b=1;
          $dosql->Execute("SELECT * FROM `pmw_maintype` where parentid=$pid and parentstr like '%$pid%' and checkinfo='true'",$a);
		  $i=0;
		  while($i<$dosql->GetTotalRow($a))
          {
	      $Data[$i]=$g = $dosql->GetArray($a);
	      $i++;
          }
		    $pinpaiid=$Data[0]['id'];
		    $dosql->Execute("SELECT * FROM `pmw_maintype` where parentid=$pinpaiid and parentstr like '%$pinpaiid%' and checkinfo='true'",$b);
		    while($h=$dosql->GetArray($b)){
			?>
	<option value="<?php echo $h['classname']; ?>"<?php if($row['Pinpai']==$h['classname']){echo "selected='selected'";}?>><?php echo $h['classname'];?></option>
            <?php }?>
	      </select>
          </td>
		  <td width="3%" align="center">类型：</td>
		  <td width="5%" id="leixing"><select name="types" id="types" class="input"  style="width:80px;">
		  <?php
		  $a=0;
		  $b=1;
          $dosql->Execute("SELECT * FROM `pmw_maintype` where parentid=$pid and parentstr like '%$pid%' and checkinfo='true'",$a);
		  $i=0;
		  while($i<$dosql->GetTotalRow($a))
          {
	      $Data[$i]=$g = $dosql->GetArray($a);
	      $i++;
          }
		    $leixingid=$Data[1]['id'];
		    $dosql->Execute("SELECT * FROM `pmw_maintype` where parentid=$leixingid and parentstr like '%$leixingid%' and checkinfo='true'",$b);
		    while($l=$dosql->GetArray($b)){
			?>
		    <option value="<?php echo $l['classname']; ?>"<?php if($row['Types']==$l['classname']){echo "selected='selected'";}?>><?php echo $l['classname'];?></option>
			<?php }?>
	      </select></td>
		  <td width="3%" align="center">国家：</td>
		  <td width="35%" id="countrys"><span style="font-size:12px; color:#ffa8a8;display:inline;">
		    <select name="country" id="country" class="input"  style="width:80px;">
			<?php
		  $a=0;
		  $b=1;
          $dosql->Execute("SELECT * FROM `pmw_maintype` where parentid=$pid and parentstr like '%$pid%' and checkinfo='true'",$a);
		  $i=0;
		  while($i<$dosql->GetTotalRow($a))
          {
	      $Data[$i]=$g = $dosql->GetArray($a);
	      $i++;
          }
		    $leixingid=$Data[2]['id'];
		    $dosql->Execute("SELECT * FROM `pmw_maintype` where parentid=$leixingid and parentstr like '%$leixingid%' and checkinfo='true'",$b);
		    while($c=$dosql->GetArray($b)){
			?>
		      <option value="<?php echo $c['classname']; ?>"<?php if($row['Country']==$c['classname']){echo "selected='selected'";}?>><?php echo $c['classname'];?></option>
			  <?php }?>
	      </select>
		  </span></td>
	  </tr>
      <tr>
	  <td height="40" align="right">首页广告：</td>
		  <td colspan="2"><p>
          <label>
		      <input type="radio" name="gd" value="1" <?php if($row['gd']==1){echo "checked='checked'";}?> id="gd" />
		      是</label>
          &nbsp;&nbsp;
		    <label>
		      <input name="gd" type="radio" id="gd" value="0" <?php if($row['gd']==0){echo "checked='checked'";}?> />
		      否</label>
           &nbsp;&nbsp;

		    （首页广告位显示）<br />
	      </p></td>
		  <td>&nbsp;</td>
		  <td align="right">&nbsp;</td>
		  <td>&nbsp;</td>
		  <td align="right">&nbsp;</td>
		  <td id="hot2">&nbsp;</td>
		  <td align="right">&nbsp;</td>
		  <td id="leixing2">&nbsp;</td>
		  <td align="right">&nbsp;</td>
		  <td  id="countrys2">&nbsp;</td>
    </tr>
    <tr>
		  <td height="128" align="right">产品参数：</td>
		  <td colspan="11"><textarea name="canshu" id="canshu" class="kindeditor"><?php echo $row['canshu']; ?></textarea>
				<script>
				var editor;
				KindEditor.ready(function(K) {
					editor = K.create('textarea[name="canshu"]', {
						allowFileManager : true,
						width:'1200px',
						height:'125px',
						extraFileUploadParams : {
							sessionid :  '<?php echo session_id(); ?>'
						}
					});
				});
				</script>	</td>
    </tr>
      <tr>
		  <td height="345" align="right">商品详情：</td>
		  <td colspan="11"><textarea name="Details" id="Details" class="kindeditor"><?php echo $row['Details']; ?></textarea>
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
        <td><input type="text" name="orderid" id="orderid" class="inputos" value="<?php echo $row['orderid']; ?>" /></td>
      </tr>
      <tr>
      <td height="40" align="right">&nbsp;</td>
       <td><div class="formSubBtn" style="float:left; margin-top:5px;">
<input type="submit" class="submit" value="保存" />
		<input type="button" class="back" value="返回" onclick="history.go(-1);" />
		<input type="hidden" name="action" id="action" value="update" />
		<input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
  </div></td>
    </tr>
	</table>

</form>
</body>
</html>
