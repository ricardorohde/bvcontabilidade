<?php
ini_set('memory_limit','164M'); // set memory to prevent fatal errors


include("../../conexao.php");
include("../../funcaoform.php");


$op = seguranca($_GET['op']);

$form = @$_POST;

if($op == "novo")
{
	$id = seguranca(@$_GET['id']);
	
	$form2['razao_social-string'] = $form['razao_social'];
	$form2['doc-string'] = $form['doc'];
	$form2['cnpj-string'] = $form['cnpj'];
	$form2['email-string'] = $form['email'];
	$form2['cep-string'] = $form['cep'];
	$form2['endereco-string'] = $form['endereco'];
	$form2['numero-string'] = $form['numero'];
	$form2['bairro-string'] = $form['bairro'];
	$form2['complemento-string'] = $form['complemento'];
	$form2['cidade-string'] = $form['cidade'];
	$form2['estado-string'] = $form['estado'];
	
	$form3['data_lancamento-date'] = date("d/m/Y");
	
	$form3['id_empresa-num'] = $form['id_empresa'];
	$form3['nome_funcionario-string'] = $form['nome_funcionario'];
	$form3['cpf_funcionario-string'] = $form['cpf_funcionario'];
	$form3['cargo-string'] = $form['cargo'];
	$form3['data_de-date'] = $form['data_de'];
	$form3['data_ate-date'] = $form['data_ate'];
	$form3['tipo_jornada-string'] = $form['tipo_jornada'];
	$form3['entrada_1_1-string'] = $form['entrada_1_1'];
	$form3['entrada_1_2-string'] = $form['entrada_1_2'];
	$form3['entrada_1_3-string'] = $form['entrada_1_3'];
	$form3['entrada_1_4-string'] = $form['entrada_1_4'];
	$form3['entrada_1_5-string'] = $form['entrada_1_5'];
	$form3['saida_1_1-string'] = $form['saida_1_1'];
	$form3['saida_1_2-string'] = $form['saida_1_2'];
	$form3['saida_1_3-string'] = $form['saida_1_3'];
	$form3['saida_1_4-string'] = $form['saida_1_4'];
	$form3['saida_1_5-string'] = $form['saida_1_5'];
	$form3['entrada_2_1-string'] = $form['entrada_2_1'];
	$form3['entrada_2_2-string'] = $form['entrada_2_2'];
	$form3['entrada_2_3-string'] = $form['entrada_2_3'];
	$form3['entrada_2_4-string'] = $form['entrada_2_4'];
	$form3['entrada_2_5-string'] = $form['entrada_2_5'];
	$form3['saida_2_1-string'] = $form['saida_2_1'];
	$form3['saida_2_2-string'] = $form['saida_2_2'];
	$form3['saida_2_3-string'] = $form['saida_2_3'];
	$form3['saida_2_4-string'] = $form['saida_2_4'];
	$form3['saida_2_5-string'] = $form['saida_2_5'];
	$form3['carga_horaria_1-string'] = $form['carga_horaria_1'];
	$form3['carga_horaria_2-string'] = $form['carga_horaria_2'];
	$form3['carga_horaria_3-string'] = $form['carga_horaria_3'];
	$form3['carga_horaria_4-string'] = $form['carga_horaria_4'];
	$form3['carga_horaria_5-string'] = $form['carga_horaria_5'];
	$form3['entrada_1_s-string'] = $form['entrada_1_s'];
	$form3['saida_1_s-string'] = $form['saida_1_s'];
	$form3['entrada_2_s-string'] = $form['entrada_2_s'];
	$form3['saida_2_s-string'] = $form['saida_2_s'];
	$form3['carga_horaria_s-string'] = $form['carga_horaria_s'];
	$form3['entrada_1_d-string'] = $form['entrada_1_d'];
	$form3['saida_1_d-string'] = $form['saida_1_d'];
	$form3['entrada_2_d-string'] = $form['entrada_2_d'];
	$form3['saida_2_d-string'] = $form['saida_2_d'];
	$form3['carga_horaria_d-string'] = $form['carga_horaria_d'];
	
	$verificafunci = mysql_query("SELECT id FROM funcionarios_ponto WHERE cpf_funcionario = '".$form['cpf_funcionario']."'");

	if($id)
	{
		$condicao = "cnpj = '".$form['cnpj']."'";
		$sql = executa($form2, "empresas_ponto", "edita", $condicao);
	}
	else
	{
		$verificaemp = mysql_query("SELECT id FROM empresas_ponto WHERE cnpj = '".$form['cnpj']."'");
		if(mysql_num_rows($verificaemp) == 0)
		{
			$sql = executa($form2, "empresas_ponto", "inserir", "");
		}
		else
		{
			$regemp = mysql_fetch_array($verificaemp);
			$sql = $regemp['id'];
		}
	}
	
	//$form3['id_empresa-num'] = $sql;
	
	if(mysql_num_rows($verificafunci) > 0)
	{
		$reg = mysql_fetch_array($verificafunci);
		$condicao = "id = '".$id."'";
		$sql2 = executa($form3, "funcionarios_ponto", "edita", $condicao);
	}
	else
	{
		$sql2 = executa($form3, "funcionarios_ponto", "inserir", "");
	}
	
	
	if($sql2 && $sql)
		header("Location: ../../index.php?pag=lis_ponto");
	else
		echo "Erro";
	
	

}

else if($op == "exclui_funci")
{
	$id = seguranca($_GET['id']);
	
	$sql = mysql_query("DELETE FROM funcionarios_ponto WHERE id = '".$id."'");

	if($sql)
		header("Location: ../../index.php?pag=lis_ponto");
	else
		echo "Erro";
}

else if($op == "envia")
{
	require '../../../phpmailer/class.phpmailer.php';
	include("../../../paginas/upload.php");
	include('../../../paginas/MPDF57/mpdf.php');
	
	$id = seguranca($_GET['id']);
	
	$sql = mysql_query("SELECT a.*, b.* FROM funcionarios_ponto AS a LEFT JOIN empresas_ponto AS b ON a.id_empresa = b.id WHERE a.id = '".$id."'");
	$reg = mysql_fetch_array($sql);
	
	if(strlen($reg['cnpj']) > 14)
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
        	<td width="33%"><strong>Empregador</strong>: '.$reg['razao_social'].'</td>
            <td width="33%"><strong>'.$doc.'</strong>: '.$reg['cnpj'].'</td>
			<td width="33%"><strong>Per&iacute;odo de</strong>: '.date("d/m/Y",strtotime($reg['data_de'])).' a '.date("d/m/Y",strtotime($reg['data_ate'])).'</td>
       	</tr>
        <tr>
        	<td style="border-top: 1px solid #DDD;" colspan="3"><strong>Endere&ccedil;o</strong>: '.$reg["endereco"].', '.$reg["numero"].', '.$reg["bairro"];
			if(@$reg["complemento"])
				$mensagem .= " - ".$reg["complemento"];
			$mensagem .= '- '.$reg["cidade"].', '.$reg["estado"].' - CEP: '.$reg["cep"].'</td>
        </tr>
        <tr>
        	<td style="border-top: 1px solid #DDD;"><strong>Empregado</strong>: '.$reg["nome_funcionario"].'</td>
            <td style="border-top: 1px solid #DDD;"><strong>CPF</strong>: '.@$reg["cpf_funcionario"].'</td>
			<td style="border-top: 1px solid #DDD;"><strong>Fun&ccedil;&atilde;o</strong>: '.$reg["cargo"].'</td>
       	</tr>
		<tr>
			<td colspan="3" style="border-top: 1px solid #DDD;"><strong>Horário </strong>:';
			if($reg["entrada_1_1"] == $reg["entrada_1_5"] && $reg['saida_2_1'] == $reg['saida_2_5'])
        	 	$mensagem .= '<strong>SEG a SEX</strong>: '.$reg["entrada_1_1"]." às ".$reg['saida_1_1']." e ".$reg["entrada_2_1"]." às ".$reg['saida_2_1'];
			else
				$mensagem .= '<strong>SEG a QUI</strong>: '.$reg["entrada_1_1"]." às ".$reg['saida_1_1']." e ".$reg["entrada_2_1"]." às ".$reg['saida_2_1']." e SEX:".$reg["entrada_1_5"]." às ".$reg['saida_1_5']." e ".$reg["entrada_2_5"]." às ".$reg['saida_2_5'];
			if($reg['entrada_1_s'])
				$mensagem .= "&nbsp;&nbsp;&nbsp;<strong>Finais de Semana</strong>: SÁB. ".$reg['entrada_1_s']." às ".$reg['saida_1_s'];
			if($reg['entrada_2_s'])
				$mensagem .= " e ".$reg['entrada_2_s']." às ".$reg['saida_2_s'];
			if($reg['entrada_1_d'])
				$mensagem .= " - DOM. ".$reg['entrada_1_d']." às ".$reg['saida_1_d'];
			if($reg['entrada_2_d'])
				$mensagem .= " e ".$reg['entrada_2_d']." às ".$reg['saida_2_d'];
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
					$data_de = $reg['data_de'];
					$data_ate = $reg['data_ate'];
					$diasemana = array("DOM","SEG","TER","QUA","QUI","SEX","SAB");
					$linha = 0;
					$mesinicio = date("m", strtotime($data_de));
					$mesfim = date("m", strtotime($data_ate));
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
 	
	$sqlm = mysql_fetch_array(mysql_query("SELECT * FROM mensagem_emails WHERE form = 'cartao_ponto'"));
	
 	$msg = '<table cellpadding="10" cellspacing="0" width="100%" border="0">
					<tr><td>'.html_entity_decode($sqlm["mensagem"]).'</td></tr>
			</table>
			<table cellpadding="10" cellspacing="0" width="100%" border="0">
				<tr>
					<td width="20%"><a href="http://www.bvcontabilidade.com.br"><img width="140" src="http://www.bvcontabilidade.com.br/imagens/logo.png" border="0" /></a></td>
					<td>Travessa Pirajá, 1298 - sala 02, Marco<br />Belém, PA<br />CEP 66095-631<br />
					Telefone: (91) 3228.0364 - 3352.0200</td>
				</tr>
			</table>';
		
	$arquivo = date("d-m-Y-Hi")."_cartao_ponto_".$reg['nome_funcionario'].".pdf";
	$mpdf=new mPDF('','A4');
	$mpdf->WriteHTML($mensagem);
	$mpdf->Output($arquivo,"f");
	
	$emails = explode(";",@$reg["email"]);
	
	
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
	$mail->setFrom("contato@bvcontabilidade.com.br", 'BV Contabilidade');
	//Set an alternative reply-to address
	$mail->addReplyTo("contato@bvcontabilidade.com.br");
	//Set who the message is to be sent to
	foreach($emails as $email)
	{
		$mail->addAddress(trim($email));
	}
	//$mail->addAddress("contato@bvcontabilidade.com.br", 'BV Contabilidade');
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
	
	//send the message, check for errors
	if (!$mail->send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
		$sql2 = mysql_query("UPDATE funcionarios_ponto SET data_lancamento = '".date("Y-m-d H:i")."' WHERE id = '".$id."'");
		echo '<meta http-equiv="refresh" content="0; url=../../index.php?pag=lis_ponto&mgs=enviook">';
	}
}

else if($op == "mensagem")
{
	$id = seguranca($_GET["id"]);
	if($id)
	{
		$condicao = "id = '".$id."'";
		$sql = executa($form, "mensagem_emails", "edita", $condicao);
		
		if($sql)
		{
			echo '<meta http-equiv="refresh" content="0; url=../../index.php?pag=lis_ponto">';
		}
	}
}
?>