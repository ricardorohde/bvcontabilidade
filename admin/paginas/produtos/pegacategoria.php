<?php
include("../../conexao.php");
include("../../funcaoform.php");

$tipo = seguranca($_POST['tipo']);
$sql = mysql_query("SELECT * FROM categorias WHERE tipo = '".$tipo."' ORDER BY nome_cat");
$numsubcat = mysql_num_rows($sql);
if($numsubcat > 0)
{
	echo "<option value=''>Selecione...</option>";
	while($reg = mysql_fetch_array($sql))
	{
	?>
		<option value="<?php echo $reg['id'];?>"><?php echo $reg['nome_cat'];?></option>
	<?php
	}
}
else
	echo "<option value=''>Selecione...</option>";
?>
