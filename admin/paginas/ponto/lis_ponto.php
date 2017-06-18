<?php
$op = seguranca(@$_GET['op']);

$palavra = seguranca(htmlentities(utf8_decode(@$_GET['palavra'])));
if($palavra)
	$filtro = "AND (a.nome_funcionario LIKE '%".$palavra."%' OR a.cpf_funcionario LIKE '%".$palavra."%' OR b.razao_social LIKE '%".$palavra."%' OR b.cnpj LIKE '%".$palavra."%')";
else
	$filtro = "";



$sql = mysql_query("SELECT a.id, a.nome_funcionario, a.cpf_funcionario, a.data_de, a.data_lancamento,  DATE_FORMAT(a.data_lancamento, '%d/%m/%Y') AS data_correta, b.razao_social FROM funcionarios_ponto AS a LEFT JOIN empresas_ponto AS b ON a.id_empresa = b.id WHERE 1 $filtro ORDER BY b.razao_social, a.data_lancamento DESC");
	
	

?>

<script type="text/javascript">
$(function(){
		
		<?php
		if(@$_GET['mgs'] == "enviook")
			echo "alert('Cartão Ponto enviado com sucesso')";
		?>
		
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
	if(confirm("Deseja excluir o funcionário " +nome+"?")) {
   		location.href = "paginas/ponto/acoes.php?op=exclui_funci&id="+id;
 	}
}



</script>

<table cellpadding="0" cellspacing="2" width="100%" class="tblcadastro" id="tabela">
		<thead>
		<tr>
            <th>Empresa</th>
            <th>Funcionário</th>
            <th>CPF</th>
            <th>Ponto Enviado</th>
			<th>Último Envio</th>
            <th colspan="3">A&ccedil;&otilde;es</th>
        </tr>
        </thead>
        <tbody>
        <?php
		$data = "";
		$publi = "";
		while($reg = mysql_fetch_array($sql))
		{
			$data = explode("-",@$reg['data_lancamento']);
			if($data[1] == date("m")){
				$publi = "<img src='imagens/icon-32-apply.png' border='0' title='Ponto gerado neste mês' alt='Ponto gerado neste mês' />";
			}
			else
			{
				$publi = "";
			}
			
		?>	
	        <tr>
            	<td><?php echo html_entity_decode($reg['razao_social']);?></td>
                <td><?php echo html_entity_decode($reg['nome_funcionario']);?></td>
                <td><?php echo $reg['cpf_funcionario'];?></td>
                <td align="center" class="publi"><?php echo $publi;?></td>
                <td><?php echo $reg['data_correta'];?></td>
                <td align="center"><button onclick="location.href='paginas/ponto/acoes.php?op=envia&id=<?php echo $reg['id'];?>'" type="button" class="button">Enviar Ponto</button></td>
                <td align="center"><a href="index.php?pag=cad_ponto&id=<?php echo $reg['id'];?>"><img src="imagens/icon-32-edit.png" border="0" title="Editar" alt="Editar" /></a></td>
                <td align="center"><a onclick="confirma('<?php echo $reg['id'];?>','<?php echo $reg['nome_funcionario'];?>')"><img style="cursor:pointer;" title="Excluir" alt="Excluir" src="imagens/icon-32-cancel.png" /></a></td>
            </tr>
        <?php
		}
		?>
        </tbody>
</table>
