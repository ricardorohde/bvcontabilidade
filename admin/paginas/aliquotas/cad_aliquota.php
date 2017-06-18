<?php
$sql = mysql_query("SELECT * FROM aliquotas_inss");
$reg = mysql_fetch_array($sql);

$aliquota9 = explode("|",$reg['aliquota9']);
$aliquota9_de = $aliquota9[0];
$aliquota9_ate = $aliquota9[1];

$aliquota11 = explode("|",$reg['aliquota11']);
$aliquota11_de = $aliquota11[0];
$aliquota11_ate = $aliquota11[1];

?>
<script type="text/javascript">
$(function(){

	$("#formcadastro").validate();
	
	
	$(".valor").maskMoney({
		showSymbol:false, 
		symbol:"", 
		decimal:",", 
		thousands:".",
		allowZero: true
	});	
	
	$("input[name='aliquota8-float']").keyup(function(){
		var valor = parseFloat((($(this).val()).replace(".","")).replace(",","."));
		var valor2 = valor+0.01;
		
		$("input[name='aliquota9-cond[0]']").val(valor2);

	});
	
	$(".valor").blur(function(){
		
		$(this).maskMoney({
			showSymbol:false, 
			symbol:"", 
			decimal:",", 
			thousands:".",
			allowZero: true
		});	
	});


});
</script>
<form action="paginas/aliquotas/acoes.php?op=novo" method="post" id="formcadastro">
<table cellpadding="0" cellspacing="2" width="100%" class="tblcadastro">
		<tr>
        	<th>Al&iacute;quotas</th>
            <th>Valores</th>
        </tr>
        <tr>
        	<td>Al&iacute;quota 8%</td>
            <td>at&eacute; <input type="text" name="aliquota8-float" class="inputbox valor required" value="<?php echo number_format(@$reg['aliquota8'],2,",",".");?>" style="width: 200px; text-align: right;" />
            </td>
      	</tr>
        <tr>
        	<td>Al&iacute;quota 9%</td>
            <td>de <input type="text" name="aliquota9-cond[0]" class="inputbox valor required" value="<?php echo number_format(@$aliquota9_de,2,",",".")?>" style="width: 200px; text-align: right;" /> at&eacute; <input type="text" name="aliquota9-cond[1]" class="inputbox valor required" value="<?php echo number_format(@$aliquota9_ate,2,",",".");?>" style="width: 200px; text-align: right;" />
            </td>
      	</tr>
        <tr>
        	<td>Al&iacute;quota 11%</td>
            <td>de <input type="text" name="aliquota11-cond[]" class="inputbox valor required" value="<?php echo number_format(@$aliquota11_de,2,",",".");?>" style="width: 200px; text-align: right;" /> at&eacute; <input type="text" name="aliquota11-cond[]" class="inputbox valor required" value="<?php echo number_format($aliquota11_ate,2,",",".");?>" style="width: 200px; text-align: right;" />
            </td>
      	</tr>
        
        <tr>
    		<td colspan="2" class="salvar"><input type="submit" value="Salvar" class="button" /></td>
        </tr>
</table>
</form>
