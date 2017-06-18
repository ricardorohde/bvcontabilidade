<?php
function tira_acento($string){
	$a = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ ,;:/ºª';
	$b = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr_______';
	
	//$a = ' ,;:/';
	//$b = '_____';
	//$string = utf8_decode($string);
	$string = strtr($string, $a, $b); //substitui letras acentuadas por "normais"
	$string = str_replace(" ","_",$string); // retira espaco
	$string = strtolower($string); // passa tudo para minusculo
	return utf8_encode($string); //finaliza, gerando uma saída para a funcao
}

function removeEspaco($arquivo)
{
	$array1 = array(" ", "á", "à", "â", "ã", "ä", "é", "è", "ê", "ë", "í", "ì", "î", "ï", "ó", "ò", "ô", "õ", "ö", "ú", "ù", "û", "ü", "ç", "Á", "À", "Â", "Ã", "Ä", "É", "È", "Ê", "Ë", "Í", "Ì", "Î", "Ï", "Ó", "Ò", "Ô", "Õ", "Ö", "Ú", "Ù", "Û", "Ü", "Ç", "-" , "º", "ª");
	$array2 = array("_", "a", "a", "a", "a", "a", "e", "e", "e", "e", "i", "i", "i", "i", "o", "o", "o", "o", "o", "u", "u", "u", "u", "c", "A", "A", "A", "A", "A", "E", "E", "E", "E", "I", "I", "I", "I", "O", "O", "O", "O", "O", "U", "U", "U", "U", "C", "_" ,"_","_");
		
	return $arquivo = str_replace( $array1, $array2, utf8_encode($arquivo));

}

function uploadarquivo($tipo, $arquivo, $nomepessoa)
{
	$link = "";
	

	$nomepessoa = removeEspaco(utf8_decode($nomepessoa));
	
	if($tipo == "irpf")
	{
		if(is_dir("../irpf/".$nomepessoa."/"))
			$pasta = "../irpf/".$nomepessoa."/";
		else
		{
			mkdir("../irpf/".$nomepessoa."/", 0777);
			$pasta = "../irpf/".$nomepessoa."/";
		}
	}
	else
	{
		if(is_dir("../admissao/".$nomepessoa."/"))
			$pasta = "../admissao/".$nomepessoa."/";
		else
		{
			mkdir("../admissao/".$nomepessoa."/", 0777);
			$pasta = "../admissao/".$nomepessoa."/";
		}
	}
// Pasta onde o arquivo vai ser salvo
	$_UP['pasta'] = $pasta;
	
	// Tamanho máximo do arquivo (em Bytes)
	$_UP['tamanho'] = 1024 * 1024 * 2; // 2Mb
	
	// Array com as extensões permitidas
	$_UP['extensoes'] = array('exe');
	
	// Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
	$_UP['renomeia'] = false;

	// Array com os tipos de erros de upload do PHP
	$_UP['erros'][0] = 'Não houve erro';
	$_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
	$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
	$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
	$_UP['erros'][4] = 'Não foi feito o upload do arquivo';
	

	for($i=0;$i<=count($arquivo['name']);$i++)
	{
		// Faz a verificação da extensão do arquivo
		
		$extensao = strtolower(end(explode('.', utf8_decode(@$arquivo['name'][$i]))));
		if (array_search($extensao, $_UP['extensoes']) === true) {
			echo "Por favor, envie arquivos com as seguintes extensões: xls, xlsx, doc, docx ou pdf";
		}
		else if ($_UP['tamanho'] < @$arquivo['size'][$i]) {
			echo "O arquivo enviado é muito grande, envie arquivos de até 2Mb.";
		}
		else
		{
	
			$nome_final = date("dmYHi")."_".removeEspaco(utf8_decode(@$arquivo['name'][$i]));
	
			// Depois verifica se é possível mover o arquivo para a pasta escolhida
				if (move_uploaded_file(@$arquivo['tmp_name'][$i], $_UP['pasta'] . $nome_final)) {
					chmod ($_UP['pasta'] . $nome_final, 0777);
					// Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
					
					@$link .= '<a href="http://www.bvcontabilidade.com.br/' . $_UP['pasta'] . $nome_final . '">'.$nome_final.'</a><br>';
	
				} else {
					// Não foi possível fazer o upload, provavelmente a pasta está incorreta
					//@$link .= "Erro ao anexar ".$nome_final;
	
				}
		}
		
	}
	return $link;
	
}

?>
