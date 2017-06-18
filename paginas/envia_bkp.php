<?php
ini_set('memory_limit','164M'); // set memory to prevent fatal errors

include("../admin/conexao.php");
include("../admin/funcaoform.php");
include("upload.php");
include('MPDF57/mpdf.php');

$op = @$_GET['op'];
$retorno = @$_GET['retorno'];

$form = $_POST;

require '../phpmailer/class.phpmailer.php';

if($op == "irpf")
{
	
	//echo "<pre>";
	//print_r($form);
	//print_r($_FILES["declaracaoanterior"]);
	//echo "</pre>";
	
	$mensagem = '<table cellpadding="10" cellspacing="0" width="100%" border="0">
			<tr><td width="40%">Nome</td><td width="60%">'.@$form["nome"].'</td></tr>
			<tr><td>CPF:</td><td>'.@$form["cpf"].'</td></tr>
			<tr><td>E-mail:</td><td>'.@$form["email"].'</td></tr>
			<tr><td>Telefone:</td><td>'.@$form["telefone"].'</td></tr>
			<tr><td>Banco:</td><td>'.@$form["banco"].'</td></tr>
			<tr><td>Ag&ecirc;ncia:</td><td>'.@$form["agencia"].'</td></tr>
			<tr><td>Conta Corrente:</td><td>'.@$form["conta_corrente"].'</td></tr>
			<tr><td colspan="2"><hr /></td></tr>
			
			<tr><td>Primeira declara&ccedil;&atilde;o feita pela BV Contabilidade?</td><td>'.@$form["pdbv"].'</td></tr>';
			
			if(@$form["pdbv"] == "sim")
			{
				$mensagem .= '<tr><td>Declarou ano passado?</td><td>'.@$form["bvdeanopassado"].'</td></tr>';
				if(@$form["bvdeanopassado"] == "sim")
				{
					
					if(@$form['bvenviapessoalmente'] != "nao")
					{
						$mensagem .= '<tr><td>Declara&ccedil;&atilde;o anterior:</td><td>Desejo entregar pessoalmente</td></tr>';
					}
					else
					{
						if(@$_FILES["declaracaoanterior"]["name"][0])
						{
							$link = uploadarquivo("irpf", ($_FILES["declaracaoanterior"]), (@$form["nome"]))."<br />";
							$mensagem .= '<tr><td>Declara&ccedil;&atilde;o anterior:</td><td>'.$link.'</td></tr>';
						}
						if(@$_FILES["reciboanterior"]["name"][0])
						{
							$link2 = uploadarquivo("irpf", ($_FILES["reciboanterior"]), (@$form["nome"]))."<br />";
							$mensagem .= '<tr><td>Recibo anterior:</td><td>'.$link2.'</td></tr>';
						}
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
				$mensagem .= '<tr><td>Declarou ano passado?</td><td>'.@$form["nbvdeanopassado"].'</td></tr>';
				if(@$form["nbvdeanopassado"] == "sim")
				{
					$mensagem .= '<tr><td>Houve mudança de endereço?</td><td>'.@$form["nbvmudanca"].'</td></tr>';
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
						if($dependente != "")
						{
							$mensagem .= '<tr><td>Nome:</td><td>'.$dependente.'</td></tr>
										<tr><td>Grau de parentesco:</td><td>'.@$form["parentesco"][$indice].'</td></tr>
								<tr><td>Data de nascimento:</td><td>'.@$form["data_nascparente"][$indice].'</td></tr>';
								if(@$form['cpf_parente'][$indice] != "")
									$mensagem .= '<tr><td>CPF:</td><td>'.@$form["cpf_parente"][$indice].'</td></tr>';
						}
					}
				}
			$mensagem .= '<tr><td colspan="2"><hr /></td></tr>
				<tr><td>Houve despesas com educação?</td><td>'.@$form["despesasedu"].'</td></tr>';	
				if(@$form["despesasedu"] == "sim")
				{
					foreach(@$form["nome_despesaedu"] as $indice => $nomedesp)
					{
						if($nomedesp != "")
						{
							$mensagem .= '<tr><td>Nome do Contribuinte ou Dependente:</td></td>'.$nomedesp.'</td></tr>
								<tr><td>Instituição:</td><td>'.@$form["empresa_despesaedu"][$indice].'</td></tr>
								<tr><td>CNPJ:</td><td>'.@$form["cnpj_despesaedu"][$indice].'</td></tr>
								<tr><td>Valor:</td><td>'.@$form["valor_despesaedu"][$indice].'</td></tr>';
						}
					}
				}
			$mensagem .= '<tr><td colspan="2"><hr /></td></tr>
				<tr><td>Houve despesas médicas?</td><td>'.@$form["despesasmedica"].'</td></tr>';   
				if(@$form["despesasmedica"] == "sim")
				{
					foreach(@$form["nome_despesamedica"] as $indice => $nomedespmedica)
					{
						if($nomedespmedica != "")
						{
							$mensagem .= '<tr><td>Nome do Contribuinte ou Dependente:</td><td>'.$nomedespmedica.'</td></tr>
								<tr><td>Empresa:</td><td>'.@$form["empresa_despesamedica"][$indice].'</td></tr>
								<tr><td>CNPJ:</td><td>'.@$form["cnpj_despesamedica"][$indice].'</td></tr>
								<tr><td>Valor:</td><td>'.@$form["valor_despesamedica"][$indice].'</td></tr>';
						}
					}
				}
			$mensagem .= '<tr><td colspan="2"><hr /></td></tr>
				<tr><td>Houve despesas com empregado domestico?</td><td>'.@$form["despesasempregado"].'</td></tr>';   
				if(@$form["despesasempregado"] == "sim")
				{
					foreach(@$form["nome_empregado"] as $indice => $empregado)
					{
						if($empregado != "")
						{
							$mensagem .= '<tr><td>Nome:</td><td>'.$empregado.'</td></tr>
								<tr><td>CPF:</td><td>'.@$form["cpf_empregado"][$indice].'</td></tr>
								<tr><td>PIS:</td><td>'.@$form["pis_empregado"][$indice].'</td></tr>
								<tr><td>Valor:</td><td>'.@$form["valor_empregado"][$indice].'</td></tr>';
						}
					}
				}
			$mensagem .= '<tr><td colspan="2"><hr /></td></tr>
				<tr><td>Houve compra e/ou vendas de bens?</td><td>'.@$form["comprabens"].'</td></tr>';   
				if(@$form["comprabens"] == "sim")
				{
					$mensagem .= '<tr><td>Tipo / descrição:</td><td>';
					foreach(@$form["tipo_comprabens"] as $indice => $bens)
					{
						$mensagem .= $bens.'<br />'.@$form["infomacoesbens"][$indice].'<br /><br />';
					}
					$mensagem .= '</td></tr>';
				}
			$mensagem .= '<tr><td colspan="2"><hr /></td></tr>';  
			
			if(@$_FILES["comprovantes"]['name'][0] || @$_FILES["extratos"]['name'][0])
			{
				$mensagem .= '<tr><td colspan="2"><hr /></td></tr>
					<tr><td colspan="2">Relação de documentos</td></tr>';
				
				
				if(@$_FILES["comprovantes"]['name'][0])
				{
					$mensagem .= '<tr><td>Comprovante de rendimentos:</td><td>';
	
						$link = uploadarquivo("irpf", ($_FILES["comprovantes"]), (@$form["nome"]));
						$mensagem .= $link."<br />";
	
					$mensagem .= '</td></tr>';
				}
				if(@$_FILES["extratos"]['name'][0])
				{
					$mensagem .= '<tr><td>Extrato de Rendimentos Financeiros e Financiamentos de Todos os Bancos:</td><td>';
	
						$link = uploadarquivo("irpf", ($_FILES["extratos"]), (@$form["nome"]));
						$mensagem .= $link."<br />";
	
					$mensagem .= '</td></tr>';
				}
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
	$mail->addAddress("bruno@bvcontabilidade.com.br", 'Bruno');
	$mail->addAddress("joao@bvcontabilidade.com.br", 'Joao');
	$mail->addAddress("sara@bvcontabilidade.com.br", 'Sara');
	$mail->addAddress("cristiane@bvcontabilidade.com.br", 'Cristiane');
	$mail->addAddress("tamires@bvcontabilidade.com.br", 'Tamires');
	$mail->addAddress("leticia@bvcontabilidade.com.br", 'Leticia');
	
	
	//Set the subject line
	$mail->Subject = utf8_decode("Site BV Contabilidade - IRPF");
	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	$mail->msgHTML(utf8_decode($mensagem));
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
			<tr><td>Dias e hor&aacute;rios de trabalho:</td><td>'.@$form["horario_trabalho"].'</td></tr>
			<tr><td>Funcion&aacute;rio esta recebendo ou deu entrada, sem receber primeira parcela, no seguro desemprego?</td><td>'.utf8_decode(@$form["seguro"]).'</td></tr>
			<tr><td>Observa&ccedil;&atilde;o:</td><td>'.utf8_decode(@$form["observacao"]).'</td></tr>
			<tr><td colspan="2"><hr /></td></tr>';
			
			
			if($_FILES["documentos"]['name'][0])
			{
				$mensagem .= '<tr><td>Documentos:</td><td>';

					$link = uploadarquivo("admissao", ($_FILES["documentos"]), (@$form["nome_funcionario"]));
					$mensagem .= $link."<br />";

				$mensagem .= '</td></tr>';
			}
			
			
		$mensagem .= '</table>';

	//Create a new PHPMailer instance
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPDebug = 1;
	$mail->Port = 80; //Indica a porta de conexão para a saída de e-mails
	$mail->Host = 'smtpout.secureserver.net';//Endereço do Host do SMTP Locaweb
	$mail->SMTPAuth = true; //define se haverá ou não autenticação no SMTP
	$mail->Username = 'contatosite@bvcontabilidade.com.br'; //Login de autenticação do SMTP
	$mail->Password = 'bv159contabili'; //Senha de autenticação do SMTP
	//Set who the message is to be sent from
	$mail->setFrom("contato@bvcontabilidade.com.br", "BV Contabilidade");
	//Set an alternative reply-to address
	$mail->addReplyTo("contato@bvcontabilidade.com.br", "BV Contabilidade");
	//Set who the message is to be sent to
	$mail->addAddress("contato@bvcontabilidade.com.br", 'BV Contabilidade');
	$mail->addAddress("bruno@bvcontabilidade.com.br", 'Bruno');
	$mail->addAddress("joao@bvcontabilidade.com.br", 'Joao');
	$mail->addAddress("sara@bvcontabilidade.com.br", 'Sara');
	$mail->addAddress("cristiane@bvcontabilidade.com.br", 'Cristiane');
	$mail->addAddress("tamires@bvcontabilidade.com.br", 'Tamires');
	$mail->addAddress("leticia@bvcontabilidade.com.br", 'Leticia');

	//Set the subject line
	$mail->Subject = utf8_decode("Site BV Contabilidade - Admissão - ".$form["nome_empresa"]);
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
		if($retorno)
		{
			echo '<meta http-equiv="refresh" content="0; url=../domestico/index.php?pag=admissao&msg=ok">';
		}
		else
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
			<tr><td>Aviso pr&eacute;vio:</td><td>'.@$form["aviso"].'</td></tr>';
			if(@$form["aviso"] == "sim")
				$mensagem .= '<tr><td>Trabalhado ou indenizado:</td><td>'.@$form["tipoaviso"].'</td></tr>';
			
	$mensagem .= '<tr><td>Valor de Desconto Vale Transporte:</td><td>'.@$form["valor_desconto"].'</td></tr>
			<tr><td>Quantidades de Faltas:</td><td>'.@$form["qtd_faltas"].'</td></tr>
			<tr><td>Adiantamento:</td><td>'.@$form["adiantamento"].'</td></tr>
			<tr><td>Outras Vari&aacute;veis:</td><td>'.utf8_decode(@$form["variaveis"]).'</td></tr>
			<tr><td>Observa&ccedil;&atilde;o:</td><td>'.utf8_decode(@$form["observacao"]).'</td></tr></table>';
					
	
	//Create a new PHPMailer instance
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPDebug = 1;
	$mail->Port = 80; //Indica a porta de conexão para a saída de e-mails
	$mail->Host = 'smtpout.secureserver.net';//Endereço do Host do SMTP Locaweb
	$mail->SMTPAuth = true; //define se haverá ou não autenticação no SMTP
	$mail->Username = 'contatosite@bvcontabilidade.com.br'; //Login de autenticação do SMTP
	$mail->Password = 'bv159contabili'; //Senha de autenticação do SMTP
	//Set who the message is to be sent from
	$mail->setFrom("contato@bvcontabilidade.com.br", "BV Contabilidade");
	//Set an alternative reply-to address
	$mail->addReplyTo("contato@bvcontabilidade.com.br", "BV Contabilidade");
	//Set who the message is to be sent to
	
	$mail->addAddress("contato@bvcontabilidade.com.br", 'BV Contabilidade');
	$mail->addAddress("bruno@bvcontabilidade.com.br", 'Bruno');
	$mail->addAddress("joao@bvcontabilidade.com.br", 'Joao');
	$mail->addAddress("sara@bvcontabilidade.com.br", 'Sara');
	$mail->addAddress("cristiane@bvcontabilidade.com.br", 'Cristiane');
	$mail->addAddress("tamires@bvcontabilidade.com.br", 'Tamires');
	$mail->addAddress("leticia@bvcontabilidade.com.br", 'Leticia');
	
	//Set the subject line
	$mail->Subject = utf8_decode("Site BV Contabilidade - Demissão - ".$form["nome_empresa"]);
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
else if($op == "horaextra")
{
	
	$salario_base = str_replace(",",".",str_replace(".","",$form["salario_base"]));
	$adicional = str_replace(",",".",str_replace(".","",$form["adicional"]));
	$insalubridade = str_replace(",",".",str_replace(".","",$form["insalubridade"]));
	$periculosidade = str_replace(",",".",str_replace(".","",$form["periculosidade"]));
	$provento = str_replace(",",".",str_replace(".","",$form["provento"]));
	$horasmensais = explode(":",$form["horasmensais"]);
	$horas = $horasmensais[0];
	$agregacao = $form['agregacao'];
	$qtdhoras = $form['qtdhoras'];
	if($qtdhoras == "" || $qtdhoras == 0)
		$qtdhoras = 1;
	
	$valorhorabase = (($salario_base + $adicional + $insalubridade + $periculosidade + $provento) / $horas);
	$valoragregacao = ($valorhorabase * $agregacao) / 100;
	
	//(2 + 100 + 100 + 100) / 220 = 1.372
	
	//(1.372 * 50)/100 = 0.686
	
	//(1.372 + 0.686) * 20 = 41.16
	
	$valorhora = ($valorhorabase + $valoragregacao) * $qtdhoras;
	//41.16 / 6 = 6.86
	
	$dsr = $valorhora / 6;
	//48,02
	$valorhora = number_format($valorhora,2,",","."); 
	
	
	$mensagem = '<table cellpadding="10" cellspacing="0" width="100%" border="0">
			<tr><td width="20%">Nome da Empresa</td><td width="60%">'.utf8_decode(@$form["nome_empresa"]).'</td></tr>
			<tr><td>Nome do Funcion&aacute;rio:</td><td>'.utf8_decode(@$form["nome_funcionario"]).'</td></tr>
			<tr><td>C&oacute;digo de funcion&aacute;rio:</td><td>'.utf8_decode(@$form["codigo_funcionario"]).'</td></tr>
			<tr><td>Sal&aacute;rio Base (R$):</td><td>'.number_format($salario_base,2,",",".").'</td></tr>
			<tr><td>Adicional por Tempo de Servi&ccedil;o (R$):</td><td>'.number_format($adicional,2,",",".").'</td></tr>
			<tr><td>Insalubridade (R$):</td><td>'.number_format($insalubridade,2,",",".").'</td></tr>
			<tr><td>Periculosidade (R$):</td><td>'.number_format($periculosidade,2,",",".").'</td></tr>
			<tr><td>Outro Provento (R$):</td><td>'.number_format($provento,2,",",".").'</td></tr>
			<tr><td>Total de Horas Mensais:</td><td>'.$form["horasmensais"].'</td></tr>
			<tr><td>Percentual de Agrega&ccedil;&atilde;o (%):</td><td>'.$form["agregacao"].'</td></tr>
			<tr><td>Quantidade de Horas:</td><td>'.$form["qtdhoras"].'</td></tr>
			<tr><td>DSR (R$):</td><td>'.number_format($dsr,2,",",".").'</td></tr>
			<tr><td>Valor da Hora Extra (R$):</td><td>'.$valorhora.'</td></tr></table>
			
			<hr />
			<table cellpadding="10" cellspacing="0" width="100%" border="0">
				<tr>
					<td width="20%"><a href="http://www.bvcontabilidade.com.br"><img width="140" src="http://www.bvcontabilidade.com.br/imagens/logo.png" border="0" /></a></td>
					<td>Travessa '.utf8_decode("Pirajá").', 1298 - sala 02, Marco<br />'.utf8_decode("Belém").', PA<br />CEP 66095-631<br />
					Telefone: (91) 3228.0364 - 3352.0200</td>
				</tr>
			</table>';
					
	
	//Create a new PHPMailer instance
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPDebug = 1;
	$mail->Port = 80; //Indica a porta de conexão para a saída de e-mails
	$mail->Host = 'smtpout.secureserver.net';//Endereço do Host do SMTP Locaweb
	$mail->SMTPAuth = true; //define se haverá ou não autenticação no SMTP
	$mail->Username = 'contatosite@bvcontabilidade.com.br'; //Login de autenticação do SMTP
	$mail->Password = 'bv159contabili'; //Senha de autenticação do SMTP
	//Set who the message is to be sent from
	$mail->setFrom("contato@bvcontabilidade.com.br", "BV Contabilidade");
	//Set an alternative reply-to address
	$mail->addReplyTo("contato@bvcontabilidade.com.br", "BV Contabilidade");
	//Set who the message is to be sent to
	
	$mail->addAddress("contato@bvcontabilidade.com.br", 'BV Contabilidade');
	$mail->addAddress($form["emailenvio"]);
	
	//Set the subject line
	$mail->Subject = utf8_decode("Site BV Contabilidade - Cálculo de Hora Extra - ".$form["nome_empresa"]);
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

else if($op == "rescisao")
{
	
	echo "<pre>";
	print_r($form);
	echo "</pre>";
	
	$mensagem = "<strong>SIMULA&Ccedil;&Atilde;O DE DEMISS&Atilde;O</strong><br /><br />";
	$mensagem .= "<strong>Data admiss&atilde;o:</strong> ".$form['data_admissao'];
	$mensagem .= "<br /><strong>Data demiss&atilde;o:</strong> ".$form['data_demissao'];

	$data_admissao = strtotime(str_replace("/","-",$form['data_admissao']));
	$data_demissao = strtotime(str_replace("/","-",$form['data_demissao']));
	$data_retorno = strtotime(str_replace("/","-",@$form['data_retorno']));
	$data_dissidio = strtotime(str_replace("/","-",$form['data_dissidio']."-".date("Y")));
	$avisop = @$form['aviso'];
	$tipoaviso = @$form['tipoaviso'];

	$afastado = @$form['afastado'];
	
	$data_admissao2 = date("Y-m-d",strtotime(str_replace("/","-",$form['data_admissao'])));
	$data_demissao2 = date("Y-m-d",strtotime(str_replace("/","-",$form['data_demissao'])));
	//$data_demissao2 = date("Y-m-d",strtotime("+1 days",strtotime(str_replace("/","-",$form['data_demissao']))));
	$data_retorno2 = date("Y-m-d",strtotime(str_replace("/","-",@$form['data_retorno'])));
	
	$date = new DateTime( $data_admissao2 ); 
	$interval = $date->diff( new DateTime( $data_demissao2 ) );
	$num_anos = $interval->format( '%Y' );
	
	
	$dia_demissao = date("d",$data_demissao);
	if($dia_demissao == "31")
		$dia_demissao = 30;
		
	$mes_admissao = date("m",$data_admissao);
	$mes_demissao = date("m",$data_demissao);

	
	$salario_base = str_replace(",",".",str_replace(".","",$form["salario_base"]));
	$adicional = str_replace(",",".",str_replace(".","",$form["adicional"]));
	$insalubridade = str_replace(",",".",str_replace(".","",$form["insalubridade"]));
	$periculosidade = str_replace(",",".",str_replace(".","",$form["periculosidade"]));
		
	$provento = str_replace(",",".",str_replace(".","",$form["provento"]));
	$remuneracoes = str_replace(",",".",str_replace(".","",$form["remuneracoes"]));
	
	$valor_desconto = str_replace(",",".",str_replace(".","",$form["valor_desconto"]));
	$adiantamento = str_replace(",",".",str_replace(".","",$form["adiantamento"]));
	$variaveis = str_replace(",",".",str_replace(".","",$form["variaveis"]));
	
	$faltas = $form['qtd_faltas'];
	
	
	$totalizador = $salario_base + $adicional + $insalubridade + $periculosidade + $provento + $remuneracoes;
	$mensagem .= "<br /><strong>M&eacute;dia da Maior Remunera&ccedil;&atilde;o:</strong> ".number_format($totalizador,2,",",".");
	
	

	
	$mensagem .= "<br /><strong>Tempo de trabalho:</strong> ".$num_anos;
	if($num_anos == 1)
		$mensagem .= " ano";
	else if($num_anos > 1)
		$mensagem .= " anos";

	$qtd_ferias = $form['qtd_ferias'];
	if($qtd_ferias == "")
		$qtd_ferias = 0;
	$mensagem .= "<br /><strong>Qtd de f&eacute;rias gozadas:</strong> ".$qtd_ferias;
	
	$mensagem .= "<br /><br /><hr />";
	$mensagem .= "<br /><strong>PROVENTOS (R$)</strong><br />";
	
	$dias_aviso_base = 30;


	if($num_anos < 1)
		$total_diasaviso = 30;
	else if($num_anos > 20)
		$total_diasaviso = 90;
	else
		$total_diasaviso = (($num_anos) * 3) + $dias_aviso_base;

	if(@$form['motivo'] == "Iniciativa do empregado")
		$total_diasaviso = $dias_aviso_base;

		
	
		
	
	//////// AVISO PREVIO //////////////////////////
	$multa_dissidio = 0;
	$frase_dissidio = "";
	
	if($form['motivo'] == "Iniciativa do empregador")
	{
		if($form['tipoaviso'] == "trabalhado")
		{
			$valor_avisoprevio = 0;
			$fraseavisoprovento = "";
			$valor_avisoprevioprovento = 0;
		}
		else
		{
			$valor_avisoprevioprovento = ($totalizador / 30) * $total_diasaviso;
			$fraseavisoprovento = "<strong>Valor aviso pr&eacute;vio:</strong> ".number_format($valor_avisoprevioprovento,2,",",".")."<br />";
		}
	}
	else if($form['motivo'] == "Iniciativa do empregado")
	{
		if($form['tipoaviso'] == "trabalhado")
		{
			
			$valor_avisoprevio = 0;
			$fraseavisoprovento = "";
			$valor_avisoprevioprovento = 0;


		}
		else
		{
			$valor_avisopreviodesconto = ($totalizador / 30) * $total_diasaviso;
			$fraseavisodesconto = "<strong>Valor aviso pr&eacute;vio:</strong> ".number_format($valor_avisopreviodesconto,2,",",".")."<br />";
		}
	}

	function geraTimestamp($data) {
		$partes = explode('/', $data);
		return mktime(0, 0, 0, $partes[1], $partes[0], $partes[2]);
	}
	
	if($form['tipoaviso'] == "trabalhado")
	{
		
		$data_projecao = date("d/m/Y",strtotime("+".$total_diasaviso." days",$data_demissao));
		$data_dissidio2 = date("d/m/Y",$data_dissidio);
		
		$time_inicial = geraTimestamp($data_dissidio2);
		$time_final = geraTimestamp($data_projecao);

		$diferenca = $time_final - $time_inicial;
		$dias = (int)floor($diferenca / (60 * 60 * 24));

		if($dias < $total_diasaviso)
		{

			$multa_dissidio = ($totalizador / 30) * $total_diasaviso;
			$frase_dissidio = "<br><br><strong>Multa Art 9 CLT:</strong> ".number_format($multa_dissidio,2,",",".");
		}
		else
		{
			$multa_dissidio = 0;
			$frase_dissidio = "";
		}
	}
	else
	{
		$data_projecao = date("d/m/Y",strtotime("+".$total_diasaviso." days",$data_demissao));
		$data_dissidio2 = date("d/m/Y",$data_dissidio);
		
		$time_inicial = geraTimestamp($data_dissidio2);
		$time_final = geraTimestamp($data_projecao);

		$diferenca = $time_final - $time_inicial;
		$dias = abs((int)floor($diferenca / (60 * 60 * 24)));
		
		if($dias < $total_diasaviso)
		{
			$multa_dissidio = ($totalizador / 30) * $total_diasaviso;
			$frase_dissidio = "<br><br><strong>Multa Art 9 CLT:</strong> ".number_format($multa_dissidio,2,",",".");
		}
		else
		{
			$multa_dissidio = 0;
			$frase_dissidio = "";
		}

	}
	

	/////// MESES PARA 13 /////
	if($num_anos < 1)
	{
		$ano_admissao = date("Y",$data_admissao);
		$ano_demissao = date("Y",$data_demissao);
		if($ano_admissao == $ano_demissao)
		{
			$date = new DateTime( $data_admissao2 ); 
			$interval = $date->diff( new DateTime( $data_demissao2 ) );
			$nummeses13 = $interval->format( '%m' );
		}
		else
		{
			$date = new DateTime( $ano_admissao."-01-01" ); 
			$interval = $date->diff( new DateTime( $data_demissao2 ) );
			$nummeses13 = $interval->format( '%m' );
		}
		
		if($dia_demissao >= 15)
			$nummeses13 = $nummeses13 + 1;
		
		
		/*
		if($mes_admissao > $mes_demissao)
		{
			$nummeses13 = $mes_demissao;
			if($dia_demissao < 15)
				$nummeses13 = $nummeses13 - 1;
		}
		else
		{
			$nummeses13 = $mes_demissao - $mes_admissao;
			if($dia_demissao >= 15)
				$nummeses13 = $nummeses13 + 1;
		}
		*/
	}
	else
	{
		$nummeses13 = $mes_demissao;
		if($dia_demissao < 15)
			$nummeses13 = $nummeses13 - 1;
	}

	/////// MESES PARA FERIAS PROPORCIONAIS /////
	if($afastado == "sim")
		$date = new DateTime( $data_retorno2 );
	else
		$date = new DateTime( $data_admissao2 );
		
	

	if($num_anos < 1)
	{
		$ano_admissao = date("Y",$data_admissao);
		$ano_demissao = date("Y",$data_demissao);
		if($ano_admissao == $ano_demissao)
		{
			$interval = $date->diff( new DateTime( $data_demissao2 ) );
			$nummeses = $interval->format( '%m' );
		}
		else
		{
			$date = new DateTime( $ano_admissao."-01-01" ); 
			$interval = $date->diff( new DateTime( $data_demissao2 ) );
			$nummeses = $interval->format( '%m' );
		}
		
		if($dia_demissao >= 15)
			$nummeses = $nummeses + 1;
	}
	else if($num_anos == 1)
	{
		$ano_admissao = date("Y",$data_admissao);
		$ano_demissao = date("Y",$data_demissao);
		if($ano_admissao == $ano_demissao)
		{
			$interval = $date->diff( new DateTime( $data_demissao2 ) );
			$nummeses = $interval->format( '%m' );
		}
		else
		{
			$date = new DateTime($data_admissao2); 
			$interval = $date->diff( new DateTime($ano_admissao."-12-01"));
			$nummeses1 = $interval->format( '%m' ) + 1;

			$date = new DateTime($ano_admissao."-01-01"); 
			$interval = $date->diff( new DateTime( $data_demissao2 ));
			$nummeses2 = $interval->format( '%m' );
			$nummeses = $nummeses1 + $nummeses2;
		}
		if($dia_demissao >= 15)
			$nummeses = $nummeses + 1;
	}
	else
	{
		$date = new DateTime($data_admissao2); 
		$interval = $date->diff( new DateTime($ano_admissao."-12-01"));
		$nummeses1 = $interval->format( '%m' ) + 1;

		$date = new DateTime($ano_admissao."-01-01"); 
		$interval = $date->diff( new DateTime( $data_demissao2 ));
		$nummeses2 = $interval->format( '%m' );
		$nummeses = $nummeses1 + $nummeses2;

		if($dia_demissao < 15)
			$nummeses = $nummeses - 1;
	}

	/*
	$interval = $date->diff( new DateTime( $data_demissao2 ) );
	$nummeses = $interval->format( '%m' );
	
	if($dia_demissao > 15)
		$nummeses = $nummeses + 1;
	*/
	/*	
	if($mes_admissao > $mes_demissao)
	{
		$nummeses = ($mes_demissao - $mes_admissao) + 12;
		if($dia_demissao > 15)
			$nummeses = $nummeses + 1;
	}
	else
	{
		$nummeses = $mes_demissao - $mes_admissao;
		if($dia_demissao > 15)
			$nummeses = $nummeses + 1;
	}
	*/
	
	$mensagem .= "<br />".@$fraseavisoprovento;
	
	//////// 13o SALARIO //////////////////////////
	if($form['motivo'] != "Justa causa")
	{
		$decimoterceiro = ($totalizador / 12) * $nummeses13;
		
		$mensagem .= "<br /><strong>13&deg; Sal&aacute;rio:</strong> ".number_format($decimoterceiro,2,",",".");
		$mensagem .= "<br />";
	
	}
	else
		$decimoterceiro = 0;
		
	/////////// FERIAS ///////////////
	$valorferias = 0;
	$tercoferias = 0;
	$valorferiasdobro = 0;
	$tercoferiasdobro = 0;
	
	$valorferias = $totalizador;
	$feriasvencidas = $num_anos - $qtd_ferias;
	
	if($feriasvencidas > 0)
	{
		if($afastado != "sim")
		{
			$tercoferias = $valorferias / 3;
			$mensagem .= "<br /><strong>F&eacute;rias vencidas (".$feriasvencidas."):</strong> ".number_format($valorferias,2,",",".");
			$mensagem .= "<br /><strong>1/3 de f&eacute;rias vencidas:</strong> ".number_format($tercoferias,2,",",".");
			$mensagem .= "<br />";
		}
		else
		{
			$valorferias = 0;
			$tercoferias = 0;
			$mensagem .= "<br /><strong>F&eacute;rias vencidas:</strong> ".number_format($valorferias,2,",",".");
			$mensagem .= "<br /><strong>1/3 de f&eacute;rias vencidas:</strong> ".number_format($tercoferias,2,",",".");
			$mensagem .= "<br />";
		}
	}
	else
	{
		$valorferias = 0;
		$tercoferias = 0;
	}
	
	if($feriasvencidas >= 2)
	{
		if($afastado != "sim")
		{
			$valorferiasdobro = $valorferias * $feriasvencidas;
			$tercoferiasdobro = number_format($valorferiasdobro / 3 ,2);
			$mensagem .= "<br /><strong>F&eacute;rias dobrada (".$feriasvencidas."):</strong> ".number_format($valorferiasdobro,2,",",".");
			$mensagem .= "<br /><strong>1/3 de f&eacute;rias dobrada:</strong> ".number_format($tercoferiasdobro,2,",",".");
			$mensagem .= "<br />";
		}
		else
		{
			$valorferiasdobro = 0;
			$tercoferiasdobro = 0;
		}
	}
	else
	{
		$valorferiasdobro = 0;
		$tercoferiasdobro = 0;
	}

	
	////////// FERIAS PROPORCIONAIS E 1/3 DE FERIAS PROPORCIONAIS
	if($form['motivo'] != "Justa causa")
	{
		$feriasprop = ($totalizador / 12) * $nummeses;
		$tercoferiasprop = number_format($feriasprop / 3 ,2);
		$mensagem .= "<br /><strong>F&eacute;rias proporcionais (".$nummeses."/12):</strong> ".number_format($feriasprop,2,",",".");
		$mensagem .= "<br /><strong>1/3 de f&eacute;rias proporcionais:</strong> ".number_format($tercoferiasprop,2,",",".");
		$mensagem .= "<br />";
	}
	else
	{
		$feriasprop = 0;
		$tercoferiasprop = 0;
	}
	
	$saldosalario = ($salario_base / 30) * $dia_demissao;
	$mensagem .= "<br /><strong>Saldo do Sal&aacute;rio (".$dia_demissao."):</strong> ".number_format($saldosalario,2,",",".");
	$mensagem .= "<br />";
	
	if($form['motivo'] == "Iniciativa do empregador")
	{
		if($tipoaviso == "indenizado")
		{
			$mesindenizado_dias = strtotime("+".$total_diasaviso." days", $data_demissao);
			$mesindenizado_data = date("Y-m-d",$mesindenizado_dias);
			$date = new DateTime( $mesindenizado_data ); 
			$interval = $date->diff( new DateTime( $data_demissao2 ) );
			$mesindenizado = $interval->format( '%m' );
	
			$diaverifica = date("d", $mesindenizado_dias);
			
			/* ALTERADO EM 21/09/2015
			if($diaverifica <= 14)
				$mesindenizado = $mesindenizado;
			else
				$mesindenizado = $mesindenizado + 1;
			*/
			$feriasind = number_format(($totalizador / 12) * $mesindenizado ,2);
			$tercoferiasind = number_format($feriasind / 3 ,2);
			
			$decimoterceiroind = number_format($feriasind,2);
			$mensagem .= "<br /><strong>13&deg; Indenizadas (".$mesindenizado."/12):</strong> ".number_format($decimoterceiroind,2,",",".");
			$mensagem .= "<br /><strong>F&eacute;rias Indenizadas (".$mesindenizado."/12):</strong> ".number_format($feriasind,2,",",".");
			$mensagem .= "<br /><strong>1/3 de f&eacute;rias Indenizado:</strong> ".number_format($tercoferiasind,2,",",".");
			$mensagem .= "<br />";
		}
	}
	if($adicional)
	{
				$adicionalprop = ($adicional / 30) * $dia_demissao;
				$mensagem .= "<br /><strong>Adicional por tempo de servi&ccedil;o (proporcional):</strong> ".number_format($adicionalprop,2,",",".");
	}
	if($insalubridade)
	{
				$insalubridadeprop = ($insalubridade / 30) * $dia_demissao;
				$mensagem .= "<br /><strong>Insalubridade (proporcional):</strong> ".number_format($insalubridadeprop,2,",",".");
	}
	if($periculosidade)
	{
				$periculosidadeprop = ($periculosidade / 30) * $dia_demissao;
				$mensagem .= "<br /><strong>Periculosidade (proporcional):</strong> ".number_format($periculosidadeprop,2,",",".");
	}
	$mensagem .= $frase_dissidio;
	
	////////// SALDO SALARIO /////////////
	$total_proventos = @$valor_avisoprevioprovento + @$decimoterceiro + @$feriasprop + @$tercoferiasprop + @$valorferias + @$tercoferias + @$valorferiasdobro + @$tercoferiasdobro + @$decimoterceiroind + @$feriasind + @$tercoferiasind + @$saldosalario + @$adicionalprop + @$insalubridadeprop + @$periculosidadeprop + @$multa_dissidio;
	$mensagem .= "<br /><br /><br /><strong>TOTAL PROVENTOS:</strong> ".number_format($total_proventos,2,",",".");

	
	$mensagem .= "<br /><br /><hr />";
	$mensagem .= "<br /><strong>DESCONTOS (R$)</strong><br />";
	
	$mensagem .= "<br />".@$fraseavisodesconto;
	
	if($form['parcela13_2'] == "sim")
	{
		$mensagem .= "<br /><strong>2&ordf; parcela 13&deg; Sal&aacute;rio:</strong> ".number_format($decimoterceiro,2,",",".");
		$mensagem .= "<br />";
		
		$desc13 = $decimoterceiro;
	}
	else
	{	
		if($form['parcela13_1'] == "sim")
		{
			$desc13 = $decimoterceiro / 2;
			$mensagem .= "<br /><strong>1&ordf; parcela 13&deg; Sal&aacute;rio:</strong> ".number_format($desc13,2,",",".");
			$mensagem .= "<br />";
		}
		else
			$desc13 = "";
	}
	
	if($faltas > 0)
	{
		$qtd_faltas = ($salario_base / 30) * $faltas;
		$mensagem .= "<br /><strong>Faltas:</strong> ".number_format($qtd_faltas,2,",",".");

		$dsr = $qtd_faltas / 6;
		$mensagem .= "<br /><strong>DSR sobre faltas (1/6):</strong> ".number_format($dsr,2,",",".");
	}
	if($valor_desconto > 0)
	{
		$mensagem .= "<br /><strong>Desconto Vale Transporte:</strong> ".number_format($valor_desconto,2,",",".");
	}
	if($adiantamento > 0)
	{
		$mensagem .= "<br /><strong>Adiantamento:</strong> ".number_format($adiantamento,2,",",".");
	}
	if($variaveis > 0)
	{
		$mensagem .= "<br /><strong>Outras vari&aacute;veis:</strong> ".number_format($variaveis,2,",",".");
	}
	
	$sql = mysql_query("SELECT * FROM aliquotas_inss");
	$reg = mysql_fetch_array($sql);
	
	$aliquota9 = explode("|",$reg['aliquota9']);
	$aliquota9_de = $aliquota9[0];
	$aliquota9_ate = $aliquota9[1];
	
	$aliquota11 = explode("|",$reg['aliquota11']);
	$aliquota11_de = $aliquota11[0];
	$aliquota11_ate = $aliquota11[1];
	
	///////// INSS //////////////
	if($tipoaviso == "indenizado")
		$saldoparainss = ((@$saldosalario + @$adicionalprop) - (@$dsr + @$qtd_faltas));
	else
	{
		$saldoparainss = ((@$valor_avisoprevioprovento + @$saldosalario + @$adicionalprop) - (@$dsr + @$qtd_faltas));
		
	}
	if($saldoparainss <= $reg['aliquota8'])
		$inss = ($saldoparainss * 8) / 100;
	else if($saldoparainss >= $aliquota9_de && $saldoparainss <= $aliquota9_ate)
		$inss = ($saldoparainss * 9) / 100;
	else if($saldoparainss >= $aliquota11_de && $saldoparainss <= $aliquota11_ate)
		$inss = ($saldoparainss * 11) / 100;
	
	$mensagem .= "<br /><br /><strong>INSS:</strong> ".number_format($inss,2,",",".");	
	
	///////// INSS 13o SALARIO   //////////////
	if($form['motivo'] != "Justa causa")
	{
		/*
		if($tipoaviso == "indenizado")
			$inss13 = 0;
		else
		{
		*/
			if($decimoterceiro <= $reg['aliquota8'])
				$inss13 = ($decimoterceiro * 8) / 100;
			else if($decimoterceiro >= $aliquota9_de && $decimoterceiro <= $aliquota9_ate)
				$inss13 = ($decimoterceiro * 9) / 100;
			else if($decimoterceiro >= $aliquota11_de && $decimoterceiro <= $aliquota11_ate)
				$inss13 = ($decimoterceiro * 11) / 100;
		//}
		
		$mensagem .= "<br /><strong>INSS sobre 13&deg; sal&aacute;rio:</strong> ".number_format($inss13,2,",",".");
	}
	else
		$inss13 = 0;
		
	///////// IRRF //////////////
	$sql = mysql_query("SELECT * FROM aliquotas_irpf");
	$reg = mysql_fetch_array($sql);
	
	$aliquota0 = explode("|",$reg['aliquota0']);
	$aliquota0_de = $aliquota0[0];
	$aliquota0_desconto = $aliquota0[1];
	
	$aliquota7_5 = explode("|",$reg['aliquota7_5']);
	$aliquota7_5_de = $aliquota7_5[0];
	$aliquota7_5_ate = $aliquota7_5[1];
	$aliquota7_5_desconto = $aliquota7_5[2];
	
	$aliquota15 = explode("|",$reg['aliquota15']);
	$aliquota15_de = $aliquota15[0];
	$aliquota15_ate = $aliquota15[1];
	$aliquota15_desconto = $aliquota15[2];
	
	$aliquota22_5 = explode("|",$reg['aliquota22_5']);
	$aliquota22_5_de = $aliquota22_5[0];
	$aliquota22_5_ate = $aliquota22_5[1];
	$aliquota22_5_desconto = $aliquota22_5[2];
	
	$aliquota27_5 = explode("|",$reg['aliquota27_5']);
	$aliquota27_5_de = $aliquota27_5[0];
	$aliquota27_5_desconto = $aliquota27_5[1];
	
	$saldoparairrf = $salario_base - $inss;
	if($saldoparairrf <= $aliquota0_de)
		$irrf = $aliquota0_desconto;
	else if($saldoparairrf >= $aliquota7_5_de && $saldoparairrf <= $aliquota7_5_ate)
		$irrf = (($saldoparairrf * 7.5) / 100) - $aliquota7_5_desconto;
	else if($saldoparainss >= $aliquota15_de && $saldoparairrf <= $aliquota15_ate)
		$irrf = (($saldoparairrf * 15) / 100) - $aliquota15_desconto;
	else if($saldoparainss >= $aliquota22_5_de  && $saldoparairrf <= $aliquota22_5_ate)
		$irrf = (($saldoparairrf * 22.5) / 100) - $aliquota22_5_desconto;
	else if($saldoparainss > $aliquota27_5_de)
		$irrf = (($saldoparairrf * 27.5) / 100) - $aliquota27_5_desconto;
	
	$mensagem .= "<br /><br /><strong>IRRF sal&aacute;rio:</strong> ".number_format($irrf,2,",",".");
	
	///////// IRRF 13o salario //////////////
	if($form['motivo'] != "Justa causa")
	{
		$saldoparairrf13 = $decimoterceiro - $inss13;
		if($saldoparairrf13 <= $aliquota0_de)
			$irrf13 = 0;
		else if($saldoparairrf13 >= $aliquota7_5_de && $saldoparairrf13 <= $aliquota7_5_ate)
			$irrf13 = (($saldoparairrf13 * 7.5) / 100) - $aliquota7_5_desconto;
		else if($saldoparairrf13 >= $aliquota15_de && $saldoparairrf13 <= $aliquota15_ate)
			$irrf13 = (($saldoparairrf13 * 15) / 100) - $aliquota15_desconto;
		else if($saldoparairrf13 >= $aliquota22_5_de  && $saldoparairrf13 <= $aliquota22_5_ate)
			$irrf13 = (($saldoparairrf13 * 22.5) / 100) - $aliquota22_5_desconto;
		else if($saldoparainss > $aliquota27_5_de)
			$irrf13 = (($saldoparairrf13 * 27.5) / 100) - $aliquota27_5_desconto;
	
		$mensagem .= "<br /><strong>IRRF 13&deg; sal&aacute;rio:</strong> ".number_format($irrf13,2,",",".");
	}
	else
		$irrf13 = 0;
	
	$total_descontos = @$valor_avisopreviodesconto + @$valor_desconto + @$adiantamento + @$variaveis + @$inss + @$inss13 + @$irrf + @$irrf13 + @$dsr + @$qtd_faltas + @$desc13;
	$mensagem .= "<br /><br /><br /><strong>TOTAL DESCONTOS:</strong> ".number_format($total_descontos,2,",",".");
	
	$mensagem .= "<br /><br /><hr />";
	$mensagem .= "<br /><strong>L&Iacute;QUIDO A RECEBER (R$):</strong> ".number_format(($total_proventos - $total_descontos),2,",",".");
	
	
	$msg = '<table cellpadding="10" cellspacing="0" width="100%" border="0">
			<tr><td width="20%">Nome da Empresa</td><td width="60%">'.utf8_decode(@$form["nome_empresa"]).'</td></tr>
			<tr><td>Nome do Funcion&aacute;rio:</td><td>'.utf8_decode(@$form["nome_funcionario"]).'</td></tr>
			<tr><td>C&oacute;digo de funcion&aacute;rio:</td><td>'.utf8_decode(@$form["codigo_funcionario"]).'</td></tr>
			<tr><td>Motivo:</td><td>'.utf8_decode(@$form["motivo"]).'</td></tr>
			<tr><td>Sal&aacute;rio Base (R$):</td><td>'.number_format($salario_base,2,",",".").'</td></tr>
			<tr><td>Adicional por Tempo de Servi&ccedil;o (R$):</td><td>'.number_format($adicional,2,",",".").'</td></tr>
			<tr><td>Insalubridade (R$):</td><td>'.number_format($insalubridade,2,",",".").'</td></tr>
			<tr><td>Periculosidade (R$):</td><td>'.number_format($periculosidade,2,",",".").'</td></tr>
			<tr><td>M&eacute;dia das Remunera&ccedil;&otilde;es Vari&aacute;veis (R$):</td><td>'.number_format($remuneracoes,2,",",".").'</td></tr>
			<tr><td>Aviso pr&eacute;vio:</td><td>'.utf8_decode(@$form["aviso"]).' ('.@$form['tipoaviso'].')</td></tr>
			<tr><td>Desconto Vale Transporte (R$):</td><td>'.number_format($valor_desconto,2,",",".").'</td></tr>
			<tr><td>Adiantamento (R$):</td><td>'.number_format($adiantamento,2,",",".").'</td></tr>
			<tr><td>Quantidades de Faltas:</td><td>'.$faltas.'</td></tr>
			<tr><td>Qtd de F&eacute;rias Gozadas:</td><td>'.$qtd_ferias.'</td></tr>
			<tr><td>O funcion&aacute;rio esteve afastado em um mesmo per&iacute;odo aquisitivo por mais de seis meses, sejam eles corridos ou descont&iacute;nuos, por motivo de acidente ou doen&ccedil;a?</td><td>'.utf8_decode(@$form["afastado"]).'</td></tr>';
			if(@$form["afastado"] == "sim")
			{
				$msg .= '<tr><td>Data do retorno ao trabalho:</td><td>'.utf8_decode(@$form["data_retorno"]).'</td></tr>';
			}

			$msg .= '<tr><td>Outras Vari&aacute;veis (R$):</td><td>'.number_format($variaveis,2,",",".").'</td></tr>
			<tr><td>A 1&ordf; parcela do 13&deg; Sal&aacute;rio j&aacute; foi paga?:</td><td>'.utf8_decode($form['parcela13_1']).'</td></tr>
			<tr><td>A 2&ordf; parcela do 13&deg; Sal&aacute;rio j&aacute; foi paga?:</td><td>'.utf8_decode($form['parcela13_2']).'</td></tr>
			<tr><td colspan="2"><hr /></td></tr>
			<tr><td colspan="2">'.$mensagem.'</td></tr>
			<tr><td colspan="2"><hr /></td></tr>
			</table>
			<table cellpadding="10" cellspacing="0" width="100%" border="0">
				<tr>
					<td width="20%"><a href="http://www.bvcontabilidade.com.br"><img width="140" src="http://www.bvcontabilidade.com.br/imagens/logo.png" border="0" /></a></td>
					<td>Travessa '.utf8_decode("Pirajá").', 1298 - sala 02, Marco<br />'.utf8_decode("Belém").', PA<br />CEP 66095-631<br />
					Telefone: (91) 3228.0364 - 3352.0200</td>
				</tr>
			</table>';
		
	echo $msg;
	/*
	//Create a new PHPMailer instance
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPDebug = 1;
	$mail->Port = 80; //Indica a porta de conexão para a saída de e-mails
	$mail->Host = 'smtpout.secureserver.net';//Endereço do Host do SMTP Locaweb
	$mail->SMTPAuth = true; //define se haverá ou não autenticação no SMTP
	$mail->Username = 'contatosite@bvcontabilidade.com.br'; //Login de autenticação do SMTP
	$mail->Password = 'bv159contabili'; //Senha de autenticação do SMTP
	//Set who the message is to be sent from
	$mail->setFrom("contato@bvcontabilidade.com.br", "BV Contabilidade");
	//Set an alternative reply-to address
	$mail->addReplyTo("contato@bvcontabilidade.com.br", "BV Contabilidade");
	//Set who the message is to be sent to
	
	//$mail->addAddress("contato@bvcontabilidade.com.br", 'BV Contabilidade');
	$mail->addAddress($form["emailenvio"]);
	
	//Set the subject line
	$mail->Subject = utf8_decode("Site BV Contabilidade - Simulação de Demissão - ".$form["nome_empresa"]);
	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	$mail->msgHTML($msg);
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
	*/
}

else if($op == "advertencia")
{
	$html = '<html>
			<head>
			</head>
			<body>
			<style>
			@font-face {
				font-family: "Zurich";
				src: url("../fonts/tt0296m-webfont.eot");
				src: url("../fonts/tt0296m-webfont.eot?#iefix") format("embedded-opentype"),
					 url("../fonts/tt0296m-webfont.woff") format("woff"),
					 url("../fonts/tt0296m-webfont.ttf") format("truetype"),
					 url("../fonts/tt0296m-webfont.svg#zurich_ltcn_btlight") format("svg");
				font-weight: normal;
				font-style: normal;
			
			}

body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	font-size: 10pt;
	color: #333;
	font-family: Arial;

}

#site_interno{
	width: 800px;
	height: auto;
	margin: 0 auto 0 auto;
	text-align: center;
}

#cabecalho{
	text-align: center;
	margin: 0 0 30px 0 ;
	clear: both;
	height: 100px;
}
#rodape{
	padding-top: 20px;
	font-size: 12px;
	line-height: 130%;
	width: 85%;
	text-align: center;
	border-top: 1px solid #DDD;
	position: absolute;
	margin-top: 260mm;
}
.texto{
	line-height: 130%;
	text-align: justify;
	padding-top: 30px;
	height: 800px;
}

			</style>
			<div id="rodape">Gerado em '.date("d/m/Y").' a partir do site www.bvcontabilidade.com.br</div>
			<div class="texto">	
				<h2 style="margin-bottom: 50px; text-align: center;">AVISO DE ADVERTÊNCIA DO EMPREGADO</h2>
				<p style="text-align: justify; text-transform: uppercase;"><strong>A(o) senhor(a):</strong> '.@$form["nome_funcionario"].'</p>
				<p style="text-align: justify;">Na Conformidade da  consolidação das leis do trabalho, fica advertido pelas faltas abaixo discriminadas:</p>
					<p style="text-align: justify;">'.str_replace("\n","<br />",@$form["motivo"]).'</p>
					<p style="text-align: justify;">Nós só esperamos que tome as necessárias providências a fim de que não se repitam as irregularidade acima discriminadas, como também aproveitamos para esclarecer-lhe que a repetição ou prática de outras irregularidades prevista em nossos regulamentos de ordens de serviços, comunicações, etc., irá contribuir desfavoravelmente em seu progresso nesta empresa, além de poder acarretar-lhe penalidades mais severas, conforme preceitua as disposições do artigo 482 e suas alíneas da consolidação das leis do trabalho.</p>
					<p style="text-align: justify;" style="margin-bottom:100px;"><strong>Atenciosamente,</strong></p>

				<table width="100%" style="font-family: Arial;font-size: 10pt; margin-bottom: 50px;">
					<tr><td colspan="2"><br /><br /></td></tr>
					<tr>
						<td align="center" valign="top">______________________________<br /><small>'.@$form["nome_empresa"].'</small></td>
						<td align="center" valign="top">______________________________<br /><small>'.@$form["nome_funcionario"].'</small></td>
					</tr>
				</table>
				<br />
				<p style="text-align: justify;">'.@$form["cidade"].', ____/____/________</p>
				</div>
				
			</body>
		</html>';
				
	$arquivo = date("d-m-Y-Hi")."_advertencia.pdf";
	$mpdf=new mPDF('','A4');
	$mpdf->WriteHTML($html);
	$mpdf->Output($arquivo,"f");
	
	
	$msg = '<table cellpadding="10" cellspacing="0" width="100%" border="0">
					<tr><td>'.utf8_decode("Fomulário em anexo.").'</td></tr>
			</table>
			<table cellpadding="10" cellspacing="0" width="100%" border="0">
				<tr>
					<td width="20%"><a href="http://www.bvcontabilidade.com.br"><img width="140" src="http://www.bvcontabilidade.com.br/imagens/logo.png" border="0" /></a></td>
					<td>Travessa '.utf8_decode("Pirajá").', 1298 - sala 02, Marco<br />'.utf8_decode("Belém").', PA<br />CEP 66095-631<br />
					Telefone: (91) 3228.0364 - 3352.0200</td>
				</tr>
			</table>';
			
	//Create a new PHPMailer instance
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPDebug = 1;
	$mail->Port = 80; //Indica a porta de conexão para a saída de e-mails
	$mail->Host = 'smtpout.secureserver.net';//Endereço do Host do SMTP Locaweb
	$mail->SMTPAuth = true; //define se haverá ou não autenticação no SMTP
	$mail->Username = 'contatosite@bvcontabilidade.com.br'; //Login de autenticação do SMTP
	$mail->Password = 'bv159contabili'; //Senha de autenticação do SMTP
	//Set who the message is to be sent from
	$mail->setFrom("contatosite@bvcontabilidade.com.br", 'BV Contabilidade');
	//Set an alternative reply-to address
	$mail->addReplyTo($form["email"]);
	//Set who the message is to be sent to
	$mail->addAddress($form["email"]);
	$mail->addAddress("contato@bvcontabilidade.com.br", 'BV Contabilidade');

	//Set the subject line
	$mail->Subject = utf8_decode("Site BV Contabilidade - Formulário de Advertência");
	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	$mail->msgHTML($msg);
	//Replace the plain text body with one created manually
	//$mail->AltBody = 'This is a plain-text message body';
	//Attach an image file
	$mail->addAttachment($arquivo);
	
	//send the message, check for errors
	if (!$mail->send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
		echo '<meta http-equiv="refresh" content="0; url=../index.php?pag=confirmacao">';
	}
	
}

else if($op == "avisoprevio")
{
	$numdias = $form['numdias'];
	switch($numdias)
	{
		case 2:
		$numdias = "2 (dois)";
		break;
		
		case 3:
		$numdias = "3 (três)";
		break;
		
		case 4:
		$numdias = "4 (quatro)";
		break;
		
		case 5:
		$numdias = "5 (cinco)";
		break;
		
		case 6:
		$numdias = "6 (seis)";
		break;
		
		case 7:
		$numdias = "7 (sete)";
		break;
		
		case 8:
		$numdias = "8 (oito)";
		break;
		
		case 9:
		$numdias = "9 (nove)";
		break;
		
		case 10:
		$numdias = "10 (dez)";
		break;	
		
		case "":
		$numdias = "7 (sete)";
		break;		
	}

	$mensagem = '<html>
			<head>
			</head>
			<body>
			<style>
			@font-face {
				font-family: "Zurich";
				src: url("../fonts/tt0296m-webfont.eot");
				src: url("../fonts/tt0296m-webfont.eot?#iefix") format("embedded-opentype"),
					 url("../fonts/tt0296m-webfont.woff") format("woff"),
					 url("../fonts/tt0296m-webfont.ttf") format("truetype"),
					 url("../fonts/tt0296m-webfont.svg#zurich_ltcn_btlight") format("svg");
				font-weight: normal;
				font-style: normal;
			
			}

body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	font-size: 10pt;
	color: #333;
	font-family: Arial;

}

#site_interno{
	width: 800px;
	height: auto;
	margin: 0 auto 0 auto;
	text-align: center;
}

#cabecalho{
	text-align: center;
	margin: 0 0 30px 0 ;
	clear: both;
	height: 100px;
}
#rodape{
	padding-top: 20px;
	font-size: 12px;
	line-height: 130%;
	width: 85%;
	text-align: center;
	border-top: 1px solid #DDD;
	position: absolute;
	margin-top: 260mm;
}
.texto{
	line-height: 130%;
	text-align: justify;
	padding-top: 30px;
	height: 800px;
}

			</style>
			<div id="rodape">Gerado em '.date("d/m/Y").' a partir do site www.bvcontabilidade.com.br</div>
			<div class="texto">			
			';



	$data_aviso = strtotime(str_replace("/","-",@$form["data_aviso"]));
   	$data_admissao = strtotime(str_replace("/","-",@$form["data_admissao"]));
	
	$data_dissidio = strtotime(str_replace("/","-",$form['data_dissidio']."-".date("Y")));

    $data_aviso2 = date("Y-m",strtotime(str_replace("/","-",@$form["data_aviso"])));
   	$data_admissao2 = date("Y-m",strtotime(str_replace("/","-",@$form["data_admissao"]))); 
	$data_dissidio2 = date("Y-m",@$data_dissidio); 
	
	$date = new DateTime( $data_admissao2 ); 
	$interval = $date->diff( new DateTime( $data_aviso2 ) );
	$num_anos = $interval->format( '%Y' );
	
	$date2 = new DateTime( $data_aviso2 ); 
	$interval = $date2->diff( new DateTime( $data_dissidio2 ) );
	$num_mes = $interval->format( '%m' );
	
	if($form['tipoaviso'] == "indenizado")
	{
		$aviso = "Indenizado";

		
		if(@$form['qtd_aviso'])
		{
			$total_diasaviso = @$form['qtd_aviso'];
		}
		else
		{
			$dias_aviso_base = 30;
			if($num_anos < 1)
				$total_diasaviso = 30;
			else if($num_anos > 20)
				$total_diasaviso = 90;
			else
				$total_diasaviso = (($num_anos) * 3) + $dias_aviso_base;

			if(@$form['motivo'] == "Iniciativa do empregado")
				$total_diasaviso = $dias_aviso_base;
			
		}
        
        $data_aviso = date("d/m/Y", strtotime("+".$total_diasaviso." days",$data_aviso));
		
		$mensagem .= '<h2 style="margin-bottom: 50px; text-align: center;">AVISO PRÉVIO INDENIZADO</h2>
                <p style="text-align: justify; text-transform: uppercase;"><strong>Empresa:</strong> '.@$form["nome_empresa"].'</p>
				<p style="text-align: justify; text-transform: uppercase;"><strong>A(o) senhor(a):</strong> '.@$form["nome_funcionario"].'</p>

				<p style="text-align: justify;">Pelo presente, notificamos a V.S.a que não serão mais utilizados os seus serviços, vimos por meio deste, rescindi-lo, na forma da legislação pertinente, devendo V.S.a cessar suas atividades em '.@$form["data_aviso"].'.</p>';
				$mensagem .= '<p style="text-align: justify;">Deverá V.S.a apresentar-se para o recebimento da importâncias que lhe são devidas e cumprimento das demais formalidades exigidas para cessação do contrato de trabalho, apresentando sua carteira de trabalho e do exame médico demissional para as devidas anotações.</p>';

				if($num_mes <= 1)
				{
					$mensagem .= '<p style="text-align: justify; margin-bottom: 50px;">Art 9&deg; - O empregado dispensado, sem justa causa, no período de 30 (trinta) dias que antecede a data de sua correção salarial, terá direito à indenização adicional equivalente a um salário mensal, seja ele optante ou não pelo Fundo de Garantia do Tempo de Serviço – FGTS (Lei nº 7.238 de 29 de Outubro de 1984).</p>';
				}
				
				$dadossind = explode("|",@$form['sindicato']);
				$dataav = strtotime(str_replace("/","-",@$form["data_aviso"]));
				$datasind = strtotime(str_replace("/","-",@$dadossind[0])."-".date("Y"));
				if(($dataav > $datasind) && $dadossind[1] == 30)
				{
					$mensagem .= '<p style="text-align: justify; margin-bottom: 50px;">GARANTIA DE EMPREGO: Fica assegurada a garantia de emprego, pelo prazo de 30 (Trinta) dias, a contar da data da assinatura da presente Convenção Coletiva de Trabalho aos empregados da categoria. Com exceção dos empregados que na data da assinatura do presente instrumento Coletivo já haviam assinado o aviso de dispensa trabalhado ou indenizado.</p>';
				}

				if($num_anos >= 1)
				{
					$mensagem .= '<p>Deve comparecer para acerto no Sindicato: '.@$form['data_sindicato'].'<br />
					Endere&ccedil;o: '.@$form['endereco_sindicato'].'</p>';
				}

				$mensagem .= '<p style="text-align: justify; margin-bottom:100px; text-transform: uppercase;"><strong>Solicitamos a devolução da cópia deste, com seu ciente.</strong></p>
				<table width="100%">
					<tr>
						<td align="center">Ciente em: '.@$form["data_aviso"].'</td>
						<td align="center" valign="bottom">_______________________________<br /><small>'.@$form["nome_empresa"].'</small></td>
					</tr>
					<tr><td colspan="2"><br /><br /></td></tr>
					<tr>
						<td align="center" valign="top">_______________________________<br /><small>'.@$form["nome_funcionario"].'</small></td>
						<td align="center" valign="top">_______________________________<br /><small>Assinatura do Responsável<br />(Quando Menor)</small></td>
					</tr>
				</table>';
				
	}
	else
	{
		$aviso = "Trabalhado";

        
		$dias_aviso_base = 30;
		if($num_anos < 1)
			$total_diasaviso = 30;
		else if($num_anos > 20)
			$total_diasaviso = 90;
		else
			$total_diasaviso = (($num_anos) * 3) + $dias_aviso_base;

		if(@$form['motivo'] == "Iniciativa do empregado")
				$total_diasaviso = $dias_aviso_base;
	
        
        $data_aviso = date("d/m/Y", strtotime("+".$total_diasaviso." days",$data_aviso));
        
		$mensagem .= '<h2 style="margin-bottom: 50px; text-align: center;">AVISO PRÉVIO TRABALHADO</h2>
				<p style="text-align: justify; text-transform: uppercase;"><strong>Empresa:</strong> '.@$form["nome_empresa"].'</p>
				<p style="text-align: justify; text-transform: uppercase;"><strong>A(o) senhor(a):</strong> '.@$form["nome_funcionario"].'</p>
				<p style="text-align: justify;">Pelo presente, notificamos a V.S.a que não serão mais utilizados os seus serviços, vimos por meio deste, rescindi-lo, na forma da legislação pertinente, devendo V.S.a cessar suas atividades em '.$data_aviso.'.</p>
				<p style="text-align: justify;">Ao término do prazo deste aviso, deverá V.S.a apresentar-se para o recebimento da importâncias que lhe são devidas e cumprimento das demais formalidades exigidas para cessação do contrato de trabalho, apresentando sua carteira de trabalho e do exame médico demissional para as devidas anotações.</p>';
				if($num_mes <= 1)
				{
					$mensagem .= '<p style="text-align: justify; margin-bottom: 50px;">Art 9&deg; - O empregado dispensado, sem justa causa, no período de 30 (trinta) dias que antecede a data de sua correção salarial, terá direito à indenização adicional equivalente a um salário mensal, seja ele optante ou não pelo Fundo de Garantia do Tempo de Serviço – FGTS (Lei nº 7.238 de 29 de Outubro de 1984).</p>';
				}

				$dadossind = explode("|",@$form['sindicato']);
				$dataav = strtotime(str_replace("/","-",@$form["data_aviso"]));
				$datasind = strtotime(str_replace("/","-",@$dadossind[0])."-".date("Y"));
				if(($dataav > $datasind) && $dadossind[1] == 30)
				{
					$mensagem .= '<p>GARANTIA DE EMPREGO: Fica assegurada a garantia de emprego, pelo prazo de 30 (Trinta) dias, a contar da data da assinatura da presente Convenção Coletiva de Trabalho aos empregados da categoria. Com exceção dos empregados que na data da assinatura do presente instrumento Coletivo já haviam assinado o aviso de dispensa trabalhado ou indenizado.</p>';
				}
				
				$mensagem .= '<p style="text-align: center; text-transform: uppercase;"><strong>Ciente da opção (Lei N&deg; 7093/83)</strong></p>
				<p style="text-align: justify;">Declaro-me ciente, exercendo a opção por:</p>
				<p style="text-align: justify;">(&nbsp;&nbsp;&nbsp;) redução de 2(duas) horas diárias</p>
				<p style="text-align: justify;">(&nbsp;&nbsp;&nbsp;) faltar os '.$numdias.' últimos dias corridos.</p>
				<p style="text-align: justify;margin-bottom:100px; margin-top: 50px; text-transform: uppercase;"><strong>Solicitamos a devolução da cópia deste, com seu ciente.</strong></p>
				<table width="100%">
					<tr>
						<td align="center">Ciente em: '.@$form["data_aviso"].'</td>
						<td align="center" valign="bottom">_______________________________<br /><small>'.@$form["nome_empresa"].'</small></td>
					</tr>
					<tr><td colspan="2"><br /><br /></td></tr>
					<tr>
						<td align="center" valign="top">_______________________________<br /><small>'.@$form["nome_funcionario"].'</small></td>
						<td align="center" valign="top">_______________________________<br /><small>Assinatura do Responsável<br />(Quando Menor)</small></td>
					</tr>
				</table>';
	}
			$mensagem .= '
				</div>
			</body>
		</html>';
	
	$arquivo = date("d-m-Y-Hi")."_aviso_previo_".$form['tipoaviso'].".pdf";
	$mpdf=new mPDF('','A4');
	$mpdf->WriteHTML($mensagem);
	$mpdf->Output($arquivo,"f");
	
	$msg = '<table cellpadding="10" cellspacing="0" width="100%" border="0">
					<tr><td>'.utf8_decode("Fomulário em anexo.").'</td></tr>
			</table>
			<table cellpadding="10" cellspacing="0" width="100%" border="0">
				<tr>
					<td width="20%"><a href="http://www.bvcontabilidade.com.br"><img width="140" src="http://www.bvcontabilidade.com.br/imagens/logo.png" border="0" /></a></td>
					<td>Travessa '.utf8_decode("Pirajá").', 1298 - sala 02, Marco<br />'.utf8_decode("Belém").', PA<br />CEP 66095-631<br />
					Telefone: (91) 3228.0364 - 3352.0200</td>
				</tr>
			</table>';
	
	//Create a new PHPMailer instance
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPDebug = 1;
	$mail->Port = 80; //Indica a porta de conexão para a saída de e-mails
	$mail->Host = 'smtpout.secureserver.net';//Endereço do Host do SMTP Locaweb
	$mail->SMTPAuth = true; //define se haverá ou não autenticação no SMTP
	$mail->Username = 'contatosite@bvcontabilidade.com.br'; //Login de autenticação do SMTP
	$mail->Password = 'bv159contabili'; //Senha de autenticação do SMTP
	//Set who the message is to be sent from
	$mail->setFrom("contatosite@bvcontabilidade.com.br", 'BV Contabilidade');
	//Set an alternative reply-to address
	$mail->addReplyTo($form["email"]);
	//Set who the message is to be sent to
	$mail->addAddress($form["email"]);
	$mail->addAddress("contato@bvcontabilidade.com.br", 'BV Contabilidade');

	//Set the subject line
	$mail->Subject = utf8_decode("Site BV Contabilidade - Aviso Prévio ".$aviso);
	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	$mail->msgHTML($msg);
	//Replace the plain text body with one created manually
	//$mail->AltBody = 'This is a plain-text message body';
	//Attach an image file
	$mail->addAttachment($arquivo);
	
	//send the message, check for errors
	if (!$mail->send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
		echo '<meta http-equiv="refresh" content="0; url=../index.php?pag=confirmacao">';
	}
	
}

else if($op == "ctps")
{
	$html = '<html>
			<head>
			</head>
			<body>
			<style>
			@font-face {
				font-family: "Zurich";
				src: url("../fonts/tt0296m-webfont.eot");
				src: url("../fonts/tt0296m-webfont.eot?#iefix") format("embedded-opentype"),
					 url("../fonts/tt0296m-webfont.woff") format("woff"),
					 url("../fonts/tt0296m-webfont.ttf") format("truetype"),
					 url("../fonts/tt0296m-webfont.svg#zurich_ltcn_btlight") format("svg");
				font-weight: normal;
				font-style: normal;
			
			}

body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	font-size: 10pt;
	color: #333;
	font-family: Arial;

}

#site_interno{
	width: 800px;
	height: auto;
	margin: 0 auto 0 auto;
	text-align: center;
}

#cabecalho{
	text-align: center;
	margin: 0 0 30px 0 ;
	clear: both;
	height: 100px;
}
#rodape{
	padding-top: 20px;
	font-size: 12px;
	line-height: 130%;
	width: 85%;
	text-align: center;
	border-top: 1px solid #DDD;
	position: absolute;
	margin-top: 260mm;
}
.texto{
	line-height: 130%;
	text-align: justify;
	padding-top: 0;
	height: 800px;
}

			</style>
			<div id="rodape">Gerado em '.date("d/m/Y").' a partir do site www.bvcontabilidade.com.br</div>
			<div class="texto">	
				<h2 style="margin-bottom: 50px; text-align: center; line-height: 25px;">RECIBO DE ENTREGA DA CARTEIRA DE TRABALHO<br />E PREVIDÊNCIA SOCIAL PARA ANOTAÇÕES</h2>
				<p style="text-align: justify;">Nome do empregado: <strong style="text-transform: uppercase;">'.@$form["nome_funcionario"].'</strong></p>
				<table width="100%" style="font-family: Arial;font-size: 10pt; margin-bottom: 50px;">
					<tr>
						<td valign="top" colspan="3">Carteira Profissional n&deg;: '.strtoupper(@$form["carteira"]).'</td>
					</tr>
					<tr><td colspan="3">&nbsp;</td></tr>
					<tr>
						<td valign="top">CBO: '.@$form["cbo"].'</td>
						<td valign="top" align="center">Função: '.@$form["funcao"].'</td>
						<td valign="top" align="right">Data de Admissão: '.@$form["data_admissao"].'</td>
					</tr>
				</table>
				
				<p>Recebemos a carteira de trabalho e previdência social acima, para as anotações necessárias e que será devolvida dentro de 48 horas, de acordo com as disposições legais vigentes.</p>
				<p style="text-align: justify;"><br />Local e Data: <span style="text-transform:capitalize;">'.@$form["cidade"].'</span>, ____/____/________</p>

				<table width="100%" style="font-family: Arial;font-size: 10pt; margin: 30px 0;">
					<tr>
						<td align="left" valign="top">______________________________<br />'.@$form["nome_empresa"].'</td>
					</tr>
				</table>
				<br />
				<div style="border: none; border-bottom: 1px dashed #000;">
					<img src="http://www.bvcontabilidade.com.br/imagens/tesoura.png" />
				</div>
				<br /><br />
				<h2 style="margin-bottom: 50px; text-align: center; line-height: 25px;">COMPROVANTE DE DEVOLUÇÃO DA CARTEIRA DE TRABALHO E PREVIDÊNCIA SOCIAL</h2>
				<p style="text-align: justify;">Nome do empregado: <strong style="text-transform: uppercase;">'.@$form["nome_funcionario"].'</strong></p>
				<table width="100%" style="font-family: Arial;font-size: 10pt; margin-bottom: 50px;">
					<tr>
						<td valign="top" colspan="3">Carteira Profissional n&deg;: '.strtoupper(@$form["carteira"]).'</td>
					</tr>
					<tr><td colspan="3">&nbsp;</td></tr>
					<tr>
						<td valign="top">CBO: '.@$form["cbo"].'</td>
						<td valign="top" align="center">Função: '.@$form["funcao"].'</td>
						<td valign="top" align="right">Data de Admissão: '.@$form["data_admissao"].'</td>
					</tr>
				</table>
				
				<p>Recebi em devolução a carteira de trabalho e previdência social acima, com as respectivas anotações.</p>
				<p style="text-align: justify;"><br />Local e Data: <span style="text-transform:capitalize;">'.@$form["cidade"].'</span>, ____/____/________</p>

				<table width="100%" style="font-family: Arial;font-size: 10pt; margin: 30px 0;">
					<tr>
						<td align="left" valign="top">______________________________<br />'.@$form["nome_funcionario"].'</td>
					</tr>
				</table>
			</div>
				
			</body>
		</html>';
				
	$arquivo = date("d-m-Y-Hi")."_recibo_entrega_CTPS.pdf";
	$mpdf=new mPDF('','A4');
	$mpdf->WriteHTML($html);
	$mpdf->Output($arquivo,"f");
	
	$msg = '<table cellpadding="10" cellspacing="0" width="100%" border="0">
					<tr><td>'.utf8_decode("Fomulário em anexo.").'</td></tr>
			</table>
			<table cellpadding="10" cellspacing="0" width="100%" border="0">
				<tr>
					<td width="20%"><a href="http://www.bvcontabilidade.com.br"><img width="140" src="http://www.bvcontabilidade.com.br/imagens/logo.png" border="0" /></a></td>
					<td>Travessa '.utf8_decode("Pirajá").', 1298 - sala 02, Marco<br />'.utf8_decode("Belém").', PA<br />CEP 66095-631<br />
					Telefone: (91) 3228.0364 - 3352.0200</td>
				</tr>
			</table>';
			
	//Create a new PHPMailer instance
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPDebug = 1;
	$mail->Port = 80; //Indica a porta de conexão para a saída de e-mails
	$mail->Host = 'smtpout.secureserver.net';//Endereço do Host do SMTP Locaweb
	$mail->SMTPAuth = true; //define se haverá ou não autenticação no SMTP
	$mail->Username = 'contatosite@bvcontabilidade.com.br'; //Login de autenticação do SMTP
	$mail->Password = 'bv159contabili'; //Senha de autenticação do SMTP
	//Set who the message is to be sent from
	$mail->setFrom("contatosite@bvcontabilidade.com.br", 'BV Contabilidade');
	//Set an alternative reply-to address
	$mail->addReplyTo($form["email"]);
	//Set who the message is to be sent to
	$mail->addAddress($form["email"]);
	$mail->addAddress("contato@bvcontabilidade.com.br", 'BV Contabilidade');

	//Set the subject line
	$mail->Subject = utf8_decode("Site BV Contabilidade - Recibo de Entrega de CTPS");
	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	$mail->msgHTML($msg);
	//Replace the plain text body with one created manually
	//$mail->AltBody = 'This is a plain-text message body';
	//Attach an image file
	$mail->addAttachment($arquivo);
	
	//send the message, check for errors
	if (!$mail->send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
		echo '<meta http-equiv="refresh" content="0; url=../index.php?pag=confirmacao">';
	}
}

else if($op == "aditivo")
{
	$html = '<html>
			<head>
			</head>
			<body>
			<style>
			@font-face {
				font-family: "Zurich";
				src: url("../fonts/tt0296m-webfont.eot");
				src: url("../fonts/tt0296m-webfont.eot?#iefix") format("embedded-opentype"),
					 url("../fonts/tt0296m-webfont.woff") format("woff"),
					 url("../fonts/tt0296m-webfont.ttf") format("truetype"),
					 url("../fonts/tt0296m-webfont.svg#zurich_ltcn_btlight") format("svg");
				font-weight: normal;
				font-style: normal;
			
			}

body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	font-size: 10pt;
	color: #333;
	font-family: Arial;

}

#site_interno{
	width: 800px;
	height: auto;
	margin: 0 auto 0 auto;
	text-align: center;
}

#cabecalho{
	text-align: center;
	margin: 0 0 30px 0 ;
	clear: both;
	height: 100px;
}
#rodape{
	padding-top: 20px;
	font-size: 12px;
	line-height: 130%;
	width: 85%;
	text-align: center;
	border-top: 1px solid #DDD;
	position: absolute;
	margin-top: 260mm;
}
.texto{
	line-height: 130%;
	text-align: justify;
	padding-top: 0;
	height: 800px;
}

			</style>
			<div id="rodape">Gerado em '.date("d/m/Y").' a partir do site www.bvcontabilidade.com.br</div>
			<div class="texto">	
				<h2 style="margin-bottom: 50px; text-align: center; line-height: 25px;">TERMO ADITIVO AO CONTRATO DE TRABALHO</h2>
				<p style="text-align: justify;"><span style="text-transform: uppercase;">'.$form['nome_empresa'].'</span>, empresa estabelecida na '.$form['endereco_emp'].', '.$form['numero_emp'].', '.$form['bairro_emp'].', ';
				if($form['complemento_emp']) 
					$html .= $form['complemento_emp'].", ";
				$html .= 'CEP: '.$form['cep_emp'].', '.$form['cidade_emp'].' - '.$form['estado_emp'].', inscrita no CNPJ sob o nº '.$form['cnpj'].', doravante denominada EMPREGADORA, e, de outro lado, '.$form['nome_funcionario'].', titular da CTPS No '.$form['carteira'].', '.$form['nacionalidade'].', natural de <span style="text-transform:capitalize;">'.$form['natural'].'</span>, '.$form['estado_civil'].', residente e domiciliado em '.$form['endereco'].', '.$form['numero'].', '.$form['bairro'].', ';
				if($form['complemento'])
					$html .= $form['complemento'].", ";
				$html .= 'CEP: '.$form['cep'].', '.$form['cidade'].' - '.$form['estado'].', doravante denominado(a) EMPREGADO, têm como justo e acertado o presente termo aditivo ao contrato de trabalho:</p>
				
				<br />
				<p style="text-align: justify;">Cláusula Primeira: Por mútuo acordo entre as partes, o horário de trabalho do(a) funcionário(a) acima qualificado(a), '.$form['infomacoes_atual'].'.</p>

				<p style="text-align: justify;">Alterado para '.$form['infomacoes_novo'].'.</p>
				<br />
				<p style="text-align: justify;">Cláusula Segunda: O contrato de trabalho fica ratificado em todos os seus termos, cláusula se condições não expressamente alteradas por este documento, que àquele se integra, formando um todo, único e indivisível para todos os efeitos legais.

				<p style="text-align: justify;">Assinado por ambas as partes em duas vias de igual teor, na presença das testemunhas abaixo assinadas.</p>
				<br /><br />
				<p style="text-align: justify;text-transform:capitalize;">'.@$form["local"].', '. @$form["data"].'</p>
				<br />
				<p>_________________________________<br />Assinatura do empregado</p>
				<br />
				<p>_________________________________<br />Assinatura do empregador</p>
				<br /><br />
				Testemunhas:<br />
				<p>1) ______________________________<br /></p>
				<p>2) ______________________________<br /></p>
			</div>
				
			</body>
		</html>';
				
	$arquivo = date("d-m-Y-Hi")."_termo_aditivo_contrato_trabalho.pdf";
	$mpdf=new mPDF('','A4');
	$mpdf->WriteHTML($html);
	$mpdf->Output($arquivo,"f");
	
	$msg = '<table cellpadding="10" cellspacing="0" width="100%" border="0">
					<tr><td>'.utf8_decode("Fomulário em anexo.").'</td></tr>
			</table>
			<table cellpadding="10" cellspacing="0" width="100%" border="0">
				<tr>
					<td width="20%"><a href="http://www.bvcontabilidade.com.br"><img width="140" src="http://www.bvcontabilidade.com.br/imagens/logo.png" border="0" /></a></td>
					<td>Travessa '.utf8_decode("Pirajá").', 1298 - sala 02, Marco<br />'.utf8_decode("Belém").', PA<br />CEP 66095-631<br />
					Telefone: (91) 3228.0364 - 3352.0200</td>
				</tr>
			</table>';
	
	//Create a new PHPMailer instance
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPDebug = 1;
	$mail->Port = 80; //Indica a porta de conexão para a saída de e-mails
	$mail->Host = 'smtpout.secureserver.net';//Endereço do Host do SMTP Locaweb
	$mail->SMTPAuth = true; //define se haverá ou não autenticação no SMTP
	$mail->Username = 'contatosite@bvcontabilidade.com.br'; //Login de autenticação do SMTP
	$mail->Password = 'bv159contabili'; //Senha de autenticação do SMTP
	//Set who the message is to be sent from
	$mail->setFrom("contatosite@bvcontabilidade.com.br", 'BV Contabilidade');
	//Set an alternative reply-to address
	$mail->addReplyTo($form["email"]);
	//Set who the message is to be sent to
	$mail->addAddress($form["email"]);
	$mail->addAddress("contato@bvcontabilidade.com.br", 'BV Contabilidade');

	//Set the subject line
	$mail->Subject = utf8_decode("Site BV Contabilidade - Termo Aditivo ao Contrato de Trabalho");
	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	$mail->msgHTML($msg);
	//Replace the plain text body with one created manually
	//$mail->AltBody = 'This is a plain-text message body';
	//Attach an image file
	$mail->addAttachment($arquivo);
	
	//send the message, check for errors
	if (!$mail->send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
		echo '<meta http-equiv="refresh" content="0; url=../index.php?pag=confirmacao">';
	}
}

else if($op == "dut")
{
	$html = '<html>
			<head>
			</head>
			<body>
			<style>
			@font-face {
				font-family: "Zurich";
				src: url("../fonts/tt0296m-webfont.eot");
				src: url("../fonts/tt0296m-webfont.eot?#iefix") format("embedded-opentype"),
					 url("../fonts/tt0296m-webfont.woff") format("woff"),
					 url("../fonts/tt0296m-webfont.ttf") format("truetype"),
					 url("../fonts/tt0296m-webfont.svg#zurich_ltcn_btlight") format("svg");
				font-weight: normal;
				font-style: normal;
			
			}

body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	font-size: 10pt;
	color: #333;
	font-family: Arial;

}

#site_interno{
	width: 800px;
	height: auto;
	margin: 0 auto 0 auto;
	text-align: center;
}

#cabecalho{
	text-align: center;
	margin: 0 0 30px 0 ;
	clear: both;
	height: 100px;
}
#rodape{
	padding-top: 20px;
	font-size: 12px;
	line-height: 130%;
	width: 85%;
	text-align: center;
	border-top: 1px solid #DDD;
	position: absolute;
	margin-top: 260mm;
}
.texto{
	line-height: 130%;
	text-align: justify;
	padding-top: 0;
	height: 800px;
}

			</style>
			<div id="rodape">Gerado em '.date("d/m/Y").' a partir do site www.bvcontabilidade.com.br</div>
			<div class="texto">	
				<h2 style="margin-bottom: 50px; text-align: center; line-height: 25px;">DOCUMENTO DE ÚLTIMO DIA TRABALHADO</h2>
				<p align="center"><strong>Dados do Requerimento</strong></p>
				<table width="100%" padding="15" style="font-family: Arial;font-size: 10pt;">
					<tr><td width="15%">Nome:</td><td>'.$form['nome_empresa'].'</td></tr>
					<tr><td>PIS:</td><td>'.$form['pis'].'</td></tr>
					<tr><td>CEP:</td><td>'.$form['cep'].'</td></tr>
					<tr><td>Endere&ccedil;o:</td><td>'.$form['endereco'].", ".$form['numero'].' '.@$form['complemento'].'</td></tr>
					<tr><td>Bairro:</td><td>'.$form['bairro'].'</td></tr>
					<tr><td>Cidade:</td><td>'.$form['cidade'].'</td></tr>
					<tr><td>Estado:</td><td>'.$form['estado'].'</td></tr>
					<tr><td>CNPJ:</td><td>'.$form['cnpj'].'</td></tr>
					<tr><td valign="top">Data do último dia de trabalho:</td><td>'.$form['data'].'</td></tr>
				</table>
				<br />
				<p align="center"><strong>Termo de Responsabilidade</strong></p>
				<p style="text-align: justify;">Confirmo a data do último dia de trabalho informada:</p>
				<br /><br />
				<p style="text-align: center;">_________________________________<br /><small>Carimbo e assinatura do responsável da empresa</small></p>
				<br /><br />
				<p style="text-align: justify;">Responsabilizo-me sob as penas da lei pela veracidade das informações prestadas.</p>
				<br /><br />
				<p style="text-align: center;">_________________________________<br /><small>Assinatura</small></p>
				<br /><br />
				<p style="text-align: justify;">Data: ____/____/________</p>

			</div>
				
			</body>
		</html>';
				
	$arquivo = date("d-m-Y-Hi")."_documento_ultimo_dia_trabalhado.pdf";
	$mpdf=new mPDF('','A4');
	$mpdf->WriteHTML($html);
	$mpdf->Output($arquivo,"f");
	
	$msg = '<table cellpadding="10" cellspacing="0" width="100%" border="0">
					<tr><td>'.utf8_decode("Fomulário em anexo.").'</td></tr>
			</table>
			<table cellpadding="10" cellspacing="0" width="100%" border="0">
				<tr>
					<td width="20%"><a href="http://www.bvcontabilidade.com.br"><img width="140" src="http://www.bvcontabilidade.com.br/imagens/logo.png" border="0" /></a></td>
					<td>Travessa '.utf8_decode("Pirajá").', 1298 - sala 02, Marco<br />'.utf8_decode("Belém").', PA<br />CEP 66095-631<br />
					Telefone: (91) 3228.0364 - 3352.0200</td>
				</tr>
			</table>';
	
	//Create a new PHPMailer instance
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPDebug = 1;
	$mail->Port = 80; //Indica a porta de conexão para a saída de e-mails
	$mail->Host = 'smtpout.secureserver.net';//Endereço do Host do SMTP Locaweb
	$mail->SMTPAuth = true; //define se haverá ou não autenticação no SMTP
	$mail->Username = 'contatosite@bvcontabilidade.com.br'; //Login de autenticação do SMTP
	$mail->Password = 'bv159contabili'; //Senha de autenticação do SMTP
	//Set who the message is to be sent from
	$mail->setFrom("contatosite@bvcontabilidade.com.br", 'BV Contabilidade');
	//Set an alternative reply-to address
	$mail->addReplyTo($form["email"]);
	//Set who the message is to be sent to
	$mail->addAddress($form["email"]);
	$mail->addAddress("contato@bvcontabilidade.com.br", 'BV Contabilidade');
	//$mail->addAddress("nos7manjibr@gmail.com", 'BV Contabilidade');

	//Set the subject line
	$mail->Subject = utf8_decode("Site BV Contabilidade - DUT");
	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	$mail->msgHTML($msg);
	//Replace the plain text body with one created manually
	//$mail->AltBody = 'This is a plain-text message body';
	//Attach an image file
	$mail->addAttachment($arquivo);
	
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
			<tr><td width="20%">Nome</td><td width="60%">'.utf8_decode(@$form["nome"]).'</td></tr>
			<tr><td>E-mail:</td><td>'.@$form["email"].'</td></tr>
			<tr><td>Telefone:</td><td>'.@$form["telefone"].'</td></tr>
			<tr><td>Mensagem:</td><td>'.utf8_decode(@$form["mensagem"]).'</td></tr>
			</table>';
			
	//Create a new PHPMailer instance
	$mail = new PHPMailer();
	//Set who the message is to be sent from
	$mail->setFrom($form["email"], $form["nome"]);
	//Set an alternative reply-to address
	$mail->addReplyTo($form["email"], $form["nome"]);
	//Set who the message is to be sent to
	$mail->addAddress("contato@bvcontabilidade.com.br", 'BV Contabilidade');
	$mail->addAddress("bruno@bvcontabilidade.com.br", 'Bruno');
	$mail->addAddress("joao@bvcontabilidade.com.br", 'Joao');
	$mail->addAddress("sara@bvcontabilidade.com.br", 'Sara');
	$mail->addAddress("tamires@bvcontabilidade.com.br", 'Tamires');
	$mail->addAddress("leticia@bvcontabilidade.com.br", 'Leticia');

	//Set the subject line
	$mail->Subject = "Site BV Contabilidade - ".utf8_decode($form["assunto"]);
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

		if($retorno)
		{
			echo '<meta http-equiv="refresh" content="0; url=../domestico/index.php?pag=fale-conosco&msg=ok">';
		}
		else
			echo '<meta http-equiv="refresh" content="0; url=../index.php?pag=confirmacao">';
	}


}

else if($op == "dispensa")
{
	$mensagem = '<html>
			<head>
			</head>
			<body>
			<style>
			@font-face {
				font-family: "Zurich";
				src: url("../fonts/tt0296m-webfont.eot");
				src: url("../fonts/tt0296m-webfont.eot?#iefix") format("embedded-opentype"),
					 url("../fonts/tt0296m-webfont.woff") format("woff"),
					 url("../fonts/tt0296m-webfont.ttf") format("truetype"),
					 url("../fonts/tt0296m-webfont.svg#zurich_ltcn_btlight") format("svg");
				font-weight: normal;
				font-style: normal;
			
			}

body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	font-size: 10pt;
	color: #333;
	font-family: Arial;

}

#site_interno{
	width: 800px;
	height: auto;
	margin: 0 auto 0 auto;
	text-align: center;
}

#cabecalho{
	text-align: center;
	margin: 0 0 30px 0 ;
	clear: both;
	height: 100px;
}
#rodape{
	padding-top: 20px;
	font-size: 12px;
	line-height: 130%;
	width: 85%;
	text-align: center;
	border-top: 1px solid #DDD;
	position: absolute;
	margin-top: 260mm;
}
.texto{
	line-height: 130%;
	text-align: justify;
	padding-top: 30px;
	height: 800px;
}

			</style>
			<div id="rodape">Gerado em '.date("d/m/Y").' a partir do site www.bvcontabilidade.com.br</div>
			<div class="texto">			
			';
		
		$data_aviso = strtotime(str_replace("/","-",@$form["data_aviso"]));
		$data_admissao = strtotime(str_replace("/","-",@$form["data_admissao"]));
	
		$data_aviso2 = date("Y-m-d",strtotime(str_replace("/","-",@$form["data_aviso"])));
		$data_admissao2 = date("Y-m-d",strtotime(str_replace("/","-",@$form["data_admissao"])));                       
	
		$date = new DateTime( $data_admissao2 ); 
		$interval = $date->diff( new DateTime( $data_aviso2 ) );
		$num_anos = $interval->format( '%Y' );
            
        
        $data_aviso = date("d/m/Y", strtotime("+".$total_diasaviso." days",$data_aviso));
		
		$mensagem .= '<h2 style="margin-bottom: 50px; text-align: center;">COMUNICADO DE DISPENSA</h2>
				<p style="text-align: justify; text-transform: uppercase;"><strong>A(o) senhor(a):</strong> '.@$form["nome_funcionario"].'</p>

				<p style="text-align: justify;">Pelo presente, notificamos a V.S.a que não serão mais utilizados os seus serviços, vimos por meio deste, rescindi-lo, na forma da legislação pertinente, devendo V.S.a cessar suas atividades em '.@$form["data_aviso"].'.</p>
				<p style="text-align: justify; margin-bottom: 50px;">Ao término do prazo deste aviso, deverá V.S.a apresentar-se para o recebimento da importâncias que lhe são devidas e cumprimento das demais formalidades exigidas para cessação do contrato de trabalho, apresentando sua carteira de trabalho e do exame médico demissional para as devidas anotações.</p>';
				
				if($num_anos >= 1)
				{
					$mensagem .= '<p>Deve comparecer para acerto no Sindicato: '.@$form['data_sindicato'].'<br />
					Endere&ccedil;o: '.@$form['endereco_sindicato'].'</p>';
				}

				$mensagem .= '<p style="text-align: justify; margin-bottom:100px; text-transform: uppercase;"><strong>Solicitamos a devolução da cópia deste, com seu ciente.</strong></p>
				<table width="100%">
					<tr>
						<td align="center">Ciente em: '.@$form["data_aviso"].'</td>
						<td align="center" valign="bottom">_______________________________<br /><small>'.@$form["nome_empresa"].'</small></td>
					</tr>
					<tr><td colspan="2"><br /><br /></td></tr>
					<tr>
						<td align="center" valign="top">_______________________________<br /><small>'.@$form["nome_funcionario"].'</small></td>
						<td align="center" valign="top">_______________________________<br /><small>Assinatura do Responsável<br />(Quando Menor)</small></td>
					</tr>
				</table>';
				
			$mensagem .= '
				</div>
			</body>
		</html>';
		
	$arquivo = date("d-m-Y-Hi")."_comunicado_dispensa_".$form['tipoaviso'].".pdf";
	$mpdf=new mPDF('','A4');
	$mpdf->WriteHTML($mensagem);
	$mpdf->Output($arquivo,"f");
	
	$msg = '<table cellpadding="10" cellspacing="0" width="100%" border="0">
					<tr><td>'.utf8_decode("Fomulário em anexo.").'</td></tr>
			</table>
			<table cellpadding="10" cellspacing="0" width="100%" border="0">
				<tr>
					<td width="20%"><a href="http://www.bvcontabilidade.com.br"><img width="140" src="http://www.bvcontabilidade.com.br/imagens/logo.png" border="0" /></a></td>
					<td>Travessa '.utf8_decode("Pirajá").', 1298 - sala 02, Marco<br />'.utf8_decode("Belém").', PA<br />CEP 66095-631<br />
					Telefone: (91) 3228.0364 - 3352.0200</td>
				</tr>
			</table>';
	
	//Create a new PHPMailer instance
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPDebug = 1;
	$mail->Port = 80; //Indica a porta de conexão para a saída de e-mails
	$mail->Host = 'smtpout.secureserver.net';//Endereço do Host do SMTP Locaweb
	$mail->SMTPAuth = true; //define se haverá ou não autenticação no SMTP
	$mail->Username = 'contatosite@bvcontabilidade.com.br'; //Login de autenticação do SMTP
	$mail->Password = 'bv159contabili'; //Senha de autenticação do SMTP
	//Set who the message is to be sent from
	$mail->setFrom("contatosite@bvcontabilidade.com.br", 'BV Contabilidade');
	//Set an alternative reply-to address
	$mail->addReplyTo($form["email"]);
	//Set who the message is to be sent to
	$mail->addAddress($form["email"]);
	$mail->addAddress("contato@bvcontabilidade.com.br", 'BV Contabilidade');
	//$mail->addAddress("nos7manjibr@gmail.com", 'BV Contabilidade');

	//Set the subject line
	$mail->Subject = utf8_decode("Site BV Contabilidade - Comunicado de Dispensa");
	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	$mail->msgHTML($msg);
	//Replace the plain text body with one created manually
	//$mail->AltBody = 'This is a plain-text message body';
	//Attach an image file
	$mail->addAttachment($arquivo);
	
	//send the message, check for errors
	if (!$mail->send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
		echo '<meta http-equiv="refresh" content="0; url=../index.php?pag=confirmacao">';
	}

}

else if($op == "calcextra")
{
	//echo "<pre>";
	//print_r($form);
	//echo "</pre>";
	
	$data_de = date("Y-m-d",strtotime(str_replace("/","-",$form['data_de'])));
	$data_ate = date("Y-m-d",strtotime(str_replace("/","-",$form['data_ate'])));
	$diasemana = array("DOM","SEG","TER","QUA","QUI","SEX","SAB");
	$linha = 0;
	$mesinicio = date("m", strtotime($data_de));
	$mesfim = date("m", strtotime($data_ate));
	
	function m2h($totalhoras) {
			$menos = "";
			if(preg_match('/-/',$totalhoras))
				$menos = "-";
		
			$totalhoras = str_replace("-","",$totalhoras);
			$hora = floor($totalhoras/60);
			if($hora < 10)
				$hora = "0".$hora;
			$resto = $totalhoras%60;
			if($resto < 10)
				$resto = "0".$resto;
			return $menos.$hora.':'.$resto;
	}
		
	$totalhoras = 0;
	$totaladicional = 0;
	$totalfaltas = 0;
	$totalferiadostrab = 0;
	$totalferiados = 0;
	$totalfolgas = 0;
					
					//echo "<pre>";
					//print_r($form);
					//echo "</pre>";
	$html = '<html>
			<head>
			</head>
			<body>
			<style>


body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	font-size: 10pt;
	color: #333;
	font-family: Arial;

}

.tblhoras{
	 font-size: 10pt !important;
	color: #333;
	font-family: Arial;
	border: 1px solid #000;
}
.tblhoras td{
	border-bottom: 1px solid #CCC;
}

#site_interno{
	width: 800px;
	height: auto;
	margin: 0 auto 0 auto;
	text-align: center;
}

#cabecalho{
	text-align: center;
	margin: 0 0 30px 0 ;
	clear: both;
	height: 100px;
}
#rodape{
	padding-top: 20px;
	font-size: 12px;
	line-height: 130%;
	width: 85%;
	text-align: center;
	border-top: 1px solid #DDD;
	position: absolute;
	margin-top: 240mm;
}
.texto{
	line-height: 130%;
	text-align: justify;
	padding-top: 0;
	height: 800px;
}

			</style>

			<div class="texto">	
				<h2 style="margin-bottom: 10px; text-align: center; line-height: 20px;">Hora Extra</h2>
				<table width="100%" padding="15" style="font-family: Arial;font-size: 10pt;">
					<tr><td>Empresa: '.$form['razao_social'].'</td><td>'.strtoupper($form['doc']).': '.$form['cnpj'].'</td><td>Período: '.$form['data_de'].' a '.$form['data_ate'].'</td></tr>
					<tr><td colspan="3">Endereço: '.$form['endereco'].", ".$form['numero'].' '.@$form['complemento'].', '.$form['bairro'].' - '.$form['cidade'].', '.$form['estado'].' - '.$form['cep'].'</td></tr>
					<tr><td>Funcionário: '.$form['nome_funcionario'].'</td><td colspan="2">Cargo: '.$form['cargo'].'</td></tr>
				</table>	
				<table cellpadding="10" cellspacing="0" width="100%">
        <tr>
        	<td colspan="2">
            	<table class="tblhoras" cellpadding="5" cellspacing="0" width="100%">
                	<tr>
                    	<th style="border-right: 1px solid #333;" align="center">DIA</th>
                    	<th style="border-right: 1px solid #333;">CARGA HORÁRIA</th>
                    	<th style="border-right: 1px solid #333;" align="center" colspan="2">HOR&Aacute;RIO: &nbsp;1&deg; TURNO</th>
                        <th style="border-right: 1px solid #333;" align="center" colspan="2">HOR&Aacute;RIO: &nbsp;2&deg; TURNO</th>
                        <th style="border-right: 1px solid #333;" align="center" colspan="2">HORA EXTRA</th>
                        <th style="border-right: 1px solid #333;" align="center">SALDO</th>
						<th style="border-right: 1px solid #333;" align="center" width="5%">ADICIONAL NOTURNO</th>
                        <th align="center">OBSERVA&Ccedil;&Otilde;ES</th>
                    </tr>
                    <tr>
						<td style="border-right: 1px solid #333;"></td>
						<td style="border-right: 1px solid #333;"></td>
                    	<td align="center" style="border-right: 1px solid #333;">Entrada</td>
                        <td align="center" style="border-right: 1px solid #333;">Sa&iacute;da</td>
                        <td align="center" style="border-right: 1px solid #333;">Entrada</td>
                        <td align="center" style="border-right: 1px solid #333;">Sa&iacute;da</td>
                        <td align="center" style="border-right: 1px solid #333;">Entrada</td>
                        <td align="center" style="border-right: 1px solid #333;">Sa&iacute;da</td>
                        <td style="border-right: 1px solid #333;" align="center">Horas</td>
						<td style="border-right: 1px solid #333;" align="center">Horas</td>
						<td></td>
                    </tr>';
					
					$data_de = date("Y-m-d",strtotime(str_replace("/","-",$form['data_de'])));
					$data_ate = date("Y-m-d",strtotime(str_replace("/","-",$form['data_ate'])));
					$diasemana = array("DOM","SEG","TER","QUA","QUI","SEX","SAB");
					$linha = 0;
					$mesinicio = date("m", strtotime($data_de));
					$mesfim = date("m", strtotime($data_ate));
					
						
					$totalhoras = 0;
					$totaladicional = 0;
					$totalfaltas = 0;
					$totalferiadostrab = 0;
					$totalferiados = 0;
					$totalfolgas = 0;
					
					foreach($form['entrada_1'] as $indice => $entrada_1)
					{
						if($form['tipo'][$indice] == "Falta")
						{
							$form['tipo'][$indice] = $form['tipo'][$indice];
							$totalfaltas++;
						}
						else if($form['tipo'][$indice] == "Feriado_BH")
						{
							$form['tipo'][$indice] = str_replace("_"," ",$form['tipo'][$indice]);
							$totalferiados++;
						}
						//else if($form['tipo'][$indice] == "Dia de folga" || preg_match("/DOM/",$form['dia'][$indice]))
						else if($form['tipo'][$indice] == "Dia de folga")
							$totalfolgas++;
						else if($form['tipo'][$indice] == "Feriado_PG")
						{
							$form['tipo'][$indice] = str_replace("_"," ",$form['tipo'][$indice]);
							$totalferiadostrab++;
						}
						
						
						if($entrada_1 == "" || $form['tipo'][$indice] == "Falta")
							$entrada_1 = "--:--";
						if($form['carga_horaria'][$indice] == "" || $form['tipo'][$indice] == "Falta")
							$form['carga_horaria'][$indice] = "--:--";
						if($form['saida_1'][$indice] == "" || $form['tipo'][$indice] == "Falta")
							$form['saida_1'][$indice] = "--:--";
						if($form['entrada_2'][$indice] == "" || $form['tipo'][$indice] == "Falta")
							$form['entrada_2'][$indice] = "--:--";
						if($form['saida_2'][$indice] == "" || $form['tipo'][$indice] == "Falta")
							$form['saida_2'][$indice] = "--:--";
						if($form['entrada_he'][$indice] == "" || $form['tipo'][$indice] == "Falta")
							$form['entrada_he'][$indice] = "--:--";
						if($form['saida_he'][$indice] == "" || $form['tipo'][$indice] == "Falta")
							$form['saida_he'][$indice] = "--:--";
						if($form['total_he'][$indice] == "" || $form['tipo'][$indice] == "Falta")
							$form['total_he'][$indice] = "00:00";
						else
						{

							if(preg_match('/-/',$form['total_he'][$indice]))
							{
								$tempo = explode(":",$form['total_he'][$indice]);
								$minutos_neg = str_replace("-","",$tempo[0]);

								$minutos_neg = $minutos_neg*60;
								$minutos_neg = $minutos_neg + $tempo[1];
								$minutos_neg = "-$minutos_neg";
								
								$totalhoras = $totalhoras + $minutos_neg;
							}
							else
							{
								$tempo = explode(":",$form['total_he'][$indice]);
								$minutos = $tempo[0];

								$minutos = $minutos*60;
								$minutos = $minutos + $tempo[1];
								
								$totalhoras = $totalhoras + $minutos;
							}
						}
						
						if($form['total_ad'][$indice] == "")
							$form['total_ad'][$indice] = "00:00";
						else
						{
							$tempo = explode(":",$form['total_ad'][$indice]);
							$minutos = $tempo[0];

							$minutos = $minutos*60;
							$minutos = $minutos + $tempo[1];
							
							$totaladicional = $totaladicional + $minutos;
						}
						
						$totalhorasadicionalt = m2h($totaladicional);
						$totalhorast = m2h($totalhoras); 
							
						$html .= '
						<tr>
							<td style="border-right: 1px solid #333;" align="left">'.str_replace("-"," ",$form['dia'][$indice]).'</td>
							<td style="border-right: 1px solid #333;" align="center">'.$form['carga_horaria'][$indice].'</td>
							<td style="border-right: 1px solid #333;" align="center">'.$entrada_1.'</td>
							<td style="border-right: 1px solid #333;" align="center">'.$form['saida_1'][$indice].'</td>
							<td style="border-right: 1px solid #333;" align="center">'.$form['entrada_2'][$indice].'</td>
							<td style="border-right: 1px solid #333;" align="center">'.$form['saida_2'][$indice].'</td>
							<td style="border-right: 1px solid #333;" align="center">'.$form['entrada_he'][$indice].'</td>
							<td style="border-right: 1px solid #333;" align="center">'.$form['saida_he'][$indice].'</td>
							<td style="border-right: 1px solid #333;" align="center">'.$form['total_he'][$indice].'</td>
							<td style="border-right: 1px solid #333;" align="center">'.$form['total_ad'][$indice].'</td>
							<td align="center">'.$form['tipo'][$indice].'</td>
						</tr>';
					}
					
					
					$totalextranoturno = floor($totalhorasadicionalt / 8);
					if($totalextranoturno < 10)
						$totalextranoturno = "0".$totalextranoturno.":00";
					else
						$totalextranoturno = $totalextranoturno.":00";
						
					$html .= '<tr>
							<td colspan="9" align="right">
								<strong>TOTAL HORAS EXTRAS:</strong><br>
								<strong>TOTAL ADICIONAL NOTURNO:</strong>
							</td>
							<td align="right" style="border-right: 1px solid #333;">
								<strong>'.$totalhorast.'</strong><br>
								<strong>'.$totalhorasadicionalt.'</strong>
							</td>
							<td></td>
						</tr>
						<tr>
							<td colspan="3" align="left"><strong>TOTAL FALTAS:</strong> '.$totalfaltas.'</td>
							<td colspan="3" align="left"><strong>TOTAL FALTAS DSR:</strong> '.$totalferiados.'</td>
							<td colspan="4" align="right"><strong>TOTAL FERIADOS TRABALHADOS:</strong> '.$totalferiadostrab.'</td>
							<td></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>';
		$html .= '<table width="100%">
					<tr><td><br /></td></tr>
					<tr>
						<td align="center" valign="top">_______________________________<br /><small>'.@$form["nome_funcionario"].'</small></td>
					</tr>
				</table>
				<div style="text-align: center; padding: 20px 0 20px 0;font-size: 14px; width: 100%;">Gerado em '.date("d/m/Y").' a partir do site www.bvcontabilidade.com.br</div>
</div>
			</body>
		</html>';
	
	
		$arquivo = date("d-m-Y-Hi")."_calculo_horas.pdf";
		$mpdf=new mPDF('','A4');
		$mpdf->WriteHTML($html);
		$mpdf->Output($arquivo,"f");
	
	
		$msg = '<table cellpadding="10" cellspacing="0" width="100%" border="0">
						<tr><td>'.utf8_decode("Fomulário em anexo.").'</td></tr>
				</table>
				<table cellpadding="10" cellspacing="0" width="100%" border="0">
					<tr>
						<td width="20%"><a href="http://www.bvcontabilidade.com.br"><img width="140" src="http://www.bvcontabilidade.com.br/imagens/logo.png" border="0" /></a></td>
						<td>Travessa '.utf8_decode("Pirajá").', 1298 - sala 02, Marco<br />'.utf8_decode("Belém").', PA<br />CEP 66095-631<br />
						Telefone: (91) 3228.0364 - 3352.0200</td>
					</tr>
				</table>';
	
		
			//Create a new PHPMailer instance
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->SMTPDebug = 1;
			$mail->Port = 80; //Indica a porta de conexão para a saída de e-mails
			$mail->Host = 'smtpout.secureserver.net';//Endereço do Host do SMTP Locaweb
			$mail->SMTPAuth = true; //define se haverá ou não autenticação no SMTP
			$mail->Username = 'contatosite@bvcontabilidade.com.br'; //Login de autenticação do SMTP
			$mail->Password = 'bv159contabili'; //Senha de autenticação do SMTP
			//Set who the message is to be sent from
			$mail->setFrom("contatosite@bvcontabilidade.com.br", 'BV Contabilidade');
			//Set an alternative reply-to address
			$mail->addReplyTo($form["email"]);
			//Set who the message is to be sent to
			$mail->addAddress($form["email"]);
			$mail->addAddress("contato@bvcontabilidade.com.br", 'BV Contabilidade');
			//$mail->addAddress("nos7manjibr@gmail.com", 'BV Contabilidade');
		
			//Set the subject line
			$mail->Subject = utf8_decode("Site BV Contabilidade - Hora Extra");
			//Read an HTML message body from an external file, convert referenced images to embedded,
			//convert HTML into a basic plain-text alternative body
			$mail->msgHTML($msg);
			//Replace the plain text body with one created manually
			//$mail->AltBody = 'This is a plain-text message body';
			//Attach an image file
			$mail->addAttachment($arquivo);
			
			//send the message, check for errors
			
			if (!$mail->send()) {
				echo "Mailer Error: " . $mail->ErrorInfo;
			} else {
				if(@$retorno)
					echo '<meta http-equiv="refresh" content="0; url=../domestico/index.php?pag=calchoraextra&msg=ok">';
				else
					echo '<meta http-equiv="refresh" content="0; url=../index.php?pag=confirmacao">';
			}
			
	
	
}
else if($op == "cartapreposicao")
{
	if($form['doc'] == "ct")
		$documento = 'da Carteira Profissional nº '.$form['carteira_representante'];
	else
		$documento = 'do RG nº '.$form['carteira_representante'];;
		
	$html = '<html>
			<head>
			</head>
			<body>
			<style>
			@font-face {
				font-family: "Zurich";
				src: url("../fonts/tt0296m-webfont.eot");
				src: url("../fonts/tt0296m-webfont.eot?#iefix") format("embedded-opentype"),
					 url("../fonts/tt0296m-webfont.woff") format("woff"),
					 url("../fonts/tt0296m-webfont.ttf") format("truetype"),
					 url("../fonts/tt0296m-webfont.svg#zurich_ltcn_btlight") format("svg");
				font-weight: normal;
				font-style: normal;
			
			}

body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	font-size: 10pt;
	color: #333;
	font-family: Arial;

}

#site_interno{
	width: 800px;
	height: auto;
	margin: 0 auto 0 auto;
	text-align: center;
}

#cabecalho{
	text-align: center;
	margin: 0 0 30px 0 ;
	clear: both;
	height: 100px;
}
#rodape{
	padding-top: 20px;
	font-size: 12px;
	line-height: 130%;
	width: 85%;
	text-align: center;
	border-top: 1px solid #DDD;
	position: absolute;
	margin-top: 260mm;
}
.texto{
	line-height: 130%;
	text-align: justify;
	padding-top: 0;
	height: 800px;
}

			</style>
			<div id="rodape">Gerado em '.date("d/m/Y").' a partir do site www.bvcontabilidade.com.br</div>
			<div class="texto">	
				<h2 style="margin-bottom: 50px; text-align: center; line-height: 25px;">CARTA DE PREPOSIÇÃO</h2>
				<table width="100%">
					<tr>
						<td>Empresa:</td>
						<td>'.@$form["nome_empresa"].'</td>
					</tr>
					<tr>
						<td>Endereço:</td>
						<td>'.$form['endereco_emp'].', '.$form['numero_emp'].', '.$form['bairro_emp'].', ';
							if($form['complemento_emp']) 
								$html .= $form['complemento_emp'].", ";
						$html .= 'CEP: '.$form['cep_emp'].', '.$form['cidade_emp'].' - '.$form['estado_emp'].'</td>
					</tr>
					<tr>
						<td>CNPJ:</td>
						<td>'.@$form["cnpj"].'</td>
					</tr>
				</table>		
				<br />
				<p style="text-align: justify;">Na pessoa do seu representante legal abaixo assinado, pelo presente instrumento de <strong>CARTA DE PREPOSIÇÃO</strong>, nomeia o(a)  Sr.(a) '.$form['nome_representante'].', portador '.$documento.', empregado (a) da prepotente, para a finalidade de representá-la perante esse Sindicato, nos atos da(s) Homologação(ões) do(s) funcionário(s):</p>';
				$count = 1;
				foreach($form['nome_funcionario'] as $funcionario)
				{
					if($funcionario)
					{
						$html .= $count.". ".$funcionario."<br>";
						$count++;
					}
				}
				
				$html .= '<br /><br />
				<p style="text-align: justify;text-transform:capitalize;">'.@$form["local"].', '. @$form["data"].'</p>
				<br />
				<p align="center">_________________________________<br />Assinatura / representante legal</p>
			</div>
				
			</body>
		</html>';
	
	$arquivo = date("d-m-Y-Hi")."_carta_preposicao.pdf";
	$mpdf=new mPDF('','A4');
	$mpdf->WriteHTML($html);
	$mpdf->Output($arquivo,"f");
	
	
	$msg = '<table cellpadding="10" cellspacing="0" width="100%" border="0">
					<tr><td>'.utf8_decode("Fomulário em anexo.").'</td></tr>
			</table>
			<table cellpadding="10" cellspacing="0" width="100%" border="0">
				<tr>
					<td width="20%"><a href="http://www.bvcontabilidade.com.br"><img width="140" src="http://www.bvcontabilidade.com.br/imagens/logo.png" border="0" /></a></td>
					<td>Travessa '.utf8_decode("Pirajá").', 1298 - sala 02, Marco<br />'.utf8_decode("Belém").', PA<br />CEP 66095-631<br />
					Telefone: (91) 3228.0364 - 3352.0200</td>
				</tr>
			</table>';
	
	//Create a new PHPMailer instance
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPDebug = 1;
	$mail->Port = 80; //Indica a porta de conexão para a saída de e-mails
	$mail->Host = 'smtpout.secureserver.net';//Endereço do Host do SMTP Locaweb
	$mail->SMTPAuth = true; //define se haverá ou não autenticação no SMTP
	$mail->Username = 'contatosite@bvcontabilidade.com.br'; //Login de autenticação do SMTP
	$mail->Password = 'bv159contabili'; //Senha de autenticação do SMTP
	//Set who the message is to be sent from
	$mail->setFrom("contatosite@bvcontabilidade.com.br", 'BV Contabilidade');
	//Set an alternative reply-to address
	$mail->addReplyTo($form["email"]);
	//Set who the message is to be sent to
	$mail->addAddress($form["email"]);
	$mail->addAddress("contato@bvcontabilidade.com.br", 'BV Contabilidade');

	//Set the subject line
	$mail->Subject = utf8_decode("Site BV Contabilidade - Carta de Preposição");
	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	$mail->msgHTML($msg);
	//Replace the plain text body with one created manually
	//$mail->AltBody = 'This is a plain-text message body';
	//Attach an image file
	$mail->addAttachment($arquivo);
	
	//send the message, check for errors
	if (!$mail->send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
		echo '<meta http-equiv="refresh" content="0; url=../index.php?pag=confirmacao">';
	}
	
}
else if($op == "admissao_domesticos")
{
	//echo "<pre>";
	//print_r($form);
	//echo "</pre>";
	$mensagem = '<table cellpadding="10" cellspacing="0" width="100%" border="0">
			<tr><td colspan="2">DADOS DO EMPREGADOR</td></tr>
			<tr><td width="40%">Nome</td><td width="60%">'.@$form["nome"].'</td></tr>
			<tr><td>CPF</td><td>'.@$form["cpf"].'</td></tr>
			<tr><td>Data de Nascimento:</td><td>'.@$form["data_nascimento"].'</td></tr>
			<tr><td>E-mail:</td><td>'.@$form["email"].'</td></tr>
			<tr><td>Telefone:</td><td>'.@$form["telefone"].'</td></tr>
			<tr><td>Endereço:</td><td>'.@$form["endereco"].', '.@$form["numero"].' - '.@$form["bairro"].'<br>
					'.@$form["cidade"].', '.@$form["estado"].'</td></tr>
			<tr><td width="40%">Fez declaração de imposto de renda?</td><td width="60%">'.@$form["declaracao"].'</td></tr>';
			if(@$form["declaracao"] == "sim")
				$mensagem .= '<tr><td width="40%">Foi feita com a BV?</td><td width="60%">'.@$form["declaracaobv"].'</td></tr>';
			else
				$mensagem .= '<tr><td width="40%">Título de eleitor</td><td width="60%">'.@$form["titulo_eleitor"].'</td></tr>';
				
			if(@$form["declaracaobv"] != "sim")
				$mensagem .= '<tr><td width="40%">Recibo das duas &uacute;ltimas declara&ccedil;&otilde;es:</td><td width="60%">'.implode(" e ",@$form["declaracoes"]).'</td></tr>';
			
			$mensagem .= '
			<tr><td width="40%">Observação:</td><td width="60%">'.@$form["observacao"].'</td></tr>
			<tr><td colspan="2"><hr></td></tr>
			<tr><td colspan="2">DADOS DO EMPREGADO</td></tr>
			<tr><td>Grau de instrução:</td><td>'.@$form["grau_instrucao"].'</td></tr>
			<tr><td>Raça / Cor:</td><td>'.@$form["raca"].'</td></tr>
			<tr><td>Salário:</td><td>R$ '.@$form["salario"].'</td></tr>
			<tr><td>Dias e hor&aacute;rios de trabalho:</td><td>'.@$form["horario_trabalho"].'</td></tr>
			<tr><td>E-mail:</td><td>'.@$form["email_empregado"].'</td></tr>
			<tr><td>Telefone:</td><td>'.@$form["telefone_empregado"].'</td></tr>
			<tr><td>Endereço:</td><td>'.@$form["endereco_emp"].', '.@$form["numero_emp"].' - '.@$form["bairro_emp"].'<br>
					'.@$form["cidade_emp"].', '.@$form["estado_emp"].'</td></tr>
			<tr><td>Data de admiss&atilde;o:</td><td>'.@$form["data_admissao"].'</td></tr>
			<tr><td>Estado civil:</td><td>'.@$form["estado_civil"].'</td></tr>
			<tr><td>Trabalhador recebe Aposentadoria por idade ou tempo de contribuição?</td><td>'.@$form["aposentado"].'</td></tr>
			<tr><td>Qual a função exercida pelo trabalhador?</td><td>'.@$form["funcao"].'</td></tr>
			<tr><td colspan="2"><hr /></td></tr>';
			
			
			if($_FILES["documentos"]['name'][0])
			{
				$mensagem .= '<tr><td>Documentos:</td><td>';

					$link = uploadarquivo("admissao_domestico", ($_FILES["documentos"]), (@$form["nome"]));
					$mensagem .= $link."<br />";

				$mensagem .= '</td></tr>';
			}
			
			
		$mensagem .= '</table>';
	
	//echo $mensagem;
	
	
	//Create a new PHPMailer instance
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPDebug = 1;
	$mail->Port = 80; //Indica a porta de conexão para a saída de e-mails
	$mail->Host = 'smtpout.secureserver.net';//Endereço do Host do SMTP Locaweb
	$mail->SMTPAuth = true; //define se haverá ou não autenticação no SMTP
	$mail->Username = 'contatosite@bvcontabilidade.com.br'; //Login de autenticação do SMTP
	$mail->Password = 'bv159contabili'; //Senha de autenticação do SMTP
	//Set who the message is to be sent from
	$mail->setFrom("contato@bvcontabilidade.com.br", "BV Contabilidade");
	//Set an alternative reply-to address
	$mail->addReplyTo("contato@bvcontabilidade.com.br", "BV Contabilidade");
	//Set who the message is to be sent to
	$mail->addAddress("contato@bvcontabilidade.com.br", 'BV Contabilidade');
	$mail->addAddress("bruno@bvcontabilidade.com.br", 'Bruno');
	$mail->addAddress("joao@bvcontabilidade.com.br", 'Joao');
	$mail->addAddress("sara@bvcontabilidade.com.br", 'Sara');
	$mail->addAddress("cristiane@bvcontabilidade.com.br", 'Cristiane');
	$mail->addAddress("tamires@bvcontabilidade.com.br", 'Tamires');
	$mail->addAddress("leticia@bvcontabilidade.com.br", 'Leticia');


	//Set the subject line
	$mail->Subject = utf8_decode("Site BV Contabilidade - Admissão Domésticos - ".$form["nome"]);
	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	$mail->msgHTML(utf8_decode($mensagem));
	//Replace the plain text body with one created manually
	//$mail->AltBody = 'This is a plain-text message body';
	//Attach an image file
	//$mail->addAttachment('images/phpmailer_mini.gif');
	
	//send the message, check for errors
	if (!$mail->send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
		if($retorno)
		{
			echo '<meta http-equiv="refresh" content="0; url=../domestico/index.php?pag=admissao&msg=ok">';
		}
		else
			echo '<meta http-equiv="refresh" content="0; url=../index.php?pag=confirmacao">';

	}
	
}
else if($op == "suspensao")
{
	$mensagem = '<html>
			<head>
			</head>
			<body>
			<style>
			@font-face {
				font-family: "Zurich";
				src: url("../fonts/tt0296m-webfont.eot");
				src: url("../fonts/tt0296m-webfont.eot?#iefix") format("embedded-opentype"),
					 url("../fonts/tt0296m-webfont.woff") format("woff"),
					 url("../fonts/tt0296m-webfont.ttf") format("truetype"),
					 url("../fonts/tt0296m-webfont.svg#zurich_ltcn_btlight") format("svg");
				font-weight: normal;
				font-style: normal;
			
			}

body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	font-size: 10pt;
	color: #333;
	font-family: Arial;

}

#site_interno{
	width: 800px;
	height: auto;
	margin: 0 auto 0 auto;
	text-align: center;
}

#cabecalho{
	text-align: center;
	margin: 0 0 30px 0 ;
	clear: both;
	height: 100px;
}
#rodape{
	padding-top: 20px;
	font-size: 12px;
	line-height: 130%;
	width: 85%;
	text-align: center;
	border-top: 1px solid #DDD;
	position: absolute;
	margin-top: 260mm;
}
.texto{
	line-height: 130%;
	text-align: justify;
	padding-top: 30px;
	height: 800px;
}

			</style>
			<div id="rodape">Gerado em '.date("d/m/Y").' a partir do site www.bvcontabilidade.com.br</div>
			<div class="texto">			
			';

		$fdias = "dia";
		if(@$form['prazo'] > 1)
			$fdias = "dias";
        
		$data = explode("/",@$form["data_inicio"]);
		$dia = $data[0];
		
		switch($data[1])
		{
			case 1;
			$mes = "janeiro";
			break;
			
			case 2;
			$mes = "fevereiro";
			break;
			
			case 3;
			$mes = "março";
			break;
			
			case 4;
			$mes = "abril";
			break;
			
			case 5;
			$mes = "maio";
			break;
			
			case 6;
			$mes = "junho";
			break;
			
			case 7;
			$mes = "julho";
			break;
			
			case 8;
			$mes = "agosto";
			break;
			
			case 9;
			$mes = "setembro";
			break;
			
			case 10;
			$mes = "outubro";
			break;
			
			case 11;
			$mes = "novembro";
			break;
			
			case 12;
			$mes = "dezembro";
			break;
		}
		
		$mensagem .= '<h2 style="margin-bottom: 50px; text-align: center;">AVISO EMPREGADOR PARA SUSPENDER O<br> EMPREGADO DO SERVIÇO</h2>
				<p style="text-align: justify;">'.@$form["cidade"].', '.$dia.' de '.$mes.' de '.$data[2].'</p>
				<p style="text-align: justify; text-transform: uppercase;"><strong>A(o) senhor(a):</strong> '.@$form["nome_funcionario"].'</p>

				<p style="text-align: justify;">Pelo presente o notificamos que a partir de '.@$form["data_inicio"].', está suspenso do exercício de suas funções, pelo prazo de '.@$form["prazo"]." ".$fdias.', devendo, portanto, apresentar-se novamente ao serviço no horário usual, no dia '.@$form["data_volta"].', salvo outra resolução nossa, que lhe daremos parte se for o caso, e assim pedimos a devolução do presente com o seu &quot;ciente&quot;.</p>
				<p style="text-align: justify;">Saudações<br><br></p>';

				$mensagem .= '
				<table width="100%">
					<tr>
						<td align="left" colspan="2">Ciente em: '.@$form["data_inicio"].'</td>
					</tr>
					<tr><td colspan="2"><br /><br /></td></tr>
					<tr>
						<td align="center" valign="top">_______________________________<br /><small>'.@$form["nome_empresa"].'</small></td>
						<td align="center" valign="top">_______________________________<br /><small>'.@$form["nome_funcionario"].'</small></td>
					</tr>
				</table>
				
				<table width="100%">
					<tr>
						<td valign="bottom" width="100"><p style="text-align: justify;"><br><br>Testemunhas:<br /><br></p>
							Nome:</td>
						<td valign="bottom">_______________________________________<br></td>
					</tr>
					<tr>
						<td valign="bottom" width="100">RG:</td>
						<td valign="bottom">_______________________________________<br></td>
					</tr>
					<tr><td colspan="2"><br></td></tr>
					<tr>
						<td valign="bottom" width="100">Nome:</td>
						<td valign="bottom">_______________________________________<br></td>
					</tr>
					<tr>
						<td valign="bottom" width="100">RG:</td>
						<td valign="bottom">_______________________________________<br></td>
					</tr>
				</table>';
				
			$mensagem .= '
				</div>
			</body>
		</html>';
		
	//echo $mensagem;
	
	
	$arquivo = date("d-m-Y-Hi")."_comunicado_suspensao_".$form['nome_funcionario'].".pdf";
	$mpdf=new mPDF('','A4');
	$mpdf->WriteHTML($mensagem);
	$mpdf->Output($arquivo,"f");
	
	$msg = '<table cellpadding="10" cellspacing="0" width="100%" border="0">
					<tr><td>'.utf8_decode("Fomulário em anexo.").'</td></tr>
			</table>
			<table cellpadding="10" cellspacing="0" width="100%" border="0">
				<tr>
					<td width="20%"><a href="http://www.bvcontabilidade.com.br"><img width="140" src="http://www.bvcontabilidade.com.br/imagens/logo.png" border="0" /></a></td>
					<td>Travessa '.utf8_decode("Pirajá").', 1298 - sala 02, Marco<br />'.utf8_decode("Belém").', PA<br />CEP 66095-631<br />
					Telefone: (91) 3228.0364 - 3352.0200</td>
				</tr>
			</table>';
		
	
	//Create a new PHPMailer instance
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPDebug = 1;
	$mail->Port = 80; //Indica a porta de conexão para a saída de e-mails
	$mail->Host = 'smtpout.secureserver.net';//Endereço do Host do SMTP Locaweb
	$mail->SMTPAuth = true; //define se haverá ou não autenticação no SMTP
	$mail->Username = 'contatosite@bvcontabilidade.com.br'; //Login de autenticação do SMTP
	$mail->Password = 'bv159contabili'; //Senha de autenticação do SMTP
	//Set who the message is to be sent from
	$mail->setFrom("contatosite@bvcontabilidade.com.br", 'BV Contabilidade');
	//Set an alternative reply-to address
	$mail->addReplyTo($form["email"]);
	//Set who the message is to be sent to
	$mail->addAddress($form["email"]);
	$mail->addAddress("contato@bvcontabilidade.com.br", 'BV Contabilidade');
	//$mail->addAddress("nos7manjibr@gmail.com", 'BV Contabilidade');

	//Set the subject line
	$mail->Subject = utf8_decode("Site BV Contabilidade - Comunicado de Suspensão");
	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	$mail->msgHTML(utf8_decode($msg));
	//Replace the plain text body with one created manually
	//$mail->AltBody = 'This is a plain-text message body';
	//Attach an image file
	$mail->addAttachment($arquivo);
	
	//send the message, check for errors
	if (!$mail->send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
		echo '<meta http-equiv="refresh" content="0; url=../index.php?pag=confirmacao">';
	}
	
}
else if($op == "cartaoponto")
{
	if(strlen($form['cnpj']) > 14)
		$doc = "CNPJ";
	else
		$doc = "CPF";
		
	$mensagem = '<html>
			<head>
			</head>
			<body>
			<style>
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	font-size: 9pt;
	color: #333;
	font-family: Arial;

}

.tblhoras{
	 font-size: 9pt !important;
	color: #333;
	font-family: Arial;
	border-collapse:collapse;
}
.tblhoras td{
	border-bottom: 1px solid #CCC;
	border-right: 1px solid #CCC;
	padding: 0 5px;
	border-collapse:collapse;
}
.tblhoras th{
	text-transform: uppercase;
	font-size:10px;
	padding: 1px 5px;
	border-collapse:collapse;
}

#site_interno{
	width: 800px;
	height: auto;
	margin: 0 auto 0 auto;
	text-align: center;
}

#cabecalho{
	text-align: center;
	margin: 0 0 30px 0 ;
	clear: both;
	height: 100px;
}
#rodape{
	padding-top: 20px;
	font-size: 11px;
	line-height: 130%;
	width: 85%;
	text-align: center;
	position: absolute;
	margin-top: 270mm;
}
.texto{
	line-height: 130%;
	text-align: justify;
	padding-top: 0;
	height: 800px;
}

.tbldados td{
	font-size: 12px;
	padding: 1px 2px;
}

			</style>
	<div id="rodape">Gerado em '.date("d/m/Y").' a partir do site www.bvcontabilidade.com.br</div>
	<div align="center"><img width="90" src="http://www.bvcontabilidade.com.br/imagens/logo.png" border="0" style="margin-top: -20px; margin-bottom: 10px;" /></div>
	<table cellpadding="10" cellspacing="0" width="100%" class="tbldados">
		<tr>
        	<td width="33%"><strong>Empregador</strong>: '.$form['razao_social'].'</td>
            <td width="33%"><strong>'.$doc.'</strong>: '.$form['cnpj'].'</td>
			<td width="33%"><strong>Per&iacute;odo de</strong>: '.$form['data_de'].' a '.$form['data_ate'].'</td>
       	</tr>
        <tr>
        	<td style="border-top: 1px solid #DDD;" colspan="3"><strong>Endere&ccedil;o</strong>: '.$form["endereco"].', '.$form["numero"].', '.$form["bairro"];
			if(@$form["complemento"])
				$mensagem .= " - ".$form["complemento"];
			$mensagem .= '- '.$form["cidade"].', '.$form["estado"].' - CEP: '.$form["cep"].'</td>
        </tr>
        <tr>
        	<td style="border-top: 1px solid #DDD;"><strong>Empregado</strong>: '.$form["nome_funcionario"].'</td>
            <td style="border-top: 1px solid #DDD;"><strong>CPF</strong>: '.@$form["cpf_funcionario"].'</td>
			<td style="border-top: 1px solid #DDD;"><strong>Fun&ccedil;&atilde;o</strong>: '.$form["cargo"].'</td>
       	</tr>
		<tr>
			<td colspan="3" style="border-top: 1px solid #DDD;"><strong>Horário </strong>:';
			if($form["entrada_1_1"] == $form["entrada_1_5"] &&  $form['saida_2_1'] == $form['saida_2_5'])
        	 	$mensagem .= '<strong>SEG a SEX</strong>: '.$form["entrada_1_1"]." às ".$form['saida_1_1']." e ".$form["entrada_2_1"]." às ".$form['saida_2_1'];
			else
				$mensagem .= '<strong>SEG a QUI</strong>: '.$form["entrada_1_1"]." às ".$form['saida_1_1']." e ".$form["entrada_2_1"]." às ".$form['saida_2_1']." e SEX:".$form["entrada_1_5"]." às ".$form['saida_1_5']." e ".$form["entrada_2_5"]." às ".$form['saida_2_5'];
			if($form['entrada_1_s'])
				$mensagem .= "&nbsp;&nbsp;&nbsp;<strong>Finais de Semana</strong>: SÁB. ".$form['entrada_1_s']." às ".$form['saida_1_s'];
			if($form['entrada_2_s'])
				$mensagem .= " e ".$form['entrada_2_s']." às ".$form['saida_2_s'];
			if($form['entrada_1_d'])
				$mensagem .= " - DOM. ".$form['entrada_1_d']." às ".$form['saida_1_d'];
			if($form['entrada_2_d'])
				$mensagem .= " e ".$form['entrada_2_d']." às ".$form['saida_2_d'];
		$mensagem .= '</td>
       	</tr>
    </table>
   	<table cellpadding="0" cellspacing="0" width="100%" style="border-top: 2px solid #000; margin-top: 10px;" class="tblhoras">
		<tr>
			<th style="border-left: 1px solid #CCC;"></th>
			<th align="center" colspan="2" style="border-right: 1px solid #CCC;">HOR&Aacute;RIO: &nbsp;1&deg; TURNO</th>
			<th align="center" colspan="2" style="border-right: 1px solid #CCC;">HOR&Aacute;RIO: &nbsp;2&deg; TURNO</th>
			<th rowspan="2" align="center" style="border-bottom: 2px solid #000;border-right: 1px solid #CCC;" width="10%">HORA<br />EXTRA</th>
			<th rowspan="2" align="center" style="border-bottom: 2px solid #000;border-right: 1px solid #CCC;">ASSINATURA<br />EMPREGADOR</th>
			<th rowspan="2" align="center" style="border-bottom: 2px solid #000;border-right: 1px solid #CCC;">ASSINATURA<br />TRABALHADOR</th>
		</tr>
		<tr>
			<th align="center" style="border-bottom: 2px solid #000;border-left: 1px solid #CCC;">Dia</th>
			<th align="center" style="border-bottom: 2px solid #000;border-right: 1px solid #CCC;" width="10%">Entrada</th>
			<th align="center" style="border-bottom: 2px solid #000;border-right: 1px solid #CCC;" width="10%">Sa&iacute;da</th>
			<th align="center" style="border-bottom: 2px solid #000;border-right: 1px solid #CCC;" width="10%">Entrada</th>
			<th align="center" style="border-bottom: 2px solid #000;border-right: 1px solid #CCC;" width="10%">Sa&iacute;da</th>
		</tr>';
					$data_de = date("Y-m-d",strtotime(str_replace("/","-",$_POST['data_de'])));
					$data_ate = date("Y-m-d",strtotime(str_replace("/","-",$_POST['data_ate'])));
					$diasemana = array("DOM","SEG","TER","QUA","QUI","SEX","SAB");
					$linha = 0;
					$mesinicio = date("m", strtotime($data_de));
					$anoinicio = date("Y", strtotime($data_de));
					$mesfim = date("m", strtotime($data_ate));
					$anofim = date("Y", strtotime($data_ate));
					$desabilita = "";
					if($mesinicio == $mesfim)
					{
						for($i = $data_de; $i <= $data_ate; $i++)
						{
							if($diasemana[date("w",strtotime($i))] == "DOM" || $diasemana[date("w",strtotime($i))] == "SAB")
								$bg = "#EEE";	
							else
								$bg = "#FFF";	
						
						$mensagem .= '<tr class="l'.$linha.'">
							<td align="left" style="border-left: 1px solid #CCC; background: '.$bg.'; font-size: 10px; font-weight:bold; padding: 5px 0 5px 15px;">'.date("d/m",strtotime($i)).' - '.$diasemana[date("w",strtotime($i))].'</td>
							<td align="center" style="background: '.$bg.';"></td>
							<td align="center" style="background: '.$bg.';"></td>
							<td align="center" style="background: '.$bg.';"></td>
							<td align="center" style="background: '.$bg.';"></td>
							<td align="center" style="background: '.$bg.';"></td>
                            <td align="center"></td>
							<td align="center"></td>
						</tr>';
							$linha++;
						}
					}
					else
					{
						$anode = date("Y", strtotime($data_de));
						$anoate = date("Y", strtotime($data_ate));
						$ultimodia = date("t", strtotime($data_de));
						$ultimodia = $anode."-".$mesinicio."-".$ultimodia;
						for($i = $data_de; $i <= $ultimodia; $i++)
						{
							if($diasemana[date("w",strtotime($i))] == "DOM" || $diasemana[date("w",strtotime($i))] == "SAB")
								$bg = "#EEE";	
							else
								$bg = "#FFF";	
							$mensagem .= '<tr class="l'.$linha.'">
								<td align="left" style="border-left: 1px solid #CCC; background: '.$bg.'; font-size: 10px; font-weight:bold; padding: 5px 0 5px 15px;">'.date("d/m",strtotime($i)).' - '.$diasemana[date("w",strtotime($i))].'</td>
								<td align="center" style="background: '.$bg.';"></td>
								<td align="center" style="background: '.$bg.';"></td>
								<td align="center" style="background: '.$bg.';"></td>
								<td align="center" style="background: '.$bg.';"></td>
								<td align="center" style="background: '.$bg.';"></td>
								<td align="center"></td>
								<td align="center"></td>
							</tr>';
							$linha++;
						}
						$ultimodia = date("t", strtotime($data_de));
						$novoinicio = $anoate."-".$mesfim."-01";
						for($i = $novoinicio; $i <= $data_ate; $i++)
						{
							if($diasemana[date("w",strtotime($i))] == "DOM" || $diasemana[date("w",strtotime($i))] == "SAB")
								$bg = "#EEE";	
							else
								$bg = "#FFF";	
							$mensagem .= '<tr class="l'.$linha.'">
								<td align="left" style="border-left: 1px solid #CCC; background: '.$bg.'; font-size: 10px; font-weight:bold; padding: 5px 0 5px 15px;">'.date("d/m",strtotime($i)).' - '.$diasemana[date("w",strtotime($i))].'</td>
								<td align="center" style="background: '.$bg.';"></td>
								<td align="center" style="background: '.$bg.';"></td>
								<td align="center" style="background: '.$bg.';"></td>
								<td align="center" style="background: '.$bg.';"></td>
								<td align="center" style="background: '.$bg.';"></td>
								<td align="center"></td>
								<td align="center"></td>
							</tr>';
						$linha++;
						}
					}
					$mensagem .= '
                </table>
 </body>
 </html>';
 
 	$msg = '<table cellpadding="10" cellspacing="0" width="100%" border="0">
					<tr><td>Cartão de ponto</td></tr>
			</table>
			<table cellpadding="10" cellspacing="0" width="100%" border="0">
				<tr>
					<td width="20%"><a href="http://www.bvcontabilidade.com.br"><img width="140" src="http://www.bvcontabilidade.com.br/imagens/logo.png" border="0" /></a></td>
					<td>Travessa Pirajá, 1298 - sala 02, Marco<br />Belém, PA<br />CEP 66095-631<br />
					Telefone: (91) 3228.0364 - 3352.0200</td>
				</tr>
			</table>';
		
	$arquivo = date("d-m-Y-Hi")."_cartao_ponto_".$form['nome_funcionario'].".pdf";
	$mpdf=new mPDF('','A4');
	$mpdf->WriteHTML($mensagem);
	$mpdf->Output($arquivo,"f");
	
	
	//Create a new PHPMailer instance
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPDebug = 1;
	$mail->Port = 80; //Indica a porta de conexão para a saída de e-mails
	$mail->Host = 'smtpout.secureserver.net';//Endereço do Host do SMTP Locaweb
	$mail->SMTPAuth = true; //define se haverá ou não autenticação no SMTP
	$mail->Username = 'contatosite@bvcontabilidade.com.br'; //Login de autenticação do SMTP
	$mail->Password = 'bv159contabili'; //Senha de autenticação do SMTP
	//Set who the message is to be sent from
	$mail->setFrom("contatosite@bvcontabilidade.com.br", 'BV Contabilidade');
	//Set an alternative reply-to address
	$mail->addReplyTo($form["email"]);
	//Set who the message is to be sent to
	$mail->addAddress($form["email"]);
	$mail->addAddress("contato@bvcontabilidade.com.br", 'BV Contabilidade');
	//$mail->addAddress("nos7manjibr@gmail.com", 'BV Contabilidade');

	//Set the subject line
	$mail->Subject = utf8_decode("Site BV Contabilidade - Cartão de Ponto");
	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	$mail->msgHTML(utf8_decode($msg));
	//Replace the plain text body with one created manually
	//$mail->AltBody = 'This is a plain-text message body';
	//Attach an image file
	$mail->addAttachment($arquivo);


	if (!$mail->send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
		if($retorno)
		{
			echo '<meta http-equiv="refresh" content="0; url=../domestico/index.php?pag=cartaoponto&msg=ok">';
		}
		else
			echo '<meta http-equiv="refresh" content="0; url=../index.php?pag=confirmacao">';
	}
	
}


?>