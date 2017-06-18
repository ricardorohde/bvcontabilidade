<?php
session_start();
include("../../conexao.php");
include("../../funcaoform.php");
//include("../../enviaemail.php");

$op = seguranca($_GET['op']);

$form = @$_POST;

if($op == "login")
{
	$usuario = seguranca($_POST['usuario']);
	$senha = seguranca($_POST['senha']);

	$sql = "SELECT * FROM usuarios WHERE usuario = '".$usuario."' AND senha = '".$senha."'";
	$sql = mysql_query($sql);

	if(mysql_num_rows($sql) > 0)
	{
		$reg = mysql_fetch_array($sql);

		//session_start();
		$_SESSION['id_usuario'] = $reg['id'];
		$_SESSION['usuario'] = $reg['usuario'];
		$_SESSION['nivel_acesso'] = $reg['id_nivel'];
		$_SESSION['nome'] = $reg['nome'];
		$_SESSION['id_empresa'] = $reg['id_empresa'];
		$_SESSION['email'] = $reg['email'];
		$_SESSION['telefone'] = $reg['telefone'];

		header("Location: ../../index.php?pag=lis_produto");
	}
	else
	{
		header("Location: ../../index.php?pag=loginincorreto&erro=login");
	}
}

else if($op == "logout")
{
	session_start();
	session_destroy();
	session_unset();

	header("Location: ../../index.php");

}

else if($op == "senha")
{
	$id_usuario = seguranca($_GET['id_usuario']);
	$senha = seguranca($_POST['senha']);

	$sql = mysql_query("UPDATE usuarios SET senha = '".$senha."' WHERE id_usuario = '".$id_usuario."'");

	if($sql){
		header("Location: ../../index.php?pag=senha&ok=oksenha");
	}else{
		header("Location: ../../index.php?pag=senha&ok=errosenha");
	}
}

else if ($op == "novo")
{
	$id = seguranca($_GET['id']);
	if($id)
	{
		$condicao = "id = '".$id."'";
		$sql = executa($form, "usuarios", "edita", $condicao);
	
		if($sql)
			header("Location: ../../index.php?pag=lis_usuario");
	}
	else
	{
		$sql = executa($form, "usuarios", "inserir", "");
	
		if($sql)
			header("Location: ../../index.php?pag=lis_usuario");
	}


}

elseif ($op == "excluir"){
	$id = seguranca($_GET['id']);

	$sql = mysql_query("DELETE FROM usuarios WHERE id = '".$id."'");
	if($sql)
		header("Location: ../../index.php?pag=lis_usuario");

}

else if ($op == "lembrar")
{
	$usuario = seguranca($_POST['usuario']);
	
	$origem = seguranca($_POST['origem']);
	
	$sql = mysql_query("SELECT email, senha FROM usuarios
						WHERE id_usuario = (SELECT id_usuario FROM usuarios WHERE usuario = '".$usuario."')");
	if(mysql_num_rows($sql) == 0){
		echo "erro_usu";
	}else{
	$reg = mysql_fetch_array($sql);
	$email = $reg['email'];
	$senha = $reg['senha'];
	
	//Envio de email
	$mensagem = "Recupera&ccedil;&atilde;o de Senha. <br /> Usu&aacute;rio: $usuario <br /> Senha: $senha <br /><br />
	N&atilde;o Responder - Resposta autom&aacute;tica.";
	$nome = "UFT Usinagem";
	$assunto = utf8_decode("Cadastro de Usuário");
	$para = $email;
	$emailresposta = "";
	
	enviaemail($nome, $para, $assunto, $emailresposta, $mensagem, $origem);
	}	
}

?>