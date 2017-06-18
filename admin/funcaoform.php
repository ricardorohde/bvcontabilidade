<?php
function seguranca($valor)
{
	$array = array("DELETE", " OR ", "UPDATE", "INSERT", "DROP", "SELECT", "TABLE", "WHERE", "'", "/", "UNION", "JOIN");

	$valor = str_ireplace($array,"",$valor);
	
	return $valor;
}

function salvaimagem($imagem, $num, $largura, $altura, $caminho, $crop)
{
		require_once('../lib/WideImage.php');
		
		$img_temp = $imagem['tmp_name'];
	
		$img = explode(".", $imagem['name'], 2);
		$img_ext = $img[1];
			
		$gerador = rand(0,999).date("dmYHis").rand(0,999);
		$nome_imagem = md5($img[0].$gerador).".".$img_ext;
		$image = WideImage::load($img_temp);
		
		for($i=1;$i<=$num;$i++)
		{
			if($crop[$i] != "")
				$imagesalva = $image->resize($largura[$i], $altura[$i])->crop('center', 'center', $crop[$i][0], $crop[$i][1])->saveToFile($caminho[$i].$nome_imagem);
			else
				$imagesalva = $image->resize($largura[$i], $altura[$i])->saveToFile($caminho[$i].$nome_imagem);
				
			chmod($caminho[$i].$nome_imagem, 0777);
		}
		return $nome_imagem;
}


function filtro($tipocampo, $valor)
{
	$arraylixo = array("“","”","‘","’","–","&amp;");
	$arraytroca = array("&ldquo;","&rdquo;","&lsquo;","&rsquo;","&ndash;","&");
	switch($tipocampo)
	{
		case "string":
		$valor = htmlentities($valor, ENT_QUOTES);
		$valor = str_replace($arraylixo,$arraytroca,$valor);
		break;
			
		case "date":
		if($valor != null || $valor != ""){
			$valor = date("Y-m-d H:i", strtotime(str_replace("/","-",$valor)));
		}else{
			$valor = "";
		}
		break;
						
		case "num":
		$valor = str_replace("/","",str_replace("-","",str_replace(".","",$valor)));
		break;
			
		case "float":
		$valor = str_replace(",",".",str_replace(".","",$valor));
		break;
		
		case "cond"://condição
		$valor = "";
		break;
		
		default:
		$valor = htmlentities($valor, ENT_QUOTES);
		$valor = str_replace($arraylixo,$arraytroca,$valor);
		
	}
	return $valor;
}

function executa($form, $tabela, $acao, $condicao)
{
	$campos = "";
	$valores = "";
	$count = 0;
	if($acao == "inserir")
	{
		foreach($form as $campo => $valor)
		{
			$tipo = explode("-",$campo);
			
			$valor = filtro($tipo[1],$valor);
			
			if ($valor != null || $valor != "" || $valor != 0){
			
				if($count != 0)
					$campos .= ", ".$tipo[0];
				else
					$campos .= $tipo[0];
				
				if($count != 0)
					$valores .= ", '".($valor)."'";
				else
					$valores .= "'".($valor)."'";
			
				$count++;
			}
		}
		$sql = "INSERT INTO $tabela ($campos) VALUES ($valores)";
		$sql = mysql_query($sql);
		$id = mysql_insert_id();
		return $id;
	}
	else if($acao == "edita")
	{
		foreach($form as $campo => $valor)
		{
			$tipo = explode("-",$campo);
			
			if($valor == "")
				$valor = "NULL";
			
			if($tipo[1] != 'cond'){
			
				$valor = filtro($tipo[1],$valor);
			
				if($count != 0)
				{
					if($valor == "NULL")
						$campos .= ", ".$tipo[0]." = ".($valor);
					else
						$campos .= ", ".$tipo[0]." = '".($valor)."'";
				}
				else
				{
					if($valor == "NULL")
						$campos .= $tipo[0]." = ".($valor);
					else
						$campos .= $tipo[0]." = '".($valor)."'";
				}
		  
				$count++;
			}
		}
		$sql = "UPDATE $tabela SET $campos WHERE $condicao";
		$sql = mysql_query($sql);
		return $sql;
	}
}
?>