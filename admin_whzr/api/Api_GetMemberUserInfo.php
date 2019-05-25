<?php

//根据接口的实际情况，进行编写sql语句(MemberUserInfo接口)
		   $row=$dosql->GetOne("SELECT * FROM `memberuser` WHERE Id='$id'");
		   $cachedate[]=$row;
		   $cachename=$row['Account'];  //会员缓存的名称直接用用户的手机号码
		   GetCache($cachedate,$cachename);
		?>