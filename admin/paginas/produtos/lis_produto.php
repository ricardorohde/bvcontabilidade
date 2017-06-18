<?php
$op = seguranca(@$_GET['op']);
$tipo = seguranca(@$_GET['tipo']);

$palavra = seguranca(htmlentities(utf8_decode(@$_GET['palavra'])));
if($palavra)
	$filtro = "AND (a.titulo LIKE '%".$palavra."%' OR a.texto LIKE '%".$palavra."%' OR a.resumo LIKE '%".$palavra."%' OR b.nome_cat LIKE '%".$palavra."%')";
else
	$filtro = "";



$sql = mysql_query("SELECT a.*, DATE_FORMAT(a.data, '%d/%m/%Y') AS data_correta, b.nome_cat FROM noticias AS a LEFT JOIN categorias AS b ON a.id_categoria = b.id WHERE 1 $filtro ORDER BY a.data");
	
	

?>

<script type="text/javascript">
$(function(){

		$('.tblcadastro tr').mouseover(function(){
			$(this).addClass('listra2');										
		});
		$('.tblcadastro tr').mouseout(function(){
			$(this).removeClass('listra2');										
		});
		
		
		$(".publi a").click(function(){
			var campo = $(this).attr("id").split("-");
			var status = campo[0];
			var id = campo[1];
			
			$.post("paginas/produtos/acoes.php?op=publi_produto",{
				status : status,
				id : id
					  
				}, function(data){
					location.href = window.location;
				}
			);
									 
		});
		
		$(".capa").click(function(){
			var campo = $(this).attr("id").split("-");
			var id = campo[1];
			
			$.post("paginas/produtos/acoes.php?op=capa",{
				id : id
					  
				}, function(data){
					location.href = window.location;
				}
			);
									 
		});

		$("#tabela").dataTable({
					"sPaginationType": "full_numbers"
		});
		
});
function confirma(id, nome)
{
	if(confirm("Deseja excluir o post " +nome+"?")) {
   		location.href = "paginas/produtos/acoes.php?op=exclui_produto<?php if($op){ echo "&op2=opiniao";}?>&id="+id;
 	}
}



</script>

<table cellpadding="0" cellspacing="2" width="100%" class="tblcadastro" id="tabela">
		<thead>
		<tr>
            <th>T&iacute;tulo</th>
            <?php
			if($pag == "lis_produto")
			{
				$link = "cad_produto";
			?>
            <th>Categoria</th>
            <?php
			}
			else
			{
				if($pag == "lis_documentos")
					$link = "cad_documentos";
				else
					$link = "cad_noticias";
			?>
            <th>Data</th>
            <?php
			}
			?>
            <th colspan="3">A&ccedil;&otilde;es</th>
        </tr>
        </thead>
        <tbody>
        <?php
		while($reg = mysql_fetch_array($sql))
		{
			if($reg['status'] == "n"){
				$publi = "<img src='imagens/icon-32-apply-off.png' border='0' title='Publicar' alt='Publicar' />";
				$estilo = " style='background: #EEE !important; color: #999;'";
				$status = "s";
			}
			else
			{
				$publi = "<img src='imagens/icon-32-apply.png' border='0' title='Despublicar' alt='Despublicar' />";
				$estilo = "";
				$status = "n";
			}
			
		?>	
	        <tr>
            	<td<?php echo $estilo;?> width="50%"><?php echo html_entity_decode($reg['titulo']);?></td>
                <?php
				if($pag != "lis_noticias" && $pag != "lis_documentos")
				{
				?>
                <td<?php echo $estilo;?> width="20%"><?php echo html_entity_decode($reg['nome_cat']);?></td>
                <?php
				}
				else
				{
				?>
                	<td<?php echo $estilo;?> width="40%" align="center"><?php echo $reg['data_correta'];?></td>
                <?php
				}
				?>
                <td<?php echo $estilo;?> align="center" class="publi"><a style="cursor:pointer;" id="<?php echo $status."-".$reg['id'];?>"><?php echo $publi;?></a></td>
                <td<?php echo $estilo;?> align="center"><a href="index.php?pag=<?php echo $link;?><?php if($op){ echo "&op=opiniao";}?>&id=<?php echo $reg['id'];?>"><img src="imagens/icon-32-edit.png" border="0" title="Editar" alt="Editar" /></a></td>
                <td<?php echo $estilo;?> align="center"><a onclick="confirma('<?php echo $reg['id'];?>','<?php echo $reg['titulo'];?>')"><img style="cursor:pointer;" title="Excluir" alt="Excluir" src="imagens/icon-32-cancel.png" /></a></td>
            </tr>
        <?php
		}
		?>
        </tbody>
</table>
