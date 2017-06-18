<?php

if(is_dir("../irpf/teste/"))
		echo "ok";
	else
	{
		if(mkdir("../irpf/teste/", 0777));
			echo "okpasta";
	}
	
	
?>