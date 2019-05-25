<?php

//根据接口的实际情况，进行编写sql语句(Api_GetCommercialById接口)
        if(isset($Id)){
		$Idd=$Id;
		}elseif(isset($id)){
		$Idd=$id;	
		}
		$row=$dosql->Execute("SELECT * FROM `commercialuser` WHERE Id='$Idd'");
        $date[]=$row;
        $cachename=$Idd;
		GetCache($date,$cachename);
		
		?>