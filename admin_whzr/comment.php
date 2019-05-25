<?php require_once(dirname(__FILE__).'/inc/config.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>评论管理</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<link href="templates/style/menu1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/forms.func.js"></script>
<script type="text/javascript" src="layer/layer.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<script>
function ord(OrderId)
{
  layer.open({
  type: 2,
  title: '订单详情：',
  maxmin: true,
  shadeClose: true, //点击遮罩关闭	层
  area : ['900px' , '600px'],
  content: 'ordershow.php?OrderId='+OrderId,
  });

}
function changestatus(status,id){
	var ajax_url='comment_ajax.php?id='+id+'&status='+status;
   //alert(ajax_url);
	$.ajax({
    url:ajax_url,
    type:'get',
	data: "data" ,
	dataType:'html',
    success:function(data){
     document.getElementById("changestatus"+id).innerHTML = data;
    } ,
	error:function(){
       alert('error');
    }
	});
	}
  function showimg(orderid,Id){
    var ajax_url='ajax_imgs.php?orderid='+orderid;
  // alert(ajax_url);
	$.ajax({     
    url:ajax_url,     
    type:'get',  
	data: "data" ,  
	dataType:'html', 
    success:function(data){  
	var div1 = document.getElementById("checkimages"+Id);
       div1.style.display="";
     document.getElementById("checkimages"+Id).innerHTML = data; 
    } ,
	error:function(){     
       alert('error');     
    }    
	}); 
  }
  function outimg(orderid,Id){
    
	var div1 = document.getElementById("checkimages"+Id);
     div1.style.display="none";
     
  }
function reply(id){
	var recomment=document.getElementById('recomment').value;
	window.location.href="comment_save.php?id="+id+"&action=reply"+"&recomment="+recomment;
	}
</script>
</head>
<body>
<?php
$adminlevel=$_SESSION['adminlevel'];
?>
<div class="topToolbar"> <span class="title">所有评论</span> <a href="javascript:location.reload();" class="reload">刷新</a></div>
<form name="form" id="form" method="post" action="comment_save.php">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="dataTable">
		<tr align="left" class="head">
			<td width="1%" height="31" align="center"><input type="checkbox" name="checkid" id="checkid" onclick="CheckAll(this.checked);"></td>
			<td width="5%" align="center">会员头像</td>
			<td width="9%" align="center">会员昵称</td>
			<td width="34%">评论内容</td>
			<td width="22%">回复内容</td>
			<td width="9%">订单号</td>
			<td width="7%">是否审核</td>
			<td width="10%">评论时间</td>
			<td width="3%" align="left">操作</td>
		</tr>
		<?php
		$dopage->GetPage("SELECT b.Alias,b.Image,a.Id,a.comment,a.recomment,a.userid,a.orderid,a.status,a.timestamp FROM `pmw_comment` a inner join memberuser b on b.Account=a.userid",15);
		while($row = $dosql->GetArray())
		{
			switch($row['status']){
				case 1:
				$status="<i style='color:#179545;cursor:pointer' class='fa fa-check'></i>";
				break;
				case 0:
				$status="<i style='color:red;cursor:pointer' class='fa fa-close'></i>";
				break;
				}
				if($row['Image']==""){
			$Image="../templates/default/images/noimage.jpg";
		    }else{
            if(strpos($row['Image'],'uploads') !== false){
            $Image="../".$row['Image'];
            }else{
            $Image=$row['Image'];
            }
            }
		?>
		
		<tr align="left" class="dataTr">
			<td height="42" align="center"><input type="checkbox" name="checkid[]" id="checkid[]" value="<?php  echo $row['Id']; ?>" /></td>
			<td align="center" valign="middle"><img style="height: 50px;padding: 5px;" src="<?php  echo $Image;?>" /></td>
			<td align="center" valign="middle"><?php  echo $row['Alias'];?></td>
            <td align="center" ><?php  echo $row['comment'];?></td>
            <td align="center" ><input type="text" class="inputd" id="recomment" style="width:100%; text-align:center;color:red;font-weight:bold;" value="<?php echo $row['recomment']; ?>" /></td>
			<td align="center" >
        <a title="评论订单详情"  style="cursor:pointer" onmouseout="JavaScript:outimg('<?php echo $row['orderid'];?>','<?php echo $row['Id'];?>')" onmouseover="JavaScript:showimg('<?php echo $row['orderid'];?>','<?php echo $row['Id'];?>')" onclick="ord('<?php  echo $row['orderid'];?>')"><?php  echo $row['orderid'];?></a></td>
			<td align="center" ><span id=changestatus<?php echo $row['Id'];?> onclick="changestatus('<?php echo $row['status'];?>','<?php echo $row['Id'];?>')"><?php echo $status;?></span></td>
			<td align="center" ><?php  echo $row['timestamp'];?></td>
			<td align="center">
            <div id="jsddm"><a title="回复评论内容" href="javascript:vod(0)" onclick="reply('<?php echo $row['Id'];?>');"><i class="fa fa-reply-all" aria-hidden="true"></i></a></div>

            <div id="jsddm"><a title="删除" href="comment_save.php?action=del2&id=<?php  echo $row['Id']; ?>" onclick="return ConfDel(0);"><i class="fa fa-trash fa-lg fa-fw" aria-hidden="true"></i></a></div>

            </td>
		</tr>
        <tr style="display:none;" id="checkimages<?php echo $row['Id'];?>" align="left" class="dataTr">
		  <td height="42" align="center">&nbsp;</td>
		  <td align="center" valign="middle">&nbsp;</td>
		  <td align="center" valign="middle">&nbsp;</td>
		  <td align="center" >&nbsp;</td>
		  <td colspan="2" align="center" ></td>
		  <td align="center" >&nbsp;</td>
		  <td align="center" >&nbsp;</td>
		  <td align="center"></td>
	  </tr>
		<?php
		}
		?>
	</table>
</form>
<?php

//判断无记录样式
if($dosql->GetTotalRow() == 0)
{
	echo '<div class="dataEmpty">暂时没有相关的记录</div>';
}
?>
<div class="bottomToolbar"><span class="selArea"><span>选择：</span> <a href="javascript:CheckAll(true);">全部</a> - <a href="javascript:CheckAll(false);">无</a> - <a href="javascript:DelAllNone('promotion_save.php');" onclick="return ConfDelAll(0);">删除</a></span></div>
<div class="page"> <?php echo $dopage->GetList(); ?> </div>
</body>
</html>
