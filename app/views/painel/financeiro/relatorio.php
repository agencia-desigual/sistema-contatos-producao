<?php
$arquivo = 'relatorio-'.date('d-m-y-H-i-s').'.xls';

// Criamos uma tabela HTML com o formato da planilha
$html = '';
$html .= '<table border="1">';
$html .= '<tr>';
$html .= '<td colspan="5">Relatório de Notas Financeiras</td>';
$html .= '</tr>';

$html .= '<tr>';
$html .= '<td><b>ID</b></td>';
$html .= '<td><b>Empresa</b></td>';
$html .= '<td><b>CNPJ / CPF</b></td>';
$html .= '<td><b>Valor</b></td>';
$html .= '<td><b>Data da nota</b></td>';
$html .= '</tr>';


foreach ($notas as $nota)
{
    $html .= '<tr>';
    $html .= '<td>'.$nota->id_financeiro.'</td>';
    $html .= '<td>'.$nota->empresa->nome.'</td>';
    $html .= '<td>'.(!empty($nota->empresa->cnpj) ? $nota->empresa->cnpj : $nota->empresa->cpf).'</td>';
    $html .= '<td>R$'.number_format($nota->valor,2,",",".").'</td>';
    $html .= '<td>'.date("d/m/Y", strtotime($nota->data)).'</td>';
    $html .= '</tr>';
}

$html .= '</table>';

// Configurações header para forçar o download
header ("Expires: Mon, 07 Jul 2016 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/x-msexcel");
header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
header ("Content-Description: PHP Generated Data" );

echo $html;
exit;


?>