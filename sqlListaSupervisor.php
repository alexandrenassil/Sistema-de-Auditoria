<?php

    include "../conexoes/conexao_ambiente121.php";

    $script = "SELECT DISTINCT NOME_SUPERVISOR FROM AUDITORIA_VENDAS.DBO.CONTROLE_FILA_AUDITORIA ORDER BY NOME_SUPERVISOR";

    $result = mssql_query($script);
    $numRows = mssql_num_rows($result);

    for($j=0;$j<$numRows;$j++)
    {
        $ListaSupervisor = mssql_fetch_array($result);
        $supervisor = "<option value='".$ListaSupervisor['NOME_SUPERVISOR']."'>".$ListaSupervisor['NOME_SUPERVISOR']."</option>";
        echo utf8_encode($supervisor);
    }
?>