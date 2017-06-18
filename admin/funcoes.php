<?php
function seguranca($valor)
{
	$array = array("DELETE", " OR ", "UPDATE", "INSERT", "DROP", "SELECT", "TABLE", "WHERE", "'", "/");

	$valor = str_ireplace($array,"",$valor);
	
	return $valor;
}


function limitaTexto($string, $word_limit) 
{   
	$tags = array("[imagem]", "[galeria]", "[video]", "&lt;p&gt;", "&lt;/p&gt;", "&lt;br&gt;", "&lt;br /&gt;");
	$string = str_replace($tags,"",strip_tags($string));
	$words = explode(' ', $string);  
	return implode(' ', array_slice($words, 0, $word_limit))."...";
}

function mesAbreviado($mes)
{
	$mesarray = array (1 => "jan", 
					  2 => "fev",
					  3 => "mar",
					  4 => "abr",
					  5 => "mai",
					  6 => "jun",
					  7 => "jul",
					  8 => "ago",
					  9 => "set",
					  10 => "out",
					  11 => "nov",
					  12 => "dez");
	
	$mes = $mesarray[date('n',strtotime($mes))];
	return $mes;
}

function mes($mes)
{
	$mesarray = array (1 => "Janeiro", 
					  2 => "Fevereiro",
					  3 => "Mar&ccedil;o",
					  4 => "Abril",
					  5 => "Maio",
					  6 => "Junho",
					  7 => "Julho",
					  8 => "Agosto",
					  9 => "Setembro",
					  10 => "Outubro",
					  11 => "Novembro",
					  12 => "Dezembro");
	$mes = $mesarray[date('m',strtotime($mes))];
	return $mes;
}

function mes2($mes)
{
	$mesarray = array (1 => "Janeiro", 
					  2 => "Fevereiro",
					  3 => "Mar&ccedil;o",
					  4 => "Abril",
					  5 => "Maio",
					  6 => "Junho",
					  7 => "Julho",
					  8 => "Agosto",
					  9 => "Setembro",
					  10 => "Outubro",
					  11 => "Novembro",
					  12 => "Dezembro");
	$mes = $mesarray[$mes];
	return $mes;
}


function semana($dia)
{
	$diaarray = array (0 => "Domingo", 
					  1 => "Segunda-Feira",
					  2 => "Ter&ccedil;a-Feira",
					  3 => "Quarta-Feira",
					  4 => "Quinta-Feira",
					  5 => "Sexta-Feira",
					  6 => "S&aacute;bado");
		
	$dia = $diaarray[date('N',strtotime($dia))];
	return $dia;
}


function dataBlog($data, $tipo)
{
	if($tipo == "blog")
	{
		$datafinal = "<span class='dia'>".date("d",strtotime($data))."</span><br /><span class='mes'>".mesAbreviado($data)."</span>";
	}
	
	else if($tipo == "post")
	{		
		$dia = date('d',strtotime($data));
		$mes = mes($data);
		$ano = date('Y',strtotime($data));
		
		$datafinal = $dia." de ".$mes." de ".$ano;
	}
	
	else if($tipo == "semana")
	{		
		$datafinal = semana($data);
	}
	return $datafinal;
	
}

?>