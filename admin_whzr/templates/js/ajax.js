// JavaScript Document
function tuiji(v){
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
function tuiji_fan(v){
  //	alert(v);
  	if(v !="")
	{
	var ajax_url='product_fan_ajax.php';
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
function fenlei(v){
  //	alert(v);
  	if(v =="-1")
	{
	var ajax_url='product_ajax.php';
  // alert(ajax_url);
	$.ajax({     
    url:ajax_url,     
    type:'get',  
	data: "data" ,  
	dataType:'html', 
    success:function(data){  
     document.getElementById("fenlei").innerHTML = data; 
    } ,
	error:function(){     
       alert('error');     
    }    
	});   
	}
   document.getElementById('CommodityClass').focus();
   return false;
	}