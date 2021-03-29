<?php
$arquivo = 'relatorio-'.date('d-m-y-H-i-s').'.xls';

// Criamos uma tabela HTML com o formato da planilha
$html = '';
$html .= '<table border="1">';
$html .= '<tr>';
$html .= '<td colspan="5">Relatorio de Notas Financeiras</td>';
$html .= '</tr>';

$html .= '<tr>';
$html .= '<td><b>Nome</b></td>';
$html .= '<td><b>Cliente</b></td>';
$html .= '<td><b>CNPJ / CPF</b></td>';
$html .= '<td><b>Produto</b></td>';
$html .= '<td><b>Descricao</b></td>';
$html .= '<td><b>Vencimento</b></td>';
$html .= '<td><b>Cartao</b></td>';
$html .= '<td><b>Valor</b></td>';
$html .= '</tr>';

$total = 0;

foreach ($notas as $nota)
{
    $html .= '<tr>';
    $html .= '<td>'.$nota->nome.'</td>';
    $html .= '<td>'.$nota->empresa->nome.'</td>';
    $html .= '<td>'.(!empty($nota->empresa->cnpj) ? $nota->empresa->cnpj : $nota->empresa->cpf).'</td>';
    $html .= '<td>'.$nota->produto.'</td>';
    $html .= '<td>'.$nota->descricao.'</td>';
    $html .= '<td>'.date("d/m/Y", strtotime($nota->data)).'</td>';
    $html .= '<td>'.$nota->cartao.'</td>';
    $html .= '<td>R$'.number_format($nota->valor,2,",",".").'</td>';
    $html .= '</tr>';

    $total = $total + $nota->valor;
}

    $html .= '<tr>';
    $html .= '<td></td>';
    $html .= '<td></td>';
    $html .= '<td></td>';
    $html .= '<td></td>';
    $html .= '<td></td>';
    $html .= '<td></td>';
    $html .= '<td></td>';
    $html .= '<td>R$'.number_format($total,2,",",".").'</td>';
    $html .= '</tr>';

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