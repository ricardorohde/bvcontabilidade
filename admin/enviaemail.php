<?php
function enviaemail($nome, $para, $assunto, $emailresposta, $mensagem, $origem)
{
	require_once('../../../phpmailer/class.phpmailer.php');
	
	$mensagem = str_replace("\n","<br />",@$mensagem);
	
	// faço a chamada da classe
	$Email = new PHPMailer();
	// na classe, há a opção de idioma, setei como br
	$Email->SetLanguage("br");
	// esta chamada diz que o envio será feito através da função mail do php. Você mudar para sendmail, qmail, etc
	// se quiser utilizar o programa de email do seu unix/linux para enviar o email
	$Email->IsSMTP(); 														  //ENVIAR VIA SMTP
	//$Email->Host = "smtp.benettoncomunicacao.com.br";
	//$Email->SMTPAuth = true; 												//ATIVA O /SMTP AUTENTICADO
	//$Email->Username = "falecom@benettoncomunicacao.com.br";
	//$Email->Password = "pepemail120";
	//$Email->IsMail();
	// ativa o envio de e-mails em HTML, se false, desativa.
	$Email->IsHTML(true);
	// email do remetente da mensagem
	$Email->From = "cleverson@benettoncomunicacao.com.br";//Colocar aqui o email da empresa;
	// nome do remetente do email
	$Email->FromName = $nome;
	// Endereço de destino do emaail, ou seja, pra onde você quer que a mensagem do formulário vá.
	$Email->AddAddress($para);
	//$Email->AddAddress("nos7manjibr@gmail.com");
	$Email->AddReplyTo($emailresposta);
	// informando no email, o assunto da mensagem
	$Email->Subject = $assunto;
	// Define o texto da mensagem (aceita HTML)
	
	$Email->Body .= "
			<img src='http://www.benettoncomunicacao.com.br/amostra/uft/site/admin/imagens/uft_logo.png' />
			<hr />
			<table cellpadding='5' cellspacing='5' width='100%'>
				<tr><td>$mensagem</td></tr>
			</table>";				
	
	if(!$Email->Send()){
		echo "<script language='javascript'>
			alert('Ocorreu um erro durante o envio de Email.');
			window.location.href='../../".$origem."';
		</script>";
	}
	else{
		echo "<script language='javascript'>
			alert('Email enviado com sucesso.'); 
			window.location.href='../../".$origem."';
		</script>";
	}
}
?>