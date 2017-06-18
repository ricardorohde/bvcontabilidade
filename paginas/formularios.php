<?php
$id_categoria = seguranca(@$_GET['cat']);

?>
<script type="text/javascript">
$(function(){
	$( ".data" ).datepicker({
		dateFormat: "dd/mm/yy",
		changeMonth: true,
		changeYear: true
    });

    $( ".data2" ).datepicker({
		dateFormat: "dd/mm",
		changeMonth: true,
		changeYear: false
    });
	
	$(".datamascara").blur(function(){
		var tamanho = $(this).val().length;
		if(tamanho != 10)
			$(this).val("");
	});
	
	<?php
	if(@$id_categoria == "")
	{
	?>
		$("#formularios").hide();
	<?php
	}
	else
	{
	?>
		$(".submenu").hide();
		$(".linkform").click(function(){
			$(".submenu").slideDown();
		});
	<?php
	}
	?>
	
	
});
</script>
<h1><?php echo $titulo;?> <?php echo @$id_categoria ? '<small class="linkform">- Abrir Menu</small>' : '';?></h1>

<ul class="submenu">
		
        <li><a href="index.php?pag=formularios&cat=admissao" class="umalinha">Admiss&atilde;o</a></li>
        <li><a href="index.php?pag=formularios&cat=admissao_domesticos" class="duaslinhas">Admiss&atilde;o Dom&eacute;sticos</a></li>
        <li><a href="index.php?pag=formularios&cat=advertencia" class="umalinha">Advert&ecirc;ncia</a></li>
        <li><a href="index.php?pag=formularios&cat=avisoprevio" class="umalinha">Aviso Pr&eacute;vio</a></li>
        <li><a href="index.php?pag=formularios&cat=horaextra" class="duaslinhas">C&aacute;lculo de Hora Extra</a></li>
        <li><a href="index.php?pag=formularios&cat=calchoraextra" class="duaslinhas">C&aacute;lculo<br /> Cart&atilde;o Ponto</a></li>
        <li><a href="index.php?pag=formularios&cat=cartapreposicao" class="duaslinhas">Carta de Preposi&ccedil;&atilde;o</a></li>
        <li><a href="/cartaoponto" class="umalinha">Cart&atilde;o Ponto</a></li>
        <li><a href="index.php?pag=formularios&cat=dispensa" class="duaslinhas">Comunicado de Dispensa</a></li>
        <li><a href="index.php?pag=formularios&cat=demissao" class="umalinha">Demiss&atilde;o</a></li>
        <li><a href="index.php?pag=formularios&cat=dut" class="umalinha">DUT</a></li>
        <li><a href="index.php?pag=formularios&cat=irpf" class="umalinha">IRPF</a></li>
        <li><a href="index.php?pag=formularios&cat=ctps" class="duaslinhas">Recibo de Entrega de CTPS</a></li>
        
        <li><a href="index.php?pag=formularios&cat=rescisao" class="duaslinhas">Simula&ccedil;&atilde;o de Demiss&atilde;o</a></li>   
        <li><a href="index.php?pag=formularios&cat=aditivo" class="treslinhas">Termo aditivo ao contrato de trabalho</a></li>        
</ul>

<?php
switch(@$id_categoria)
{
	case "admissao":
	$tituloform = "Admiss&atilde;o";
	break;
	
	case "admissao_domesticos":
	$tituloform = "Admiss&atilde;o Dom&eacute;sticos";
	break;
	
	case "advertencia":
	$tituloform = "Advert&ecirc;ncia";
	break;
	
	case "avisoprevio":
	$tituloform = "Aviso Pr&eacute;vio";
	break;
	
	case "horaextra":
	$tituloform = "C&aacute;lculo de Hora Extra";
	break;
	
	case "demissao":
	$tituloform = "Demiss&atilde;o";
	break;
	
	case "dut":
	$tituloform = "DUT";
	break;
	
	case "irpf":
	$tituloform = "IRPF";
	break;
	
	case "ctps":
	$tituloform = "Recibo de Entrega de CTPS";
	break;
	
	case "rescisao":
	$tituloform = "Simula&ccedil;&atilde;o de Demiss&atilde;o";
	break;
	
	case "aditivo":
	$tituloform = "Termo aditivo ao contrato de trabalho";
	break;
	
	case "dispensa":
	$tituloform = "Comunicado de Dispensa";
	break;
	
	case "cartapreoposicao":
	$tituloform = "Carta de Preposi&ccedil;&atilde;o";
	break;
	
	case "suspensao":
	$tituloform = "Formul&aacute;rio de Suspens&atilde;o de Empregado";
	break;
}

if($id_categoria == "irpf")
{
?>

<script type="text/javascript">
$(function(){
	$(".esconde").hide();
	$("#formularios").validate();
	
	$(".valor").maskMoney({
		showSymbol:false, 
		symbol:"", 
		decimal:",", 
		thousands:".",
		allowZero: true
	});
	
	$("input[name='pdbv']").click(function(){
		$(".pdbvsim").hide();
		var valor = $(this).val();
		$(".pdbvsim").show();

		if(valor == "sim")
		{
			//$("input[name='nbvdeanopassado']").removeClass("required");
			//$("input[name='bvdeanopassado']").addClass("required");
			//$(".form2").hide();
		}
		else if(valor == "nao")
		{
			
			//$("input[name='nbvdeanopassado']").addClass("required");
			//$("input[name='bvdeanopassado']").removeClass("required");
			//$(".form1 input").removeClass("required");
			//$(".form1").hide();
		}
	});
	
	$("input[name='bvdeanopassado']").click(function(){
		var valor = $(this).val();
		
		if(valor == "sim")
		{
			$(".bvdeanopassadosim").show();
			//$(".bvdeanopassadosim input").addClass("required");
			$(".bvdeanopassadonao").hide();
			$(".bvdeanopassadonao input").removeClass("required");
			$("#frase1").empty().html("novos");
		}
		else
		{
			$(".bvdeanopassadosim input").removeClass("required");
			$(".bvdeanopassadosim").hide();
			$(".bvdeanopassadonao").show();
			//$(".bvdeanopassadonao input").addClass("required");
			$("#frase1").empty().html("");
		}
	});
	
	$("input[name='bvenviapessoalmente']").click(function(){
		var valor = $(this).val();
		if(valor == "nao")
		{
			$(".bvenviapessoalmente").show();
			//$(".bvenviapessoalmente input").addClass("required");
		}
		else
		{
			$(".bvenviapessoalmente input").removeClass("required");
			$(".bvenviapessoalmente").hide();
		}
	});
	
	$("input[name='nbvdeanopassado']").click(function(){
		/*
		var valor = $(this).val();
		if(valor == "sim")
		{
			$(".nbvdeanopassadosim").show();
			//$(".nbvdeanopassadosim input").addClass("required");
			$(".bvdeanopassadonao").hide();
			$(".bvdeanopassadonao input").removeClass("required");
			$("#frase1").empty().html("novos");
		}
		else
		{
			$(".nbvdeanopassadosim input").removeClass("required");
			$(".nbvdeanopassadosim").hide();
			//$(".bvdeanopassadonao input").addClass("required");
			$(".bvdeanopassadonao").show();
			$("#frase1").empty().html("");
		}
		*/
	});
	
	$("input[name='nbvmudanca']").click(function(){
		var valor = $(this).val();
		if(valor == "sim")
		{
			$(".nbvmudancas").show();
			//$(".nbvmudancas input").addClass("required");
			$(".nbvmudancan").hide();
			$(".nbvmudancan input").removeClass("required");
			//$(".bvdeanopassadonao input").addClass("required");
		}
		else
		{
			$(".nbvmudancas").hide();
			$(".nbvmudancas input").removeClass("required");
			$(".nbvmudancan").show();
			//$(".nbvmudancan input").addClass("required");
			$(".bvdeanopassadonao input").removeClass("required");
		}
	});
	
	$("#campodependentes table").hide();
	$("input[name='novosdependentes']").click(function(){
		var valor = $(this).val();
		if(valor == "sim")
		{
			$(".novosdependentess").show();
			$("#campodependentes1").show();
			$(".novosdependentess").find(".cpf2").setMask("cpf");
		}
		else{
			$(".novosdependentess").hide().find("input").removeClass("required");
			$(".novosdependentess").find(".cpf2").setMask("");
		}
	});
	
	$("#campoedu table").hide();
	$("input[name='despesasedu']").click(function(){
		var valor = $(this).val();
		if(valor == "sim")
		{
			$(".despesasedus").show();
			$("#campoedu1").show();
			$(".despesasedus").find(".cnpj2").setMask("cnpj");
		}
		else
		{
			$(".despesasedus").hide().find("input").removeClass("required");
			$(".despesasedus").find(".cnpj2").setMask("");
		}
	});
	
	$("#campomedica table").hide();
	$("input[name='despesasmedica']").click(function(){
		var valor = $(this).val();
		if(valor == "sim")
		{
			$(".despesasmedicas").show();
			$("#campomedica1").show();
			$(".despesasmedicas").find(".cpfcnpj").setMask("cpfcnpj");
		}
		else
		{
			$(".despesasmedicas").hide().find("input").removeClass("required");
			$(".despesasmedicas").find(".cpfcnpj").setMask("");
		}
	});
	
	$("#campoempregado table").hide();
	$("input[name='despesasempregado']").click(function(){
		var valor = $(this).val();
		if(valor == "sim")
		{
			$(".despesasempregados").show();
			$("#campoempregado1").show();
			$(".despesasempregados").find(".cpf2").setMask("cpf");
		}
		else
		{
			$(".despesasempregados").hide().find("input").removeClass("required");
			$(".despesasempregados").find(".cpf2").setMask("cpf");
		}
	});
	
	$("input[name='comprabens']").click(function(){
		var valor = $(this).val();
		if(valor == "sim")
		{
			$(".comprabenss").show();
			//$(".comprabenss").find("textarea").addClass("required");
		}
		else
		{
			$(".comprabenss").hide().find("input").removeClass("required");
			$(".comprabenss").find("textarea").removeClass("required");
		}
	});
	
	var count = 1;
	$(".adddependente").click(function(){
		count++;	
		if(count > 7)
			count = 7;		
		$("#campodependentes"+count).show();
						  
	});
	$(".removedependente").click(function(){
		if(count > 1)
		{
			$("#campodependentes"+count).hide().find("input").removeClass("required");
			count--;
		}
	});
	
	
	var count2 = 1;
	$(".addedu").click(function(){
		count2++;
		if(count2 > 7)
			count2 = 7;			
		$("#campoedu"+count2).show();
	});
	$(".removeedu").click(function(){
		if(count2 > 1)
		{
			$("#campoedu"+count2).hide().find("input").removeClass("required");
			count2--;
		}
	});
	
	var count3 = 1;
	$(".addmedica").click(function(){
		count3++;
		if(count3 > 7)
			count3 = 7;	
		$("#campomedica"+count3).show();
						  
	});
	$(".removemedica").click(function(){
		if(count3 > 1)
		{
			$("#campomedica"+count3).hide().find("input").removeClass("required");
			count3--;
		}
	});
	
	var count4 = 1;
	$(".addempregado").click(function(){
		count4++;
		if(count4 > 7)
			count4 = 7;			
		$("#campoempregado"+count4).show();
	});
	$(".removeempregado").click(function(){
		if(count4 > 1)
		{
			$("#campoempregado"+count4).hide().find("input").removeClass("required");
			count4--;
		}
		
	});
	
	$(".adddeclaracao").click(function(){
		$(".declaracoes").append('<span><br /><input type="file" name="declaracaoanterior[]" class="inputbox" style="width:190px;" /></span>');
	});
	$(".removedeclaracao").click(function(){
			$(".declaracoes span").last().remove();	
	});
	
	
	$(".addcomprovante").click(function(){
						
		$(".comprovantes").append('<span><br /><input type="file" name="comprovantes[]" class="inputbox" style="width:190px;" /></span>');
	});
	$(".removecomprovante").click(function(){
			$(".comprovantes span").last().remove();	
	});
	
	$(".addextrato").click(function(){
						
		$(".extratos").append('<span><br /><input type="file" name="extratos[]" class="inputbox" style="width:190px;" /></span>');
	});
	$(".removeextrato").click(function(){
			$(".extratos span").last().remove();	
	});
	
	$(".addbens").click(function(){
		var itens = $("#campobens0").html();
		$("#campobens").append('<span>'+itens+'</span>');
		//$("#campobens").find("textarea").addClass("required");
	});
	$(".removebens").click(function(){
			$("#campobens span").last().remove();
			$("#campobens").find("textarea").removeClass("required");
	});
	
	
	$("#formularios").submit(function(){

		/*
		var count = 0;
		var ano = "<?php echo date("Y");?>";
		$("input[name='cpf_parente[]']").each(function(i) {
  			if($(".cpf-"+count).val() != "")  
			{
				var data = ($(".data-"+count).val()).split("/");
				var idade = ano - data[2];
				
				alert(idade)
				return false;
			}
			count++;
        });
		*/
		//return true;
		
	});
	
	
	$(".cpfcnpj").focus(function(){
		$(this).setMask("99999999999999");	
	});
	$(".cpfcnpj").blur(function(){
		var tamanho = $(this).val().length;
		if(tamanho == 11)
			$(".cpfcnpj").setMask("cpf");
		else if(tamanho > 11)
			$(".cpfcnpj").setMask("cnpj");
	});
	$(".cpf").setMask("cpf");
	$(".cnpj").setMask("cnpj");
	
	
	$("#cep").setMask("99999-999");
	$("#telefone").setMask("(99) 999999999");
	$("#titulo_eleitor").setMask("9999999999999999");
	$("#numero").setMask("99999999");
	$(".data_nasc").setMask("99/99/9999");
	$("#cep").blur(function(){
		var cep = $(this).val();
		
		$.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+cep, function(){
			if(resultadoCEP["resultado"] == 1) {
				$("#endereco").val(unescape(resultadoCEP["tipo_logradouro"])+" "+unescape(resultadoCEP["logradouro"]));
				$("#bairro").val(unescape(resultadoCEP["bairro"]));
				$("#cidade").val(unescape(resultadoCEP["cidade"]));
				$("#estado").val(unescape(resultadoCEP["uf"]));
				$("#numero").focus();
			} else if(resultadoCEP["resultado"] == 2) {
				$("#cidade").val(unescape(resultadoCEP["cidade"]));
				$("#estado").val(unescape(resultadoCEP["uf"]));
				$("#endereco").focus();
			} else {
				alert("Endereço não encontrado");
			}
		});
	});
	
	var datalimite = <?php echo strtotime("-18 years",strtotime(date("Y-m-d")));?>;
	$(".data_nasc").blur(function(){
		var campo = $(this).parent().parent().parent().parent().attr("id");
		
		
		var data = ($(this).val()).split("/");
		data = data[2]+"-"+data[1]+"-"+data[0];
		data2 = new Date(data);
		data2 = (data2.getTime()) / 1000;
		
		if(data2 <= datalimite)
			$("#"+campo).find(".cpf").addClass("required");
		else
			$("#"+campo).find(".cpf").removeClass("required");
	})
	
});
</script>
<form action="paginas/envia.php?op=irpf" method="post" id="formularios" enctype="multipart/form-data">
	<h3 align='center' style='margin-top: 20px;'><?php echo @$tituloform;?></h3>
	<table cellpadding="10" cellspacing="0" width="100%" class="tblform">
    	<tr>
        	<td valign="top">Nome:<br /><input type="text" name="nome" class="inputbox required" style="width:250px;" /></td>
            <td valign="top">CPF:<br /><input type="text" name="cpf" class="inputbox cpf required" style="width:250px;" /></td>
		</tr>
        <tr>
        	<td valign="top">E-mail:<br /><input type="text" name="email" class="inputbox required email" style="width:250px;" /></td>
            <td valign="top">Telefone:<br /><input type="text" name="telefone" id="telefone" class="inputbox required" style="width:250px;" /></td>
		</tr>
        <tr>
        	<td valign="top" colspan="2">Banco:<br />
            	<select name="banco" class="inputbox required"  style="width:560px;">
					<option value="">Selecione...</option>
						<?php
                        $sqlbanco = mysql_query("SELECT * FROM bancos ORDER BY banco");
                        while($regbanco = mysql_fetch_array($sqlbanco))
                        {
                            echo "<option value='".$regbanco['codigo']." - ".utf8_encode($regbanco['banco'])."'>".$regbanco['codigo']." - ".utf8_encode($regbanco['banco'])."</option>";
            
                        }
                        ?>
				</select>
            </td>
		</tr>
        <tr>
        	<td valign="top">Ag&ecirc;ncia:<br /><input type="text" name="agencia" class="inputbox required" style="width:250px;" /></td>
            <td valign="top">Conta:<br /><input type="text" name="conta_corrente" class="inputbox required" style="width:250px;" /></td>
		</tr>
        <tr><td colspan="2"><hr /></td></tr>
        <tr>
        	<td valign="top" colspan="2" align="center">Primeira declara&ccedil;&atilde;o feita pela BV Contabilidade?<br />
            	<label><input type="radio" class="required" name="pdbv" value="sim" /> Sim</label>&nbsp;&nbsp;&nbsp;
                <label><input type="radio" name="pdbv" value="nao" /> N&atilde;o</label>
          	</td>
       	</tr>
        <tr class="form1 pdbvsim esconde">
        	<td valign="top" colspan="2" align="center">Declarou ano passado?<br />
            	<label><input type="radio" class="" name="bvdeanopassado" value="sim" /> Sim</label>&nbsp;&nbsp;&nbsp;
                <label><input type="radio" name="bvdeanopassado" value="nao" /> N&atilde;o</label>
          	</td>
       	</tr>

        <tr class="form1 bvdeanopassadosim esconde">
        	<td valign="top" colspan="2" align="center">Como deseja entregar a declaração do ano passado?<br />
            	<label><input type="radio" name="bvenviapessoalmente" value="Pessoalmente" /> Pessoalmente</label>&nbsp;&nbsp;&nbsp;
                <label><input type="radio" name="bvenviapessoalmente" value="nao" /> Atrav&eacute;s do site</label>
          	</td>
       	</tr>
        <tr class="form1 bvenviapessoalmente esconde">
        	<td valign="top" align="right">Enviar declara&ccedil;&atilde;o anterior:</td>
            <td valign="top"><input type="file" name="declaracaoanterior[]" class="inputbox" style="width:190px;" /><!--&nbsp;<a class="adddeclaracao" style="cursor: pointer;" title="Adicionar mais declara&ccedil;&atilde;o">[+]</a> <a class="removedeclaracao" style="cursor: pointer;" title="Remover declara&ccedil;&atilde;o">[ - ]</a>
                <span class="declaracoes"></span>-->
            </td>
		</tr>
        <tr class="form1 bvenviapessoalmente esconde">
        	<td valign="top" align="right">Enviar recibo:</td>
            <td valign="top"><input type="file" name="reciboanterior[]" class="inputbox" style="width:190px;" /></td>
		</tr>       
        
        
        
        <tr class="form2 nbvdeanopassadosim">
        	<td valign="top" colspan="2" align="center">Houve mudan&ccedil;a de endere&ccedil;o?<br />
            	<label><input type="radio" class="required" name="nbvmudanca" value="sim" /> Sim</label>&nbsp;&nbsp;&nbsp;
                <label><input type="radio" name="nbvmudanca" value="nao" /> N&atilde;o</label>
          	</td>
       	</tr>
        
        
        <tr class="form1 bvdeanopassadonao esconde">
        	<td valign="top">T&iacute;tulo de eleitor:<br /><input type="text" name="titulo_eleitor" id="titulo_eleitor" class="inputbox" style="width:250px;" /></td>
            <td valign="top">Data de nascimento: (DD/MM/AAAA)<br /><input type="text" name="data_nascimento" class="inputbox required data_nasc datamascara" style="width:250px;" /></td>
		</tr>
        <tr class="form1 bvdeanopassadonao nbvmudancas esconde">
        	<td valign="top">CEP:<br /><input type="text" name="cep" id="cep" class="inputbox required" style="width:250px;" /></td>
            <td valign="top">Endere&ccedil;o:<br /><input type="text" name="endereco" id="endereco" class="inputbox required" style="width:250px;" /></td>
		</tr>
        <tr class="form1 bvdeanopassadonao nbvmudancas esconde">
        	<td valign="top">N&uacute;mero:<br /><input type="text" name="numero" id="numero" class="inputbox required" style="width:250px;" /></td>
            <td valign="top">Bairro:<br /><input type="text" name="bairro" id="bairro" class="inputbox required" style="width:250px;" /></td>
		</tr>
        <tr class="form1 bvdeanopassadonao nbvmudancas esconde">
        	<td valign="top">Cidade:<br /><input type="text" name="cidade" id="cidade" class="inputbox required" style="width:250px;" /></td>
            <td valign="top">Estado:<br /><input type="text" name="estado" id="estado" class="inputbox required" style="width:250px;" /></td>
		</tr>
        <tr class="form1 bvdeanopassadonao nbvmudancas esconde">
        	<td valign="top" colspan="2">
            	<select name="ocupacao" class="inputbox" style="width:550px;">
                	<option value="">Natureza Ocupa&ccedil;&atilde;o e Ocupa&ccedil;&atilde;o Principal:</option>
                	<optgroup label="Membros Superiores, Dirigentes e Servidores do Poder Público e de Organizações de Interesse Público">
						<option value="101-Membro do Poder Executivo (Presidente da República, Vice-Presidente da República, Ministro de Estado, Governador, etc)">101-Membro do Poder Executivo (Presidente da República, Vice-Presidente da República, Ministro de Estado, Governador, etc)</option>
                        <option value="102-Membro do Poder Judiciário (Ministro, Juiz e Desembargador) e de Tribunal de Contas (Ministro e Conselheiro)">102-Membro do Poder Judiciário (Ministro, Juiz e Desembargador) e de Tribunal de Contas (Ministro e Conselheiro)</option>
                        <option value="103-Membro do Poder Legislativo (Senador, Deputado Federal, Deputado Estadual e Vereador)">103-Membro do Poder Legislativo (Senador, Deputado Federal, Deputado Estadual e Vereador)</option>
                        <option value="104-Membro do Ministério Público (Procurador e Promotor)">104-Membro do Ministério Público (Procurador e Promotor)</option>
                        <option value="105-Dirigente superior da administração pública (ocupante de cargo de direção, chefia, assessoria e de natureza especial)">105-Dirigente superior da administração pública (ocupante de cargo de direção, chefia, assessoria e de natureza especial)</option>
                        <option value="106-Diplomata e afins">106-Diplomata e afins</option>
                        <option value="107-Servidor das carreiras do Poder Legislativo">107-Servidor das carreiras do Poder Legislativo</option>
                        <option value="108-Servidor das carreiras do Ministério Público">108-Servidor das carreiras do Ministério Público</option>
                        <option value="109-Servidor das carreiras do Poder Judiciário, Oficial de Justiça, Auxiliar, Assistente e Analista Judiciário">109-Servidor das carreiras do Poder Judiciário, Oficial de Justiça, Auxiliar, Assistente e Analista Judiciário</option>
                        <option value="110-Advogado do setor público, Advogado da união, Procurador da Fazenda, Consultor Jurídico, Procurador de autarquias etc">110-Advogado do setor público, Advogado da união, Procurador da Fazenda, Consultor Jurídico, Procurador de autarquias etc</option>
                        <option value="111-Servidor das carreiras de auditoria fiscal e de fiscalização">111-Servidor das carreiras de auditoria fiscal e de fiscalização</option>
                        <option value="112-Servidor das carreiras do Banco Central, CVM e Susep">112-Servidor das carreiras do Banco Central, CVM e Susep</option>
                        <option value="113-Delegado de Polícia e outros servidores das carreiras de polícia, exceto militar">113-Delegado de Polícia e outros servidores das carreiras de polícia, exceto militar</option>
                        <option value="114-Servidor das carreiras de gestão governamental, analista, gestor e técnico de planejamento">114-Servidor das carreiras de gestão governamental, analista, gestor e técnico de planejamento</option>
                        <option value="115-Servidor das carreiras de ciência e tecnologia">115-Servidor das carreiras de ciência e tecnologia</option>
                        <option value="116-Servidor das demais carreiras da administração pública direta, autárquica e fundacional">116-Servidor das demais carreiras da administração pública direta, autárquica e fundacional</option>
                        <option value="117-Titular de Cartório">117-Titular de Cartório</option>
                        <option value="118-Dirigente ou administrador de partido político, organização patronal, sindical, filantrópica e religiosa">118-Dirigente ou administrador de partido político, organização patronal, sindical, filantrópica e religiosa</option>
                	</optgroup>
                    <optgroup label="Dirigentes e Gerentes">
                    	<option value="120-Dirigente, presidente e diretor de empresa industrial, comercial ou prestadora de serviços">120-Dirigente, presidente e diretor de empresa industrial, comercial ou prestadora de serviços</option>
                        <option value="121-Presidente e diretor de empresa pública e sociedade de economia mista">121-Presidente e diretor de empresa pública e sociedade de economia mista</option>
                        <option value="130-Gerente ou supervisor de empresa industrial, comercial ou prestadora de serviços">130-Gerente ou supervisor de empresa industrial, comercial ou prestadora de serviços</option>
                        <option value="131-Gerente ou superior de empresa pública e sociedade de economia mista">131-Gerente ou superior de empresa pública e sociedade de economia mista</option>
                        <option value="140-Presidente, diretor, gerente e supervisor de organismo internacional e de organização não governamental">140-Presidente, diretor, gerente e supervisor de organismo internacional e de organização não governamental</option>
                 	</optgroup>
                    <optgroup label="Profissionais das Ciências Exatas, Físicas, Químicas e da Engenharia">
                    	<option value="211-Matemático, estatístico, atuário e afins">211-Matemático, estatístico, atuário e afins</option>
                        <option value="212-Analista de sistemas, desenvolvedor de software, administrador de redes e bancos de dados e outros especialistas em informática (exceto técnico)">212-Analista de sistemas, desenvolvedor de software, administrador de redes e bancos de dados e outros especialistas em informática (exceto técnico)</option>
                        <option value="213-Físico, químico, metereologista, geólogo, oceanógrafo e afins">213-Físico, químico, metereologista, geólogo, oceanógrafo e afins</option>
                        <option value="214-Engenheiro, arquiteto e afins">214-Engenheiro, arquiteto e afins</option>
                    	<option value="215-Piloto de aeronaves, comandante de embarcações e oficiais de máquinas">215-Piloto de aeronaves, comandante de embarcações e oficiais de máquinas</option>
                   	</optgroup>
                    <optgroup label="Profissionais das Ciências Biológicas, Bioquímicas, da Saúde e Afins">
                    	<option value="221-Biólogo, biométrico e afins">221-Biólogo, biométrico e afins</option>
                        <option value="222-Agrônomo e afins">222-Agrônomo e afins</option>
                        <option value="224-Profissional da educação física (exceto professor)">224-Profissional da educação física (exceto professor)</option>
                        <option value="225-Médico">225-Médico</option>
                        <option value="226-Odontólogo">226-Odontólogo</option>
                        <option value="227-Enfermeiro de nível superior, nutricionista, farmacêutico e afins">227-Enfermeiro de nível superior, nutricionista, farmacêutico e afins</option>
                        <option value="228-Veterinário, patologista (veterinário) e zootecnista">228-Veterinário, patologista (veterinário) e zootecnista</option>
                        <option value="229-Fonoaudiólogo, fisioterapeuta, terapeuta ocupacional e afins">229-Fonoaudiólogo, fisioterapeuta, terapeuta ocupacional e afins</option>
                  	</optgroup>
                    <optgroup label="Profissionais das Ciências Jurídicas, Sociais e Humanas">
                    	<option value="241-Advogado">241-Advogado</option>
                        <option value="250-Sociólogo e cientista político">250-Sociólogo e cientista político</option>
                        <option value="251-Antropólogo e arqueólogo">251-Antropólogo e arqueólogo</option>
                        <option value="252-Economista, administrador, contador, auditor e afins">252-Economista, administrador, contador, auditor e afins</option>
                        <option value="253-Profissional de relações públicas, de marketing, de publicidade e de comercialização">253-Profissional de relações públicas, de marketing, de publicidade e de comercialização</option>
                        <option value="255-Psicólogo e psicanalista">255-Psicólogo e psicanalista</option>
                        <option value="256-Geógrafo">256-Geógrafo</option>
                        <option value="257-Historiador">257-Historiador</option>
                        <option value="258-Assistente social e economista doméstico">258-Assistente social e economista doméstico</option>
                        <option value="259-Filósofo">259-Filósofo</option>
                  	</optgroup>
                    <optgroup label="Profissionais das Letras, das Artes, da Comunicação e Religiosos">
                    	<option value="261-Jornalista e repórter">261-Jornalista e repórter</option>
                        <option value="263-Sacerdote ou membro de ordens ou seitas religiosas">263-Sacerdote ou membro de ordens ou seitas religiosas</option>
                        <option value="264-Tradutor, intérprete, filósofo">264-Tradutor, intérprete, filósofo</option>
                        <option value="265-Bibliotecário, documentarista, arquivólogo, museólogo">265-Bibliotecário, documentarista, arquivólogo, museólogo</option>
                        <option value="266-Escritor, crítico, redator">266-Escritor, crítico, redator</option>
                        <option value="271-Locutor, comentarista">271-Locutor, comentarista</option>
                        <option value="272-Ator, diretor de espetáculos">272-Ator, diretor de espetáculos</option>
                        <option value="273-Cantor e compositor">273-Cantor e compositor</option>
                        <option value="274-Músico, arranjador, regente de orquestra ou coral">274-Músico, arranjador, regente de orquestra ou coral</option>
                        <option value="275-Desenhista industrial (designer), escultor, pintor artístico e afins">275-Desenhista industrial (designer), escultor, pintor artístico e afins</option>
                        <option value="276-Cenógrafo, decorador de interiores">276-Cenógrafo, decorador de interiores</option>
                        <option value="277-Empresário e produtor de espetáculos">277-Empresário e produtor de espetáculos</option>
                        <option value="279-Outros profissionais do espetáculo e das artes">279-Outros profissionais do espetáculo e das artes</option>
                   	</optgroup>
                 	<optgroup label="Profissionais do Ensino">
                        <option value="290-Professor na educação infantil">290-Professor na educação infantil</option>
                        <option value="291-Professor do ensino fundamental">291-Professor do ensino fundamental</option>
                        <option value="292-Professor do ensino médio">292-Professor do ensino médio</option>
                        <option value="293-Professor do ensino profissional">293-Professor do ensino profissional</option>
                        <option value="294-Professor do ensino superior">294-Professor do ensino superior</option>
                        <option value="295-Instrutor e professor de escolas livres">295-Instrutor e professor de escolas livres</option>
                        <option value="296-Pedagogo, orientador educacional">296-Pedagogo, orientador educacional</option>
                    </optgroup>
                    <optgroup label="Técnicos de Nível Médio das Ciências Físicas, Químicas, Engenharia e Afins">
                        <option value="311-Técnico em ciências físicas e químicas">311-Técnico em ciências físicas e químicas</option>
                        <option value="312-Técnico em construção civil, de edificações e obras de infra-estrutura">312-Técnico em construção civil, de edificações e obras de infra-estrutura</option>
                        <option value="313-Técnico em eletro-eletrônica e fotônica">313-Técnico em eletro-eletrônica e fotônica</option>
                        <option value="314-Técnico em em metalmecânica">314-Técnico em em metalmecânica</option>
                        <option value="316-Técnico em minralogia e geologia">316-Técnico em minralogia e geologia</option>
                        <option value="317-Técnico em em informática">317-Técnico em em informática</option>
                        <option value="318-Desenhista técnico e modelista">318-Desenhista técnico e modelista</option>
                        <option value="319-Outros técnicos de nível médio das ciências físicas, químicas, engenharia e afins">319-Outros técnicos de nível médio das ciências físicas, químicas, engenharia e afins</option>
                     </optgroup>
                     <optgroup label="Técnicos de Nível Médio das Ciências Biológicas, Bioquímicas, da Saúde e Afins">
                        <option value="320-Técnico em biologia">320-Técnico em biologia</option>
                        <option value="321-Técnico da produção agropecuária">321-Técnico da produção agropecuária</option>
                        <option value="322-Técnico da da ciência da saúde humana">322-Técnico da da ciência da saúde humana</option>
                        <option value="323-Técnico da da ciência da saúde animal">323-Técnico da da ciência da saúde animal</option>
                        <option value="324-Técnico de laboratório, Raios-X e outros equipamentos e instrumentos de diagnóstico">324-Técnico de laboratório, Raios-X e outros equipamentos e instrumentos de diagnóstico</option>
                        <option value="325-Técnico de bioquímica e da biotecnologia">325-Técnico de bioquímica e da biotecnologia</option>
                        <option value="328-Técnico de conservação, dissecação e empalhamento de corpos">328-Técnico de conservação, dissecação e empalhamento de corpos</option>
                     </optgroup>   
                     <optgroup label="Técnicos de Nível Médio em Serviços de Transportes">
                        <option value="341-Técnico da em navegação aérea, marítima, fluvial e metroferroviária">341-Técnico da em navegação aérea, marítima, fluvial e metroferroviária</option>
                        <option value="342-Técnico da em transportes (logística)">342-Técnico da em transportes (logística)</option>
                     </optgroup>   
                     <optgroup label="Técnicos de Nível Médio nas Ciências Administrativas">
                        <option value="351-Técnico das ciências administrativas e contábeis">351-Técnico das ciências administrativas e contábeis</option>
                       	<option value="352-Técnico de inspeção, fiscalização e coordenação administrativa">352-Técnico de inspeção, fiscalização e coordenação administrativa</option>
                       	<option value="353-Agente de Bolsa de Valores, câmbio e outros serviços financeiros">353-Agente de Bolsa de Valores, câmbio e outros serviços financeiros</option>
                       	<option value="354-Agente e representante comercial, corretor, leiloeiro e afins">354-Agente e representante comercial, corretor, leiloeiro e afins</option>
                      </optgroup>   
                     <optgroup label="Técnicos de Nível Médio dos Serviços Culturais, das Comunicações e dos Desportos">
                        <option value="371-Técnico de serviços culturais">371-Técnico de serviços culturais</option>
                        <option value="372-Cinegrafista, fotógrafo e outros técnicos em operação de máquinas de tratamento de dados">372-Cinegrafista, fotógrafo e outros técnicos em operação de máquinas de tratamento de dados</option>
                        <option value="373-Ténico em operação de estações de rádio e televisão">373-Ténico em operação de estações de rádio e televisão</option>
                        <option value="374-Técnico em operação de aparelhos de sonorização, cenografia e projeção">374-Técnico em operação de aparelhos de sonorização, cenografia e projeção</option>
                        <option value="375-Decorador e vitrinista">375-Decorador e vitrinista</option>
                        <option value="376-Apresentador, artistas de artes populares e modelos">376-Apresentador, artistas de artes populares e modelos</option>
                        <option value="377-Atleta, desportista e afins">377-Atleta, desportista e afins</option>
                     </optgroup>   
                     <optgroup label="Outros Técnicos de Nível Médio">
                        <option value="391- Outros Técnicos de Nível Médio">391- Outros Técnicos de Nível Médio</option>
                     </optgroup>   
                     <optgroup label="Trabalhadores de Serviços Administrativos">
                        <option value="410-Bancário, economiário, escriturário, secretário, assistente e auxiliar administrativo">410-Bancário, economiário, escriturário, secretário, assistente e auxiliar administrativo</option>
                        <option value="420-Trabalhador de atendimento ao público, caixa, despachante, recenseador e afins">420-Trabalhador de atendimento ao público, caixa, despachante, recenseador e afins</option>
                     </optgroup>   
                     <optgroup label="Trabalhadores de Serviços Diversos">
                        <option value="511-Comissário de bordo, guia turístico, agente de viagens e afins">511-Comissário de bordo, guia turístico, agente de viagens e afins</option>
                        <option value="512-Trabalhador dos serviços domésticos em geral">512-Trabalhador dos serviços domésticos em geral</option>
                        <option value="513-Trabalhador dos serviços de hotelaria e alimentação">513-Trabalhador dos serviços de hotelaria e alimentação</option>
                        <option value="514- Trabalhador dos serviços de administração, conservação e manutenção de edifícios">514- Trabalhador dos serviços de administração, conservação e manutenção de edifícios</option>
                        <option value="515-Trabalhador dos serviços de saúde">515-Trabalhador dos serviços de saúde</option>
                        <option value="516- Trabalhador dos serviços de embelezamento e cuidados pessoais">516- Trabalhador dos serviços de embelezamento e cuidados pessoais</option>
                        <option value="517- Trabalhador dos serviços de proteção e segurança (exceto militar)">517- Trabalhador dos serviços de proteção e segurança (exceto militar)</option>
                        <option value="518-Motorista e condutor do transporte de passageiros (motorista de taxi, ônibus, pequena embarcação etc)">518-Motorista e condutor do transporte de passageiros (motorista de taxi, ônibus, pequena embarcação etc)</option>
                        <option value="519-Outros trabalhadores de serviços diversos">519-Outros trabalhadores de serviços diversos</option>
                     </optgroup>   
                     <optgroup label="Vendedores e Prestadores de Serviços de Comércio">
                        <option value="529-Vendedor e prestador de serviços do comércio, ambulente, caixeiro-viajante e camelô">529-Vendedor e prestador de serviços do comércio, ambulente, caixeiro-viajante e camelô</option>
                     </optgroup>   
                     <optgroup label="Trabalhadores do Setor Primário">
                        <option value="610-Produtor na exploração agropecuária">610-Produtor na exploração agropecuária</option>
                        <option value="620-Trabalhador na exploração agropecuária">620-Trabalhador na exploração agropecuária</option>
                        <option value="630-Pescador, caçador e extrativista florestal">630-Pescador, caçador e extrativista florestal</option>
                        <option value="640-Operador de máquina agropecuária e florestal">640-Operador de máquina agropecuária e florestal</option>
                     </optgroup>   
                     <optgroup label="Trabalhadores das Indústrias">
                        <option value="710-Trabalhador da indústria extrativista e da construção civil">710-Trabalhador da indústria extrativista e da construção civil</option>
                        <option value="720-Trabalhador da transformação de metais e compósitos">720-Trabalhador da transformação de metais e compósitos</option>
                        <option value="730-Trabalhador da fabricação e instalação eletro-eletônica">730-Trabalhador da fabricação e instalação eletro-eletônica</option>
                        <option value="740-Montador de aparelhos e instrumentos de precisão e musicais">740-Montador de aparelhos e instrumentos de precisão e musicais</option>
                        <option value="750-Joalheiro, vidreiro, ceramista e afins">750-Joalheiro, vidreiro, ceramista e afins</option>
                        <option value="760-Trabalhador das indústrias têxteis, do curtimento, do vestuário e das artes gráficas">760-Trabalhador das indústrias têxteis, do curtimento, do vestuário e das artes gráficas</option>
                        <option value="770-Trabalhador das indústrias de madeira e do mobiliário">770-Trabalhador das indústrias de madeira e do mobiliário</option>
                        <option value="780-Condutor e operador de robôs, veículos de equipamentos de movimentação de carga e afins">780-Condutor e operador de robôs, veículos de equipamentos de movimentação de carga e afins</option>
                       	<option value="810-Trabalhador das indústrias química, petroquímica, borracha e plástico e afins">810-Trabalhador das indústrias química, petroquímica, borracha e plástico e afins</option>
                        <option value="820-Trabalhador de instalações siderúrgicas e de materiais de construção">820-Trabalhador de instalações siderúrgicas e de materiais de construção</option>
                        <option value="830-Trabalhador de instalações e máquinas de fabricação de celulose e papel">830-Trabalhador de instalações e máquinas de fabricação de celulose e papel</option>
                        <option value="840-Trabalhador da fabricação de alimentos, bebidas, fumo e de agroindústrias">840-Trabalhador da fabricação de alimentos, bebidas, fumo e de agroindústrias</option>
                        <option value="860-Operador de instalações de produção e distribuição de energia">860-Operador de instalações de produção e distribuição de energia</option>
                        <option value="870-Trabalhador de outras instalações agroindustriais">870-Trabalhador de outras instalações agroindustriais</option>
                     </optgroup>   
                     <optgroup label="Trabalhadores de Reparação e Manutenção">
                        <option value="900-Trabalhador de reparação e manutenção">900-Trabalhador de reparação e manutenção</option>
                     </optgroup>   
                     <optgroup label="Militares">
                        <option value="010-Militar da Aeronáutica">010-Militar da Aeronáutica</option>
                        <option value="020-Militar do Exército">020-Militar do Exército</option>
                        <option value="030-Militar da Marinha">030-Militar da Marinha</option>
                        <option value="040-Polícia Militar">040-Polícia Militar</option>
                        <option value="050-Bombeiro Militar">050-Bombeiro Militar</option>
                     </optgroup>   
                     <optgroup label="Outras Ocupações">
                        <option value="000-Outras ocupações não especificadas anteriomente">000-Outras ocupações não especificadas anteriomente</option>
					</optgroup>
              	</select>
            </td>
		</tr>
        
        <tr><td colspan="2"><hr /></td></tr>
        
        <tr>
        	<td valign="top">Existem <span id="frase1"></span> dependentes ou alimentados?</td>
			<td valign="top"><label><input type="radio" class="required" name="novosdependentes" value="sim" /> Sim</label>&nbsp;&nbsp;&nbsp;
                <label><input type="radio" name="novosdependentes" value="nao" /> N&atilde;o</label></td>
       	</tr>
        <tr class="novosdependentess esconde">
        	<td valign="top" colspan="2" align="center" id="campodependentes">
            	<?php
				for($i=0;$i<8;$i++)
				{
				?>
            	<table cellpadding="0" cellspacing="0" id="campodependentes<?php echo $i;?>">
                	<tr>
                        <td valign="top">Grau de parentesco:<br /><input type="text" name="parentesco[<?php echo $i;?>]" class="inputbox" style="width:230px;" /></td>
                        <td valign="top">Nome:<br /><input type="text" name="nomeparente[<?php echo $i;?>]" class="inputbox" style="width:230px;" /></td>
                    </tr>
                    <tr class="novosdependentess esconde">
                        <td valign="top">Data de nascimento: (DD/MM/AAAA)<br /><input type="text" name="data_nascparente[<?php echo $i;?>]" class="inputbox data_nasc datamascara" style="width:230px;" /></td>
                        <td valign="top">CPF:<br /><input type="text" name="cpf_parente[<?php echo $i;?>]" class="inputbox cpf2" style="width:230px;" /></td>
                    </tr>
       			</table>
                <?php
				}
				?>
          	</td>
       	</tr>
        <tr class="novosdependentess esconde">     
            <td colspan="2" align="center">
            <a class="adddependente" style="color: #FFF; cursor:pointer;">[ + ] Adicionar</a>&nbsp;&nbsp;
            <a class="removedependente" style="color: #FFF; cursor:pointer;">[ - ] Remover</a></td>
        </tr>
        <tr class="novosdependentess esconde"><td colspan="2"><hr /></td></tr>
                   
        <tr>
        	<td valign="top">Houve despesas com educação?</td>
			<td valign="top"><label><input type="radio" class="required" name="despesasedu" value="sim" /> Sim</label>&nbsp;&nbsp;&nbsp;
                <label><input type="radio" name="despesasedu" value="nao" /> N&atilde;o</label></td>
       	</tr>
        <tr class="despesasedus esconde">
        	<td colspan="2" align="center" id="campoedu">
            	<?php
				for($a=0;$a<8;$a++)
				{
				?>
            	<table cellpadding="0" cellspacing="0" id="campoedu<?php echo $a;?>">
                    <tr class="despesasedus esconde">
                        <td valign="top">Nome do Contribuinte ou Dependente:<br /><input type="text" name="nome_despesaedu[<?php echo $a;?>]" class="inputbox" style="width:230px;" /></td>
                        <td valign="top">Valor:<br /><input type="text" name="valor_despesaedu[<?php echo $a;?>]" class="inputbox valor" style="width:230px;" /></td>
                    </tr>
                    <tr class="despesasedus esconde">
                    	<td valign="top">Institui&ccedil;&atilde;o:<br /><input type="text" name="empresa_despesaedu[<?php echo $a;?>]" class="inputbox" style="width:230px;" /></td>
                        <td valign="top">CNPJ:<br /><input type="text" name="cnpj_despesaedu[<?php echo $a;?>]" class="inputbox cnpj2" style="width:230px;" /></td>
                    </tr>
        		</table>
                <?php
				}
				?>
          	</td>
       	</tr>
        <tr class="despesasedus esconde">     
            <td colspan="2" align="center">
            <a class="addedu" style="color: #FFF; cursor:pointer;">[ + ] Adicionar</a>&nbsp;&nbsp;
            <a class="removeedu" style="color: #FFF; cursor:pointer;">[ - ] Remover</a></td>
        </tr>
        <tr class="despesasedus esconde"><td colspan="2"><hr /></td></tr>
        <tr>
        	<td valign="top">Houve despesas médicas?</td>
			<td valign="top"><label><input type="radio" class="required" name="despesasmedica" value="sim" /> Sim</label>&nbsp;&nbsp;&nbsp;
                <label><input type="radio" name="despesasmedica" value="nao" /> N&atilde;o</label></td>
       	</tr>
        <tr class="despesasmedicas esconde">
        	<td colspan="2" align="center" id="campomedica">
            	<?php
				for($b=0;$b<8;$b++)
				{
				?>
            	<table cellpadding="0" cellspacing="0" id="campomedica<?php echo $b;?>">
                    <tr class="despesasmedicas esconde">
                        <td>Nome do Contribuinte ou Dependente:<br /><input type="text" name="nome_despesamedica[<?php echo $b;?>]" class="inputbox" style="width:230px;" /></td>
                        <td>Valor:<br /><input type="text" name="valor_despesamedica[<?php echo $b;?>]" class="inputbox valor" style="width:230px;" /></td>
                    </tr>
                    <tr class="despesasmedicas esconde">
                    	<td>Empresa:<br /><input type="text" name="empresa_despesamedica[<?php echo $b;?>]" class="inputbox" style="width:230px;" /></td>
                        <td>CPF / CNPJ:<br /><input type="text" name="cnpj_despesamedica[<?php echo $b;?>]" class="inputbox cpfcnpj" style="width:230px;" /></td>
                    </tr>
        		</table>
                <?php
				}
				?>
          	</td>
       	</tr>
        <tr class="despesasmedicas esconde">     
            <td colspan="2" align="center">
            <a class="addmedica" style="color: #FFF; cursor:pointer;">[ + ] Adicionar</a>&nbsp;&nbsp;
            <a class="removemedica" style="color: #FFF; cursor:pointer;">[ - ] Remover</a></td>
        </tr>
        <tr class="despesasmedicas esconde"><td colspan="2"><hr /></td></tr>
        
        
        <tr>
        	<td valign="top">Houve despesas com empregado dom&eacute;stico?</td>
            <td valign="top"><label><input type="radio" class="required" name="despesasempregado" value="sim" /> Sim</label>&nbsp;&nbsp;&nbsp;
                <label><input type="radio" name="despesasempregado" value="nao" /> N&atilde;o</label></td>
       	</tr>
        <tr class="despesasempregados esconde">
        	<td colspan="2" align="center" id="campoempregado">
            	<?php
				for($c=0;$c<8;$c++)
				{
				?>
            	<table cellpadding="0" cellspacing="0" id="campoempregado<?php echo $c;?>">
                    <tr class="despesasempregados esconde">
                        <td>Nome:<br /><input type="text" name="nome_empregado[<?php echo $c;?>]" class="inputbox" style="width:230px;" /></td>
                        <td>CPF:<br /><input type="text" name="cpf_empregado[<?php echo $c;?>]" class="inputbox cpf2" style="width:230px;" /></td>
                    </tr>
                    <tr class="despesasempregados esconde">
                        <td>PIS:<br /><input type="text" name="pis_empregado[<?php echo $c;?>]" class="inputbox" style="width:230px;" /></td>
                        <td>Valor:<br /><input type="text" name="valor_empregado[<?php echo $c;?>]" class="inputbox valor" style="width:230px;" /></td>
                    </tr>
        		</table>
                <?php
				}
				?>
          	</td>
       	</tr>
        <tr class="despesasempregados esconde">     
            <td colspan="2" align="center">
            <a class="addempregado" style="color: #FFF; cursor:pointer;">[ + ] Adicionar</a>&nbsp;&nbsp;
            <a class="removeempregado" style="color: #FFF; cursor:pointer;">[ - ] Remover</a></td>
        </tr>
        <tr class="despesasempregados esconde"><td colspan="2"><hr /></td></tr>
        
        
        <tr>
        	<td valign="top">Houve compra e/ou vendas de bens?</td>
            <td valign="top"><label><input type="radio" class="required" name="comprabens" value="sim" /> Sim</label>&nbsp;&nbsp;&nbsp;
                <label><input type="radio" name="comprabens" value="nao" /> N&atilde;o</label></td>
       	</tr>
        <tr class="comprabenss esconde">
        	<td colspan="2" align="center" id="campobens">
        		<table cellpadding="0" cellspacing="0" id="campobens0" >
                    <tr class="comprabenss esconde">
        				<td colspan="2">
                        <hr>
                        Tipo / descrição (mantenha a tecla ctrl pressionada para selecionar mais de uma op&ccedil;&atilde;o):<br />
                        <select name="tipo_comprabens[]" class="inputbox" style="width:550px;">
                        	<option value="01-Prédio redidencial">01-Prédio redidencial</option>
                            <option value="02-Prédio comercial">02-Prédio comercial</option>
                            <option value="03-Galpão">03-Galpão</option>
                            <option value="11-Apartamento">11-Apartamento</option>
                           	<option value="12-Casa">12-Casa</option>
                            <option value="13-Terreno">13-Terreno</option>
                            <option value="14-Terra nua">14-Terra nua</option>
                            <option value="15-Sala ou conjunto">15-Sala ou conjunto</option>
                            <option value="16-Construção">16-Construção</option>
                            <option value="17-Benfeitorias">17-Benfeitorias</option>
                            <option value="18-Loja">18-Loja</option>
                            <option value="19-Outros bens imóveis">19-Outros bens imóveis</option>
                            <option value="21-Veículo automotor terrestre: caminhão, automóvel, moto, etc">21-Veículo automotor terrestre: caminhão, automóvel, moto, etc</option>
                            <option value="22-Aeronave">22-Aeronave</option>
                            <option value="23-Embarcação">23-Embarcação</option>
                            <option value="24-Bem relacionado com o exercício da atividade autônoma">24-Bem relacionado com o exercício da atividade autônoma</option>
                            <option value="25-Joia, quadro, objeto de arte, de coleção, antiguidade, etc">25-Joia, quadro, objeto de arte, de coleção, antiguidade, etc</option>
                            <option value="26-Linha telefônica">26-Linha telefônica</option>
                            <option value="29-Outros bens móveis">29-Outros bens móveis</option>
                            <option value="31-Ações (inclusive as provenientes de linha telefônica)">31-Ações (inclusive as provenientes de linha telefônica)</option>
                            <option value="32-Quotas ou quinhões de capital">32-Quotas ou quinhões de capital</option>
                            <option value="39-Outras participações societárias">39-Outras participações societárias</option>
                            <option value="41-Caderneta de poupança">41-Caderneta de poupança</option>
                            <option value="45-Aplicação de renda fixa (CDB, RDB e outros)">45-Aplicação de renda fixa (CDB, RDB e outros)</option>
                            <option value="46-Ouro, ativo financeiro">46-Ouro, ativo financeiro</option>
                            <option value="47-Mercados futuros, de opções e termo">47-Mercados futuros, de opções e termo</option>
                            <option value="49-Outras aplicações e Investimentos">49-Outras aplicações e Investimentos</option>
                            <option value="51-Crédito decorrente de empréstimo">51-Crédito decorrente de empréstimo</option>
                            <option value="52-Crédito decorrente de alienação">52-Crédito decorrente de alienação</option>
                            <option value="53-Plano PAIT e caderneta pecúlio">53-Plano PAIT e caderneta pecúlio</option>
                            <option value="54-Poupança para construção ou aquisição de bem móvel">54-Poupança para construção ou aquisição de bem móvel</option>
                            <option value="59-Outros créditos e poupança vinculados">59-Outros créditos e poupança vinculados</option>
                            <option value="61-Depósito bancário em conta corrente no País">61-Depósito bancário em conta corrente no País</option>
                            <option value="62-Depósito bancário em conta corrente no exterior">62-Depósito bancário em conta corrente no exterior</option>
                            <option value="63-Dinheiro em espécie - moeda nacional">63-Dinheiro em espécie - moeda nacional</option>
                            <option value="64-Dinheiro em espécie - moeda estrangeira">64-Dinheiro em espécie - moeda estrangeira</option>
                            <option value="69-Outros depósitos à vista e numerário">69-Outros depósitos à vista e numerário</option>
                            <option value="71-Fundo de Curto Prazo">71-Fundo de Curto Prazo</option>
                            <option value="72-Fundo de Longo Prazo e Fundo de Investimentos em Direitor Creditórios (FIDC)">72-Fundo de Longo Prazo e Fundo de Investimentos em Direitor Creditórios (FIDC)</option>
                            <option value="73-Fundo de Investimentos Imobiliário">73-Fundo de Investimentos Imobiliário</option>
                            <option value="74-Fundo de ações, Fundos Mútuos de Privatização, Fundos de Investimentos em Empresas Emergentes, etc">74-Fundo de ações, Fundos Mútuos de Privatização, Fundos de Investimentos em Empresas Emergentes, etc</option>
                            <option value="79-Outros fundos">79-Outros fundos</option>
                            <option value="91-Livença e concessão especiais">91-Livença e concessão especiais</option>
                            <option value="92-Título de clube assemelhado">92-Título de clube assemelhado</option>
                            <option value="93-Direito de autor, de inventor e patente">93-Direito de autor, de inventor e patente</option>
                            <option value="94-Direito de lavra e assemelhado">94-Direito de lavra e assemelhado</option>
                            <option value="95-Consórcio não contemplado">95-Consórcio não contemplado</option>
                            <option value="96-Leasing">96-Leasing</option>
                            <option value="97-VGBL - Vida Gerador de Benefício Livre">97-VGBL - Vida Gerador de Benefício Livre</option>
                            <option value="99-Outros bens de direitos">99-Outros bens de direitos</option>
                        </select><br />
                        Informe endere&ccedil;o, valor, se foi compra ou venda do item escolhido:<br />
                        <textarea name="infomacoesbens[]" class="inputbox" style="width:530px; height:60px;"></textarea>
                        </td>
                  	</tr>
          		</table>
          	</td>                
		</tr>
        <tr class="comprabenss esconde">     
            <td colspan="2" align="center">
            <a class="addbens" style="color: #FFF; cursor:pointer;">[ + ] Adicionar</a>&nbsp;&nbsp;
            <a class="removebens" style="color: #FFF; cursor:pointer;">[ - ] Remover</a></td>
        </tr>
        
        
        <tr><td colspan="2"><hr /></td></tr>
        <tr>
        	<td colspan="2" align="center">Relação de documentos</td>
       	</tr>
        <tr>
        	<td valign="top">Comprovante de rendimentos:</td>
			<td valign="top"><input type="file" name="comprovantes[]" class="inputbox" style="width:190px;" />&nbsp;<a class="addcomprovante" style="cursor: pointer;" title="Adicionar mais comprovantes">[+]</a> <a class="removecomprovante" style="cursor: pointer;" title="Remover comprovante">[ - ]</a>
            	<span class="comprovantes"></span>
            </td>
      	</tr>
        <tr>
            <td valign="top">Extrato de Rendimentos Financeiros e Financiamentos de Todos os Bancos:</td>
            <td valign="top"><input type="file" name="extratos[]" class="inputbox" style="width:190px;" />&nbsp;<a class="addextrato" style="cursor: pointer;" title="Adicionar mais extratos">[+]</a> <a class="removeextrato" style="cursor: pointer;" title="Remover extrato">[ - ]</a>
            	<span class="extratos"></span>
            </td>
		</tr>
        <tr><td colspan="2"><hr /></td></tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" value="Enviar" class="button" /></td>
		</tr>

	</table>
</form>



<?php
}
else if($id_categoria == "admissao")
{
?>	
<script type="text/javascript">
$(function(){
	
	$("#formularios").validate();
	
	$(".data_admissao").setMask("99/99/9999");
	
	$(".adddoc").click(function(){
						
		$(".documentos").append("<span><br /><input type='file' name='documentos[]' class='inputbox' style='width:480px;' /></span>");
	});
	$(".removedoc").click(function(){
			$(".documentos span").last().remove();	
	});
});
</script>
<form action="paginas/envia.php?op=admissao" method="post" id="formularios" enctype="multipart/form-data">
	<h3 align='center' style='margin-top: 20px;'><?php echo @$tituloform;?></h3>
	<table cellpadding="10" cellspacing="0" width="100%" class="tblform">
    	<tr>
        	<td valign="top">Nome da empresa:<br /><input type="text" name="nome_empresa" class="inputbox required" style="width:250px;" /></td>
            <td valign="top">Nome do funcion&aacute;rio:<br /><input type="text" name="nome_funcionario" class="inputbox required" style="width:250px;" /></td>
		</tr>
        <tr>
        	<td valign="top">Fun&ccedil;&atilde;o:<br /><input type="text" name="funcao" class="inputbox required" style="width:250px;" /></td>
            <td valign="top">Data de admiss&atilde;o:<br /><input type="text" name="data_admissao" class="inputbox data_admissao datamascara required" style="width:250px;" /></td>
		</tr>
        <tr>
        	<td>Sal&aacute;rio:<br /><input type="text" name="salario" class="inputbox required" style="width:250px;" /></td>
            <td><label><input type="checkbox" name="minimo_categoria" value="sim" class="inputbox" /> M&iacute;nimo da categoria</label></td>
		</tr>
        <tr>
        	<td valign="top">Prazo de experi&ecirc;ncia:<br /><input type="text" name="prazo_experiencia" class="inputbox" style="width:250px;" /></td>
            <td valign="top">Grau de instru&ccedil;&atilde;o:<br /><input type="text" name="grau_instrucao" class="inputbox required" style="width:250px;" /></td>
		</tr>
        <tr>
        	<td colspan="2">Dias e hor&aacute;rios de trabalho:<br /><input type="text" name="horario_trabalho" class="inputbox required" style="width:250px;" /></td>
       	</tr>
        <tr>
        	<td colspan="2" valign="top">Funcion&aacute;rio esta recebendo ou deu entrada, sem receber primeira parcela, no seguro desemprego?<br />
            	<label><input type="radio" name="seguro" value="sim" class="inputbox required" /> Sim </label>&nbsp;&nbsp;
                <label><input type="radio" name="seguro" value="não" class="inputbox" /> N&atilde;o </label>
            </td>
       	</tr>
        <tr>
            <td colspan="2">Observa&ccedil;&atilde;o:<br /><textarea name="observacao" class="inputbox" style="width:530px; height:100px;"></textarea></td>
		</tr>
        <tr>
        	<td colspan="2">Anexar documentos:<br />
			<input type="file" name="documentos[]" class="inputbox" style="width:480px;" />&nbsp;<a class="adddoc" style="cursor: pointer;" title="Anexar mais documentos">[+]</a> <a class="removedoc" style="cursor: pointer;" title="Remover documento">[ - ]</a>
            	<span class="documentos"></span>
            </td>
      	</tr>
        <tr><td colspan="2"><hr /></td></tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" value="Enviar" class="button" /></td>
		</tr>
	</table>
    Relação de documentos:
	<ol>
    	<li>Carteira Profissional</li>
		<li>RG</li>
		<li>CPF</li>
		<li>Titulo Eleitor</li>
		<li>Carteira de Reservista</li>
		<li>Carteira Nacional de Habilitação</li>
		<li>PIS</li>
		<li>Comprovante de Endereço</li>
		<li>Certidão de Nascimento Filhos</li>
		<li>Certidão de Casamento</li>
		<li>Foto</li>
		<li>Cópia simples do cartão passe Fácil</li>
	</ol>
</form>
<?php
}
else if($id_categoria == "demissao")
{
?>	
<script type="text/javascript">
$(function(){
	
	$("#formularios").validate();
	
	$(".tipoaviso").hide();
	
	$("input[name='aviso']").click(function(){
		var aviso = $(this).val();
		if(aviso == "sim")
			$(".tipoaviso").show();
		else
			$(".tipoaviso").hide();
	});
	
	$(".data_desligamento").setMask("99/99/9999");
	
	$(".adddoc").click(function(){
						
		$(".documentos").append("<span><br /><input type='file' name='documentos' class='inputbox' style='width:480px;' /></span>");
	});
	$(".removedoc").click(function(){
			$(".documentos span").last().remove();	
	});
});
</script>
<form action="paginas/envia.php?op=demissao" method="post" id="formularios">
	<h3 align='center' style='margin-top: 20px;'><?php echo @$tituloform;?></h3>
	<table cellpadding="10" cellspacing="0" width="100%" class="tblform">
    	<tr>
        	<td>Nome da empresa:<br /><input type="text" name="nome_empresa" class="inputbox required" style="width:250px;" /></td>
        	<td>Nome do funcion&aacute;rio:<br /><input type="text" name="nome_funcionario" class="inputbox required" style="width: 250px;" /></td>
        </tr>
        <tr>
        	<td>C&oacute;digo de funcion&aacute;rio:<br /><input type="text" name="codigo_funcionario" class="inputbox" style="width:250px;" /></td>
            <td>Motivo:<br /><select name="motivo" class="inputbox required">
            				<option value="">Selecione...</option>
                            <option value="Iniciativa do empregador">Iniciativa do empregador</option>
                            <option value="Iniciativa do empregado">Iniciativa do empregado</option>
                            <option value="T&eacute;rmino de contrato">T&eacute;rmino de contrato</option>
                            <option value="Justa causa">Justa causa</option>
            			</select></td>
		</tr>
        <tr>
        	<td>Data do desligamento:<br /><input type="text" name="data_desligamento" class="inputbox data_desligamento datamascara required" style="width:250px;" /></td>
            <td>Aviso pr&eacute;vio: <label><input type="radio" name="aviso" value="sim" class="inputbox" /> Sim </label>&nbsp;&nbsp;&nbsp;<label><input type="radio" name="aviso" value="n&atilde;o" class="inputbox" /> N&atilde;o </label><br />
            	<label class="tipoaviso"><input type="radio" name="tipoaviso" value="trabalhado" class="inputbox" /> Trabalhado</label>&nbsp;&nbsp;&nbsp;<label class="tipoaviso"><input type="radio" name="tipoaviso" value="indenizado" class="inputbox" /> Indenizado</label></td>
		</tr>
        <tr>
        	<td>Valor de Desconto Vale Transporte:<br /><input type="text" name="valor_desconto" class="inputbox" style="width:250px;" /></td>
            <td>Quantidades de Faltas:<br /><input type="text" name="qtd_faltas" class="inputbox" style="width:250px;" /></td>
		</tr>
        <tr>
        	<td>Adiantamento:<br /><input type="text" name="adiantamento" class="inputbox" style="width:250px;" /></td>
            <td>Outras Vari&aacute;veis:<br /><input type="text" name="variaveis" class="inputbox" style="width:250px;" /></td>
		</tr>
        <tr>
            <td colspan="2">Observa&ccedil;&atilde;o:<br /><textarea name="observacao" class="inputbox" style="width:530px; height:100px;"></textarea></td>
		</tr>
        <tr><td colspan="2"><hr /></td></tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" value="Enviar" class="button" /></td>
		</tr>
	</table>
</form>    
<?php	
}
else if($id_categoria == "horaextra")
{
?>	
<script type="text/javascript">
$(function(){
	
	$("#formularios").validate();
	
	$(".tipoaviso").hide();
	
	$("input[name='aviso']").click(function(){
		var aviso = $(this).val();
		if(aviso == "sim")
			$(".tipoaviso").show();
		else
			$(".tipoaviso").hide();
	});
	
	$(".data_desligamento").setMask("99/99/9999");
	$("input[name='horasmensais']").setMask("999:99");
	
	$(".adddoc").click(function(){
						
		$(".documentos").append("<span><br /><input type='file' name='documentos' class='inputbox' style='width:480px;' /></span>");
	});
	$(".removedoc").click(function(){
			$(".documentos span").last().remove();	
	});
	
	$(".valor").maskMoney({
		showSymbol:false, 
		symbol:"", 
		decimal:",", 
		thousands:".",
		allowZero: true
	});

});
</script>
<form action="paginas/envia.php?op=horaextra" method="post" id="formularios">
	<h3 align='center' style='margin-top: 20px;'><?php echo @$tituloform;?></h3>
	<table cellpadding="10" cellspacing="0" width="100%" class="tblform">
    	<tr>
        	<td>Nome da empresa:<br /><input type="text" name="nome_empresa" class="inputbox required" style="width:250px;" /></td>
        	<td>Nome do funcion&aacute;rio:<br /><input type="text" name="nome_funcionario" class="inputbox required" style="width: 250px;" /></td>
        </tr>
        <tr>
        	<td>C&oacute;digo de funcion&aacute;rio:<br /><input type="text" name="codigo_funcionario" class="inputbox" style="width:250px;" /></td>
            <td>E-mail para envio do c&aacute;lculo:<br /><input type="text" name="emailenvio" class="inputbox email required" style="width:250px;" /></td>            
		</tr>
        <tr>
        	<td>Sal&aacute;rio Base (R$):<br /><input type="text" name="salario_base" class="inputbox valor required" value="0,00" style="width:250px;" /></td>
        	<td>Adicional por Tempo de Servi&ccedil;o (R$):<br /><input type="text" name="adicional" class="inputbox valor" value="0,00" style="width:250px;" /></td>
		</tr>
        <tr>
        	<td>Insalubridade (R$):<br /><input type="text" name="insalubridade" class="inputbox valor" value="0,00" style="width:250px;" /></td>
        	<td>Periculosidade (R$):<br /><input type="text" name="periculosidade" class="inputbox valor" value="0,00" style="width:250px;" /></td>
		</tr>
        <tr>
        	<td>Outro Provento (R$):<br /><input type="text" name="provento" class="inputbox valor" value="0,00" style="width:250px;" /></td>
        	<td>Total de Horas Mensais:<br /><input type="text" name="horasmensais" class="inputbox required" style="width:250px;" /></td>
		</tr>
        <tr>
        	<td>Percentual de Agrega&ccedil;&atilde;o (%):<br /><input type="text" name="agregacao" class="inputbox required" style="width:250px;" /><small>Consultar acordo coletivo</small></td>
            <td>Quantidade de Horas:<br /><input type="text" name="qtdhoras" class="inputbox required" style="width:250px;" />
            	<small>Obs.: Consultar acordo coletivo sobre 1&ordf; e 2&ordf; hora</small></td>
       	</tr>
        <tr><td colspan="2"><hr /></td></tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" value="Enviar" class="button" /></td>
		</tr>
	</table>
</form>    
<?php	
}
else if($id_categoria == "rescisao")
{
?>	
<script type="text/javascript">
$(function(){
	
	$("#formularios").validate();
	
	$(".valor").maskMoney({
		showSymbol:false, 
		symbol:"", 
		decimal:",", 
		thousands:".",
		allowZero: true
	});
	
	$(".tipoaviso").hide();
	
	$("input[name='aviso']").click(function(){
		var aviso = $(this).val();
		if(aviso == "sim")
		{
			$(".tipoaviso").show();
			$("input[name='tipoaviso']").addClass("required");
		}
		else
		{
			$(".tipoaviso").hide();
			$("input[name='tipoaviso']").removeClass("required");
		}
	});
	
	$(".data_admissao").setMask("99/99/9999");
	$(".data_demissao").setMask("99/99/9999");
	$(".num").setMask("999999");
	
	$(".adddoc").click(function(){
						
		$(".documentos").append("<span><br /><input type='file' name='documentos' class='inputbox' style='width:480px;' /></span>");
	});
	$(".removedoc").click(function(){
			$(".documentos span").last().remove();	
	});
	
	$("select[name='sindicato']").change(function(){
		var data = $(this).val();
		
		$("input[name='data_dissidio']").val(data);
	});
	
	$(".parcela13_2").hide();
	$("input[name='parcela13_1']").click(function(){
		var par = $(this).val();
		if(par == "sim")
		{
			$(".parcela13_2").show();
			$("input[name='parcela13_2']").addClass("required");
		}
		else
		{
			$("input[name='parcela13_2']").removeClass("required");
			$(".parcela13_2").hide();
		}
	});
	$(".afastado").hide();
	$("input[name='afastado']").click(function(){
		var par = $(this).val();
		if(par == "sim")
		{
			$(".afastado").show();
			$("input[name='data_retorno']").addClass("required");
		}
		else
		{
			$(".afastado").hide();
			$("input[name='data_retorno']").removeClass("required");
		}
	});
});
</script>
<form action="paginas/envia.php?op=rescisao" method="post" id="formularios">
	<h3 align='center' style='margin-top: 20px;'><?php echo @$tituloform;?></h3>
	<table cellpadding="10" cellspacing="0" width="100%" class="tblform">
    	<tr>
        	<td colspan="2">Nome da empresa:<br /><input type="text" name="nome_empresa" class="inputbox required" style="width:530px;" /></td>
        </tr>
        <tr>
        	<td>Nome do funcion&aacute;rio:<br /><input type="text" name="nome_funcionario" class="inputbox required" style="width: 250px;" /></td>
        	<td>C&oacute;digo de funcion&aacute;rio:<br /><input type="text" name="codigo_funcionario" class="inputbox" style="width:250px;" /></td>
		</tr>
        <tr>
	        <td>E-mail para envio do c&aacute;lculo:<br /><input type="text" name="emailenvio" class="inputbox email required" style="width:250px;" /></td>    
            <td>Motivo:<br><select name="motivo" class="inputbox required">
            				<option value="">Selecione...</option>
                            <option value="Iniciativa do empregador">Iniciativa do empregador</option>
                            <option value="Iniciativa do empregado">Iniciativa do empregado</option>
                            <option value="T&eacute;rmino de contrato">T&eacute;rmino de contrato</option>
                            <option value="Justa causa">Justa causa</option>
            			</select></td>
        </tr>
        <tr>
        	<td>Data de Admiss&atilde;o:<br /><input type="text" name="data_admissao" class="inputbox data_admissao required data datamascara" placeholder="DD/MM/AAAA" style="width:250px;" /></td>
            <td>Data de Demiss&atilde;o:<input type="text" name="data_demissao" class="inputbox data_demissao required data datamascara" placeholder="DD/MM/AAAA" style="width:250px;" /></td>
       	</tr>
        <tr>
       		<td valign="top">Data base do diss&iacute;dio coletivo <br>(selecione o sindicado no campo ao lado ou informe uma data):</td>
            <td>
            	<select name="sindicato" class="inputbox">
                	<option value="">Selecione</option>
                	<?php
						$sql = mysql_query("SELECT * FROM sindicatos ORDER BY sindicato");
						while($reg = mysql_fetch_array($sql))
						{
							echo "<option value='".date("d/m",strtotime($reg['data']))."'>".$reg['sindicato']."</option>";	
						}
					?>
               	</select><br>
                <input type="text" name="data_dissidio" class="inputbox data_dissidio data2 datamascara required" style="width:250px;" placeholder="DD/MM" />
            	
            </td>
		</tr>
        <tr>
        	<td>Sal&aacute;rio Base (R$):<br /><input type="text" name="salario_base" class="inputbox valor required" value="0,00" style="width:250px;" /></td>
            <td>Adicional por Tempo de Servi&ccedil;o (R$):<br /><input type="text" name="adicional" class="inputbox valor" value="0,00" style="width:250px;" /></td>
        </tr>
        <tr>
        	<td>Insalubridade (R$):<br /><input type="text" name="insalubridade" class="inputbox valor" value="0,00" style="width:250px;" /></td>
        	<td>Periculosidade (R$):<br /><input type="text" name="periculosidade" class="inputbox valor" value="0,00" style="width:250px;" /></td>
		</tr>
        <tr>
        	<td>Outro Provento (R$):<br /><input type="text" name="provento" class="inputbox valor" value="0,00" style="width:250px;" /></td>
   			<td>M&eacute;dia das Remunera&ccedil;&otilde;es Vari&aacute;veis (R$):<br /><input type="text" name="remuneracoes" class="inputbox valor" value="0,00" style="width:250px;" /></td>         
        </tr>
        <tr>
        	<td>Aviso pr&eacute;vio: <label><input type="radio" name="aviso" value="sim" class="inputbox required" /> Sim </label>&nbsp;&nbsp;&nbsp;<label><input type="radio" name="aviso" value="n&atilde;o" class="inputbox" /> N&atilde;o </label><br />
            	<label class="tipoaviso"><input type="radio" name="tipoaviso" value="trabalhado" class="inputbox" /> Trabalhado</label>&nbsp;&nbsp;&nbsp;<label class="tipoaviso"><input type="radio" name="tipoaviso" value="indenizado" class="inputbox" /> Indenizado</label></td>
            <td>Desconto Vale Transporte:<br /><input type="text" name="valor_desconto" class="inputbox valor" value="0,00" style="width:250px;" /></td>
        </tr>
        <tr>
        	<td>Adiantamento:<br /><input type="text" name="adiantamento" class="inputbox valor" value="0,00" style="width:250px;" /></td>
            <td>Quantidades de Faltas:<br /><input type="text" name="qtd_faltas" class="inputbox" value="0" style="width:250px; text-align:right;" /></td>
		</tr>
        <tr>
        	<td>Qtd de F&eacute;rias Gozadas:<br /><input type="text" name="qtd_ferias" class="inputbox num" value="0" style="width:250px; text-align:right;" /></td>
            <td>Outras Vari&aacute;veis:<br /><input type="text" name="variaveis" class="inputbox valor" value="0,00" style="width:250px;" /></td>
		</tr>
		<tr>
        	<td colspan="2" align="center">O funcionário esteve afastado em um mesmo período aquisitivo por mais de seis meses, sejam eles corridos ou descontínuos, por motivo de acidente ou doença?<br>
        	<label><input type="radio" name="afastado" value="sim" class="inputbox required" /> Sim </label>&nbsp;&nbsp;&nbsp;<label><input type="radio" name="afastado" value="n&atilde;o" class="inputbox" /> N&atilde;o </label>
        	</td>
		</tr>
		<tr class="afastado" align="center">
			<td colspan="2">Qual a data do retorno ao trabalho? <input type="text" name="data_retorno" class="inputbox data_retorno data datamascara" placeholder="DD/MM/AAAA" style="width:250px;" /></td>
		</td>
        <tr>
        	<td colspan="2" align="center">A 1ª parcela do 13º salário já foi paga?<br />
            	<label><input type="radio" name="parcela13_1" value="sim" class="inputbox required" /> Sim </label>&nbsp;&nbsp;&nbsp;<label><input type="radio" name="parcela13_1" value="n&atilde;o" class="inputbox" /> N&atilde;o </label>
            </td>
		</tr>
        <tr class="parcela13_2">
        	<td colspan="2" align="center">A 2ª parcela do 13º salário já foi paga?<br />
            	<label><input type="radio" name="parcela13_2" value="sim" class="inputbox" /> Sim </label>&nbsp;&nbsp;&nbsp;<label><input type="radio" name="parcela13_2" value="n&atilde;o" class="inputbox" /> N&atilde;o </label>
            </td>
		</tr>
        
        <tr><td colspan="2"><hr /></td></tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" value="Enviar" class="button" /></td>
		</tr>
	</table>
</form>    
<?php	
}
else if($id_categoria == "advertencia")
{
?>
<script type="text/javascript">
$(function(){
	
	$("#formularios").validate();
	
});
</script>
<form action="paginas/envia.php?op=advertencia" method="post" id="formularios">
	<h3 align='center' style='margin-top: 20px;'><?php echo @$tituloform;?></h3>
	<table cellpadding="10" cellspacing="0" width="100%" class="tblform">
    	<tr>
        	<td>Nome do funcion&aacute;rio:<br /><input type="text" name="nome_funcionario" class="inputbox required" style="width: 250px;" /></td>
            <td>Nome da empresa:<br /><input type="text" name="nome_empresa" class="inputbox required" style="width:250px;" /></td>
        </tr>
        <tr>
        	<td valign="top">E-mail <small>(para onde será enviado o arquivo)</small>:<br /><input type="text" name="email" class="inputbox required email" style="width:250px;" /></td>
        	<td>Cidade:<br /><input type="text" name="cidade" class="inputbox required" style="width: 250px;" /></td>
        </tr>
        
        <tr>
            <td colspan="2">Motivo:<br />
            <textarea name="motivo" class="inputbox required" style="width:530px; height:200px;"></textarea></td>
		</tr>
        <tr><td colspan="2"><hr /></td></tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" value="Enviar" class="button" /></td>
		</tr>
	</table>
</form>

<?php
}
else if($id_categoria == "avisoprevio")
{
?>
<script type="text/javascript">
function calculaDias(date1, date2, tipoaviso){
        //formato do brasil 'pt-br'
        moment.locale('pt-br');
        //setando data1
        var data1 = moment(date1,'DD/MM/YYYY');
        //setando data2
        var data2 = moment(date2,'DD/MM/YYYY');
        //tirando a diferenca da data2 - data1 em dias
		if(tipoaviso == "trabalhado")
       		var diff  = data2.diff(data1, 'days');
		else
			var diff  = data2.diff(data1, 'months');
        
        return diff;
}
$(function(){
	
	$("#formularios").validate();
	

	$(".data_admissao").setMask("99/99/9999");
	 $("input[name='data_aviso']").setMask("99999");
	
	$("input[name='tipoaviso']").click(function(){
		var tipoaviso = $(this).val();
		$("input[name='data_aviso']").val("");
		$("input[name='data_pagamento']").val("");

		if(tipoaviso == "trabalhado")
			$(".trabalhado").show();
		else
			$(".trabalhado").hide();
			
	});

	$("input[name='data_aviso']").change(function(){
		var tipoaviso = $("input[name='tipoaviso']:checked").val();

		var data_admissao = $(".data_admissao").val();
		var data_aviso = $(this).val();

		$.post("paginas/verificadiautil.php",{
				data_admissao : data_admissao,
				data_aviso : data_aviso,
				tipoaviso : tipoaviso

			}, function(data){
				$("input[name='data_pagamento']").val(data);
				
		});	

	})
	
	$("#envia").bind("click",function(){
		var data_admissao = $("input[name='data_admissao']").val();
		var data_aviso = $("input[name='data_aviso']").val();
		var tipoaviso = $("input[name='tipoaviso']:checked").val();

		var diferenca = calculaDias(data_admissao, data_aviso, tipoaviso);

		if(tipoaviso == "trabalhado")
		{
			if(diferenca > 365)
			{
				$("input[name='data_sindicato']").addClass("required");
				$("input[name='endereco_sindicato']").addClass("required");
			}
		}
		else if(tipoaviso == "indenizado")
		{
			if(diferenca > 11)
			{
				$("input[name='data_sindicato']").addClass("required");
				$("input[name='endereco_sindicato']").addClass("required");
			}
		}
	});

});
</script>
<form action="paginas/envia.php?op=avisoprevio" method="post" id="formularios">
	<h3 align='center' style='margin-top: 20px;'><?php echo @$tituloform;?></h3>
	<table cellpadding="10" cellspacing="0" width="100%" class="tblform">
    	<tr>
        	<td colspan="2" align="center">Tipo de Aviso: &nbsp;&nbsp;
            	<label><input type="radio" name="tipoaviso" value="indenizado" class="required" /> Indenizado</label>&nbsp;&nbsp;&nbsp;
                <label><input type="radio" name="tipoaviso" value="trabalhado" /> Trabalhado</label>
            </td>
      	</tr>
        <tr>
        	<td>Data de Admiss&atilde;o:<br /><input type="text" name="data_admissao" class="inputbox data_admissao data required datamascara" placeholder="DD/MM/AAAA" style="width:250px;" /></td>
            <td>Data do Aviso:<br /><input type="text" name="data_aviso" class="inputbox data_admissao data required datamascara" placeholder="DD/MM/AAAA" style="width:250px;" /></td>
        </tr>
        
    	<tr>
        	<td>Nome do funcion&aacute;rio:<br /><input type="text" name="nome_funcionario" class="inputbox required" style="width: 250px;" /></td>
            <td>Nome da empresa:<br /><input type="text" name="nome_empresa" class="inputbox required" style="width:250px;" /></td>
        </tr>

        <tr>
        	<td>Data do pagamento das verbas rescis&oacute;rias:<br /><input type="text" name="data_pagamento" readonly class="inputbox required" style="width: 250px;" />
        	</td>
        	<td class="trabalhado" colspan="2" valign="top">Faltar os &uacute;ltimos: 
            	<select name="numdias" class="inputbox">
                	<option selected='selected' value="7">7</option>
                    <option value="10">10</option>
                </select> dias corridos
            </td>
   		</tr>
        <tr>
       		<td valign="top">Data base do diss&iacute;dio coletivo <br>(selecione o sindicado no campo ao lado ou informe uma data):</td>
            <td>
            	<select name="sindicato" class="inputbox">
                	<option value="">Selecione</option>
                	<?php
						$sql = mysql_query("SELECT * FROM sindicatos ORDER BY sindicato");
						while($reg = mysql_fetch_array($sql))
						{
							echo "<option value='".date("d/m",strtotime($reg['data']))."|".$reg['id']."'>".$reg['sindicato']."</option>";	
						}
					?>
               	</select><br>
                <input type="text" name="data_dissidio" class="inputbox data_dissidio data2 datamascara required" style="width:250px;" placeholder="DD/MM" />
            	
            </td>
		</tr>
        <tr>
            <td>Comparecer ao sindicado<br /><small>(para funcion&aacute;rios com mais de um ano)</small>:
            <input type="text" name="data_sindicato" class="inputbox data_admissao data datamascara" placeholder="DD/MM/AAAA" style="width: 250px;" /><br />
            </td>
            <td valign="bottom">Endere&ccedil;o:<br />
            <input type="text" name="endereco_sindicato" class="inputbox" style="width: 250px;" /></td></td>
        </tr>
        <tr>
        	<td valign="top">E-mail <small>(para onde será enviado o arquivo)</small>:<br /><input type="text" name="email" class="inputbox required email" style="width:250px;" /></td>
        	<td>Cidade:<br /><input type="text" name="cidade" class="inputbox required" style="width: 250px;" /></td>
        </tr>
        <tr><td colspan="2"><hr /></td></tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" id="envia" value="Enviar" class="button" /></td>
		</tr>
	</table>
</form>
<?php
}
else if($id_categoria == "ctps")
{
?>
<script type="text/javascript">
$(function(){
	
	$("#formularios").validate();
	

	$(".data_admissao").setMask("99/99/9999");
	$("input[name='carteira']").setMask("9999999.99999-aa");
	$("input[name='cbo']").setMask("9999-99");


  
});
</script>
<form action="paginas/envia.php?op=ctps" method="post" id="formularios">
	<h3 align='center' style='margin-top: 20px;'><?php echo @$tituloform;?></h3>
	<table cellpadding="10" cellspacing="0" width="100%" class="tblform">
        
    	<tr>
        	<td>Nome do funcion&aacute;rio:<br /><input type="text" name="nome_funcionario" class="inputbox required" style="width: 250px;" /></td>
            <td>N&deg; carteira profissional:<br /><input type="text" name="carteira" class="inputbox required" style="width: 250px; text-transform:uppercase;" /></td>
        </tr>
        <tr>
            <td>CBO:<br /><input type="text" name="cbo" class="inputbox required" style="width:250px;" /></td>
            <td>Fun&ccedil;&atilde;o:<br /><input type="text" name="funcao" class="inputbox required" style="width: 250px;" /></td>
        </tr>
        <tr>
            <td>Nome da empresa:<br /><input type="text" name="nome_empresa" class="inputbox required" style="width:250px;" /></td>
            <td>Cidade:<br /><input type="text" name="cidade" class="inputbox required" style="width: 250px;" /></td>
        </tr>
        <tr>
            <td>Data de Admiss&atilde;o:<br /><input type="text" name="data_admissao" class="inputbox data_admissao data required datamascara" placeholder="DD/MM/AAAA" style="width:250px;" /></td>
            <td valign="top">E-mail <small>(para onde será enviado o arquivo)</small>:<br /><input type="text" name="email" class="inputbox required email" style="width:250px;" /></td>
        </tr>

        <tr><td colspan="2"><hr /></td></tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" value="Enviar" class="button" /></td>
		</tr>
	</table>
</form>
<?php
}
else if($id_categoria == "aditivo")
{
?>
<script type="text/javascript">
$(function(){
	
	$("#formularios").validate();
	

	$("input[name='carteira']").setMask("9999999.99999-aa");
	$(".data").setMask("99/99/9999");

	$(".cnpj").setMask("cnpj");
	$(".cep").setMask("99999-999");
	$(".numero").setMask("99999999");

	$("#cep_emp").blur(function(){
		var cep = $(this).val();
		
		$.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+cep, function(){
			if(resultadoCEP["resultado"] == 1) {
				$("#endereco_emp").val(unescape(resultadoCEP["tipo_logradouro"])+" "+unescape(resultadoCEP["logradouro"]));
				$("#bairro_emp").val(unescape(resultadoCEP["bairro"]));
				$("#cidade_emp").val(unescape(resultadoCEP["cidade"]));
				$("#estado_emp").val(unescape(resultadoCEP["uf"]));
				$("#numero_emp").focus();
			} else if(resultadoCEP["resultado"] == 2) {
				$("#cidade_emp").val(unescape(resultadoCEP["cidade"]));
				$("#estado_emp").val(unescape(resultadoCEP["uf"]));
				$("#endereco_emp").focus();
			} else {
				alert("Endereço não encontrado");
			}
		});
	});
	
	$("#cep").blur(function(){
		var cep = $(this).val();
		
		$.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+cep, function(){
			if(resultadoCEP["resultado"] == 1) {
				$("#endereco").val(unescape(resultadoCEP["tipo_logradouro"])+" "+unescape(resultadoCEP["logradouro"]));
				$("#bairro").val(unescape(resultadoCEP["bairro"]));
				$("#cidade").val(unescape(resultadoCEP["cidade"]));
				$("#estado").val(unescape(resultadoCEP["uf"]));
				$("#numero").focus();
			} else if(resultadoCEP["resultado"] == 2) {
				$("#cidade").val(unescape(resultadoCEP["cidade"]));
				$("#estado").val(unescape(resultadoCEP["uf"]));
				$("#endereco").focus();
			} else {
				alert("Endereço não encontrado");
			}
		});
	});
  
});
</script>
<form action="paginas/envia.php?op=aditivo" method="post" id="formularios">
	<h3 align='center' style='margin-top: 20px;'><?php echo @$tituloform;?></h3>
	<table cellpadding="10" cellspacing="0" width="100%" class="tblform">
    	<tr>
            <td colspan="2"><strong>DADOS DA EMPRESA</strong></td>
        </tr>
        <tr>
            <td>Nome da empresa:<br /><input type="text" name="nome_empresa" class="inputbox required" style="width:250px;" /></td>
            <td>CNPJ:<br /><input type="text" name="cnpj" class="inputbox cnpj" style="width:250px;" /></td>
        </tr>
        <tr>
        	<td valign="top">CEP:<br /><input type="text" name="cep_emp" id="cep_emp" class="inputbox cep required" style="width:250px;" /></td>
            <td valign="top">Endere&ccedil;o:<br /><input type="text" name="endereco_emp" id="endereco_emp" class="inputbox required" style="width:250px;" /></td>
		</tr>
        <tr>
        	<td valign="top">N&uacute;mero:<br /><input type="text" name="numero_emp" id="numero_emp" class="inputbox numero required" style="width:250px;" /></td>
            <td valign="top">Bairro:<br /><input type="text" name="bairro_emp" id="bairro_emp" class="inputbox required" style="width:250px;" /></td>
		</tr>
        <tr>
        	<td valign="top">Complemento:<br /><input type="text" name="complemento_emp" id="complemento_emp" class="inputbox" style="width:250px;" /></td>
        	<td valign="top">Cidade:<br /><input type="text" name="cidade_emp" id="cidade_emp" class="inputbox required" style="width:250px;" /></td>
		</tr>
        <tr>
        	<td colspan="2" valign="top">Estado:<br /><input type="text" name="estado_emp" id="estado_emp" class="inputbox required" style="width:250px;" /></td>
        </tr>
        <tr>
            <td colspan="2"><hr /></td>
        </tr>
        <tr>
            <td colspan="2"><strong>DADOS DO FUNCIO&Aacute;RIO</strong></td>
        </tr>
    	<tr>
        	<td>Nome do funcion&aacute;rio:<br /><input type="text" name="nome_funcionario" class="inputbox required" style="width: 250px;" /></td>
            <td>N&deg; carteira profissional:<br /><input type="text" name="carteira" class="inputbox required" style="width: 250px; text-transform:uppercase;" /></td>
        </tr>
        <tr>
        	<td>Nacionalidade:<br /><input type="text" name="nacionalidade" class="inputbox required" style="width: 250px;" /></td>
            <td>Natural de:<br /><input type="text" name="natural" class="inputbox required" style="width: 250px;" /></td>
        </tr>
        <tr>
        	<td>Estado Civil:<br /><input type="text" name="estado_civil" class="inputbox required" style="width: 250px;" /></td>
            <td valign="top">CEP:<br /><input type="text" name="cep" id="cep" class="inputbox cep required" style="width:250px;" /></td>
        </tr>
        <tr>
            <td valign="top">Endere&ccedil;o:<br /><input type="text" name="endereco" id="endereco" class="inputbox required" style="width:250px;" /></td>
            <td valign="top">N&uacute;mero:<br /><input type="text" name="numero" id="numero" class="inputbox numero required" style="width:250px;" /></td>
		</tr>
        <tr>
            <td valign="top">Bairro:<br /><input type="text" name="bairro" id="bairro" class="inputbox required" style="width:250px;" /></td>
            <td valign="top">Complemento:<br /><input type="text" name="complemento" id="complemento" class="inputbox" style="width:250px;" /></td>
		</tr>
        <tr>
        	<td valign="top">Cidade:<br /><input type="text" name="cidade" id="cidade" class="inputbox required" style="width:250px;" /></td>
            <td valign="top">Estado:<br /><input type="text" name="estado" id="estado" class="inputbox required" style="width:250px;" /></td>
		</tr>
        
        <tr>
            <td colspan="2"><hr /></td>
        </tr>
        <tr>
            <td colspan="2">Hor&aacute;rio atual de trabalho:<br /><textarea name="infomacoes_atual" class="inputbox required" style="width:530px; height:100px;"></textarea></td>
        </tr>
        <tr>
            <td colspan="2">Novo hor&aacute;rio de trabalho:<br /><textarea name="infomacoes_novo" class="inputbox required" style="width:530px; height:100px;"></textarea></td>
        </tr>
        <tr>
        	<td>Local:<br /><input type="text" name="local" class="inputbox required" style="width:250px;" /></td>
            <td>Data:<br /><input type="text" name="data" class="inputbox data_admissao data required datamascara" placeholder="DD/MM/AAAA" style="width:250px;" /></td>
      	</tr>
        <tr>
            <td colspan="2" valign="top">E-mail <small>(para onde será enviado o arquivo)</small>:<br /><input type="text" name="email" class="inputbox required email" style="width:250px;" /></td>
        </tr>

        <tr><td colspan="2"><hr /></td></tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" value="Enviar" class="button" /></td>
		</tr>
	</table>
</form>
<?php
}
else if($id_categoria == "dut")
{
?>
<script type="text/javascript">
$(function(){
	
	$("#formularios").validate();
	

	//$("input[name='carteira']").setMask("9999999.99999-aa");
	$(".data").setMask("99/99/9999");

	$(".cnpj").setMask("cnpj");
	$(".cep").setMask("99999-999");
	$(".numero").setMask("99999999");

	
	$("#cep").blur(function(){
		var cep = $(this).val();
		
		$.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+cep, function(){
			if(resultadoCEP["resultado"] == 1) {
				$("#endereco").val(unescape(resultadoCEP["tipo_logradouro"])+" "+unescape(resultadoCEP["logradouro"]));
				$("#bairro").val(unescape(resultadoCEP["bairro"]));
				$("#cidade").val(unescape(resultadoCEP["cidade"]));
				$("#estado").val(unescape(resultadoCEP["uf"]));
				$("#numero").focus();
			} else if(resultadoCEP["resultado"] == 2) {
				$("#cidade").val(unescape(resultadoCEP["cidade"]));
				$("#estado").val(unescape(resultadoCEP["uf"]));
				$("#endereco").focus();
			} else {
				alert("Endereço não encontrado");
			}
		});
	});
  
});
</script>
<form action="paginas/envia.php?op=dut" method="post" id="formularios">
	<h3 align='center' style='margin-top: 20px;'><?php echo @$tituloform;?></h3>
	<table cellpadding="10" cellspacing="0" width="100%" class="tblform">
        <tr>
            <td>Nome:<br /><input type="text" name="nome_empresa" class="inputbox required" style="width:250px;" /></td>
            <td>PIS:<br /><input type="text" name="pis" class="inputbox pis" style="width:250px;" /></td>
        </tr>
        <tr>
        	<td valign="top">E-mail:<br /><input type="text" name="email" class="inputbox required email" style="width:250px;" /></td>
        	<td valign="top">CEP:<br /><input type="text" name="cep" id="cep" class="inputbox cep required" style="width:250px;" /></td>
		</tr>
        <tr>
        	<td valign="top">Endere&ccedil;o:<br /><input type="text" name="endereco" id="endereco" class="inputbox required" style="width:250px;" /></td>
        	<td valign="top">N&uacute;mero:<br /><input type="text" name="numero" id="numero" class="inputbox numero required" style="width:250px;" /></td>
		</tr>
        <tr>
        	<td valign="top">Bairro:<br /><input type="text" name="bairro" id="bairro" class="inputbox required" style="width:250px;" /></td>
        	<td valign="top">Complemento:<br /><input type="text" name="complemento" id="complemento" class="inputbox" style="width:250px;" /></td>
		</tr>
        <tr>
        	<td valign="top">Cidade:<br /><input type="text" name="cidade" id="cidade" class="inputbox required" style="width:250px;" /></td>
        	<td valign="top">Estado:<br /><input type="text" name="estado" id="estado" class="inputbox required" style="width:250px;" /></td>
        </tr>
        <tr>
        	<td valign="top">CNPJ:<br /><input type="text" name="cnpj" class="inputbox cnpj" style="width:250px;" /></td>
        	<td valign="top">Data:<br /><input type="text" name="data" class="inputbox data_admissao data required datamascara" placeholder="DD/MM/AAAA" style="width:250px;" /></td>         
        </tr>
        <tr>
            <td colspan="2"><hr /></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" value="Enviar" class="button" /></td>
		</tr>
	</table>
</form>
<?php
}
else if($id_categoria == "dispensa")
{
?>
<script type="text/javascript">

$(function(){
	
	$("#formularios").validate();
	

	$(".data_admissao").setMask("99/99/9999");
	 $("input[name='qtd_aviso']").setMask("99999");
	
	$("input[name='tipoaviso']").click(function(){
		var tipoaviso = $(this).val();
		if(tipoaviso == "trabalhado")
			$(".trabalhado").show();
		else
			$(".trabalhado").hide();
			
	});

  
});
</script>
<form action="paginas/envia.php?op=dispensa" method="post" id="formularios">
	<h3 align='center' style='margin-top: 20px;'><?php echo @$tituloform;?></h3>
	<table cellpadding="10" cellspacing="0" width="100%" class="tblform">
        <tr>
        	<td>Data de Admiss&atilde;o:<br /><input type="text" name="data_admissao" class="inputbox data_admissao data required datamascara" placeholder="DD/MM/AAAA" style="width:250px;" /></td>
            <td>Data do Aviso:<br /><input type="text" name="data_aviso" class="inputbox data_admissao data required datamascara" placeholder="DD/MM/AAAA" style="width:250px;" /></td>
        </tr>
        
    	<tr>
        	<td>Nome do funcion&aacute;rio:<br /><input type="text" name="nome_funcionario" class="inputbox required" style="width: 250px;" /></td>
            <td>Nome da empresa:<br /><input type="text" name="nome_empresa" class="inputbox required" style="width:250px;" /></td>
        </tr>
        <tr>
            <td>Comparecer ao sindicado<br /><small>(para funcion&aacute;rios com mais de um ano)</small>:
            <input type="text" name="data_sindicato" class="inputbox data_admissao data datamascara" placeholder="DD/MM/AAAA" style="width: 250px;" /><br />
            </td>
            <td valign="bottom">Endere&ccedil;o:<br />
            <input type="text" name="endereco_sindicato" class="inputbox" style="width: 250px;" /></td></td>
        </tr>
        <tr>
        	<td valign="top">E-mail <small>(para onde será enviado o arquivo)</small>:<br /><input type="text" name="email" class="inputbox required email" style="width:250px;" /></td>
        	<td>Cidade:<br /><input type="text" name="cidade" class="inputbox required" style="width: 250px;" /></td>
        </tr>
        <tr><td colspan="2"><hr /></td></tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" value="Enviar" class="button" /></td>
		</tr>
	</table>
</form>
<?php
}
else if($id_categoria == "cartapreposicao")
{
?>
<script type="text/javascript">
$(function(){
	
	$("#formularios").validate();
	

	$("input[name='carteira_representante']").setMask("9999999.99999-aa");
	
	$('input[name="doc"]').click(function(){
		var doc = $(this).val();
		if(doc == "ct")
		{
			$("input[name='carteira_representante']").val("");
			$("input[name='carteira_representante']").setMask("9999999.99999-aa");

		}
		else
		{
			$("input[name='carteira_representante']").val("");
			$("input[name='carteira_representante']").setMask("99.999.999-99");
		}
	});
	
	$(".data").setMask("99/99/9999");

	$(".cnpj").setMask("cnpj");
	$(".cep").setMask("99999-999");
	$(".numero").setMask("99999999");

	$("#cep_emp").blur(function(){
		var cep = $(this).val();
		
		$.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+cep, function(){
			if(resultadoCEP["resultado"] == 1) {
				$("#endereco_emp").val(unescape(resultadoCEP["tipo_logradouro"])+" "+unescape(resultadoCEP["logradouro"]));
				$("#bairro_emp").val(unescape(resultadoCEP["bairro"]));
				$("#cidade_emp").val(unescape(resultadoCEP["cidade"]));
				$("#estado_emp").val(unescape(resultadoCEP["uf"]));
				$("#numero_emp").focus();
			} else if(resultadoCEP["resultado"] == 2) {
				$("#cidade_emp").val(unescape(resultadoCEP["cidade"]));
				$("#estado_emp").val(unescape(resultadoCEP["uf"]));
				$("#endereco_emp").focus();
			} else {
				alert("Endereço não encontrado");
			}
		});
	});
	
	$("#campodependentes table").hide();

	var count = 1;
	$(".adddependente").click(function(){
		count++;	
		if(count > 7)
			count = 7;		
		$("#campodependentes"+count).show();
						  
	});
	$(".removedependente").click(function(){
		if(count > 1)
		{
			$("#campodependentes"+count).hide();
			count--;
		}
	});
  
});
</script>
<form action="paginas/envia.php?op=cartapreposicao" method="post" id="formularios">
	<h3 align='center' style='margin-top: 20px;'><?php echo @$tituloform;?></h3>
	<table cellpadding="10" cellspacing="0" width="100%" class="tblform">
    	<tr>
            <td colspan="2"><strong>DADOS DA EMPRESA</strong></td>
        </tr>
        <tr>
            <td>Nome da empresa:<br /><input type="text" name="nome_empresa" class="inputbox required" style="width:250px;" /></td>
            <td>CNPJ:<br /><input type="text" name="cnpj" class="inputbox cnpj" style="width:250px;" /></td>
        </tr>
        <tr>
        	<td valign="top">CEP:<br /><input type="text" name="cep_emp" id="cep_emp" class="inputbox cep required" style="width:250px;" /></td>
            <td valign="top">Endere&ccedil;o:<br /><input type="text" name="endereco_emp" id="endereco_emp" class="inputbox required" style="width:250px;" /></td>
		</tr>
        <tr>
        	<td valign="top">N&uacute;mero:<br /><input type="text" name="numero_emp" id="numero_emp" class="inputbox numero required" style="width:250px;" /></td>
            <td valign="top">Bairro:<br /><input type="text" name="bairro_emp" id="bairro_emp" class="inputbox required" style="width:250px;" /></td>
		</tr>
        <tr>
        	<td valign="top">Complemento:<br /><input type="text" name="complemento_emp" id="complemento_emp" class="inputbox" style="width:250px;" /></td>
        	<td valign="top">Cidade:<br /><input type="text" name="cidade_emp" id="cidade_emp" class="inputbox required" style="width:250px;" /></td>
		</tr>
        <tr>
        	<td colspan="2" valign="top">Estado:<br /><input type="text" name="estado_emp" id="estado_emp" class="inputbox required" style="width:250px;" /></td>
        </tr>
        <tr>
        	<td>Nome do representante legal:<br /><input type="text" name="nome_representante" class="inputbox required" style="width: 250px;" /></td>
            <td>Documento: <input type="radio" name="doc" value="ct" checked> Carteira Profissional ou <input type="radio" name="doc" value="rg"> RG <br /><input type="text" name="carteira_representante" class="inputbox required" style="width: 250px; text-transform:uppercase;" /></td>
        </tr>
        <tr>
            <td colspan="2"><hr /></td>
        </tr>
		<tr>
            <td colspan="2"><strong>FUNCION&Aacute;RIO(S)</strong></td>
        </tr>
        <tr>
        	<td valign="top" colspan="2" align="center">
            	<table cellpadding="0" cellspacing="0" id="campodependentes0">
                	<tr>
                        <td valign="top">Nome do funcion&aacute;rio:<br /><input type="text" name="nome_funcionario[0]" class="inputbox required" style="width:520px;" /></td>
                    </tr>
       			</table>
          	</td>
        </tr>
        <tr class="novosdependentess esconde">
        	<td valign="top" colspan="2" align="center" id="campodependentes">
            	<?php
				for($i=1;$i<8;$i++)
				{
				?>
            	<table cellpadding="0" cellspacing="0" id="campodependentes<?php echo $i;?>">
                	<tr>
                        <td valign="top">Nome do funcion&aacute;rio:<br /><input type="text" name="nome_funcionario[<?php echo $i;?>]" class="inputbox" style="width:520px;" /></td>
                    </tr>
       			</table>
                <?php
				}
				?>
          	</td>
       	</tr>
        <tr class="novosdependentess esconde">     
            <td colspan="2" align="center">
            <a class="adddependente" style="color: #FFF; cursor:pointer;">[ + ] Adicionar</a>&nbsp;&nbsp;
            <a class="removedependente" style="color: #FFF; cursor:pointer;">[ - ] Remover</a></td>
        </tr>
     
        <tr>
            <td colspan="2"><hr /></td>
        </tr>
        <tr>
        	<td>Cidade:<br /><input type="text" name="local" class="inputbox required" style="width:250px;" /></td>
            <td>Data:<br /><input type="text" name="data" class="inputbox data_admissao data required datamascara" placeholder="DD/MM/AAAA" style="width:250px;" /></td>
      	</tr>
        <tr>
            <td colspan="2" valign="top">E-mail <small>(para onde será enviado o arquivo)</small>:<br /><input type="text" name="email" class="inputbox required email" style="width:250px;" /></td>
        </tr>

        <tr><td colspan="2"><hr /></td></tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" value="Enviar" class="button" /></td>
		</tr>
	</table>
</form>
<?php
}
else if($id_categoria == "calchoraextra")
{
?>
<script type="text/javascript">
$(function(){
	
	$("#formularios").validate();
	
	$(".cnpj").setMask("cnpj");
	$(".cep").setMask("99999-999");
	$(".numero").setMask("99999999");
	
jQuery.validator.addMethod("cnpj", function(cnpj, element) {
   cnpj = jQuery.trim(cnpj);// retira espaços em branco
   // DEIXA APENAS OS NÚMEROS
   cnpj = cnpj.replace('/','');
   cnpj = cnpj.replace('.','');
   cnpj = cnpj.replace('.','');
   cnpj = cnpj.replace('-','');
 
   var numeros, digitos, soma, i, resultado, pos, tamanho, digitos_iguais;
   digitos_iguais = 1;
 
   if (cnpj.length < 14 && cnpj.length < 15){
      return false;
   }
   for (i = 0; i < cnpj.length - 1; i++){
      if (cnpj.charAt(i) != cnpj.charAt(i + 1)){
         digitos_iguais = 0;
         break;
      }
   }
 
   if (!digitos_iguais){
      tamanho = cnpj.length - 2
      numeros = cnpj.substring(0,tamanho);
      digitos = cnpj.substring(tamanho);
      soma = 0;
      pos = tamanho - 7;
 
      for (i = tamanho; i >= 1; i--){
         soma += numeros.charAt(tamanho - i) * pos--;
         if (pos < 2){
            pos = 9;
         }
      }
      resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
      if (resultado != digitos.charAt(0)){
         return false;
      }
      tamanho = tamanho + 1;
      numeros = cnpj.substring(0,tamanho);
      soma = 0;
      pos = tamanho - 7;
      for (i = tamanho; i >= 1; i--){
         soma += numeros.charAt(tamanho - i) * pos--;
         if (pos < 2){
            pos = 9;
         }
      }
      resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
      if (resultado != digitos.charAt(1)){
         return false;
      }
      return true;
   }else{
      return false;
   }
}, "Informe um CNPJ válido."); // Mensagem padrão 
	
	$("#cep").blur(function(){
		var cep = $(this).val();
		
		$.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+cep, function(){
			if(resultadoCEP["resultado"] == 1) {
				$("#endereco").val(unescape(resultadoCEP["tipo_logradouro"])+" "+unescape(resultadoCEP["logradouro"]));
				$("#bairro").val(unescape(resultadoCEP["bairro"]));
				$("#cidade").val(unescape(resultadoCEP["cidade"]));
				$("#estado").val(unescape(resultadoCEP["uf"]));
				$("#numero").focus();
			} else if(resultadoCEP["resultado"] == 2) {
				$("#cidade").val(unescape(resultadoCEP["cidade"]));
				$("#estado").val(unescape(resultadoCEP["uf"]));
				$("#endereco").focus();
			} else {
				alert("Endereço não encontrado");
			}
		});
	});
	 
	$(".hora").setMask("99:99");
	
	$(".hora").focus(function(){
		var linha = $(this).parent().parent().attr("class");
		$(".tblform td").removeClass("td_ativo");
		$("."+linha+" td").addClass("td_ativo");
	});
	

  
});
	// total de horas padrão
   
function isHoraInicialMenorHoraFinal(horaInicial, horaFinal){
	horaIni = horaInicial.split(':');
    horaFim = horaFinal.split(':');

	// Verifica as horas. Se forem diferentes, é só ver se a inicial 
	// é menor que a final.
	hIni = parseInt(horaIni[0], 10);
	hFim = parseInt(horaFim[0], 10);
	if(hIni != hFim)
		return hIni < hFim;
	
	// Se as horas são iguais, verifica os minutos então.
    mIni = parseInt(horaIni[1], 10);
	mFim = parseInt(horaFim[1], 10);
	if(mIni != mFim)
		return mIni < mFim;
}

function subtraiHora(hrA, hrB) {
        if(!hrA || !hrB || hrA.length != 5 || hrB.length != 5) return "00:00";
       
        temp = 0;
        nova_h = 0;
        novo_m = 0;
 
        hora1 = hrA.substr(0, 2) * 1;
        hora2 = hrB.substr(0, 2) * 1;
        minu1 = hrA.substr(3, 2) * 1;
        minu2 = hrB.substr(3, 2) * 1;
       
        temp = minu1 - minu2;
        while(temp < 0) {
                nova_h++;
                temp = temp + 60;
        }
        novo_m = temp.toString().length == 2 ? temp : ("0" + temp);
 
        temp = hora1 - hora2 - nova_h;
        while(temp < 0) {
                temp = temp + 24;
        }
        nova_h = temp.toString().length == 2 ? temp : ("0" + temp);
 
        return nova_h + ":" + novo_m;
}
function somaHora(hrA, hrB, zerarHora) {
        if(!hrA || !hrB || hrA.length != 5 || hrB.length != 5) return "00:00";
        temp = 0;
        nova_h = 0;
        novo_m = 0;
 
        hora1 = hrA.substr(0, 2) * 1;
        hora2 = hrB.substr(0, 2) * 1;
        minu1 = hrA.substr(3, 2) * 1;
        minu2 = hrB.substr(3, 2) * 1;
       
        temp = minu1 + minu2;
        while(temp > 59) {
                nova_h++;
                temp = temp - 60;
        }
        novo_m = temp.toString().length == 2 ? temp : ("0" + temp);
 
        temp = hora1 + hora2 + nova_h;
        while(temp > 23 && zerarHora) {
                temp = temp - 24;
        }
        nova_h = temp.toString().length == 2 ? temp : ("0" + temp);
 
        return nova_h + ":" + novo_m;
}

	


	/**
	 * Verifica se o usuário informou todos os campos da hora (hh:mm).
	 */
	function preencheuHoraCompleta( horario ){
		var hora = horario.replace(/[^0-9:]/g ,''); // deixa só números e o ponto
		return hora.length == 5;
	}

	/**
	 * Verifica se a hora é válidas. Exemplo: 12:34 é válido, 03:89 é inválido.
	 */
	function isHoraValida( horario ) {
		var regex = new RegExp("^([0-1][0-9]|[2][0-3]):([0-5][0-9])$");
		return regex.exec( horario ) != null;
	}

	/**
	 * Verifica se um campo está vazio.
	 */
	function possuiValor( valor ){
		return valor != undefined && valor != '';
	}
	
	/**
	 * Completa um número menor que dez com um zero à esquerda.
	 * Usado aqui para formatar as horas... Exemplo: 3:10 -> 03:10 , 10:5 -> 10:05
	 */
	function completaZeroEsquerda( numero ){
		return ( numero < 10 ? "0" + numero : numero);
	}
	
	function adicionalNoturno(horainicio, horafim)
	{
		var dif1;
		var dif2;
		
		horainicioC = parseInt((horainicio).replace(":",""));
		horafimC = parseInt((horafim).replace(":",""));
		
		/*
		if(horainicioC > 600 && horafimC < 2200)
		{
			return false;
		}
		else
		{
		*/
			if(horainicioC >= 2200 && horainicioC <= 2400)
			{
				if(horafimC >= 2200 && horafimC <= 2400)
				{
					return(subtraiHora(horafim, horainicio));
				}
				else if(horafimC <= 500)
				{
					dif1 = subtraiHora("24:00", horainicio);
					dif2 = subtraiHora(horafim, "00:00");
					
					return(somaHora(dif1, dif2, true));
				}
				else if(horafimC > 500)
				{
					if(horainicioC >= 2200)
					{
						dif1 = subtraiHora("24:00", "22:00");
						dif2 = subtraiHora("06:00", "00:00");
					}
					return somaHora(dif1, dif2, true);
				}
			}
			else if(horainicioC > 500 && horainicioC < 2200)
			{
			
				if(horafimC >= 2200 && horafimC <= 2400)
				{
					return (subtraiHora(horafim, "22:00"));
				}
				else if(horafimC <= 500)
				{
					dif1 = subtraiHora("24:00", "22:00");
					dif2 = subtraiHora(horafim, "00:00");
					
					return somaHora(dif1, dif2, true);
				}
				else if(horafimC > 500)
				{
					if(horainicioC >= 2200)
					{
						dif1 = subtraiHora("24:00", "22:00");
						dif2 = subtraiHora("06:00", "00:00");
					}
					return somaHora(dif1, dif2, true);
				}
				
			}
			else if(horainicioC >= 0 && horainicioC <= 500)
			{
				if(horafimC <= 500)
				{
					return(subtraiHora(horafim, horainicio));
				}
				else if(horafimC > 500 && horafimC <= 2200)
				{
					return(subtraiHora("06:00", horainicio));
				}
				else if(horafimC > 500 && horafimC <= 2400)
				{
					dif1 = subtraiHora("06:00", horainicio);
					dif2 = subtraiHora(horafim, "22:00");
					
					return(somaHora(dif1, dif2, true));
				}
			}
		//}

	}

</script>
<?php
	if(@$_GET['passo'])
	{
		
	?>	
	<script type="text/javascript">
	
	$(function(){
		var horaInicial_1;
		var horaFinal_1;
		var horaInicial_2;
		var horaFinal_2;
		var horaInicial_he = "00:00";
		var horaFinal_he = "00:00";
		var dif_turno1;
		var dif_turno2;
		var dif_he;
		var dif_he1;
		var dif_he2;
		var total_turno;
		var saldo;
		
		var horaInicial_Ad1 = "22:00";
		var horaFinal_Ad1;
		var dif_ad1;
		
		var horaInicial_Ad2 = "06:00";
		var horaFinal_Ad2;
		var dif_ad2;
		var dif_adhe;
		var total_ad;
		
		
	
		$(".hora").blur(function(){
			var linha = $(this).parent().parent().attr("class");
			var campo_f = $(this).attr("campo");
	
			
			if($(this).prop("readonly") == false)
			{
					
				horaInicial_1 = $("."+linha).find(".entrada_1").val();
				if(!horaInicial_1)
					horaInicial_1 = "00:00";
				horaFinal_1 = $("."+linha).find(".saida_1").val();
				if(!horaFinal_1)
					horaFinal_1 = "00:00";
				dif_turno1 = subtraiHora(horaFinal_1, horaInicial_1);		
				
				horaInicial_2 = $("."+linha).find(".entrada_2").val();
				if(!horaInicial_2)
					horaInicial_2 = "00:00";
				horaFinal_2 = $("."+linha).find(".saida_2").val();
				if(!horaFinal_2)
					horaFinal_2 = "00:00";
				dif_turno2 = subtraiHora(horaFinal_2, horaInicial_2);
				
				total_turno = somaHora(dif_turno1, dif_turno2, false);
				
				
				dif_ad1 = adicionalNoturno(horaInicial_1, horaFinal_1);
				if(!dif_ad1)
					dif_ad1 = "00:00";
				dif_ad2 = adicionalNoturno(horaInicial_2, horaFinal_2);
				if(!dif_ad2)
					dif_ad2 = "00:00";
	
				total_turno_ad = somaHora(dif_ad1, dif_ad2, false);
							
				horaInicial_he = $("."+linha).find(".entrada_he").val();
				if(!horaInicial_he)
					horaInicial_he = "00:00";
				horaFinal_he = $("."+linha).find(".saida_he").val();
				if(!horaFinal_he)
					horaFinal_he = "00:00";
			
				if((horaFinal_he != "00:00" && horaInicial_he != "00:00") || (horaFinal_he == "00:00" && horaInicial_he != "00:00"))
				{	
				
					if(isHoraInicialMenorHoraFinal(horaFinal_he, horaInicial_he))
					{
						dif_he1 = subtraiHora("24:00", horaInicial_he);
						dif_he2 = subtraiHora(horaFinal_he, "00:00");
						dif_he = somaHora(dif_he1, dif_he2, true);
						dif_adhe = adicionalNoturno(horaInicial_he, horaFinal_he);
					}
					else
					{
						if(!horaFinal_he || horaFinal_he == "00:00")
						{
							horaFinal_he = "24:00";
							dif_he = subtraiHora(horaFinal_he, horaInicial_he);
							dif_adhe = adicionalNoturno(horaInicial_he, horaFinal_he);
							
						}
						else
						{
							dif_he = subtraiHora(horaFinal_he, horaInicial_he);
							dif_adhe = adicionalNoturno(horaInicial_he, horaFinal_he);
						}
						
					}
				}
				else
					dif_he = "00:00";
				
				if(!dif_adhe)
					dif_adhe = "00:00";
					
				total_ad = somaHora(total_turno_ad, dif_adhe, false);
	
				$("."+linha).find(".total_ad").val(total_ad);
				
				saldo = somaHora(total_turno, dif_he, false);
				//(saldo);
				
				
				var carga_horaria = $("."+linha).find(".carga_horaria").val();
	
				if(isHoraInicialMenorHoraFinal(saldo, carga_horaria))
				{
					hora_saldo = subtraiHora(carga_horaria, saldo);
					$("."+linha).find(".total_he").val("-"+hora_saldo);
				}
				else
				{
					hora_saldo = subtraiHora(saldo, carga_horaria);
					$("."+linha).find(".total_he").val(hora_saldo);
				}
			
			
				$("."+linha).find(".saida_he").blur(function(){
				});
			}
	
		});
		
		var carga;
		var entrada_1;
		var entrada_2;
		var saida_1;
		var saida_2;
		var count = 0;
		$(".feriado").change(function(){
			var linha = $(this).parent().parent().attr("class");
			var tipo = $(this).val();
			var horarios = ($(this).attr("horarios")).split("|");
			
			entrada_1 = horarios[0];
			saida_1 = horarios[1];
			entrada_2 = horarios[2];
			saida_2 = horarios[3];
			carga = horarios[4];
			
			if(tipo == "Feriado_BH")
			{
				$("."+linha+" input").removeClass("required");
				$("."+linha+" input").prop("readonly", false);
				$("."+linha+" .hora").val("");
				$("."+linha+" .total_he").val("00:00");
				$("."+linha+" .carga_horaria").val("00:00");
				$("."+linha+" input").removeClass("disable");
			}
			else if(tipo == "Dia de folga")
			{
				$("."+linha+" input").removeClass("required");
				$("."+linha+" input").prop("readonly", true);
				$("."+linha+" .hora").val("");
				$("."+linha+" .carga_horaria").val("00:00");
				$("."+linha+" .total_he").val("00:00");
				$("."+linha+" .total_ad").val("00:00");
				
				$("."+linha+" input").removeClass("disable");
				
			}
			else if(tipo == "Compensação")
			{
				$("."+linha+" .hora").val("");
				$("."+linha+" .carga_horaria").val("00:00");
				$("."+linha+" .total_he").val("-"+carga);
				$("."+linha+" input").prop("readonly", true);
				$("."+linha+" input").removeClass("disable");
			}
			else if(tipo == "Falta")
			{
				$("."+linha+" .hora").val("");
				$("."+linha+" .carga_horaria").val("00:00");
				$("."+linha+" .total_he").val("00:00");
				$("."+linha+" input").prop("readonly", true);
				$("."+linha+" input").removeClass("disable");
			}
			else
			{
				
				$("."+linha+" input").removeClass("disable");
				
				$("."+linha+" .carga_horaria").val(carga);
				$("."+linha+" .entrada_1").val(entrada_1);
				$("."+linha+" .entrada_2").val(entrada_2);
				$("."+linha+" .saida_1").val(saida_1);
				$("."+linha+" .saida_2").val(saida_2);
				alert("Verifique a carga horária para esse dia.")
				$("."+linha+" .carga_horaria").focus();
				
				$("."+linha+" .total_he").val("00:00");
				
				$("."+linha+" input").prop("readonly", false);
			}
					
		});
		
		/*
		var carga;
		$(".desabilita").click(function(){
			var linha = $(this).parent().parent().attr("class");
			if($(this).is(":checked"))
			{
				carga = $("."+linha+" .carga_horaria").val();
				
				$("."+linha+" input").val("");
				$("."+linha+" input").attr("readonly", true);
			}
			else
			{
				$("."+linha+" .carga_horaria").val(carga);
				$("."+linha+" input").attr("readonly", false);
			}
					
		});
		*/
	});
	</script>
	<form action="paginas/envia.php?op=calcextra" method="post" id="formularios" style="width: 800px; margin-left: -30px;">
		<h3 align='center' style='margin-top: 20px;'><?php echo @$tituloform;?></h3>
		<input type="hidden" name="razao_social" value="<?php echo $_POST['razao_social'];?>" />
		<input type="hidden" name="doc" value="<?php echo $_POST['doc'];?>" />
		<input type="hidden" name="cnpj" value="<?php echo $_POST['cnpj'];?>" />
		<input type="hidden" name="email" value="<?php echo $_POST['email'];?>" />
		<input type="hidden" name="cep" value="<?php echo $_POST['cep'];?>" />
		<input type="hidden" name="endereco" value="<?php echo $_POST['endereco'];?>" />
		<input type="hidden" name="numero" value="<?php echo $_POST['numero'];?>" />
		<input type="hidden" name="bairro" value="<?php echo $_POST['bairro'];?>"  />
		<input type="hidden" name="complemento" value="<?php echo $_POST['complemento'];?>"  />
		<input type="hidden" name="cidade" value="<?php echo $_POST['cidade'];?>" />
		<input type="hidden" name="estado" value="<?php echo $_POST['estado'];?>" />
		<input type="hidden" name="nome_funcionario" value="<?php echo $_POST['nome_funcionario'];?>" />
		<input type="hidden" name="cargo" value="<?php echo $_POST['cargo'];?>" />
		<input type="hidden" name="data_de" value="<?php echo $_POST['data_de'];?>" />
		<input type="hidden" name="data_ate" value="<?php echo $_POST['data_ate'];?>" />
		<?php
		//echo "<pre>";
		//print_r($_POST);
		//echo "</pre>";
		?>
		<table cellpadding="10" cellspacing="0" width="100%" class="tblform">
			<tr>
				<td colspan="2">
					<table cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<th></th>
							<th align="center" colspan="2">HOR&Aacute;RIO: &nbsp;1&deg; TURNO</th>
							<th align="center" colspan="2">HOR&Aacute;RIO: &nbsp;2&deg; TURNO</th>
							<th align="center" colspan="2">HORA EXTRA</th>
							<th align="center" colspan="2">SALDO</th>
							<th></th>
						</tr>
						<tr>
							<td align="center" style="background: #111; border:1px solid #000 !important; border-right:5px solid #000 !important;">Dia</td>
							<td align="center" style="background: #111; border:1px solid #000 !important;">Entrada</td>
							<td align="center" style="background: #111; border:1px solid #000 !important; border-right:5px solid #000 !important;">Sa&iacute;da</td>
							<td align="center" style="background: #111; border:1px solid #000 !important;">Entrada</td>
							<td align="center" style="background: #111; border:1px solid #000 !important; border-right:5px solid #000 !important;">Sa&iacute;da</td>
							<td align="center" style="background: #111; border:1px solid #000 !important;">Entrada</td>
							<td align="center" style="background: #111; border:1px solid #000 !important; border-right:5px solid #000 !important;">Sa&iacute;da</td>
							<td align="center" style="background: #222; border:1px solid #000 !important;">Carga<br />Horária</td>
							<td align="center" style="background: #222; border:1px solid #000 !important;">Horas</td>
							<td align="center" style="background: #222; border:1px solid #000 !important;">Adicional<br />Noturno</td>
							<td align="center" style="background: #222; border:1px solid #000 !important;">Observação</td>
						</tr>
						<?php
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
								if($_POST['tipo_jornada'] == "12x36") ///// JORNADA 12X36 - ALTERNA DIA TARBALHADO E FOLGA
								{
									if($linha % 2 == 0) ////// 12X36 DIA DE TRABALHO
									{
										if($diasemana[date("w",strtotime($i))] == "DOM" || $diasemana[date("w",strtotime($i))] == "SAB")
										{
											$campo_f = "fimdesemana";
											$bg = "#0A0A0A";	
										}
										else
										{
											$campo_f = "semana";
											$bg = "#111";	
										}

										if($diasemana[date("w",strtotime($i))] == "SEG")
										{
											$entrada1 = $_POST['entrada_1_1'];
											$saida1 = $_POST['saida_1_1'];
											$cargahoraria = @$_POST['carga_horaria_1'];
										}
										else if($diasemana[date("w",strtotime($i))] == "TER")
										{
											$entrada1 = $_POST['entrada_1_2'];
											$saida1 = $_POST['saida_1_2'];
											$cargahoraria = @$_POST['carga_horaria_2'];
										}
										else if($diasemana[date("w",strtotime($i))] == "QUA")
										{
											$entrada1 = $_POST['entrada_1_3'];
											$saida1 = $_POST['saida_1_3'];
											$cargahoraria = @$_POST['carga_horaria_3'];
										}
										else if($diasemana[date("w",strtotime($i))] == "QUI")
										{
											$entrada1 = $_POST['entrada_1_4'];
											$saida1 = $_POST['saida_1_4'];
											$cargahoraria = @$_POST['carga_horaria_4'];
										}
										else if($diasemana[date("w",strtotime($i))] == "SEX")
										{
											$entrada1 = $_POST['entrada_1_5'];
											$saida1 = $_POST['saida_1_5'];
											$cargahoraria = @$_POST['carga_horaria_5'];
										}
											$entrada2 = "";
											$saida2 = "";
											
											$entrada_he = "";
											$saida_he = "";
											$desabilita = "";
									}
									else /////// 12X36 DIA DE FOLGA
									{
										if($diasemana[date("w",strtotime($i))] == "DOM" || $diasemana[date("w",strtotime($i))] == "SAB")
										{
											$campo_f = "fimdesemana";
											$bg = "#0A0A0A";	
										}
										else
										{
											$campo_f = "semana";
											$bg = "#111";	
										}
											$entrada1 = "";
											$saida1 = "";
											$entrada2 = "";
											$saida2 = "";
											$cargahoraria = "00:00";
											$entrada_he = "";
											$saida_he = "";
											$desabilita = "readonly";
									}
								}
								else /////// JORNADA NORMAL
								{
									if($diasemana[date("w",strtotime($i))] == "DOM") ////// DOMINGO
									{
										$entrada1 = $_POST['entrada_1_d'];
										$saida1 = $_POST['saida_1_d'];
										$entrada2 = $_POST['entrada_2_d'];
										$saida2 = $_POST['saida_2_d'];
										$cargahoraria = "00:00";
										$entrada_he = "";
										$saida_he = "";
										$desabilita = "";
										$campo_f = "fimdesemana";
										$bg = "#0A0A0A";
									}
									else if($diasemana[date("w",strtotime($i))] == "SAB") ////// SÁBADO
									{
										$entrada1 = $_POST['entrada_1_s'];
										$saida1 = $_POST['saida_1_s'];
										$entrada2 = $_POST['entrada_2_s'];
										$saida2 = $_POST['saida_2_s'];
										$cargahoraria = @$_POST['carga_horaria_s'];
										$entrada_he = "";
										$saida_he = "";
										$desabilita = "";
										$campo_f = "fimdesemana";
										$bg = "#0A0A0A";
									}
									else /////// DIA DE SEMANA
									{
										if($diasemana[date("w",strtotime($i))] == "SEG")
										{
											$entrada1 = $_POST['entrada_1_1'];
											$saida1 = $_POST['saida_1_1'];
											$entrada2 = $_POST['entrada_2_1'];
											$saida2 = $_POST['saida_2_1'];
											$cargahoraria = @$_POST['carga_horaria_1'];
										}
										else if($diasemana[date("w",strtotime($i))] == "TER")
										{
											$entrada1 = $_POST['entrada_1_2'];
											$saida1 = $_POST['saida_1_2'];
											$entrada2 = $_POST['entrada_2_2'];
											$saida2 = $_POST['saida_2_2'];
											$cargahoraria = @$_POST['carga_horaria_2'];
										}
										else if($diasemana[date("w",strtotime($i))] == "QUA")
										{
											$entrada1 = $_POST['entrada_1_3'];
											$saida1 = $_POST['saida_1_3'];
											$entrada2 = $_POST['entrada_2_3'];
											$saida2 = $_POST['saida_2_3'];
											$cargahoraria = @$_POST['carga_horaria_3'];
										}
										else if($diasemana[date("w",strtotime($i))] == "QUI")
										{
											$entrada1 = $_POST['entrada_1_4'];
											$saida1 = $_POST['saida_1_4'];
											$entrada2 = $_POST['entrada_2_4'];
											$saida2 = $_POST['saida_2_4'];
											$cargahoraria = @$_POST['carga_horaria_4'];
										}
										else if($diasemana[date("w",strtotime($i))] == "SEX")
										{
											$entrada1 = $_POST['entrada_1_5'];
											$saida1 = $_POST['saida_1_5'];
											$entrada2 = $_POST['entrada_2_5'];
											$saida2 = $_POST['saida_2_5'];
											$cargahoraria = @$_POST['carga_horaria_5'];
										}

										$entrada_he = "";
										$saida_he = "";
										$desabilita = "";
										$campo_f = "semana";
										$bg = "#111";
									}
								
								}
							?>
							<tr class="l<?php echo $linha;?>">
								<td align="center" style="border-right:5px solid #000 !important;"><?php echo date("d/m",strtotime($i));?><br /><?php echo $diasemana[date("w",strtotime($i))];?><input type="hidden" name="dia[<?php echo $linha;?>]" value="<?php echo date("d/m",strtotime($i));?>-<?php echo $diasemana[date("w",strtotime($i))];?>"></td>
								<td align="center" style="background: <?php echo $bg;?>; border:1px solid #000 !important;"><input type="text" campo="<?php echo $campo_f;?>" <?php echo $desabilita;?> name="entrada_1[<?php echo $linha;?>]" placeholder="--:--" value="<?php echo $entrada1;?>" class="inputbox hora entrada_1  " style="width: 35px; padding: 5px 7px; text-align:center; background: #000;" /></td>
								<td align="center" style="background: <?php echo $bg;?>; border:1px solid #000 !important; border-right:5px solid #000 !important;"><input type="text" campo="<?php echo $campo_f;?>" <?php echo $desabilita;?> name="saida_1[<?php echo $linha;?>]" placeholder="--:--" value="<?php echo $saida1;?>" class="inputbox hora saida_1  " style="width: 35px; padding: 5px 7px; text-align:center; background: #000;" /></td>
								<td align="center" style="background: <?php echo $bg;?>; border:1px solid #000 !important;"><input type="text" campo="<?php echo $campo_f;?>" <?php echo $desabilita;?> name="entrada_2[<?php echo $linha;?>]" placeholder="--:--" value="<?php echo $entrada2;?>" class="inputbox hora entrada_2" style="width: 35px; padding: 5px 7px; text-align:center; background: #000;" /></td>
								<td align="center" style="background: <?php echo $bg;?>; border:1px solid #000 !important; border-right:5px solid #000 !important;"><input type="text" campo="<?php echo $campo_f;?>" <?php echo $desabilita;?> name="saida_2[<?php echo $linha;?>]" placeholder="--:--" value="<?php echo $saida2;?>" class="inputbox hora saida_2  " style="width: 35px; padding: 5px 7px; text-align:center; background: #000;" /></td>
								<td align="center" style="background: <?php echo $bg;?>; border:1px solid #000 !important;"><input type="text" campo="<?php echo $campo_f;?>" <?php echo $desabilita;?> name="entrada_he[<?php echo $linha;?>]" placeholder="--:--" value="<?php echo $entrada_he;?>" class="inputbox entrada_he hora" style="width: 35px; padding: 5px 7px; text-align:center; background: #000;" /></td>
								<td align="center" style="background: <?php echo $bg;?>; border:1px solid #000 !important; border-right:5px solid #000 !important;"><input type="text" campo="<?php echo $campo_f;?>" <?php echo $desabilita;?> name="saida_he[<?php echo $linha;?>]" placeholder="--:--" value="<?php echo $saida_he;?>" class="inputbox saida_he hora" style="width: 35px; padding: 5px 7px; text-align:center; background: #000;" /></td>
								<td align="center" style="background: #222; border:1px solid #000 !important;"><input type="text" name="carga_horaria[<?php echo $linha;?>]" <?php echo $desabilita;?> placeholder="--:--" class="inputbox carga_horaria hora" value="<?php echo $cargahoraria;?>" style="width: 35px; padding: 5px 7px; text-align:center; background: #000;" /></td>
								<td align="center" style="background: #222; border:1px solid #000 !important;"><input readonly type="text" name="total_he[<?php echo $linha;?>]" placeholder="00:00" value="00:00" class="inputbox total_he" style="width: 35px; padding: 5px 7px; text-align:center; background: #000;" /></td>
								<td align="center" style="background: #222; border:1px solid #000 !important;"><input readonly type="text" name="total_ad[<?php echo $linha;?>]" placeholder="00:00" value="00:00" class="inputbox total_ad" style="width: 35px; padding: 5px 7px; text-align:center; background: #000;" /></td>
								<td align="center" style="background: #222; border:1px solid #000 !important;">
									<select name="tipo[<?php echo $linha;?>]" class="inputbox feriado" horarios="<?php echo $entrada1;?>|<?php echo $saida1;?>|<?php echo $entrada2;?>|<?php echo $saida2;?>|<?php echo $cargahoraria;?>">
										<option value="">Selecione</option>
										<option value="Falta">Falta</option>
										<option value="Compensação">Compensa&ccedil;&atilde;o</option>
										<option value="Feriado_BH">Feriado BH</option>
										<option value="Feriado_PG">Feriado PG</option>
										<?php
											if($_POST['tipo_jornada'] == "12x36")
											{
												if($linha % 2 != 0)
													$seleciona = "selected='selected'";
												else
													$seleciona = "";
											}
											else
												$seleciona = "";
										?>
										<option <?php echo $seleciona;?> value="Dia de folga">Dia de folga</option>
									</select>
								</td>
							</tr>
							<?php
								$linha++;
							}
						}
						else
						{
							$ultimodia = date("t", strtotime($data_de));
							$ultimodia = $anoinicio."-".$mesinicio."-".$ultimodia;
							for($i = $data_de; $i <= $ultimodia; $i++)
							{
								if($_POST['tipo_jornada'] == "12x36") ///// JORNADA 12X36 - ALTERNA DIA TARBALHADO E FOLGA
								{
									if($linha % 2 == 0) ////// 12X36 DIA DE TRABALHO
									{
										if($diasemana[date("w",strtotime($i))] == "DOM" || $diasemana[date("w",strtotime($i))] == "SAB")
										{
											$campo_f = "fimdesemana";
											$bg = "#0A0A0A";	
										}
										else
										{
											$campo_f = "semana";
											$bg = "#111";	
										}
										if($diasemana[date("w",strtotime($i))] == "SEG")
										{
											$entrada1 = $_POST['entrada_1_1'];
											$saida1 = $_POST['saida_1_1'];
											$cargahoraria = @$_POST['carga_horaria_1'];
										}
										else if($diasemana[date("w",strtotime($i))] == "TER")
										{
											$entrada1 = $_POST['entrada_1_2'];
											$saida1 = $_POST['saida_1_2'];
											$cargahoraria = @$_POST['carga_horaria_2'];
										}
										else if($diasemana[date("w",strtotime($i))] == "QUA")
										{
											$entrada1 = $_POST['entrada_1_3'];
											$saida1 = $_POST['saida_1_3'];
											$cargahoraria = @$_POST['carga_horaria_3'];
										}
										else if($diasemana[date("w",strtotime($i))] == "QUI")
										{
											$entrada1 = $_POST['entrada_1_4'];
											$saida1 = $_POST['saida_1_4'];
											$cargahoraria = @$_POST['carga_horaria_4'];
										}
										else if($diasemana[date("w",strtotime($i))] == "SEX")
										{
											$entrada1 = $_POST['entrada_1_5'];
											$saida1 = $_POST['saida_1_5'];
											$cargahoraria = @$_POST['carga_horaria_5'];
										}
											$entrada2 = "";
											$saida2 = "";
											$entrada_he = "";
											$saida_he = "";
											$desabilita = "";
									}
									else /////// 12X36 DIA DE FOLGA
									{
										if($diasemana[date("w",strtotime($i))] == "DOM" || $diasemana[date("w",strtotime($i))] == "SAB")
										{
											$campo_f = "fimdesemana";
											$bg = "#0A0A0A";	
										}
										else
										{
											$campo_f = "semana";
											$bg = "#111";	
										}
											$entrada1 = "";
											$saida1 = "";
											$entrada2 = "";
											$saida2 = "";
											$cargahoraria = "00:00";
											$entrada_he = "";
											$saida_he = "";
											$desabilita = "readonly";
									}
								}
								else /////// JORNADA NORMAL
								{
									if($diasemana[date("w",strtotime($i))] == "DOM") ////// DOMINGO
									{
										$entrada1 = $_POST['entrada_1_d'];
										$saida1 = $_POST['saida_1_d'];
										$entrada2 = $_POST['entrada_2_d'];
										$saida2 = $_POST['saida_2_d'];
										$cargahoraria = "00:00";
										$entrada_he = "";
										$saida_he = "";
										$desabilita = "";
										$campo_f = "fimdesemana";
										$bg = "#0A0A0A";
									}
									else if($diasemana[date("w",strtotime($i))] == "SAB") ////// SÁBADO
									{
										$entrada1 = $_POST['entrada_1_s'];
										$saida1 = $_POST['saida_1_s'];
										$entrada2 = $_POST['entrada_2_s'];
										$saida2 = $_POST['saida_2_s'];
										$cargahoraria = @$_POST['carga_horaria_s'];
										$entrada_he = "";
										$saida_he = "";
										$desabilita = "";
										$campo_f = "fimdesemana";
										$bg = "#0A0A0A";
									}
									else /////// DIA DE SEMANA
									{
										if($diasemana[date("w",strtotime($i))] == "SEG")
										{
											$entrada1 = $_POST['entrada_1_1'];
											$saida1 = $_POST['saida_1_1'];
											$entrada2 = $_POST['entrada_2_1'];
											$saida2 = $_POST['saida_2_1'];
											$cargahoraria = @$_POST['carga_horaria_1'];
										}
										else if($diasemana[date("w",strtotime($i))] == "TER")
										{
											$entrada1 = $_POST['entrada_1_2'];
											$saida1 = $_POST['saida_1_2'];
											$entrada2 = $_POST['entrada_2_2'];
											$saida2 = $_POST['saida_2_2'];
											$cargahoraria = @$_POST['carga_horaria_2'];
										}
										else if($diasemana[date("w",strtotime($i))] == "QUA")
										{
											$entrada1 = $_POST['entrada_1_3'];
											$saida1 = $_POST['saida_1_3'];
											$entrada2 = $_POST['entrada_2_3'];
											$saida2 = $_POST['saida_2_3'];
											$cargahoraria = @$_POST['carga_horaria_3'];
										}
										else if($diasemana[date("w",strtotime($i))] == "QUI")
										{
											$entrada1 = $_POST['entrada_1_4'];
											$saida1 = $_POST['saida_1_4'];
											$entrada2 = $_POST['entrada_2_4'];
											$saida2 = $_POST['saida_2_4'];
											$cargahoraria = @$_POST['carga_horaria_4'];
										}
										else if($diasemana[date("w",strtotime($i))] == "SEX")
										{
											$entrada1 = $_POST['entrada_1_5'];
											$saida1 = $_POST['saida_1_5'];
											$entrada2 = $_POST['entrada_2_5'];
											$saida2 = $_POST['saida_2_5'];
											$cargahoraria = @$_POST['carga_horaria_5'];
										}

										$entrada_he = "";
										$saida_he = "";
										$desabilita = "";
										$campo_f = "semana";
										$bg = "#111";
									}
								
								}
							?>
							<tr class="l<?php echo $linha;?>">
								<td align="center" style="border-right:5px solid #000 !important;"><?php echo date("d/m",strtotime($i));?><br /><?php echo $diasemana[date("w",strtotime($i))];?><input type="hidden" name="dia[<?php echo $linha;?>]" value="<?php echo date("d/m",strtotime($i));?>-<?php echo $diasemana[date("w",strtotime($i))];?>"></td>
								<td align="center" style="background: <?php echo $bg;?>; border:1px solid #000 !important;"><input type="text" campo="<?php echo $campo_f;?>" <?php echo $desabilita;?> name="entrada_1[<?php echo $linha;?>]" placeholder="--:--" value="<?php echo $entrada1;?>" class="inputbox hora entrada_1  " style="width: 35px; padding: 5px 7px; text-align:center; background: #000;" /></td>
								<td align="center" style="background: <?php echo $bg;?>; border:1px solid #000 !important; border-right:5px solid #000 !important;"><input type="text" campo="<?php echo $campo_f;?>" <?php echo $desabilita;?> name="saida_1[<?php echo $linha;?>]" placeholder="--:--" value="<?php echo $saida1;?>" class="inputbox hora saida_1  " style="width: 35px; padding: 5px 7px; text-align:center; background: #000;" /></td>
								<td align="center" style="background: <?php echo $bg;?>; border:1px solid #000 !important;"><input type="text" campo="<?php echo $campo_f;?>" <?php echo $desabilita;?> name="entrada_2[<?php echo $linha;?>]" placeholder="--:--" value="<?php echo $entrada2;?>" class="inputbox hora entrada_2" style="width: 35px; padding: 5px 7px; text-align:center; background: #000;" /></td>
								<td align="center" style="background: <?php echo $bg;?>; border:1px solid #000 !important; border-right:5px solid #000 !important;"><input type="text" campo="<?php echo $campo_f;?>" <?php echo $desabilita;?> name="saida_2[<?php echo $linha;?>]" placeholder="--:--" value="<?php echo $saida2;?>" class="inputbox hora saida_2  " style="width: 35px; padding: 5px 7px; text-align:center; background: #000;" /></td>
								<td align="center" style="background: <?php echo $bg;?>; border:1px solid #000 !important;"><input type="text" campo="<?php echo $campo_f;?>" <?php echo $desabilita;?> name="entrada_he[<?php echo $linha;?>]" placeholder="--:--" value="<?php echo $entrada_he;?>" class="inputbox entrada_he hora" style="width: 35px; padding: 5px 7px; text-align:center; background: #000;" /></td>
								<td align="center" style="background: <?php echo $bg;?>; border:1px solid #000 !important; border-right:5px solid #000 !important;"><input type="text" campo="<?php echo $campo_f;?>" <?php echo $desabilita;?> name="saida_he[<?php echo $linha;?>]" placeholder="--:--" value="<?php echo $saida_he;?>" class="inputbox saida_he hora" style="width: 35px; padding: 5px 7px; text-align:center; background: #000;" /></td>
								<td align="center" style="background: #222; border:1px solid #000 !important;"><input type="text" name="carga_horaria[<?php echo $linha;?>]" <?php echo $desabilita;?> placeholder="--:--" class="inputbox carga_horaria hora" value="<?php echo $cargahoraria;?>" style="width: 35px; padding: 5px 7px; text-align:center; background: #000;" /></td>
								<td align="center" style="background: #222; border:1px solid #000 !important;"><input readonly type="text" name="total_he[<?php echo $linha;?>]" placeholder="00:00" value="00:00" class="inputbox total_he" style="width: 35px; padding: 5px 7px; text-align:center; background: #000;" /></td>
								<td align="center" style="background: #222; border:1px solid #000 !important;"><input readonly type="text" name="total_ad[<?php echo $linha;?>]" placeholder="00:00" value="00:00" class="inputbox total_ad" style="width: 35px; padding: 5px 7px; text-align:center; background: #000;" /></td>
								<td align="center" style="background: #222; border:1px solid #000 !important;">
									<select name="tipo[<?php echo $linha;?>]" class="inputbox feriado" horarios="<?php echo $entrada1;?>|<?php echo $saida1;?>|<?php echo $entrada2;?>|<?php echo $saida2;?>|<?php echo $cargahoraria;?>">
										<option value="">Selecione</option>
										<option value="Falta">Falta</option>
										<option value="Compensação">Compensa&ccedil;&atilde;o</option>
										<option value="Feriado_BH">Feriado BH</option>
										<option value="Feriado_PG">Feriado PG</option>
										<?php
											if($_POST['tipo_jornada'] == "12x36")
											{
												if($linha % 2 != 0)
													$seleciona = "selected='selected'";
												else
													$seleciona = "";
											}
											else
												$seleciona = "";
										?>
										<option <?php echo $seleciona;?> value="Dia de folga">Dia de folga</option>
									</select>
								</td>
							</tr>
							<?php
								$linha++;
							}
							$ultimodia = date("t", strtotime($data_de));
							$novoinicio = $anofim."-".$mesfim."-01";
							for($i = $novoinicio; $i <= $data_ate; $i++)
							{
								if($_POST['tipo_jornada'] == "12x36") ///// JORNADA 12X36 - ALTERNA DIA TARBALHADO E FOLGA
								{
									if($linha % 2 == 0) ////// 12X36 DIA DE TRABALHO
									{
										if($diasemana[date("w",strtotime($i))] == "DOM" || $diasemana[date("w",strtotime($i))] == "SAB")
										{
											$campo_f = "fimdesemana";
											$bg = "#0A0A0A";	
										}
										else
										{
											$campo_f = "semana";
											$bg = "#111";	
										}
										
										if($diasemana[date("w",strtotime($i))] == "SEG")
										{
											$entrada1 = $_POST['entrada_1_1'];
											$saida1 = $_POST['saida_1_1'];
											$cargahoraria = @$_POST['carga_horaria_1'];
										}
										else if($diasemana[date("w",strtotime($i))] == "TER")
										{
											$entrada1 = $_POST['entrada_1_2'];
											$saida1 = $_POST['saida_1_2'];
											$cargahoraria = @$_POST['carga_horaria_2'];
										}
										else if($diasemana[date("w",strtotime($i))] == "QUA")
										{
											$entrada1 = $_POST['entrada_1_3'];
											$saida1 = $_POST['saida_1_3'];
											$cargahoraria = @$_POST['carga_horaria_3'];
										}
										else if($diasemana[date("w",strtotime($i))] == "QUI")
										{
											$entrada1 = $_POST['entrada_1_4'];
											$saida1 = $_POST['saida_1_4'];
											$cargahoraria = @$_POST['carga_horaria_4'];
										}
										else if($diasemana[date("w",strtotime($i))] == "SEX")
										{
											$entrada1 = $_POST['entrada_1_5'];
											$saida1 = $_POST['saida_1_5'];
											$cargahoraria = @$_POST['carga_horaria_5'];
										}
											$entrada2 = "";
											$saida2 = "";

											$entrada_he = "";
											$saida_he = "";
											$desabilita = "";
									}
									else /////// 12X36 DIA DE FOLGA
									{
										if($diasemana[date("w",strtotime($i))] == "DOM" || $diasemana[date("w",strtotime($i))] == "SAB")
										{
											$campo_f = "fimdesemana";
											$bg = "#0A0A0A";	
										}
										else
										{
											$campo_f = "semana";
											$bg = "#111";	
										}
											$entrada1 = "";
											$saida1 = "";
											$entrada2 = "";
											$saida2 = "";
											$cargahoraria = "00:00";
											$entrada_he = "";
											$saida_he = "";
											$desabilita = "readonly";
									}
								}
								else /////// JORNADA NORMAL
								{
									if($diasemana[date("w",strtotime($i))] == "DOM") ////// DOMINGO
									{
										$entrada1 = $_POST['entrada_1_d'];
										$saida1 = $_POST['saida_1_d'];
										$entrada2 = $_POST['entrada_2_d'];
										$saida2 = $_POST['saida_2_d'];
										$cargahoraria = "00:00";
										$entrada_he = "";
										$saida_he = "";
										$desabilita = "";
										$campo_f = "fimdesemana";
										$bg = "#0A0A0A";
									}
									else if($diasemana[date("w",strtotime($i))] == "SAB") ////// SÁBADO
									{
										$entrada1 = $_POST['entrada_1_s'];
										$saida1 = $_POST['saida_1_s'];
										$entrada2 = $_POST['entrada_2_s'];
										$saida2 = $_POST['saida_2_s'];
										$cargahoraria = @$_POST['carga_horaria_s'];
										$entrada_he = "";
										$saida_he = "";
										$desabilita = "";
										$campo_f = "fimdesemana";
										$bg = "#0A0A0A";
									}
									else /////// DIA DE SEMANA
									{
										if($diasemana[date("w",strtotime($i))] == "SEG")
										{
											$entrada1 = $_POST['entrada_1_1'];
											$saida1 = $_POST['saida_1_1'];
											$entrada2 = $_POST['entrada_2_1'];
											$saida2 = $_POST['saida_2_1'];
											$cargahoraria = @$_POST['carga_horaria_1'];
										}
										else if($diasemana[date("w",strtotime($i))] == "TER")
										{
											$entrada1 = $_POST['entrada_1_2'];
											$saida1 = $_POST['saida_1_2'];
											$entrada2 = $_POST['entrada_2_2'];
											$saida2 = $_POST['saida_2_2'];
											$cargahoraria = @$_POST['carga_horaria_2'];
										}
										else if($diasemana[date("w",strtotime($i))] == "QUA")
										{
											$entrada1 = $_POST['entrada_1_3'];
											$saida1 = $_POST['saida_1_3'];
											$entrada2 = $_POST['entrada_2_3'];
											$saida2 = $_POST['saida_2_3'];
											$cargahoraria = @$_POST['carga_horaria_3'];
										}
										else if($diasemana[date("w",strtotime($i))] == "QUI")
										{
											$entrada1 = $_POST['entrada_1_4'];
											$saida1 = $_POST['saida_1_4'];
											$entrada2 = $_POST['entrada_2_4'];
											$saida2 = $_POST['saida_2_4'];
											$cargahoraria = @$_POST['carga_horaria_4'];
										}
										else if($diasemana[date("w",strtotime($i))] == "SEX")
										{
											$entrada1 = $_POST['entrada_1_5'];
											$saida1 = $_POST['saida_1_5'];
											$entrada2 = $_POST['entrada_2_5'];
											$saida2 = $_POST['saida_2_5'];
											$cargahoraria = @$_POST['carga_horaria_5'];
										}

										$entrada_he = "";
										$saida_he = "";
										$desabilita = "";
										$campo_f = "semana";
										$bg = "#111";
									}
								
								}
							?>
							<tr class="l<?php echo $linha;?>">
								<td align="center" style="border-right:5px solid #000 !important;"><?php echo date("d/m",strtotime($i));?><br /><?php echo $diasemana[date("w",strtotime($i))];?><input type="hidden" name="dia[<?php echo $linha;?>]" value="<?php echo date("d/m",strtotime($i));?>-<?php echo $diasemana[date("w",strtotime($i))];?>"></td>
								<td align="center" style="background: <?php echo $bg;?>; border:1px solid #000 !important;"><input type="text" campo="<?php echo $campo_f;?>" <?php echo $desabilita;?> name="entrada_1[<?php echo $linha;?>]" placeholder="--:--" value="<?php echo $entrada1;?>" class="inputbox hora entrada_1  " style="width: 35px; padding: 5px 7px; text-align:center; background: #000;" /></td>
								<td align="center" style="background: <?php echo $bg;?>; border:1px solid #000 !important; border-right:5px solid #000 !important;"><input type="text" campo="<?php echo $campo_f;?>" <?php echo $desabilita;?> name="saida_1[<?php echo $linha;?>]" placeholder="--:--" value="<?php echo $saida1;?>" class="inputbox hora saida_1  " style="width: 35px; padding: 5px 7px; text-align:center; background: #000;" /></td>
								<td align="center" style="background: <?php echo $bg;?>; border:1px solid #000 !important;"><input type="text" campo="<?php echo $campo_f;?>" <?php echo $desabilita;?> name="entrada_2[<?php echo $linha;?>]" placeholder="--:--" value="<?php echo $entrada2;?>" class="inputbox hora entrada_2" style="width: 35px; padding: 5px 7px; text-align:center; background: #000;" /></td>
								<td align="center" style="background: <?php echo $bg;?>; border:1px solid #000 !important; border-right:5px solid #000 !important;"><input type="text" campo="<?php echo $campo_f;?>" <?php echo $desabilita;?> name="saida_2[<?php echo $linha;?>]" placeholder="--:--" value="<?php echo $saida2;?>" class="inputbox hora saida_2  " style="width: 35px; padding: 5px 7px; text-align:center; background: #000;" /></td>
								<td align="center" style="background: <?php echo $bg;?>; border:1px solid #000 !important;"><input type="text" campo="<?php echo $campo_f;?>" <?php echo $desabilita;?> name="entrada_he[<?php echo $linha;?>]" placeholder="--:--" value="<?php echo $entrada_he;?>" class="inputbox entrada_he hora" style="width: 35px; padding: 5px 7px; text-align:center; background: #000;" /></td>
								<td align="center" style="background: <?php echo $bg;?>; border:1px solid #000 !important; border-right:5px solid #000 !important;"><input type="text" campo="<?php echo $campo_f;?>" <?php echo $desabilita;?> name="saida_he[<?php echo $linha;?>]" placeholder="--:--" value="<?php echo $saida_he;?>" class="inputbox saida_he hora" style="width: 35px; padding: 5px 7px; text-align:center; background: #000;" /></td>
								<td align="center" style="background: #222; border:1px solid #000 !important;"><input type="text" name="carga_horaria[<?php echo $linha;?>]" <?php echo $desabilita;?> placeholder="--:--" class="inputbox carga_horaria hora" value="<?php echo $cargahoraria;?>" style="width: 35px; padding: 5px 7px; text-align:center; background: #000;" /></td>
								<td align="center" style="background: #222; border:1px solid #000 !important;"><input readonly type="text" name="total_he[<?php echo $linha;?>]" placeholder="00:00" value="00:00" class="inputbox total_he" style="width: 35px; padding: 5px 7px; text-align:center; background: #000;" /></td>
								<td align="center" style="background: #222; border:1px solid #000 !important;"><input readonly type="text" name="total_ad[<?php echo $linha;?>]" placeholder="00:00" value="00:00" class="inputbox total_ad" style="width: 35px; padding: 5px 7px; text-align:center; background: #000;" /></td>
								<td align="center" style="background: #222; border:1px solid #000 !important;">
									<select name="tipo[<?php echo $linha;?>]" class="inputbox feriado" horarios="<?php echo $entrada1;?>|<?php echo $saida1;?>|<?php echo $entrada2;?>|<?php echo $saida2;?>|<?php echo $cargahoraria;?>">
										<option value="">Selecione</option>
										<option value="Falta">Falta</option>
										<option value="Compensação">Compensa&ccedil;&atilde;o</option>
										<option value="Feriado_BH">Feriado BH</option>
										<option value="Feriado_PG">Feriado PG</option>
										<?php
											if($_POST['tipo_jornada'] == "12x36")
											{
												if($linha % 2 != 0)
													$seleciona = "selected='selected'";
												else
													$seleciona = "";
											}
											else
												$seleciona = "";
										?>
										<option <?php echo $seleciona;?> value="Dia de folga">Dia de folga</option>
									</select>
								</td>
							</tr>
							<?php
							$linha++;
							}
						}
						?>
					</table>
				</td>
			</tr>
			<tr><td colspan="2"><hr /></td></tr>
			<tr>
				<td colspan="2" align="center"><input type="submit" value="Enviar" class="button" /></td>
			</tr>
		</table>
	</form>
	<?php
	}
	else
	{
	?>
	<script type="text/javascript">
	$(function(){
		$( "input[name='data_de']" ).datepicker({
			dateFormat: "dd/mm/yy",
			changeMonth: true,
			changeYear: true,
			onClose: function( selectedDate ) {
				$( "input[name='data_ate']" ).datepicker( "option", "minDate", selectedDate );
			}
		});
		
		$( "input[name='data_ate']" ).datepicker({
			dateFormat: "dd/mm/yy",
			changeMonth: true,
			changeYear: true
		});
		
		var tipojor;
		$("select[name='tipo_jornada']").change(function(){
			var tipojor = $(this).val();
			
			if(tipojor == "normal" || tipojor == "")
			{
				//$(".entrada_2").addClass("required");
				//$(".saida_2").addClass("required");
				
				$(".entrada_1").val("08:00");
				$(".saida_1").val("12:00");
				$(".entrada_2").val("13:00");
				$(".saida_2").val("17:00");
				$(".carga_horaria").val("08:00");
				
				$("input[name='entrada_1_s']").val("08:00");
				$("input[name='saida_1_s']").val("12:00");
				$("input[name='entrada_2_s']").val("");
				$("input[name='saida_2_s']").val("");
				$("input[name='carga_horaria_s']").val("04:00");
				
				$("input[name='entrada_1_d']").val("");
				$("input[name='saida_1_d']").val("");
				$("input[name='entrada_2_d']").val("");
				$("input[name='saida_2_d']").val("");
				$("input[name='carga_horaria_d']").val("");
			}
			else if(tipojor == "12x36")
			{
				$(".entrada_2").removeClass("required");
				$(".saida_2").removeClass("required");
				
				$(".entrada_1").val("08:00");
				$(".saida_1").val("20:00");
				$(".entrada_2").val("");
				$(".saida_2").val("");
				$(".carga_horaria").val("12:00");
				
				$("input[name='entrada_1_s']").val("");
				$("input[name='saida_1_s']").val("");
				$("input[name='entrada_2_s']").val("");
				$("input[name='saida_2_s']").val("");
				$("input[name='carga_horaria_s']").val("");
				
				$("input[name='entrada_1_d']").val("");
				$("input[name='saida_1_d']").val("");
				$("input[name='entrada_2_d']").val("");
				$("input[name='saida_2_d']").val("");
				$("input[name='carga_horaria_d']").val("");
			}
			else if(tipojor == "6horas")
			{
				$(".entrada_2").removeClass("required");
				$(".saida_2").removeClass("required");
				
				$(".entrada_1").val("08:00");
				$(".saida_1").val("14:00");
				$(".entrada_2").val("");
				$(".saida_2").val("");
				$(".carga_horaria").val("06:00");
				
				$("input[name='entrada_1_s']").val("08:00");
				$("input[name='saida_1_s']").val("14:00");
				$("input[name='entrada_2_s']").val("");
				$("input[name='saida_2_s']").val("");
				$("input[name='carga_horaria_s']").val("06:00");
				
				$("input[name='entrada_1_d']").val("");
				$("input[name='saida_1_d']").val("");
				$("input[name='entrada_2_d']").val("");
				$("input[name='saida_2_d']").val("");
				$("input[name='carga_horaria_d']").val("");
			}
	
		});
		
		$("select[name='tipo_jornada']").change(function(){
			var tipo = $(this).val();
			
			if(tipo == "normal" || tipo == "6horas" || tipojor == "")
				$(".fimdesemana").show();
			else
				$(".fimdesemana").hide();
		});
		
		//$('#doc').setMask('99.999.999/9999-99');
		
		$(".cnpj").focus(function(){
			if($('input[name="doc"]').is(":checked"))
			{
				return false
			}else{
				alert("Escolha o tipo de documento (CNPJ ou CPF)");
				$(".cnpj").blur();
			}
		});
		$('input[name="doc"]').click(function(){
			var doc = $(this).val();
			if(doc == "cpf")
			{
				$("#doc").setMask("999.999.999-99");
				$("#doc").removeClass("cnpj");
				$("#doc").addClass("cpf");
			}
			else
			{
				$("#doc").setMask("99.999.999/9999-99");
				$("#doc").removeClass("cpf");
				$("#doc").addClass("cnpj");
			}
		});
		
		var horaInicial_1;
		var horaFinal_1;
		var horaInicial_2;
		var horaFinal_2;
		var dif_turno1;
		var dif_turno2;
		var total_turno;
		var saldo;
	
	
		$(".hora").blur(function(){
			var linha = $(this).parent().parent().attr("class");
		
			
			if($(this).prop("readonly") == false)
			{
				
				horaInicial_1 = $("."+linha).find(".entrada_1").val();
				if(!horaInicial_1)
					horaInicial_1 = "00:00";
				horaFinal_1 = $("."+linha).find(".saida_1").val();
				if(!horaFinal_1)
					horaFinal_1 = "00:00";
				dif_turno1 = subtraiHora(horaFinal_1, horaInicial_1);		
				
				horaInicial_2 = $("."+linha).find(".entrada_2").val();
				if(!horaInicial_2)
					horaInicial_2 = "00:00";
				horaFinal_2 = $("."+linha).find(".saida_2").val();
				if(!horaFinal_2)
					horaFinal_2 = "00:00";
				dif_turno2 = subtraiHora(horaFinal_2, horaInicial_2);
				
				total_turno = somaHora(dif_turno1, dif_turno2, false);
			
			
		
				
				var carga_horaria = $("."+linha).find(".carga_horaria").val(total_turno);
	
	
			}
	
		});
	});
	</script>
	<form action="index.php?pag=formularios&cat=calchoraextra&passo=2" method="post" id="formularios">
		<h3 align='center' style='margin-top: 20px;'><?php echo @$tituloform;?></h3>
		<table cellpadding="10" cellspacing="0" width="100%" class="tblform">
			<tr>
				<td>Raz&atilde;o Social:<br /><input type="text" name="razao_social" class="inputbox required" style="width:250px;" /></td>
				<td valign="top"><label><input type="radio" name="doc" value="cnpj"> CNPJ</label> &nbsp;ou <label><input type="radio" name="doc" value="cpf"> CPF:</label><br /><input type="text" id="doc" name="cnpj" class="inputbox cnpj required" style="width:250px;" /></td>
			</tr>
			<tr>
				<td valign="top">E-mail:<br /><input type="text" name="email" class="inputbox required email" style="width:250px;" /></td>
				<td valign="top">CEP:<br /><input type="text" name="cep" id="cep" class="inputbox cep required" style="width:250px;" /></td>
			</tr>
			<tr>
				<td valign="top">Endere&ccedil;o:<br /><input type="text" name="endereco" id="endereco" class="inputbox required" style="width:250px;" /></td>
				<td valign="top">N&uacute;mero:<br /><input type="text" name="numero" id="numero" class="inputbox numero required" style="width:250px;" /></td>
			</tr>
			<tr>
				<td valign="top">Bairro:<br /><input type="text" name="bairro" id="bairro" class="inputbox required" style="width:250px;" /></td>
				<td valign="top">Complemento:<br /><input type="text" name="complemento" id="complemento" class="inputbox" style="width:250px;" /></td>
			</tr>
			<tr>
				<td valign="top">Cidade:<br /><input type="text" name="cidade" id="cidade" class="inputbox required" style="width:250px;" /></td>
				<td valign="top">Estado:<br /><input type="text" name="estado" id="estado" class="inputbox required" style="width:250px;" /></td>
			</tr>
			<tr>
				<td>Nome do funcion&aacute;rio:<br /><input type="text" name="nome_funcionario" class="inputbox required" style="width: 250px;" /></td>
				<td>Cargo:<br /><input type="text" name="cargo" class="inputbox required" style="width: 250px;" /></td>
			</tr>
			<tr>
				<td valign="top" colspan="2">Período:<br />
				De: <input type="text" name="data_de" class="inputbox required datamascara" placeholder="DD/MM/AAAA" style="width:225px;" />&nbsp;
				At&eacute;: <input type="text" name="data_ate" class="inputbox required datamascara" placeholder="DD/MM/AAAA" style="width:225px;" /></td>         
			</tr>
			<tr><td colspan="2"><hr /></td></tr>
			<tr>
				<td valign="top" colspan="2">Tipo de Jornada de Trabalho: &nbsp;&nbsp;
				<select name="tipo_jornada" class="inputbox">
					<option value="" selected>Selecione</option>
					<option value="normal">Normal</option>
					<option value="6horas">6 Horas</option>
					<option value="12x36">12x36</option>
				</select>         
			</tr>
			<tr>
				<td colspan="2">
					<table cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<th colspan="7" align="center">SEMANAL</th>
						</tr>
						<tr>
							<th></th>
							<th align="center" colspan="2">HOR&Aacute;RIO PADR&Atilde;O: &nbsp;1&deg; TURNO</th>
							<th align="center" colspan="2">HOR&Aacute;RIO PADR&Atilde;O: &nbsp;2&deg; TURNO</th>
							<th align="center" colspan="2">CARGA HOR&Aacute;RIA</th>
						</tr>
						<tr>
							<td></td>
							<td align="center" style="background: #111; border:1px solid #000 !important;">Entrada</td>
							<td align="center" style="background: #111; border:1px solid #000 !important; border-right:5px solid #000 !important;">Sa&iacute;da</td>
							<td align="center" style="background: #111; border:1px solid #000 !important;">Entrada</td>
							<td align="center" style="background: #111; border:1px solid #000 !important; border-right:5px solid #000 !important;">Sa&iacute;da</td>
							<td align="center" style="background: #111; border:1px solid #000 !important;"></td>
						</tr>
						<tr class="l1">
							<td>SEG</td>
							<td align="center" style="background: #111; border:1px solid #000 !important;"><input type="text" name="entrada_1_1" placeholder="--:--" class="inputbox hora entrada_1 required" style="width: 50px; text-align:center; background: #000;" /></td>
							<td align="center" style="background: #111; border:1px solid #000 !important; border-right:5px solid #000 !important;"><input type="text" name="saida_1_1" placeholder="--:--" class="inputbox hora saida_1 required" style="width: 50px; text-align:center; background: #000;" /></td>
							<td align="center" style="background: #111; border:1px solid #000 !important;"><input type="text" name="entrada_2_1" placeholder="--:--" class="inputbox hora entrada_2 required" style="width: 50px; text-align:center; background: #000;" /></td>
							<td align="center" style="background: #111; border:1px solid #000 !important; border-right:5px solid #000 !important;"><input type="text" name="saida_2_1" placeholder="--:--" class="inputbox hora saida_2 required" style="width: 50px; text-align:center; background: #000;" /></td>
							<td align="center" style="background: #111; border:1px solid #000 !important;"><input type="text" name="carga_horaria_1" placeholder="--:--" class="inputbox hora carga_horaria required" style="width: 50px; text-align:center; background: #000;" /></td>
						</tr>
						<tr class="l4">
							<td>TER</td>
							<td align="center" style="background: #111; border:1px solid #000 !important;"><input type="text" name="entrada_1_2" placeholder="--:--" class="inputbox hora entrada_1 required" style="width: 50px; text-align:center; background: #000;" /></td>
							<td align="center" style="background: #111; border:1px solid #000 !important; border-right:5px solid #000 !important;"><input type="text" name="saida_1_2" placeholder="--:--" class="inputbox hora saida_1 required" style="width: 50px; text-align:center; background: #000;" /></td>
							<td align="center" style="background: #111; border:1px solid #000 !important;"><input type="text" name="entrada_2_2" placeholder="--:--" class="inputbox hora entrada_2 required" style="width: 50px; text-align:center; background: #000;" /></td>
							<td align="center" style="background: #111; border:1px solid #000 !important; border-right:5px solid #000 !important;"><input type="text" name="saida_2_2" placeholder="--:--" class="inputbox hora saida_2 required" style="width: 50px; text-align:center; background: #000;" /></td>
							<td align="center" style="background: #111; border:1px solid #000 !important;"><input type="text" name="carga_horaria_2" placeholder="--:--" class="inputbox hora carga_horaria required" style="width: 50px; text-align:center; background: #000;" /></td>
						</tr>
						<tr class="l5">
							<td>QUA</td>
							<td align="center" style="background: #111; border:1px solid #000 !important;"><input type="text" name="entrada_1_3" placeholder="--:--" class="inputbox hora entrada_1 required" style="width: 50px; text-align:center; background: #000;" /></td>
							<td align="center" style="background: #111; border:1px solid #000 !important; border-right:5px solid #000 !important;"><input type="text" name="saida_1_3" placeholder="--:--" class="inputbox hora saida_1 required" style="width: 50px; text-align:center; background: #000;" /></td>
							<td align="center" style="background: #111; border:1px solid #000 !important;"><input type="text" name="entrada_2_3" placeholder="--:--" class="inputbox hora entrada_2 required" style="width: 50px; text-align:center; background: #000;" /></td>
							<td align="center" style="background: #111; border:1px solid #000 !important; border-right:5px solid #000 !important;"><input type="text" name="saida_2_3" placeholder="--:--" class="inputbox hora saida_2 required" style="width: 50px; text-align:center; background: #000;" /></td>
							<td align="center" style="background: #111; border:1px solid #000 !important;"><input type="text" name="carga_horaria_3" placeholder="--:--" class="inputbox hora carga_horaria required" style="width: 50px; text-align:center; background: #000;" /></td>
						</tr>
						<tr class="l6">
							<td>QUI</td>
							<td align="center" style="background: #111; border:1px solid #000 !important;"><input type="text" name="entrada_1_4" placeholder="--:--" class="inputbox hora entrada_1 required" style="width: 50px; text-align:center; background: #000;" /></td>
							<td align="center" style="background: #111; border:1px solid #000 !important; border-right:5px solid #000 !important;"><input type="text" name="saida_1_4" placeholder="--:--" class="inputbox hora saida_1 required" style="width: 50px; text-align:center; background: #000;" /></td>
							<td align="center" style="background: #111; border:1px solid #000 !important;"><input type="text" name="entrada_2_4" placeholder="--:--" class="inputbox hora entrada_2 required" style="width: 50px; text-align:center; background: #000;" /></td>
							<td align="center" style="background: #111; border:1px solid #000 !important; border-right:5px solid #000 !important;"><input type="text" name="saida_2_4" placeholder="--:--" class="inputbox hora saida_2 required" style="width: 50px; text-align:center; background: #000;" /></td>
							<td align="center" style="background: #111; border:1px solid #000 !important;"><input type="text" name="carga_horaria_4" placeholder="--:--" class="inputbox hora carga_horaria required" style="width: 50px; text-align:center; background: #000;" /></td>
						</tr>
						<tr class="l7">
							<td>SEX</td>
							<td align="center" style="background: #111; border:1px solid #000 !important;"><input type="text" name="entrada_1_5" placeholder="--:--" class="inputbox hora entrada_1 required" style="width: 50px; text-align:center; background: #000;" /></td>
							<td align="center" style="background: #111; border:1px solid #000 !important; border-right:5px solid #000 !important;"><input type="text" name="saida_1_5" placeholder="--:--" class="inputbox hora saida_1 required" style="width: 50px; text-align:center; background: #000;" /></td>
							<td align="center" style="background: #111; border:1px solid #000 !important;"><input type="text" name="entrada_2_5" placeholder="--:--" class="inputbox hora entrada_2 required" style="width: 50px; text-align:center; background: #000;" /></td>
							<td align="center" style="background: #111; border:1px solid #000 !important; border-right:5px solid #000 !important;"><input type="text" name="saida_2_5" placeholder="--:--" class="inputbox hora saida_2 required" style="width: 50px; text-align:center; background: #000;" /></td>
							<td align="center" style="background: #111; border:1px solid #000 !important;"><input type="text" name="carga_horaria_5" placeholder="--:--" class="inputbox hora carga_horaria required" style="width: 50px; text-align:center; background: #000;" /></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr><td colspan="2"><hr /></td></tr>
			<tr class="fimdesemana">
				<td colspan="2">
					<table cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<th colspan="7" align="center">FINAIS DE SEMANA</th>
						</tr>
						<tr>
							<th></th>
							<th align="center" colspan="2">HOR&Aacute;RIO PADR&Atilde;O: &nbsp;1&deg; TURNO</th>
							<th align="center" colspan="2">HOR&Aacute;RIO PADR&Atilde;O: &nbsp;2&deg; TURNO</th>
							<th align="center" colspan="2">CARGA HOR&Aacute;RIA</th>
						</tr>
						<tr>
							<td></td>
							<td align="center" style="background: #111; border:1px solid #000 !important;">Entrada</td>
							<td align="center" style="background: #111; border:1px solid #000 !important; border-right:5px solid #000 !important;">Sa&iacute;da</td>
							<td align="center" style="background: #111; border:1px solid #000 !important;">Entrada</td>
							<td align="center" style="background: #111; border:1px solid #000 !important; border-right:5px solid #000 !important;">Sa&iacute;da</td>
							<td align="center" style="background: #111; border:1px solid #000 !important;"></td>
						</tr>
						<tr class="l2">
							<td>SAB</td>
							<td align="center" style="background: #111; border:1px solid #000 !important;"><input type="text" name="entrada_1_s" placeholder="--:--" class="inputbox entrada_1 hora" style="width: 50px; text-align:center; background: #000;" /></td>
							<td align="center" style="background: #111; border:1px solid #000 !important; border-right:5px solid #000 !important;"><input type="text" name="saida_1_s" placeholder="--:--" class="inputbox saida_1 hora" style="width: 50px; text-align:center; background: #000;" /></td>
							<td align="center" style="background: #111; border:1px solid #000 !important;"><input type="text" name="entrada_2_s" placeholder="--:--" class="inputbox entrada_2 hora" style="width: 50px; text-align:center; background: #000;" /></td>
							<td align="center" style="background: #111; border:1px solid #000 !important; border-right:5px solid #000 !important;"><input type="text" name="saida_2_s" placeholder="--:--" class="inputbox saida_2 hora" style="width: 50px; text-align:center; background: #000;" /></td>
							<td align="center" style="background: #111; border:1px solid #000 !important;"><input type="text" name="carga_horaria_s" placeholder="--:--" class="inputbox carga_horaria hora" style="width: 50px; text-align:center; background: #000;" /></td>
						</tr>
						<tr class="l3">
							<td>DOM</td>
							<td align="center" style="background: #111; border:1px solid #000 !important;"><input type="text" name="entrada_1_d" placeholder="--:--" class="inputbox entrada_1 hora" style="width: 50px; text-align:center; background: #000;" /></td>
							<td align="center" style="background: #111; border:1px solid #000 !important; border-right:5px solid #000 !important;"><input type="text" name="saida_1_d" placeholder="--:--" class="inputbox saida_1 hora" style="width: 50px; text-align:center; background: #000;" /></td>
							<td align="center" style="background: #111; border:1px solid #000 !important;"><input type="text" name="entrada_2_d" placeholder="--:--" class="inputbox entrada_2 hora" style="width: 50px; text-align:center; background: #000;" /></td>
							<td align="center" style="background: #111; border:1px solid #000 !important; border-right:5px solid #000 !important;"><input type="text" name="saida_2_d" placeholder="--:--" class="inputbox saida_2 hora" style="width: 50px; text-align:center; background: #000;" /></td>
							<td align="center" style="background: #111; border:1px solid #000 !important;"><input type="text" name="carga_horaria_d" placeholder="--:--" class="inputbox carga_horaria hora" style="width: 50px; text-align:center; background: #000;" /></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr><td colspan="2"><hr /></td></tr>
			<tr>
				<td colspan="2" align="center"><input type="submit" value="Enviar" class="button" /></td>
			</tr>
		</table>
	</form>
	<?php
	}
}
else if($id_categoria == "admissao_domesticos")
{
?>	
<script type="text/javascript">
$(function(){
	
	$("#formularios").validate();
	
	$(".datamascara").setMask("99/99/9999");
	$(".datamascara").blur(function(){
		var tamanho = $(this).val().length;
		if(tamanho != 10)
			$(this).val("");
	});
	
	$(".declaracoes").hide();
	$(".recibos").hide();
	$(".titulo").hide();
	$("input[name='declaracao']").click(function(){
		if($(this).val() != "sim")
		{
			$(".titulo").show();
			$("#titulo_eleitor").addClass("required");
			$("#declaracaobv").removeClass("required");
			$(".declaracoes").hide();
			$(".recibos").hide();
			$("input[name='declaracoes']").removeClass("required");
		}
		else
		{
			$("#titulo_eleitor").removeClass("required");
			$(".titulo").hide();
			$("#declaracaobv").addClass("required");
			$(".declaracoes").show();
		}			
	});
	$("input[name='declaracaobv']").click(function(){
		if($(this).val() != "sim")
		{
			$(".recibos").show();
			$("input[name='declaracoes[]']").addClass("required");
		}
		else
		{
			$(".recibos").hide();
			$("input[name='declaracoes[]']").removeClass("required");
		}			
	});
	
	$(".adddoc").click(function(){
						
		$(".documentos").append("<span><br /><input type='file' name='documentos[]' class='inputbox' style='width:480px;' /></span>");
	});
	$(".removedoc").click(function(){
			$(".documentos span").last().remove();	
	});
	
	$(".valor").maskMoney({
		showSymbol:false, 
		symbol:"", 
		decimal:",", 
		thousands:".",
		allowZero: true
	});
	
	$(".cpf").setMask("cpf");
	$("#titulo_eleitor").setMask("9999999999999999");
	$(".telefone").setMask("(99) 999999999");
	
	$("#cep").setMask("99999-999");
	$("#numero").setMask("99999999");
	$("#cep").blur(function(){
		var cep = $(this).val();
		
		$.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+cep, function(){
			if(resultadoCEP["resultado"] == 1) {
				$("#endereco").val(unescape(resultadoCEP["tipo_logradouro"])+" "+unescape(resultadoCEP["logradouro"]));
				$("#bairro").val(unescape(resultadoCEP["bairro"]));
				$("#cidade").val(unescape(resultadoCEP["cidade"]));
				$("#estado").val(unescape(resultadoCEP["uf"]));
				$("#numero").focus();
			} else if(resultadoCEP["resultado"] == 2) {
				$("#cidade").val(unescape(resultadoCEP["cidade"]));
				$("#estado").val(unescape(resultadoCEP["uf"]));
				$("#endereco").focus();
			} else {
				alert("Endereço não encontrado");
			}
		});
	});
	
	$("#cep2").setMask("99999-999");
	$("#numero2").setMask("99999999");
	$("#cep2").blur(function(){
		var cep = $(this).val();
		
		$.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+cep, function(){
			if(resultadoCEP["resultado"] == 1) {
				$("#endereco2").val(unescape(resultadoCEP["tipo_logradouro"])+" "+unescape(resultadoCEP["logradouro"]));
				$("#bairro2").val(unescape(resultadoCEP["bairro"]));
				$("#cidade2").val(unescape(resultadoCEP["cidade"]));
				$("#estado2").val(unescape(resultadoCEP["uf"]));
				$("#numero2").focus();
			} else if(resultadoCEP["resultado"] == 2) {
				$("#cidade2").val(unescape(resultadoCEP["cidade"]));
				$("#estado2").val(unescape(resultadoCEP["uf"]));
				$("#endereco2").focus();
			} else {
				alert("Endereço não encontrado");
			}
		});
	});
});
</script>
<form action="paginas/envia.php?op=admissao_domesticos" method="post" id="formularios" enctype="multipart/form-data">
	<h3 align='center' style='margin-top: 20px;'><?php echo @$tituloform;?></h3>
	<table cellpadding="10" cellspacing="0" width="100%" class="tblform">
    	<tr>
        	<td colspan="2">DADOS DO EMPREGADOR</td>
        </tr>
    	<tr>
        	<td valign="top" colspan="2">Nome:<br /><input type="text" name="nome" class="inputbox required" style="width:540px;" /></td>
		</tr>
        <tr>
        	<td valign="top">CPF:<br /><input type="text" name="cpf" class="inputbox cpf required" style="width:250px;" /></td>
            <td valign="top">Data de nascimento:<br /><input type="text" name="data_nascimento" class="inputbox datamascara required" style="width:250px;" /></td>
		</tr>
        <tr>
        	<td valign="top">E-mail:<br /><input type="text" name="email" class="inputbox required email" style="width:250px;" /></td>
        	<td valign="top">Telefone:<br /><input type="text" name="telefone" class="inputbox telefone required" style="width:250px;" /></td>
		</tr>
		<tr>
        	<td colspan="2">Endere&ccedil;o do Empregador</td>
        </tr>
        <tr>
        	<td valign="top">CEP:<br /><input type="text" name="cep" id="cep" class="inputbox required" style="width:250px;" /></td>
            <td valign="top">Endere&ccedil;o:<br /><input type="text" name="endereco" id="endereco" class="inputbox required" style="width:250px;" /></td>
		</tr>
        <tr class="form1 bvdeanopassadonao nbvmudancas esconde">
        	<td valign="top">N&uacute;mero:<br /><input type="text" name="numero" id="numero" class="inputbox required" style="width:250px;" /></td>
            <td valign="top">Bairro:<br /><input type="text" name="bairro" id="bairro" class="inputbox required" style="width:250px;" /></td>
		</tr>
        <tr class="form1 bvdeanopassadonao nbvmudancas esconde">
        	<td valign="top">Cidade:<br /><input type="text" name="cidade" id="cidade" class="inputbox required" style="width:250px;" /></td>
            <td valign="top">Estado:<br /><input type="text" name="estado" id="estado" class="inputbox required" style="width:250px;" /></td>
		</tr>
        
        <tr>
        	<td colspan="2" valign="top" align="center">Fez a declaração de imposto de renda?<br />
            	<label><input type="radio" name="declaracao" class="required" value="sim" /> Sim</label> <label><input type="radio" name="declaracao" value="não" /> Não</label></td>
       	</tr>
        <tr class="declaracoes">
            <td valign="top" colspan="2" align="center">Foi feita com a BV? 
            	<label><input type="radio" name="declaracaobv" id="declaracaobv" value="sim" /> Sim</label> <label><input type="radio" name="declaracaobv" value="não" /> Não</label></td>
        </tr>
        <tr class="recibos">
            <td valign="top">Informe o recibo das duas &uacute;ltimas declara&ccedil;&otilde;es:<br />
            	<input type="text" name="declaracoes[]" class="inputbox" style="width:250px;" placeholder="Recibo 1" /></td>
            <td valign="bottom"><input type="text" name="declaracoes[]" class="inputbox" style="width:250px;" placeholder="Recibo 2" /></td>  
        </tr>
        <tr class="titulo">
            <td valign="top" colspan="2" align="center">T&iacute;tulo de eleitor: 
            	<input type="text" name="titulo_eleitor" id="titulo_eleitor" class="inputbox" style="width:250px;" /></td>
        </tr>
        
        <tr>
        	<td colspan="2"><hr /></td>
        </tr>
        <tr>
        	<td colspan="2">DADOS DO EMPREGADO</td>
        </tr>
        <tr>
        	<td valign="top">Grau de instru&ccedil;&atilde;o:<br /><input type="text" name="grau_instrucao" class="inputbox required" style="width:250px;" /></td>
        	<td valign="top">Ra&ccedil;a / Cor:<br /><input type="text" name="raca" class="inputbox required" style="width:250px;" /></td>
        </tr>
        <tr>
        	<td>Sal&aacute;rio:<br /><input type="text" name="salario" class="inputbox valor required" style="width:250px;" /></td>
            <td colspan="2">Dias e hor&aacute;rios de trabalho:<br /><input type="text" name="horario_trabalho" class="inputbox required" style="width:250px;" /></td>
        </tr>
        <tr>
        	<td valign="top">E-mail:<br /><input type="text" name="email_empregado" class="inputbox" style="width:250px;" /></td>
        	<td valign="top">Telefone:<br /><input type="text" name="telefone_empregado" class="inputbox telefone" style="width:250px;" /></td>
		</tr>
        <tr>
        	<td colspan="2">Endere&ccedil;o do local de trabalho</td>
        </tr>
        <tr>
        	<td valign="top">CEP:<br /><input type="text" name="cep_emp" id="cep2" class="inputbox required" style="width:250px;" /></td>
            <td valign="top">Endere&ccedil;o:<br /><input type="text" name="endereco_emp" id="endereco2" class="inputbox required" style="width:250px;" /></td>
		</tr>
        <tr>
        	<td valign="top">N&uacute;mero:<br /><input type="text" name="numero_emp" id="numero2" class="inputbox required" style="width:250px;" /></td>
            <td valign="top">Bairro:<br /><input type="text" name="bairro_emp" id="bairro2" class="inputbox required" style="width:250px;" /></td>
		</tr>
        <tr>
        	<td valign="top">Cidade:<br /><input type="text" name="cidade_emp" id="cidade2" class="inputbox required" style="width:250px;" /></td>
            <td valign="top">Estado:<br /><input type="text" name="estado_emp" id="estado2" class="inputbox required" style="width:250px;" /></td>
		</tr>
        <tr>
        	<td valign="top">Data de admiss&atilde;o:<br /><input type="text" name="data_admissao" class="inputbox datamascara  required" style="width:250px;" /></td>
            <td valign="top">Estado civil:<br /><input type="text" name="estado_civil" class="inputbox required" style="width:250px;" /></td>
        </tr>
        <tr>
        	<td colspan="2" valign="top">Trabalhador recebe Aposentadoria por idade ou tempo de contribuição?<br />
            <label><input type="radio" name="aposentado" class="required" value="sim" /> Sim</label> <label><input type="radio" name="aposentado" value="não" /> Não</label></td>
        </tr>
        <tr>
        	<td valign="top" colspan="2">Qual a função exercida pelo trabalhador?<br />
            	<select name="funcao" class="inputbox required">
                	<option value="">Selecione...</option>
                    <option value="Empregado Doméstico de Serviços Gerais">Empregado Doméstico de Serviços Gerais</option>
                    <option value="Empregado Doméstico Arrumador">Empregado Doméstico Arrumador</option>
                    <option value="Empregado Doméstico Faxineiro">Empregado Doméstico Faxineiro</option>
                    <option value="Babá">Babá</option>
                    <option value="Passador de Roupa">Passador de Roupa</option>
                    <option value="Lavadeiro(a)">Lavadeiro(a)</option>
                    <option value="Caseiro">Caseiro</option>
                    <option value="Governanta">Governanta</option>
                    <option value="Mordomo">Mordomo</option>
                    <option value="Cozinheiro">Cozinheiro</option>
                    <option value="Cuidador">Cuidador</option>
                    <option value="Motorista Doméstico">Motorista Doméstico</option>
                    <option value="Motorista Particular">Motorista Particular</option>
                </select>
            </td>
            
		</tr>
		<tr><td colspan="2"><hr /></td></tr>
        
        
        <tr>
        	<td colspan="2">Anexar documentos:<br />
			<input type="file" name="documentos[]" class="inputbox" style="width:480px;" />&nbsp;<a class="adddoc" style="cursor: pointer;" title="Anexar mais documentos">[+]</a> <a class="removedoc" style="cursor: pointer;" title="Remover documento">[ - ]</a>
            	<span class="documentos"></span>
            </td>
      	</tr>
        <tr>
            <td colspan="2">Observa&ccedil;&atilde;o:<br /><textarea name="observacao" class="inputbox" style="width:530px; height:100px;"></textarea></td>
		</tr> 
        <tr><td colspan="2"><hr /></td></tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" value="Enviar" class="button" /></td>
		</tr>
	</table>
	Relação de Documentos:
	<ol>
		<li>Carteira Profissional</li>
		<li>RG</li>
		<li>CPF</li>
		<li>Titulo Eleitor</li>
		<li>Carteira de Reservista</li>
		<li>Carteira Nacional de Habilitação</li>
		<li>PIS</li>
		<li>Comprovante de Endereço Atualizado</li>
		<li>Certidão de Nascimento Filhos</li>
		<li>Foto</li>
		<li>Cópia Simples do Cartão Passe Fácil</li>
	</ol>
</form>
<?php
}
else if($id_categoria == "suspensao")
{
?>
<script type="text/javascript">
function adicionarDiasData(dias, data_inicio){
	var hoje   = new Date(data_inicio);
	var num = parseInt(dias) + 1;
  	var dataVenc    = new Date(hoje.getTime() + (num * 24 * 60 * 60 * 1000));
  	return dataVenc.getDate() + "/" + (dataVenc.getMonth() + 1) + "/" + dataVenc.getFullYear();
}
$(function(){
	
	$("#formularios").validate();
	

	$(".data").setMask("99/99/9999");
	$("input[name='prazo']").setMask("99999");
	
	$(".prazo").keyup(function(){
		var data = ($(".data_inicio").val()).split("/");
		var data_inicio = data[2]+"-"+data[1]+"-"+data[0];
		var data_volta = adicionarDiasData($(this).val(),data_inicio);
		$(".data_volta").val(data_volta);
	});
	 
});
</script>
<form action="paginas/envia.php?op=suspensao" method="post" id="formularios">
	<h3 align='center' style='margin-top: 20px;'><?php echo @$tituloform;?></h3>
	<table cellpadding="10" cellspacing="0" width="100%" class="tblform">
        <tr>
        	<td>Data de In&iacute;cio:<br /><input type="text" name="data_inicio" class="inputbox data_inicio data required datamascara" placeholder="DD/MM/AAAA" style="width:250px;" /></td>
            <td>Prazo:<br /><input type="text" name="prazo" class="inputbox prazo required" placeholder="N&deg; de dias" style="width:250px;" /></td>
       	</tr>
        <tr>
            <td>Data da Regresso:<br /><input type="text" name="data_volta" class="inputbox data_volta data required datamascara" placeholder="DD/MM/AAAA" style="width:250px;" /></td>
        </tr>
        
    	<tr>
        	<td>Nome do funcion&aacute;rio:<br /><input type="text" name="nome_funcionario" class="inputbox required" style="width: 250px;" /></td>
            <td>Nome da empresa:<br /><input type="text" name="nome_empresa" class="inputbox required" style="width:250px;" /></td>
        </tr>
        <tr>
        	<td valign="top">E-mail <small>(para onde será enviado o arquivo)</small>:<br /><input type="text" name="email" class="inputbox required email" style="width:250px;" /></td>
        	<td>Cidade:<br /><input type="text" name="cidade" class="inputbox required" style="width: 250px;" /></td>
        </tr>
        <tr><td colspan="2"><hr /></td></tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" value="Enviar" class="button" /></td>
		</tr>
	</table>
</form>
<?php
}
else if($id_categoria == "cartaoponto")
{
?>

<script type="text/javascript">
	// total de horas padrão
   
function isHoraInicialMenorHoraFinal(horaInicial, horaFinal){
	horaIni = horaInicial.split(':');
    horaFim = horaFinal.split(':');

	// Verifica as horas. Se forem diferentes, é só ver se a inicial 
	// é menor que a final.
	hIni = parseInt(horaIni[0], 10);
	hFim = parseInt(horaFim[0], 10);
	if(hIni != hFim)
		return hIni < hFim;
	
	// Se as horas são iguais, verifica os minutos então.
    mIni = parseInt(horaIni[1], 10);
	mFim = parseInt(horaFim[1], 10);
	if(mIni != mFim)
		return mIni < mFim;
}

function subtraiHora(hrA, hrB) {
        if(!hrA || !hrB || hrA.length != 5 || hrB.length != 5) return "00:00";
       
        temp = 0;
        nova_h = 0;
        novo_m = 0;
 
        hora1 = hrA.substr(0, 2) * 1;
        hora2 = hrB.substr(0, 2) * 1;
        minu1 = hrA.substr(3, 2) * 1;
        minu2 = hrB.substr(3, 2) * 1;
       
        temp = minu1 - minu2;
        while(temp < 0) {
                nova_h++;
                temp = temp + 60;
        }
        novo_m = temp.toString().length == 2 ? temp : ("0" + temp);
 
        temp = hora1 - hora2 - nova_h;
        while(temp < 0) {
                temp = temp + 24;
        }
        nova_h = temp.toString().length == 2 ? temp : ("0" + temp);
 
        return nova_h + ":" + novo_m;
}
function somaHora(hrA, hrB, zerarHora) {
        if(!hrA || !hrB || hrA.length != 5 || hrB.length != 5) return "00:00";
        temp = 0;
        nova_h = 0;
        novo_m = 0;
 
        hora1 = hrA.substr(0, 2) * 1;
        hora2 = hrB.substr(0, 2) * 1;
        minu1 = hrA.substr(3, 2) * 1;
        minu2 = hrB.substr(3, 2) * 1;
       
        temp = minu1 + minu2;
        while(temp > 59) {
                nova_h++;
                temp = temp - 60;
        }
        novo_m = temp.toString().length == 2 ? temp : ("0" + temp);
 
        temp = hora1 + hora2 + nova_h;
        while(temp > 23 && zerarHora) {
                temp = temp - 24;
        }
        nova_h = temp.toString().length == 2 ? temp : ("0" + temp);
 
        return nova_h + ":" + novo_m;
}

	


	/**
	 * Verifica se o usuário informou todos os campos da hora (hh:mm).
	 */
	function preencheuHoraCompleta( horario ){
		var hora = horario.replace(/[^0-9:]/g ,''); // deixa só números e o ponto
		return hora.length == 5;
	}

	/**
	 * Verifica se a hora é válidas. Exemplo: 12:34 é válido, 03:89 é inválido.
	 */
	function isHoraValida( horario ) {
		var regex = new RegExp("^([0-1][0-9]|[2][0-3]):([0-5][0-9])$");
		return regex.exec( horario ) != null;
	}

	/**
	 * Verifica se um campo está vazio.
	 */
	function possuiValor( valor ){
		return valor != undefined && valor != '';
	}
	
	/**
	 * Completa um número menor que dez com um zero à esquerda.
	 * Usado aqui para formatar as horas... Exemplo: 3:10 -> 03:10 , 10:5 -> 10:05
	 */
	function completaZeroEsquerda( numero ){
		return ( numero < 10 ? "0" + numero : numero);
	}
	
	function adicionalNoturno(horainicio, horafim)
	{
		var dif1;
		var dif2;
		
		horainicioC = parseInt((horainicio).replace(":",""));
		horafimC = parseInt((horafim).replace(":",""));
		
		/*
		if(horainicioC > 600 && horafimC < 2200)
		{
			return false;
		}
		else
		{
		*/
			if(horainicioC >= 2200 && horainicioC <= 2400)
			{
				if(horafimC >= 2200 && horafimC <= 2400)
				{
					return(subtraiHora(horafim, horainicio));
				}
				else if(horafimC <= 500)
				{
					dif1 = subtraiHora("24:00", horainicio);
					dif2 = subtraiHora(horafim, "00:00");
					
					return(somaHora(dif1, dif2, true));
				}
				else if(horafimC > 500)
				{
					if(horainicioC >= 2200)
					{
						dif1 = subtraiHora("24:00", "22:00");
						dif2 = subtraiHora("06:00", "00:00");
					}
					return somaHora(dif1, dif2, true);
				}
			}
			else if(horainicioC > 500 && horainicioC < 2200)
			{
			
				if(horafimC >= 2200 && horafimC <= 2400)
				{
					return (subtraiHora(horafim, "22:00"));
				}
				else if(horafimC <= 500)
				{
					dif1 = subtraiHora("24:00", "22:00");
					dif2 = subtraiHora(horafim, "00:00");
					
					return somaHora(dif1, dif2, true);
				}
				else if(horafimC > 500)
				{
					if(horainicioC >= 2200)
					{
						dif1 = subtraiHora("24:00", "22:00");
						dif2 = subtraiHora("06:00", "00:00");
					}
					return somaHora(dif1, dif2, true);
				}
				
			}
			else if(horainicioC >= 0 && horainicioC <= 500)
			{
				if(horafimC <= 500)
				{
					return(subtraiHora(horafim, horainicio));
				}
				else if(horafimC > 500 && horafimC <= 2200)
				{
					return(subtraiHora("06:00", horainicio));
				}
				else if(horafimC > 500 && horafimC <= 2400)
				{
					dif1 = subtraiHora("06:00", horainicio);
					dif2 = subtraiHora(horafim, "22:00");
					
					return(somaHora(dif1, dif2, true));
				}
			}
		//}

	}

$(function(){
	$("#formularios").validate();
	
	$( "input[name='data_de']" ).datepicker({
		dateFormat: "dd/mm/yy",
		changeMonth: true,
		changeYear: true,
		onClose: function( selectedDate ) {
        	$( "input[name='data_ate']" ).datepicker( "option", "minDate", selectedDate );
      	}
    });
	
    $( "input[name='data_ate']" ).datepicker({
		dateFormat: "dd/mm/yy",
		changeMonth: true,
		changeYear: true
    });
	
	
	//$('#doc').setMask('99.999.999/9999-99');
	
	$(".cnpj").focus(function(){
		if($('input[name="doc"]').is(":checked"))
		{
			return false
		}else{
			alert("Escolha o tipo de documento (CNPJ ou CPF)");
			$(".cnpj").blur();
		}
	});
	$('input[name="doc"]').click(function(){
		var doc = $(this).val();
		if(doc == "cpf")
		{
			$("#doc").setMask("999.999.999-99");
			$("#doc").removeClass("cnpj");
			$("#doc").addClass("cpf");
		}
		else
		{
			$("#doc").setMask("99.999.999/9999-99");
			$("#doc").removeClass("cpf");
			$("#doc").addClass("cnpj");
		}
	});
	
	$("input[name='cpf_funcionario']").setMask("999.999.999-99");
	
	$("#cep").setMask("99999-999");
	$("#numero").setMask("99999999");
	$("#cep").blur(function(){
		var cep = $(this).val();
		
		$.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+cep, function(){
			if(resultadoCEP["resultado"] == 1) {
				$("#endereco").val(unescape(resultadoCEP["tipo_logradouro"])+" "+unescape(resultadoCEP["logradouro"]));
				$("#bairro").val(unescape(resultadoCEP["bairro"]));
				$("#cidade").val(unescape(resultadoCEP["cidade"]));
				$("#estado").val(unescape(resultadoCEP["uf"]));
				$("#numero").focus();
			} else if(resultadoCEP["resultado"] == 2) {
				$("#cidade").val(unescape(resultadoCEP["cidade"]));
				$("#estado").val(unescape(resultadoCEP["uf"]));
				$("#endereco").focus();
			} else {
				alert("Endereço não encontrado");
			}
		});
	});
	
	$(".hora").setMask("99:99");
	
	$("select[name='tipo_jornada']").change(function(){
		var tipojor = $(this).val();
		
		if(tipojor == "normal" || tipojor == "")
		{
			//$("input[name='entrada_2']").addClass("required");
			//$("input[name='saida_2']").addClass("required");
			
			$(".entrada_1").val("08:00");
			$(".saida_1").val("12:00");
			$(".entrada_2").val("13:00");
			$(".saida_2").val("17:00");
			$(".carga_horaria").val("08:00");
			
			$("input[name='entrada_1_s']").val("08:00");
			$("input[name='saida_1_s']").val("12:00");
			$("input[name='entrada_2_s']").val("");
			$("input[name='saida_2_s']").val("");
			$("input[name='carga_horaria_s']").val("04:00");
			
			$("input[name='entrada_1_d']").val("");
			$("input[name='saida_1_d']").val("");
			$("input[name='entrada_2_d']").val("");
			$("input[name='saida_2_d']").val("");
			$("input[name='carga_horaria_d']").val("");
		}
		else if(tipojor == "12x36")
		{
			$(".entrada_2").removeClass("required");
			$(".saida_2").removeClass("required");
			
			$(".entrada_1").val("08:00");
			$(".saida_1").val("20:00");
			$(".entrada_2").val("");
			$(".saida_2").val("");
			$(".carga_horaria").val("12:00");
			
			$("input[name='entrada_1_s']").val("");
			$("input[name='saida_1_s']").val("");
			$("input[name='entrada_2_s']").val("");
			$("input[name='saida_2_s']").val("");
			$("input[name='carga_horaria_s']").val("");
			
			$("input[name='entrada_1_d']").val("");
			$("input[name='saida_1_d']").val("");
			$("input[name='entrada_2_d']").val("");
			$("input[name='saida_2_d']").val("");
			$("input[name='carga_horaria_d']").val("");
		}
		else if(tipojor == "6horas")
		{
			$(".entrada_2").removeClass("required");
			$(".saida_2").removeClass("required");
			
			$(".entrada_1").val("08:00");
			$(".saida_1").val("14:00");
			$(".entrada_2").val("");
			$(".saida_2").val("");
			$(".carga_horaria").val("06:00");
			
			$("input[name='entrada_1_s']").val("08:00");
			$("input[name='saida_1_s']").val("14:00");
			$("input[name='entrada_2_s']").val("");
			$("input[name='saida_2_s']").val("");
			$("input[name='carga_horaria_s']").val("06:00");
			
			$("input[name='entrada_1_d']").val("");
			$("input[name='saida_1_d']").val("");
			$("input[name='entrada_2_d']").val("");
			$("input[name='saida_2_d']").val("");
			$("input[name='carga_horaria_d']").val("");
		}

	});
	
	$("select[name='tipo_jornada']").change(function(){
		var tipo = $(this).val();
		
		if(tipo == "normal" || tipo == "6horas" || tipojor == "")
			$(".fimdesemana").show();
		else
			$(".fimdesemana").hide();
	});
	
	var horaInicial_1;
	var horaFinal_1;
	var horaInicial_2;
	var horaFinal_2;
	var dif_turno1;
	var dif_turno2;
	var total_turno;
	var saldo;


	$(".hora").blur(function(){
		var linha = $(this).parent().parent().attr("class");
	
		
		if($(this).prop("readonly") == false)
		{
			
			horaInicial_1 = $("."+linha).find(".entrada_1").val();
			if(!horaInicial_1)
				horaInicial_1 = "00:00";
			horaFinal_1 = $("."+linha).find(".saida_1").val();
			if(!horaFinal_1)
				horaFinal_1 = "00:00";
			dif_turno1 = subtraiHora(horaFinal_1, horaInicial_1);		
			
			horaInicial_2 = $("."+linha).find(".entrada_2").val();
			if(!horaInicial_2)
				horaInicial_2 = "00:00";
			horaFinal_2 = $("."+linha).find(".saida_2").val();
			if(!horaFinal_2)
				horaFinal_2 = "00:00";
			dif_turno2 = subtraiHora(horaFinal_2, horaInicial_2);
			
			total_turno = somaHora(dif_turno1, dif_turno2, false);

			var carga_horaria = $("."+linha).find(".carga_horaria").val(total_turno);

		}

	});
	
});
</script>
<form action="paginas/envia.php?op=cartaoponto" method="post" id="formularios">
	<h3 align='center' style='margin-top: 20px;'><?php echo @$tituloform;?></h3>
	<table cellpadding="10" cellspacing="0" width="100%" class="tblform">
    	<tr>
			<td>Raz&atilde;o Social:<br /><input type="text" name="razao_social" class="inputbox required" style="width:250px;" /></td>
            <td valign="top"><label><input type="radio" name="doc" value="cnpj"> CNPJ</label> &nbsp;ou <label><input type="radio" name="doc" value="cpf"> CPF:</label><br /><input type="text" id="doc" name="cnpj" class="inputbox cnpj required" style="width:250px;" /></td>
        </tr>
        <tr>
        	<td valign="top">E-mail:<br /><input type="text" name="email" class="inputbox required email" style="width:250px;" /></td>
        	<td valign="top">CEP:<br /><input type="text" name="cep" id="cep" class="inputbox cep required" style="width:250px;" /></td>
		</tr>
        <tr>
        	<td valign="top">Endere&ccedil;o:<br /><input type="text" name="endereco" id="endereco" class="inputbox required" style="width:250px;" /></td>
        	<td valign="top">N&uacute;mero:<br /><input type="text" name="numero" id="numero" class="inputbox numero required" style="width:250px;" /></td>
		</tr>
        <tr>
        	<td valign="top">Bairro:<br /><input type="text" name="bairro" id="bairro" class="inputbox required" style="width:250px;" /></td>
        	<td valign="top">Complemento:<br /><input type="text" name="complemento" id="complemento" class="inputbox" style="width:250px;" /></td>
		</tr>
        <tr>
        	<td valign="top">Cidade:<br /><input type="text" name="cidade" id="cidade" class="inputbox required" style="width:250px;" /></td>
        	<td valign="top">Estado:<br /><input type="text" name="estado" id="estado" class="inputbox required" style="width:250px;" /></td>
        </tr>
    	<tr>
        	<td>Nome do funcion&aacute;rio:<br /><input type="text" name="nome_funcionario" class="inputbox required" style="width: 250px;" /></td>
            <td>CPF do funcion&aacute;rio:<br /><input type="text" name="cpf_funcionario" class="inputbox required" style="width: 250px;" /></td>
       	</tr>
        <tr>
            <td colspan="2">Cargo:<br /><input type="text" name="cargo" class="inputbox required" style="width: 250px;" /></td>
        </tr>
		<tr>
        	<td valign="top" colspan="2">Período:<br />
            De: <input type="text" name="data_de" class="inputbox required datamascara" placeholder="DD/MM/AAAA" style="width:225px;" />&nbsp;
            At&eacute;: <input type="text" name="data_ate" class="inputbox required datamascara" placeholder="DD/MM/AAAA" style="width:225px;" /></td>         
        </tr>
        <tr><td colspan="2"><hr /></td></tr>
        <tr>
        	<td valign="top" colspan="2">Tipo de Jornada de Trabalho: &nbsp;&nbsp;
            <select name="tipo_jornada" class="inputbox">
            	<option value="" selected>Selecione</option>
                <option value="normal">Normal</option>
                <option value="6horas">6 Horas</option>
                <option value="12x36">12x36</option>
            </select>         
        </tr>
        <tr>
        	<td colspan="2">
            	<table cellpadding="0" cellspacing="0" width="100%">
                	<tr>
                    	<th colspan="7" align="center">SEMANAL</th>
                    </tr>
                	<tr>
                		<th></th>
                    	<th align="center" colspan="2">HOR&Aacute;RIO PADR&Atilde;O: &nbsp;1&deg; TURNO</th>
                        <th align="center" colspan="2">HOR&Aacute;RIO PADR&Atilde;O: &nbsp;2&deg; TURNO</th>
                        <th align="center" colspan="2">CARGA HOR&Aacute;RIA</th>
                    </tr>
                    <tr>
                    	<td></td>
                    	<td align="center" style="background: #111; border:1px solid #000 !important;">Entrada</td>
                        <td align="center" style="background: #111; border:1px solid #000 !important; border-right:5px solid #000 !important;">Sa&iacute;da</td>
                        <td align="center" style="background: #111; border:1px solid #000 !important;">Entrada</td>
                        <td align="center" style="background: #111; border:1px solid #000 !important; border-right:5px solid #000 !important;">Sa&iacute;da</td>
                        <td align="center" style="background: #111; border:1px solid #000 !important;"></td>
                    </tr>
                	<tr class="l1">
						<td>SEG</td>
						<td align="center" style="background: #111; border:1px solid #000 !important;"><input type="text" name="entrada_1_1" placeholder="--:--" class="inputbox hora entrada_1 required" style="width: 50px; text-align:center; background: #000;" /></td>
						<td align="center" style="background: #111; border:1px solid #000 !important; border-right:5px solid #000 !important;"><input type="text" name="saida_1_1" placeholder="--:--" class="inputbox hora saida_1 required" style="width: 50px; text-align:center; background: #000;" /></td>
						<td align="center" style="background: #111; border:1px solid #000 !important;"><input type="text" name="entrada_2_1" placeholder="--:--" class="inputbox hora entrada_2 required" style="width: 50px; text-align:center; background: #000;" /></td>
						<td align="center" style="background: #111; border:1px solid #000 !important; border-right:5px solid #000 !important;"><input type="text" name="saida_2_1" placeholder="--:--" class="inputbox hora saida_2 required" style="width: 50px; text-align:center; background: #000;" /></td>
						<td align="center" style="background: #111; border:1px solid #000 !important;"><input type="text" name="carga_horaria_1" placeholder="--:--" class="inputbox hora carga_horaria required" style="width: 50px; text-align:center; background: #000;" /></td>
					</tr>
					<tr class="l4">
						<td>TER</td>
						<td align="center" style="background: #111; border:1px solid #000 !important;"><input type="text" name="entrada_1_2" placeholder="--:--" class="inputbox hora entrada_1 required" style="width: 50px; text-align:center; background: #000;" /></td>
						<td align="center" style="background: #111; border:1px solid #000 !important; border-right:5px solid #000 !important;"><input type="text" name="saida_1_2" placeholder="--:--" class="inputbox hora saida_1 required" style="width: 50px; text-align:center; background: #000;" /></td>
						<td align="center" style="background: #111; border:1px solid #000 !important;"><input type="text" name="entrada_2_2" placeholder="--:--" class="inputbox hora entrada_2 required" style="width: 50px; text-align:center; background: #000;" /></td>
						<td align="center" style="background: #111; border:1px solid #000 !important; border-right:5px solid #000 !important;"><input type="text" name="saida_2_2" placeholder="--:--" class="inputbox hora saida_2 required" style="width: 50px; text-align:center; background: #000;" /></td>
						<td align="center" style="background: #111; border:1px solid #000 !important;"><input type="text" name="carga_horaria_2" placeholder="--:--" class="inputbox hora carga_horaria required" style="width: 50px; text-align:center; background: #000;" /></td>
					</tr>
					<tr class="l5">
						<td>QUA</td>
						<td align="center" style="background: #111; border:1px solid #000 !important;"><input type="text" name="entrada_1_3" placeholder="--:--" class="inputbox hora entrada_1 required" style="width: 50px; text-align:center; background: #000;" /></td>
						<td align="center" style="background: #111; border:1px solid #000 !important; border-right:5px solid #000 !important;"><input type="text" name="saida_1_3" placeholder="--:--" class="inputbox hora saida_1 required" style="width: 50px; text-align:center; background: #000;" /></td>
						<td align="center" style="background: #111; border:1px solid #000 !important;"><input type="text" name="entrada_2_3" placeholder="--:--" class="inputbox hora entrada_2 required" style="width: 50px; text-align:center; background: #000;" /></td>
						<td align="center" style="background: #111; border:1px solid #000 !important; border-right:5px solid #000 !important;"><input type="text" name="saida_2_3" placeholder="--:--" class="inputbox hora saida_2 required" style="width: 50px; text-align:center; background: #000;" /></td>
						<td align="center" style="background: #111; border:1px solid #000 !important;"><input type="text" name="carga_horaria_3" placeholder="--:--" class="inputbox hora carga_horaria required" style="width: 50px; text-align:center; background: #000;" /></td>
					</tr>
					<tr class="l6">
						<td>QUI</td>
						<td align="center" style="background: #111; border:1px solid #000 !important;"><input type="text" name="entrada_1_4" placeholder="--:--" class="inputbox hora entrada_1 required" style="width: 50px; text-align:center; background: #000;" /></td>
						<td align="center" style="background: #111; border:1px solid #000 !important; border-right:5px solid #000 !important;"><input type="text" name="saida_1_4" placeholder="--:--" class="inputbox hora saida_1 required" style="width: 50px; text-align:center; background: #000;" /></td>
						<td align="center" style="background: #111; border:1px solid #000 !important;"><input type="text" name="entrada_2_4" placeholder="--:--" class="inputbox hora entrada_2 required" style="width: 50px; text-align:center; background: #000;" /></td>
						<td align="center" style="background: #111; border:1px solid #000 !important; border-right:5px solid #000 !important;"><input type="text" name="saida_2_4" placeholder="--:--" class="inputbox hora saida_2 required" style="width: 50px; text-align:center; background: #000;" /></td>
						<td align="center" style="background: #111; border:1px solid #000 !important;"><input type="text" name="carga_horaria_4" placeholder="--:--" class="inputbox hora carga_horaria required" style="width: 50px; text-align:center; background: #000;" /></td>
					</tr>
					<tr class="l7">
						<td>SEX</td>
						<td align="center" style="background: #111; border:1px solid #000 !important;"><input type="text" name="entrada_1_5" placeholder="--:--" class="inputbox hora entrada_1 required" style="width: 50px; text-align:center; background: #000;" /></td>
						<td align="center" style="background: #111; border:1px solid #000 !important; border-right:5px solid #000 !important;"><input type="text" name="saida_1_5" placeholder="--:--" class="inputbox hora saida_1 required" style="width: 50px; text-align:center; background: #000;" /></td>
						<td align="center" style="background: #111; border:1px solid #000 !important;"><input type="text" name="entrada_2_5" placeholder="--:--" class="inputbox hora entrada_2 required" style="width: 50px; text-align:center; background: #000;" /></td>
						<td align="center" style="background: #111; border:1px solid #000 !important; border-right:5px solid #000 !important;"><input type="text" name="saida_2_5" placeholder="--:--" class="inputbox hora saida_2 required" style="width: 50px; text-align:center; background: #000;" /></td>
						<td align="center" style="background: #111; border:1px solid #000 !important;"><input type="text" name="carga_horaria_5" placeholder="--:--" class="inputbox hora carga_horaria required" style="width: 50px; text-align:center; background: #000;" /></td>
					</tr>
                </table>
            </td>
        </tr>
        <tr><td colspan="2"><hr /></td></tr>
        <tr class="fimdesemana">
        	<td colspan="2">
            	<table cellpadding="0" cellspacing="0" width="100%">
                	<tr>
                    	<th colspan="7" align="center">FINAIS DE SEMANA</th>
                    </tr>
                	<tr>
                    	<th></th>
                    	<th align="center" colspan="2">HOR&Aacute;RIO PADR&Atilde;O: &nbsp;1&deg; TURNO</th>
                        <th align="center" colspan="2">HOR&Aacute;RIO PADR&Atilde;O: &nbsp;2&deg; TURNO</th>
                        <th align="center" colspan="2">CARGA HOR&Aacute;RIA</th>
                    </tr>
                    <tr>
                    	<td></td>
                    	<td align="center" style="background: #111; border:1px solid #000 !important;">Entrada</td>
                        <td align="center" style="background: #111; border:1px solid #000 !important; border-right:5px solid #000 !important;">Sa&iacute;da</td>
                        <td align="center" style="background: #111; border:1px solid #000 !important;">Entrada</td>
                        <td align="center" style="background: #111; border:1px solid #000 !important; border-right:5px solid #000 !important;">Sa&iacute;da</td>
                        <td align="center" style="background: #111; border:1px solid #000 !important;"></td>
                    </tr>
                	<tr class="l2">
                    	<td>SAB</td>
                    	<td align="center" style="background: #111; border:1px solid #000 !important;"><input type="text" name="entrada_1_s" placeholder="--:--" class="inputbox entrada_1 hora" style="width: 50px; text-align:center; background: #000;" /></td>
                        <td align="center" style="background: #111; border:1px solid #000 !important; border-right:5px solid #000 !important;"><input type="text" name="saida_1_s" placeholder="--:--" class="inputbox saida_1 hora" style="width: 50px; text-align:center; background: #000;" /></td>
                        <td align="center" style="background: #111; border:1px solid #000 !important;"><input type="text" name="entrada_2_s" placeholder="--:--" class="inputbox entrada_2 hora" style="width: 50px; text-align:center; background: #000;" /></td>
                        <td align="center" style="background: #111; border:1px solid #000 !important; border-right:5px solid #000 !important;"><input type="text" name="saida_2_s" placeholder="--:--" class="inputbox saida_2 hora" style="width: 50px; text-align:center; background: #000;" /></td>
                        <td align="center" style="background: #111; border:1px solid #000 !important;"><input type="text" name="carga_horaria_s" placeholder="--:--" class="inputbox carga_horaria hora" style="width: 50px; text-align:center; background: #000;" /></td>
                    </tr>
                    <tr class="l3">
                    	<td>DOM</td>
                    	<td align="center" style="background: #111; border:1px solid #000 !important;"><input type="text" name="entrada_1_d" placeholder="--:--" class="inputbox entrada_1 hora" style="width: 50px; text-align:center; background: #000;" /></td>
                        <td align="center" style="background: #111; border:1px solid #000 !important; border-right:5px solid #000 !important;"><input type="text" name="saida_1_d" placeholder="--:--" class="inputbox saida_1 hora" style="width: 50px; text-align:center; background: #000;" /></td>
                        <td align="center" style="background: #111; border:1px solid #000 !important;"><input type="text" name="entrada_2_d" placeholder="--:--" class="inputbox entrada_2 hora" style="width: 50px; text-align:center; background: #000;" /></td>
                        <td align="center" style="background: #111; border:1px solid #000 !important; border-right:5px solid #000 !important;"><input type="text" name="saida_2_d" placeholder="--:--" class="inputbox saida_2 hora" style="width: 50px; text-align:center; background: #000;" /></td>
                        <td align="center" style="background: #111; border:1px solid #000 !important;"><input type="text" name="carga_horaria_d" placeholder="--:--" class="inputbox carga_horaria hora" style="width: 50px; text-align:center; background: #000;" /></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr><td colspan="2"><hr /></td></tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" value="Enviar" class="button" /></td>
		</tr>
	</table>
</form>
<?php

}
?>
<br style="clear: both;" />

		