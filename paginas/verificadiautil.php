<?php
function proximoDiaUtil($data, $saida, $tipoaviso) {
	// Converte $data em um UNIX TIMESTAMP
	$timestamp = strtotime($data);
	// Calcula qual o dia da semana de $data
	// O resultado será um valor numérico:
	// 1 -> Segunda ... 7 -> Domingo
	$dia = date('N', $timestamp);
	if($tipoaviso == "trabalhado")
	{
	 	//Se for sábado (6) ou domingo (7), calcula a próxima segunda-feira
		if ($dia >= 6) {
			$timestamp_final = $timestamp + ((8 - $dia) * 3600 * 24);
		} else {
			// Não é sábado nem domingo, mantém a data de entrada
			$timestamp_final = $timestamp;
		}
	}
	else
	{
		if ($dia == 6) {
			$timestamp_final = strtotime("-1 days",$timestamp);
		}
		else if ($dia == 7) {
			$timestamp_final = strtotime("-2 days",$timestamp);
		} else {
			// Não é sábado nem domingo, mantém a data de entrada
			$timestamp_final = $timestamp;
		}
	}
	return date($saida, $timestamp_final);
}

$tipoaviso = $_POST['tipoaviso'];
$data_admissao = date("Y-m-d",strtotime(str_replace("/","-",$_POST['data_admissao'])));
$data_aviso = date("Y-m-d",strtotime(str_replace("/","-",$_POST['data_aviso'])));
$data_aviso2 = strtotime(str_replace("/","-",$_POST['data_aviso']));

$date = new DateTime( $data_admissao ); 
$interval = $date->diff( new DateTime( $data_aviso ) );
$num_anos = $interval->format( '%Y' );


$dias_aviso_base = 30;
if($num_anos < 1)
	$total_diasaviso = 30;
else if($num_anos > 20)
	$total_diasaviso = 90;
else
	$total_diasaviso = (($num_anos) * 3) + $dias_aviso_base;



if($tipoaviso == "trabalhado")
{
	$termino_aviso = date("Y-m-d",strtotime("+".($total_diasaviso +1)." days",$data_aviso2));

	echo $data_final = proximoDiaUtil($termino_aviso, 'd/m/Y', $tipoaviso);
}
else
{
	$termino_aviso = date("Y-m-d",strtotime("+9 days",$data_aviso2));
	echo $data_final = proximoDiaUtil($termino_aviso, 'd/m/Y', $tipoaviso);
}

?>