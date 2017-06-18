<?php
$erro = @$_GET['erro'];

if($erro == 'login')
{
?>
Login incorreto.
<br /><br />

<a style="color: #000; font-weight: bold; text-decoration:none;" href="index.php" target="_self">Clique aqui.</a>
<?php
}
else
{
?>
Voc&ecirc; precisa logar no sistema.
<br /><br />

<a style="color: #000; font-weight: bold; text-decoration:none;" href="index.php" target="_self">Clique aqui.</a>
<?php
}
?>