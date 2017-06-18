<?php
include("../admin/conexao.php");
include("../admin/funcaoform.php");
include("upload.php");

$op = @$_GET['op'];
$form = $_POST;

require '../phpmailer/class.phpmailer.php';

if($op == "irpf")
{
	
	$mensagem = '<table cellpadding="10" cellspacing="0" width="100%" border="0">
			<tr><td width="40%">Nome</td><td width="60%">'.@$form["nome"].'</td></tr>
			<tr><td>CPF:</td><td>'.@$form["cpf"].'</td></tr>
			<tr><td>E-mail:</td><td>'.@$form["email"].'</td></tr>
			<tr><td>Telefone:</td><td>'.@$form["telefone"].'</td></tr>
			<tr><td colspan="2"><hr /></td></tr>
			
			<tr><td>Primeira declara&ccedil;&atilde;o feita pela BV Contabilidade?</td><td>'.@$form["pdbv"].'</td></tr>';
			
			if(@$form["pdbv"] == "sim")
			{
				$mensagem .= '<tr><td>Declarou ano passado?</td><td>'.@$form["bvdeanopassado"].'</td></tr>';
				if(@$form["bvdeanopassado"] == "sim")
				{
					if($_FILES["declaracaoanterior"])
					{
						$link = uploadarquivo("irpf", $_FILES["declaracaoanterior"], @$form["nome"]);
						$mensagem .= '<tr><td>Declara&ccedil;&atilde;o anterior:</td><td>'.$link.'</td></tr>';
					}
				}
				else
				{
					$mensagem .= '<tr><td>T&iacute;tulo de eleitor</td><td>'.@$form["titulo_eleitor"].'</td></tr>
						<tr><td>Data de nascimento:</td><td>'.@$form["data_nascimento"].'</td></tr>
						<tr><td>CEP:</td><td>'.@$form['cep'].'</td></tr>
						<tr><td>Endere&ccedil;o:</td><td>'.@$form["endereco"].'</td></tr>
						<tr><td>N&uacute;mero:</td><td>'.@$form["numero"].'</td></tr>
						<tr><td>Bairro:</td><td>'.@$form["bairro"].'</td></tr>
						<tr><td>Cidade:</td><td>'.@$form["cidade"].'</td></tr>
						<tr><td>Estado:</td><td>'.@$form["estado"].'</td></tr>
						<tr><td>Natureza Ocupa&ccedil;&atilde;o e Ocupa&ccedil;&atilde;o Principal:</td><td>'.@$form["ocupacao"].'</td></tr>';
				}
			}
			else
			{
				$mensagem .= '<tr><td>Declarou ano passado?</td><td>'.@$form["bvdeanopassado"].'</td></tr>';
				if(@$form["bvdeanopassado"] == "sim")
				{
					$mensagem .= '<tr><td>Houve mudan&ccedil;a de endere&ccedil;o?</td><td>'.@$form["nbvmudanca"].'</td></tr>';
						if(@$form["nbvmudanca"] == "sim")
						{
							$mensagem .= '<tr><td>CEP:</td><td>'.@$form['cep'].'</td></tr>
								<tr><td>Endere&ccedil;o:</td><td>'.@$form["endereco"].'</td></tr>
								<tr><td>N&uacute;mero:</td><td>'.@$form["numero"].'</td></tr>
								<tr><td>Bairro:</td><td>'.@$form["bairro"].'</td></tr>
								<tr><td>Cidade:</td><td>'.@$form["cidade"].'</td></tr>
								<tr><td>Estado:</td><td>'.@$form["estado"].'</td></tr>
								<tr><td>Natureza Ocupa&ccedil;&atilde;o e Ocupa&ccedil;&atilde;o Principal:</td><td>'.@$form["ocupacao"].'</td></tr>';
						}
				}
				else
				{
					$mensagem .= '<tr><td>T&iacute;tulo de eleitor</td><td>'.@$form["titulo_eleitor"].'</td></tr>
						<tr><td>Data de nascimento:</td><td>'.@$form["data_nascimento"].'</td></tr>
						<tr><td>CEP:</td><td>'.@$form['cep'].'</td></tr>
						<tr><td>Endere&ccedil;o:</td><td>'.@$form["endereco"].'</td></tr>
						<tr><td>N&uacute;mero:</td><td>'.@$form["numero"].'</td></tr>
						<tr><td>Bairro:</td><td>'.@$form["bairro"].'</td></tr>
						<tr><td>Cidade:</td><td>'.@$form["cidade"].'</td></tr>
						<tr><td>Estado:</td><td>'.@$form["estado"].'</td></tr>
						<tr><td>Natureza Ocupa&ccedil;&atilde;o e Ocupa&ccedil;&atilde;o Principal:</td><td>'.@$form["ocupacao"].'</td></tr>';
				}
			}
			$mensagem .= '<tr><td colspan="2"><hr /></td></tr>
				<tr><td>Existem dependentes ou alimentados?</td><td>'.@$form["novosdependentes"].'</td></tr>';
				if(@$form["novosdependentes"] == "sim")
				{
					foreach(@$form["nomeparente"] as $indice => $dependente)
					{
						$mensagem .= '<tr><td>Grau de parentesco:</td><td>'.@$form["parentesco"][$indice].'</td></tr>
							<tr><td>Nome:</td><td>'.$dependente.'</td></tr>
							<tr><td>Data de nascimento:</td><td>'.@$form["data_nascparente"][$indice].'</td></tr>';
					}
				}
			$mensagem .= '<tr><td colspan="2"><hr /></td></tr>
				<tr><td>Houve despesas com educação?</td><td>'.@$form["despesasedu"].'</td></tr>';	
				if(@$form["despesasedu"] == "sim")
				{
					foreach(@$form["nome_despesaedu"] as $indice => $nomedesp)
					{
						$mensagem .= '<tr><td>Nome / Contribuinte ou Dependente:</td></td>'.$nomedesp.'</td></tr>
							<tr><td>CNPJ:</td><td>'.@$form["cnpj_despesaedu"][$indice].'</td></tr>
							<tr><td>Valor:</td><td>'.@$form["valor_despesaedu"][$indice].'</td></tr>';
					}
				}
			$mensagem .= '<tr><td colspan="2"><hr /></td></tr>
				<tr><td>Houve despesas médicas?</td><td>'.@$form["despesasmedica"].'</td></tr>';   
				if(@$form["despesasmedica"] == "sim")
				{
					foreach(@$form["nome_despesamedica"] as $indice => $nomedespmedica)
					{
						$mensagem .= '<tr><td>Nome / Contribuinte ou Dependente:</td><td>'.$nomedespmedica.'</td></tr>
							<tr><td>CNPJ:</td><td>'.@$form["cnpj_despesamedica"][$indice].'</td></tr>
							<tr><td>Valor:</td><td>'.@$form["valor_despesamedica"][$indice].'</td></tr>';
					}
				}
			$mensagem .= '<tr><td colspan="2"><hr /></td></tr>
				<tr><td>Houve despesas com empregado domestico?</td><td>'.@$form["despesasempregado"].'</td></tr>';   
				if(@$form["despesasempregado"] == "sim")
				{
					foreach(@$form["nome_empregado"] as $indice => $empregado)
					{
						$mensagem .= '<tr><td>Nome:</td><td>'.$empregado.'</td></tr>
							<tr><td>CPF:</td><td>'.@$form["cpf_empregado"][$indice].'</td></tr>
							<tr><td>PIS:</td><td>'.@$form["pis_empregado"][$indice].'</td></tr>
							<tr><td>Valor:</td><td>'.@$form["valor_empregado"][$indice].'</td></tr>';
					}
				}
			$mensagem .= '<tr><td colspan="2"><hr /></td></tr>
				<tr><td>Houve compra e/ou vendas de bens?</td><td>'.@$form["comprabens"].'</td></tr>';   
				if(@$form["comprabens"] == "sim")
				{
					$mensagem .= '<tr><td>Tipo / descrição:</td><td>';
					foreach(@$form["tipo_comprabens"] as $bens)
					{
						$mensagem .= $bens.'<br />';
					}
					$mensagem .= '</td></tr>';
				}
			$mensagem .= '<tr><td colspan="2"><hr /></td></tr>
				<tr><td colspan="2">Relação de documentos</td></tr>';
			
			
			if($_FILES["comprovantes"]['name'][0])
			{
				$mensagem .= '<tr><td>Comprovante de rendimentos:</td><td>';

					$link = uploadarquivo("irpf", $_FILES["comprovantes"], @$form["nome"]);
					$mensagem .= $link."<br />";

				$mensagem .= '</td></tr>';
			}
			if($_FILES["extratos"]['name'][0])
			{
				$mensagem .= '<tr><td>Extrato de Rendimentos Financeiros e Financiamentos de Todos os Bancos:</td><td>';

					$link = uploadarquivo("irpf", $_FILES["extratos"], @$form["nome"]);
					$mensagem .= $link."<br />";

				$mensagem .= '</td></tr>';
			}
		$mensagem .= '</table>';
	
	
	//Create a new PHPMailer instance
	$mail = new PHPMailer();
	//Set who the message is to be sent from
	$mail->setFrom($form["email"], $form["nome"]);
	//Set an alternative reply-to address
	$mail->addReplyTo($form["email"], $form["nome"]);
	//Set who the message is to be sent to
	$mail->addAddress("contato@bvcontabilidade.com.br", 'BV Contabilidade');
	//Set the subject line
	$mail->Subject = utf8_decode("IRPF");
	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	$mail->msgHTML($mensagem);
	//Replace the plain text body with one created manually
	//$mail->AltBody = 'This is a plain-text message body';
	//Attach an image file
	//$mail->addAttachment('images/phpmailer_mini.gif');
	
	//send the message, check for errors
	if (!$mail->send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
		echo '<meta http-equiv="refresh" content="0; url=../index.php?pag=confirmacao">';
	}
}

else if($op == "admissao")
{
	$mensagem = '<table cellpadding="10" cellspacing="0" width="100%" border="0">
			<tr><td width="40%">Nome da Empresa</td><td width="60%">'.utf8_decode(@$form["nome_empresa"]).'</td></tr>
			<tr><td>Nome do Funcion&aacute;rio:</td><td>'.utf8_decode(@$form["nome_funcionario"]).'</td></tr>
			<tr><td>Fun&ccedil;&atilde;o:</td><td>'.utf8_decode(@$form["funcao"]).'</td></tr>
			<tr><td>Data de admiss&atilde;o:</td><td>'.@$form["data_admissao"].'</td></tr>
			<tr><td>Sal&aacute;rio:</td><td>'.@$form["salario"].'</td></tr>
			<tr><td>M&iacute;nimo da categoria:</td><td>'.@$form["minimo_categoria"].'</td></tr>
			<tr><td>Prazo de experi&ecirc;ncia:</td><td>'.@$form["prazo_experiencia"].'</td></tr>
			<tr><td>Hor&aacute;rio de trabalho:</td><td>'.@$form["horario_trabalho"].'</td></tr>
			<tr><td>Observa&ccedil;&atilde;o:</td><td>'.utf8_decode(@$form["observacao"]).'</td></tr>
			<tr><td colspan="2"><hr /></td></tr>';
					
			if($_FILES["documentos"]['name'][0])
			{
				$mensagem .= '<tr><td>Documentos:</td><td>';

					$link = uploadarquivo("admissao", $_FILES["documentos"], @$form["nome_funcionario"]);
					$mensagem .= $link."<br />";

				$mensagem .= '</td></tr>';
			}
		$mensagem .= '</table>';
	
	//Create a new PHPMailer instance
	$mail = new PHPMailer();
	//Set who the message is to be sent from
	$mail->setFrom("contato@bvcontabilidade.com.br", "BV Contabilidade");
	//Set an alternative reply-to address
	$mail->addReplyTo("contato@bvcontabilidade.com.br", "BV Contabilidade");
	//Set who the message is to be sent to
	$mail->addAddress("contato@bvcontabilidade.com.br", 'BV Contabilidade');
	//Set the subject line
	$mail->Subject = utf8_decode("Admissão - ".$form["nome_empresa"]);
	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	$mail->msgHTML($mensagem);
	//Replace the plain text body with one created manually
	//$mail->AltBody = 'This is a plain-text message body';
	//Attach an image file
	//$mail->addAttachment('images/phpmailer_mini.gif');
	
	//send the message, check for errors
	if (!$mail->send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
		echo '<meta http-equiv="refresh" content="0; url=../index.php?pag=confirmacao">';
	}
}

else if($op == "demissao")
{
	
	$mensagem = '<table cellpadding="10" cellspacing="0" width="100%" border="0">
			<tr><td width="40%">Nome da Empresa</td><td width="60%">'.utf8_decode(@$form["nome_empresa"]).'</td></tr>
			<tr><td>Nome do Funcion&aacute;rio:</td><td>'.utf8_decode(@$form["nome_funcionario"]).'</td></tr>
			<tr><td>C&oacute;digo de funcion&aacute;rio:</td><td>'.utf8_decode(@$form["codigo_funcionario"]).'</td></tr>
			<tr><td>Motivo:</td><td>'.utf8_decode(@$form["motivo"]).'</td></tr>
			<tr><td>Data do desligamento:</td><td>'.@$form["data_desligamento"].'</td></tr>
			<tr><td>Aviso pr&eacute;vio:</td><td>'.@$form["aviso"].'</td></tr>
			<tr><td>Trabalhado ou indenizado:</td><td>'.@$form["trabalhado"].'</td></tr>
			<tr><td>Valor de Desconto Vale Transporte:</td><td>'.@$form["valor_desconto"].'</td></tr>
			<tr><td>Quantidades de Faltas:</td><td>'.@$form["qtd_faltas"].'</td></tr>
			<tr><td>Adiantamento:</td><td>'.@$form["adiantamento"].'</td></tr>
			<tr><td>Outras Vari&aacute;veis:</td><td>'.utf8_decode(@$form["variaveis"]).'</td></tr>
			<tr><td>Observa&ccedil;&atilde;o:</td><td>'.utf8_decode(@$form["observacao"]).'</td></tr></table>';
					
	
	//Create a new PHPMailer instance
	$mail = new PHPMailer();
	//Set who the message is to be sent from
	$mail->setFrom("contato@bvcontabilidade.com.br", "BV Contabilidade");
	//Set an alternative reply-to address
	$mail->addReplyTo("contato@bvcontabilidade.com.br", "BV Contabilidade");
	//Set who the message is to be sent to
	$mail->addAddress("contato@bvcontabilidade.com.br", 'BV Contabilidade');
	//Set the subject line
	$mail->Subject = utf8_decode("Demissão - ".$form["nome_empresa"]);
	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	$mail->msgHTML($mensagem);
	//Replace the plain text body with one created manually
	//$mail->AltBody = 'This is a plain-text message body';
	//Attach an image file
	//$mail->addAttachment('images/phpmailer_mini.gif');
	
	//send the message, check for errors
	if (!$mail->send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
		echo '<meta http-equiv="refresh" content="0; url=../index.php?pag=confirmacao">';
	}
	
}

else if($op == "contato")
{
	
	$mensagem = '<table cellpadding="10" cellspacing="0" width="100%" border="0" style="font-family: Arial;">
			<tr><td width="20%">Nome</td><td width="60%">'.@$form["nome"].'</td></tr>
			<tr><td>E-mail:</td><td>'.@$form["email"].'</td></tr>
			<tr><td>Telefone:</td><td>'.@$form["telefone"].'</td></tr>
			<tr><td>Mensagem:</td><td>'.@$form["mensagem"].'</td></tr>
			</table>';
			
	//Create a new PHPMailer instance
	$mail = new PHPMailer();
	//Set who the message is to be sent from
	$mail->setFrom($form["email"], $form["nome"]);
	//Set an alternative reply-to address
	$mail->addReplyTo($form["email"], $form["nome"]);
	//Set who the message is to be sent to
	$mail->addAddress("contato@bvcontabilidade.com.br", 'BV Contabilidade');
	//Set the subject line
	$mail->Subject = utf8_decode($form["assunto"]);
	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	$mail->msgHTML($mensagem);
	//Replace the plain text body with one created manually
	//$mail->AltBody = 'This is a plain-text message body';
	//Attach an image file
	//$mail->addAttachment('images/phpmailer_mini.gif');
	
	//send the message, check for errors
	if (!$mail->send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
		echo '<meta http-equiv="refresh" content="0; url=../index.php?pag=confirmacao">';
	}
	
	
}

?>