<?php
$op = seguranca(@$_GET['op']);

$sql = mysql_query("SELECT * FROM paginas");
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
		

		
		$(".tblcadastro").dataTable({
					"sPaginationType": "full_numbers"
		});
		

		
});


</script>

<table cellpadding="0" cellspacing="2" width="100%" class="tblcadastro">
		<thead>
		<tr>
            <th>T&iacute;tulo</th>
            <th colspan="2">A&ccedil;&otilde;es</th>
        </tr>
        </thead>
        <tbody>
        <?php
		while($reg = mysql_fetch_array($sql))
		{
		?>
	        <tr>
            	<td width="50%"><?php echo html_entity_decode($reg['titulo']);?></td>
                <td align="center" width="5%"><a href="index.php?pag=cad_paginas&id=<?php echo $reg['id'];?>"><img src="imagens/icon-32-edit.png" border="0" title="Editar" alt="Editar" /></a></td>
            </tr>
        <?php
		}
		?>
        </tbody>
</table>
