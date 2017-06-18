<script type="text/javascript">
$(function(){
	$("#usuario").focus();
	
	$("#lembrar").click(function() {
		var usuario = $("#usuario").val();
		if(usuario == ""){
			alert("Entre com seu nome de usu\u00e1rio");
			$("#usuario").focus();
		}else{
			var origem = "paginas/usuarios/login.php";
			$.post("paginas/usuarios/acoes.php?op=lembrar",{
				   usuario : usuario,
				   origem : origem
			}, function(data) {
				if(data == "erro_usu"){
					alert("Usu\u00e1rio n\u00e3o encontrado. Por favor, verifique e tente novamente.");
					$("#usuario").focus();
				}else {
					alert("Email enviado. Por favor, verifique a sua caixa de entrada.");
					$("#senha").focus();
				}
			})
		}
	});
});
	
</script>
<form action="paginas/usuarios/acoes.php?op=login" method="post">
	<table cellpadding="0" cellspacing="3" width="100%" class="tblcadastro">
		<tr>
			<td valign="top">Usu&aacute;rio:<br /><input type="text" name="usuario" id="usuario" value="" class="inputbox" style="width: 200px;" /></td>
			<td valign="top">Senha:<br /><input type="password" name="senha" id="senha" value="" class="inputbox" style="width: 120px;" /><br />
            <a style="cursor:pointer;font-size:11px;font-weight:bold;" id="lembrar" >Esqueci minha senha</a>
            </td>
		</tr>
        <tr>
        	<td colspan="2" class="salvar"><input type="submit" id="clientecont" value="Ok" class="button" /></td>
        </tr>
	</table>
    </form>
