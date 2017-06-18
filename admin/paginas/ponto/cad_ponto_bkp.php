<?php
$op = seguranca(@$_GET['op']);
$id = seguranca(@$_GET['id']);

if($id)
{
	$sql = mysql_query("SELECT a.*, b.* FROM funcionarios_ponto AS a LEFT JOIN empresas_ponto AS b ON a.id_empresa = b.id WHERE a.id = '".$id."'");
	$reg = mysql_fetch_array($sql);
}

?>

<link type="text/css" rel="stylesheet" href="js/redactor.css" />
<script src="js/redactor.min.js"></script>

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
			$("input[name='entrada_2']").addClass("required");
			$("input[name='saida_2']").addClass("required");
			
			$("input[name='entrada_1']").val("08:00");
			$("input[name='saida_1']").val("12:00");
			$("input[name='entrada_2']").val("13:00");
			$("input[name='saida_2']").val("17:00");
			$("input[name='carga_horaria']").val("08:00");
			
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
			$("input[name='entrada_2']").removeClass("required");
			$("input[name='saida_2']").removeClass("required");
			
			$("input[name='entrada_1']").val("08:00");
			$("input[name='saida_1']").val("20:00");
			$("input[name='entrada_2']").val("");
			$("input[name='saida_2']").val("");
			$("input[name='carga_horaria']").val("12:00");
			
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
			$("input[name='entrada_2']").removeClass("required");
			$("input[name='saida_2']").removeClass("required");
			
			$("input[name='entrada_1']").val("08:00");
			$("input[name='saida_1']").val("14:00");
			$("input[name='entrada_2']").val("");
			$("input[name='saida_2']").val("");
			$("input[name='carga_horaria']").val("06:00");
			
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
	
	$("select[name='pegaempresa']").change(function(){
		var id_empresa = $(this).val();
		$.post("paginas/ponto/pegaempresa.php",{
				id_empresa : id_empresa

			}, function(data){
				
				var dados = (data).split("|");
				$("input[name='razao_social']").val(dados[1]);
				$("input[name='doc']").val(dados[2]);
				$("input[name='cnpj']").val(dados[3]);
				$("input[name='email']").val(dados[4]);
				$("input[name='cep']").val(dados[5]);
				$("input[name='endereco']").val(dados[6]);
				$("input[name='numero']").val(dados[7]);
				$("input[name='bairro']").val(dados[8]);
				$("input[name='complemento']").val(dados[9]);
				$("input[name='cidade']").val(dados[10]);
				$("input[name='estado']").val(dados[11]);
				
		});	

	})
	
	$("#formcadastro").validate();
});
</script>


<form action="paginas/ponto/acoes.php?op=novo&id=<?php echo $id;?>" method="post" id="formcadastro" enctype="multipart/form-data">
	<table cellpadding="0" cellspacing="2" width="100%" class="tblcadastro">
        <tr>
            <td>Selecione a empresa ou escreva a Raz&atilde;o Social:<br />
            <select name="pegaempresa" class="inputbox"  style="width:220px;">
            	<option value="">Selecione</option>
                <?php
				$sqle = mysql_query("SELECT id, razao_social FROM empresas_ponto ORDER BY razao_social");
				while($rege = mysql_fetch_array($sqle))
				{
					echo "<option value='".$rege['id']."'>".$rege['razao_social']."</option>";
				}
				?>
            </select>
            <input type="text" name="razao_social" value="<?php echo @$reg['razao_social'];?>" class="inputbox required" style="width:200px;" /></td>
            <td valign="top"><label><input type="radio" checked="checked" name="doc" <?php echo @$reg['doc'] == "cnpj" ? "checked" : "";?> value="cnpj"> CNPJ</label> &nbsp;ou <label><input type="radio" name="doc" <?php echo @$reg['doc'] == "cpf" ? "checked" : "";?> value="cpf"> CPF:</label><br /><input type="text" id="doc" name="cnpj" value="<?php echo @$reg['cnpj'];?>" class="inputbox cnpj required" style="width:430px;" /></td>
        </tr>
        <tr>
			<td valign="top">E-mail:<br /><input type="text" name="email" value="<?php echo @$reg['email'];?>" class="inputbox required email" style="width:430px;" /></td>
        	<td valign="top">CEP:<br /><input type="text" name="cep" value="<?php echo @$reg['cep'];?>" id="cep" class="inputbox cep required" style="width:430px;" /></td>
        </tr>    
		<tr>
        	<td valign="top">Endere&ccedil;o:<br /><input type="text" name="endereco" value="<?php echo @$reg['endereco'];?>" id="endereco" class="inputbox required" style="width:430px;" /></td>
        	<td valign="top">N&uacute;mero:<br /><input type="text" name="numero" value="<?php echo @$reg['numero'];?>" id="numero" class="inputbox numero required" style="width:430px;" /></td>
		</tr>
        <tr>
        	<td valign="top">Bairro:<br /><input type="text" name="bairro" value="<?php echo @$reg['bairro'];?>" id="bairro" class="inputbox required" style="width:430px;" /></td>
        	<td valign="top">Complemento:<br /><input type="text" name="complemento" value="<?php echo @@$reg['complemento'];?>" id="complemento" class="inputbox" style="width:430px;" /></td>
		</tr>
        <tr>
        	<td valign="top">Cidade:<br /><input type="text" name="cidade" value="<?php echo @$reg['cidade'];?>" id="cidade" class="inputbox required" style="width:430px;" /></td>
        	<td valign="top">Estado:<br /><input type="text" name="estado" value="<?php echo @$reg['estado'];?>" id="estado" class="inputbox required" style="width:430px;" /></td>
        </tr>
		<tr>
        	<td>Nome do funcion&aacute;rio:<br /><input type="text" name="nome_funcionario" value="<?php echo @$reg['nome_funcionario'];?>" class="inputbox required" style="width: 430px;" /></td>
            <td>CPF do funcion&aacute;rio:<br /><input type="text" name="cpf_funcionario" value="<?php echo @$reg['cpf_funcionario'];?>" class="inputbox required" style="width: 430px;" /></td>
       	</tr>
        <tr>
            <td>Cargo:<br /><input type="text" name="cargo" value="<?php echo @$reg['cargo'];?>" class="inputbox required" style="width: 430px;" /></td>
        	<td valign="top">Período:<br />
            De: <input type="text" name="data_de" value="<?php echo @$reg['data_de'] ? date("d/m/Y",strtotime(@$reg['data_de'])) : "19/".date("m/Y");?>" class="inputbox required datamascara" placeholder="DD/MM/AAAA" style="width:225px;" />&nbsp;
            At&eacute;: <input type="text" name="data_ate" value="<?php echo @$reg['data_ate'] ? @$reg['data_ate'] : "20/".date('m', strtotime("+1 month",strtotime(@$reg['data_de'])))."/".date("Y");?>" class="inputbox required datamascara" placeholder="DD/MM/AAAA" style="width:225px;" /></td>         
        </tr>
        
        <tr><td colspan="2"><hr /></td></tr>
        <tr>
        	<td valign="top" colspan="2">Tipo de Jornada de Trabalho: &nbsp;&nbsp;
            <select name="tipo_jornada" class="inputbox">
            	<option value="" <?php echo @$reg['tipo_jornada'] == "" ? "selected" : "";?>>Selecione</option>
                <option value="normal" <?php echo @$reg['tipo_jornada'] == "normal" ? "selected" : "";?>>Normal</option>
                <option value="6horas" <?php echo @$reg['tipo_jornada'] == "6horas" ? "selected" : "";?>>6 Horas</option>
                <option value="12x36" <?php echo @$reg['tipo_jornada'] == "12x36" ? "selected" : "";?>>12x36</option>
            </select>         
        </tr>
        <tr>
        	<td colspan="2">
            	<table cellpadding="0" cellspacing="0" width="100%">
                	<tr>
                    	<th colspan="6" align="center">SEMANAL</th>
                    </tr>
                	<tr>
                    	<th align="center" colspan="2">HOR&Aacute;RIO PADR&Atilde;O: &nbsp;1&deg; TURNO</th>
                        <th align="center" colspan="2">HOR&Aacute;RIO PADR&Atilde;O: &nbsp;2&deg; TURNO</th>
                        <th align="center" colspan="2">CARGA HOR&Aacute;RIA</th>
                    </tr>
                    <tr>
                    	<td align="center">Entrada</td>
                        <td align="center">Sa&iacute;da</td>
                        <td align="center">Entrada</td>
                        <td align="center">Sa&iacute;da</td>
                        <td align="center"></td>
                    </tr>
                	<tr class="l1">
                    	<td align="center"><input type="text" name="entrada_1" value="<?php echo @$reg['entrada_1'];?>" placeholder="--:--" class="inputbox hora entrada_1 required" style="width: 50px; text-align:center;" /></td>
                        <td align="center"><input type="text" name="saida_1" value="<?php echo @$reg['saida_1'];?>" placeholder="--:--" class="inputbox hora saida_1 required" style="width: 50px; text-align:center;" /></td>
                        <td align="center"><input type="text" name="entrada_2" value="<?php echo @$reg['entrada_2'];?>" placeholder="--:--" class="inputbox hora entrada_2" style="width: 50px; text-align:center;" /></td>
                        <td align="center"><input type="text" name="saida_2" value="<?php echo @$reg['saida_2'];?>" placeholder="--:--" class="inputbox hora saida_2" style="width: 50px; text-align:center;" /></td>
                        <td align="center"><input type="text" name="carga_horaria" value="<?php echo @$reg['carga_horaria'];?>" placeholder="--:--" class="inputbox hora carga_horaria required" style="width: 50px; text-align:center;" /></td>
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
                    	<td align="center">Entrada</td>
                        <td align="center">Sa&iacute;da</td>
                        <td align="center">Entrada</td>
                        <td align="center">Sa&iacute;da</td>
                        <td align="center"></td>
                    </tr>
                	<tr class="l2">
                    	<td>SAB</td>
                    	<td align="center"><input type="text" name="entrada_1_s" value="<?php echo @$reg['entrada_1_s'];?>" placeholder="--:--" class="inputbox entrada_1 hora" style="width: 50px; text-align:center;" /></td>
                        <td align="center"><input type="text" name="saida_1_s" value="<?php echo @$reg['saida_1_s'];?>" placeholder="--:--" class="inputbox saida_1 hora" style="width: 50px; text-align:center;" /></td>
                        <td align="center"><input type="text" name="entrada_2_s" value="<?php echo @$reg['entrada_2_s'];?>" placeholder="--:--" class="inputbox entrada_2 hora" style="width: 50px; text-align:center;" /></td>
                        <td align="center"><input type="text" name="saida_2_s" value="<?php echo @$reg['saida_2_s'];?>" placeholder="--:--" class="inputbox saida_2 hora" style="width: 50px; text-align:center;" /></td>
                        <td align="center"><input type="text" name="carga_horaria_s" value="<?php echo @$reg['carga_horaria_s'];?>" placeholder="--:--" class="inputbox carga_horaria hora" style="width: 50px; text-align:center;" /></td>
                    </tr>
                    <tr class="l3">
                    	<td>DOM</td>
                    	<td align="center"><input type="text" name="entrada_1_d" value="<?php echo @$reg['entrada_1_d'];?>" placeholder="--:--" class="inputbox entrada_1 hora" style="width: 50px; text-align:center;" /></td>
                        <td align="center"><input type="text" name="saida_1_d" value="<?php echo @$reg['saida_1_d'];?>" placeholder="--:--" class="inputbox saida_1 hora" style="width: 50px; text-align:center;" /></td>
                        <td align="center"><input type="text" name="entrada_2_d" value="<?php echo @$reg['entrada_2_d'];?>" placeholder="--:--" class="inputbox entrada_2 hora" style="width: 50px; text-align:center;" /></td>
                        <td align="center"><input type="text" name="saida_2_d" value="<?php echo @$reg['saida_2_d'];?>" placeholder="--:--" class="inputbox saida_2 hora" style="width: 50px; text-align:center;" /></td>
                        <td align="center"><input type="text" name="carga_horaria_d" value="<?php echo @$reg['carga_horaria_d'];?>" placeholder="--:--" class="inputbox carga_horaria hora" style="width: 50px; text-align:center;" /></td>
                    </tr>
                </table>
            </td>
        </tr>
        
        <tr>
    		<td class="salvar" colspan="2"><input type="submit" value="Salvar" class="button" /></td>
        </tr>
        
</table>
</form>
