<?php

//根据接口的实际情况，进行编写sql语句(GetCommodityById接口)
        if(isset($Id)){
		$Idd=$Id;
		}elseif(isset($id)){
		$Idd=$id;	
		}
		DelCache($Idd);
		?>