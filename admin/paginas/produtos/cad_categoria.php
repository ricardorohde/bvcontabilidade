<script type="text/javascript">

$(function(){

	$("#subsub").hide();
		

	$(".cp").hide();
	
	$("dt span").click(function(){
		var cp = ($(this).parent().attr('id')).split("-");
		$("#cat-"+cp[1]).show().focus();	
		$(this).hide();	
	});
	$(".subcat span").click(function(){
		var cp = ($(this).parent().attr('id')).split("-");
		$("#subcat-"+cp[1]).show().focus();	
		$(this).hide();	
	});

	
	$(".cp").blur(function() {
		
		var valor = $(this).val();
		var campo = $(this).attr('name');
		
		var id = ($(this).attr('id')).split("-");
		var tipo = id[0];
		var id_campo = id[1];
				
		$.post("paginas/produtos/acoes.php?op=editacategoria&id="+id_campo,{
				campo : campo,
				valor : valor,
				tipo : tipo

				}, function(data) {
					location.href = window.location;

		});

		return false;

	});
	
	$(".publi").click(function(){
			var campo = $(this).attr("id").split("-");
			var tipo = campo[0];
			var status = campo[1];
			var id = campo[2];
			
			$.post("paginas/produtos/acoes.php?op=publicat",{
				tipo : tipo,
				status : status,
				id : id
					  
				}, function(data){
					location.href = window.location;
				}
			);
									 
		});
	
	$("#id_cat").change(function() {
		var id = $(this).val();
		$.post("paginas/produtos/pegasubcategoria.php",{
				id : id
				}, function(data) {
					$("#subsub").show();
					$("#id_subcategoria").empty().html(data);

		});
		return false;
	});
	
	$("#ccat").click(function(){
			$( "#form_cat" ).dialog("open");						
	});
	$("#form_cat").dialog({
				autoOpen: false,
				height: 350,
				width: 450,
				modal: true,
				buttons: {
					"Salvar": function() {
						$("#form_cat form").submit();
						$( "#form_cat" ).dialog("close");
					}
				},
				close: function() {
				}
	});
	
	$("#cscat").click(function(){
			$( "#form_subcat" ).dialog("open");						
	});
	$("#form_subcat").dialog({
				autoOpen: false,
				height: 350,
				width: 450,
				modal: true,
				buttons: {
					"Salvar": function() {
						$("#form_subcat form").submit();
						//$( "#form_subcat" ).dialog("close");
					}
				},
				close: function() {
				}
	});
	
	$("#formcat").validate();
	$("#formsubcat").validate();
	
	
});



function confirma(op, id, nome)
{
	if(op == "cat")
	{
		if(confirm("Deseja realmente excluir a Categoria "+nome+"? Todas as sub-categorias dentro dela tambem serao apagadas."))
				location.href = "paginas/produtos/acoes.php?op=excluicat&op2="+op+"&id="+id;
	}
	else if(op == "subcat")
	{
		if(confirm("Deseja realmente excluir a Categoria "+nome+"? Todas as sub-categorias dentro dela tambem serao apagadas."))
				location.href = "paginas/produtos/acoes.php?op=excluicat&op2="+op+"&id="+id;
	}
	else if(op == "subsubcat")
	{
		if(confirm("Deseja realmente excluir a categoria "+nome+"?"))
				location.href = "paginas/produtos/acoes.php?op=excluicat&op2="+op+"&id="+id;
	}
}



</script>

<div align="center">
<input type="button" id="ccat" value="Criar Categoria" class="button" /> <!--<input type="button" id="cscat" value="Criar Sub-Categoria" class="button" />-->
</div>

<div id="form_cat" title="Criar Categoria">
<form action="paginas/produtos/acoes.php?op=criacategoria" method="post">

<table cellpadding="10" cellspacing="0" border="0" width="100%" class="tblcadastro">
	<tr>
    	<td>
             Nome da Categoria<br />
            <input type="text" name="nome_cat-string" value="" class="inputbox required" style="width: 350px;" />
       	</td>
   	</tr>
</table>
</form>
</div>

<div id="form_subcat" title="Criar Sub-Categoria">
<form action="paginas/produtos/acoes.php?op=criasubcategoria" method="post">
<table cellpadding="10" cellspacing="0" border="0" width="100%" class="tblcadastro">
	<tr>
    	<td>
        Categoria<br />
       	<select name="id_categoria-num" class="inputbox required">
            	<option value="">Selecione...</option>
                <?php
				$sqletapa = mysql_query("SELECT * FROM categorias ORDER BY nome_cat");
				while($regetapa = mysql_fetch_array($sqletapa))
				{
					echo "<option value='".$regetapa['id']."'>".$regetapa['nome_cat']."</option>";
				}
				?>
           	</select></td>
   	</tr>
    <tr>
    	<td>Nome da Sub-categoria<br />
            <input type="text" name="nome_subcat-string" value="" class="inputbox required" style="width: 350px;" />
        </td>
   	</tr>
</table>
</form>
</div>

<h3>Lista de Categorias</h3>

<?php
$tipo = seguranca(@$_GET['tipo']);
?>
<dl>
	<?php
	$sql = mysql_query("SELECT id, nome_cat, status AS status_cat FROM categorias ORDER BY id");
	
	while($reg = mysql_fetch_array($sql))
	{
		if(@$auxetapa != $reg['id'])
		{
			if($reg['status_cat'] == "n"){
				$publi = "<img style='float: right; cursor:pointer; background: #FFF; padding: 3px; margin-right: 3px;' src='imagens/icon-32-apply-off.png' border='0' title='Publicar' alt='Publicar' />";
				$estilo = " style='background: #EEE !important; color: #CCC !important;'";
				$status = "s";
			}
			else
			{
				$publi = "<img style='float: right; cursor:pointer; background: #FFF; padding: 3px; margin-right: 3px;' src='imagens/icon-32-apply.png' border='0' title='Despublicar' alt='Despublicar' />";
				$estilo = "";
				$status = "n";
			}
			
		?>
			<dt<?php echo $estilo;?> id="dt-<?php echo $reg['id'];?>"><span><?php echo $reg['nome_cat'];?></span>
            	<input type="text" name="categoria" value="<?php echo $reg['nome_cat'];?>" class="inputbox cp" id="cat-<?php echo $reg['id'];?>" />
            	<a onclick="confirma('cat','<?php echo $reg['id'];?>', '<?php echo $reg['nome_cat'];?>')" class='exclui_etapa'><img style="float: right; cursor:pointer; background: #FFF; padding: 3px;" src='imagens/icon-32-cancel.png' /></a>
                <a id="<?php echo "cat-".$status."-".$reg['id'];?>" class="publi"><?php echo $publi;?></a>
            </dt>
        <?php
			$auxetapa = $reg['id'];
		}
	}
	?>

</dl>