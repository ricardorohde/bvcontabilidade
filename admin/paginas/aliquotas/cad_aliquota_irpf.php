<?php
$sql = mysql_query("SELECT * FROM aliquotas_irpf");
$reg = mysql_fetch_array($sql);

$aliquota0 = explode("|",$reg['aliquota0']);
$aliquota0_de = $aliquota0[0];
$aliquota0_desconto = $aliquota0[1];

$aliquota7_5 = explode("|",$reg['aliquota7_5']);
$aliquota7_5_de = $aliquota7_5[0];
$aliquota7_5_ate = $aliquota7_5[1];
$aliquota7_5_desconto = $aliquota7_5[2];

$aliquota15 = explode("|",$reg['aliquota15']);
$aliquota15_de = $aliquota15[0];
$aliquota15_ate = $aliquota15[1];
$aliquota15_desconto = $aliquota15[2];

$aliquota22_5 = explode("|",$reg['aliquota22_5']);
$aliquota22_5_de = $aliquota22_5[0];
$aliquota22_5_ate = $aliquota22_5[1];
$aliquota22_5_desconto = $aliquota22_5[2];

$aliquota27_5 = explode("|",$reg['aliquota27_5']);
$aliquota27_5_de = $aliquota27_5[0];
$aliquota27_5_desconto = $aliquota27_5[1];

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
<form action="paginas/aliquotas/acoes.php?op=novoirpf" method="post" id="formcadastro">
<table cellpadding="0" cellspacing="2" width="100%" class="tblcadastro">
		<tr>
        	<th>Al&iacute;quotas</th>
            <th>Valores</th>
            <th>Imposto a deduzir</th>
        </tr>
        <tr>
        	<td>Al&iacute;quota 0%</td>
            <td>at&eacute; <input type="text" name="aliquota0-cond[0]" class="inputbox valor required" value="<?php echo number_format(@$aliquota0_de,2,",",".")?>" style="width: 200px; text-align: right;" />
            </td>
            <td><input type="text" name="aliquota0-cond[1]" class="inputbox valor required" value="<?php echo number_format(@$aliquota0_desconto,2,",",".")?>" style="width: 200px; text-align: right;" />
            </td>
      	</tr>
        <tr>
        	<td>Al&iacute;quota 7,5%</td>
            <td>de <input type="text" name="aliquota7_5-cond[0]" class="inputbox valor required" value="<?php echo number_format(@$aliquota7_5_de,2,",",".")?>" style="width: 200px; text-align: right;" /> at&eacute; <input type="text" name="aliquota7_5-cond[1]" class="inputbox valor required" value="<?php echo number_format(@$aliquota7_5_ate,2,",",".");?>" style="width: 200px; text-align: right;" />
            </td>
            <td><input type="text" name="aliquota7_5-cond[2]" class="inputbox valor required" value="<?php echo number_format(@$aliquota7_5_desconto,2,",",".")?>" style="width: 200px; text-align: right;" />
            </td>
      	</tr>
        <tr>
        	<td>Al&iacute;quota 15%</td>
            <td>de <input type="text" name="aliquota15-cond[0]" class="inputbox valor required" value="<?php echo number_format(@$aliquota15_de,2,",",".")?>" style="width: 200px; text-align: right;" /> at&eacute; <input type="text" name="aliquota15-cond[1]" class="inputbox valor required" value="<?php echo number_format(@$aliquota15_ate,2,",",".");?>" style="width: 200px; text-align: right;" />
            </td>
            <td><input type="text" name="aliquota15-cond[2]" class="inputbox valor required" value="<?php echo number_format(@$aliquota15_desconto,2,",",".")?>" style="width: 200px; text-align: right;" />
            </td>
      	</tr>
        <tr>
        	<td>Al&iacute;quota 22,5%</td>
            <td>de <input type="text" name="aliquota22_5-cond[0]" class="inputbox valor required" value="<?php echo number_format(@$aliquota22_5_de,2,",",".")?>" style="width: 200px; text-align: right;" /> at&eacute; <input type="text" name="aliquota22_5-cond[1]" class="inputbox valor required" value="<?php echo number_format(@$aliquota22_5_ate,2,",",".");?>" style="width: 200px; text-align: right;" />
            </td>
            <td><input type="text" name="aliquota22_5-cond[2]" class="inputbox valor required" value="<?php echo number_format(@$aliquota22_5_desconto,2,",",".")?>" style="width: 200px; text-align: right;" />
            </td>
      	</tr>
        <tr>
        	<td>Al&iacute;quota 27,5%</td>
            <td>acima de <input type="text" name="aliquota27_5-cond[0]" class="inputbox valor required" value="<?php echo number_format(@$aliquota27_5_de,2,",",".");?>" style="width: 200px; text-align: right;" />
            </td>
            <td><input type="text" name="aliquota27_5-cond[1]" class="inputbox valor required" value="<?php echo number_format($aliquota27_5_desconto,2,",",".");?>" style="width: 200px; text-align: right;" />
            </td>
            
      	</tr>
        
        <tr>
    		<td colspan="3" class="salvar"><input type="submit" value="Salvar" class="button" /></td>
        </tr>
</table>
</form>
