<script typet="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<style type="text/css">  
html{height:100%}  
body{height:100%;margin:0px;padding:0px}  
#container{height:90%}  
</style>  
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=BSKHkddrAesvEXNXQFHaZEW0Ws5NoiDP">
</script>
    <!--百度地图容器-->
    <div style="width:100%;height:100%;border:#ccc solid 1px;font-size:12px" id="map"></div>
  </body>
  <script type="text/javascript">
    //创建和初始化地图函数：
    function initMap(){
      createMap();//创建地图
      setMapEvent();//设置地图事件
      addMapControl();//向地图添加控件
      addMapOverlay();//向地图添加覆盖物
    }
    function createMap(){ 
      map = new BMap.Map("map"); //建树Map实例
      map.centerAndZoom(new BMap.Point(114.424704,30.506165),18);// 建树点坐标,初始化地图,设置中心点坐标和地图级别。
    }
    function setMapEvent(){
      map.enableScrollWheelZoom();//启用地图滚轮放大缩小
      map.enableKeyboard();//启用键盘上下左右键移动地图
      map.enableDragging(); //启用地图拖拽事件，默认启用(可不写)
      map.enableDoubleClickZoom()//启用鼠标双击放大，默认启用(可不写)
    }
    function addClickHandler(target,window){
      target.addEventListener("click",function(){
        target.openInfoWindow(window);
      });
    }
    
    //设置点Icon
    function addMapOverlay(){
      var markers = [
	  
	    {position:{lat:30.506456,lng:114.423597}},
        {position:{lat:30.50656,lng:114.423901}},
        {position:{lat:30.50576,lng:114.424177}},
        {position:{lat:30.506781,lng:114.421228}}
	  

      ];
      for(var index = 0; index < markers.length; index++ ){
        var point = new BMap.Point(markers[index].position.lng,markers[index].position.lat);
        var marker = new BMap.Marker(point,{icon:new BMap.Icon("http://map.baidu.com/image/us_mk_icon.png",new BMap.Size(20,20)
        // imageOffset: new BMap.Size(markers[index].imageOffset.width,markers[index].imageOffset.height)
        )});
      //  var label = new BMap.Label(markers[index].title,{offset: new BMap.Size(25,5)});
       // var opts = {
        //  width: 200,
       //   title: markers[index].title,
      //    enableMessage: false
     //   };
       // var infoWindow = new BMap.InfoWindow(markers[index].content,opts);
       // marker.setLabel(label);//显示地理名称
        marker.setLabel();//不显示地理名称      
       // addClickHandler(marker,infoWindow);
        map.addOverlay(marker);
      };
    }
 
    //向地图添加控件
    function addMapControl(){
      var scaleControl = new BMap.ScaleControl({anchor:BMAP_ANCHOR_BOTTOM_LEFT});
      scaleControl.setUnit(BMAP_UNIT_IMPERIAL);
      map.addControl(scaleControl);
      var navControl = new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_LEFT,type:BMAP_NAVIGATION_CONTROL_LARGE});
      map.addControl(navControl);
      var overviewControl = new BMap.OverviewMapControl({anchor:BMAP_ANCHOR_BOTTOM_RIGHT,isOpen:true});
      map.addControl(overviewControl);
    }
    var map;
      initMap();
  </script>
  <?php 
require_once('../../include/config.inc.php');
$State = 0;
$Descriptor = '';
$Data = array();
$Version=date("Y-m-d H:i:s");
$dosql->Execute("SELECT Lng,Lat,QqLng,QqLat,CommercialName,CommercialSite FROM `commercialuser`");
if($dosql->GetTotalRow()>0){

$i=0;
while($i<$dosql->GetTotalRow())
{  
    $row = $dosql->GetArray();
	$Data[$i]=$row;
	/*$CommodityId=$row['CommodityId'];		
    $show = $dosql->GetOne("SELECT Id,Title,Explains,Images,NewPrice,OldPrice,Standard,Colour,JiuQianMax,JiuQian,RecommendIndex,CommentNumber,Grade,ActivityType,TwoImg,CommodityNumber,Commercial,CreatTime,CommodityClass,SJJiuQian FROM `commodity` WHERE Id='$CommodityId'");
	$commodity[]=$show;	
	*/
	$i++;
}
$State = 1;
$Descriptor = '数据查询成功';	
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version,
                'Data' => $Data
                 );
				 
echo phpver($result);
}else{
$State = 0;
$Descriptor = '数据查询失败!';	
$Data[]="";
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version,
                'Data' => $Data,	
        );
echo phpver($result);
}
?>
