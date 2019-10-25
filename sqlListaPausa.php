<?php
    $tipoFunc = $_GET['tipoFunc'];
    include "../conexoes/conexao_ambiente121.php";

    if($tipoFunc == '0')
    {
        $codPausa = "1,5,11,12,13,20,30,31,25,65";
    }
    else if ($tipoFunc == '1')
    {
        $codPausa = "1,5,10,15,20,25,30,35,40,45,50,55,60,65";
    }
    else if ($tipoFunc == '')
    {
        $codPausa ="1,5,10,11,12,13,15,20,25,30,31,35,40,45,50,55,60,65";
    }

    $script = "SELECT CODIGO,DESCRICAO FROM [Auditoria_Vendas].[dbo].[LISTA_DE_PAUSA] WHERE PAUSA_ATIVA = 1 AND CODIGO IN (".$codPausa.") ORDER BY CODIGO";

    $result = mssql_query($script);
    $numRows = mssql_num_rows($result);
    $pausa = "<option value=''>SELECIONE:</option>";
    echo utf8_encode($pausa);
    for($j=0;$j<$numRows;$j++)
    {
        $tipoPausa = mssql_fetch_array($result);
        $pausa = "<option value='".$tipoPausa['CODIGO']."'>".$tipoPausa['DESCRICAO'] ."</option>";
        echo utf8_encode($pausa);
    }
?>