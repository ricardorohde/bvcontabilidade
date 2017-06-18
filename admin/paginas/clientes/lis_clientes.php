<?php

$sql = mysql_query("SELECT * FROM clientes ORDER BY id DESC");

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
			
			$.post("paginas/clientes/acoes.php?op=publi_cliente",{
				status : status,
				id : id
					  
				}, function(data){
					location.href = window.location;
				}
			);
									 
		});
		
		$(".ordem").blur(function(){
			var id = $(this).attr("id");
			
			$.post("paginas/clientes/acoes.php?op=ordem",{
				id : id
					  
				}, function(data){
					location.href = window.location;
				}
			);
									 
		});
		
		$(".tblcadastro").dataTable({
					"sPaginationType": "full_numbers"
		});
		
});
</script>

<table cellpadding="0" cellspacing="2" width="100%" class="tblcadastro">
		<thead>
		<tr>
            <th>Nome</th>
            <th colspan="3">A&ccedil;&otilde;es</th>
        </tr>
        </thead>
        <tbody>
        <?php
		while($reg = mysql_fetch_array($sql))
		{
	        if($reg['status'] == "d"){
				$publi = "<img src='imagens/icon-32-apply-off.png' border='0' title='Publicar' alt='Publicar' />";
				$estilo = " style='background: #EEE; color: #999;'";
				$status = "p";
			}
			else
			{
				$publi = "<img src='imagens/icon-32-apply.png' border='0' title='Despublicar' alt='Despublicar' />";
				$estilo = "";
				$status = "d";
			}
		?>
	        <tr<?php echo $estilo;?>>
            	<td><?php echo $reg['nome'];?></td>
                <td width="5%" align="center" class="publi"><a style="cursor:pointer;" id="<?php echo $status."-".$reg['id'];?>"><?php echo $publi;?></a></td>
                <td width="5%" align="center"><a href="index.php?pag=cad_clientes&id=<?php echo $reg['id'];?>"><img src="imagens/icon-32-edit.png" border="0" title="Editar" alt="Editar" /></a></td>
               <td width="5%" align="center"><a href="paginas/clientes/acoes.php?op=exclui_cliente&id=<?php echo $reg['id'];?>"><img src="imagens/icon-32-cancel.png" border="0" title="Excluir" alt="Excluir" /></a></td>
            </tr>
        <?php
		}
		?>
        </tbody>
</table>
