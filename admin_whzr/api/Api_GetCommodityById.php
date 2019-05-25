<?php

//根据接口的实际情况，进行编写sql语句(GetCommodityById接口)
        if(isset($Id)){
		$Idd=$Id;
		}elseif(isset($id)){
		$Idd=$id;	
		}
		$dosql->Execute("SELECT * FROM `commodity` WHERE Id='$Idd'");
		while($row = $dosql->GetArray())
		{
			$date[]=$row;
		}

		$cachename=$Idd;
		GetCache($date,$cachename);
		
		?>