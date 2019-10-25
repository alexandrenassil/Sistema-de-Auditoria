<?php

    include "../conexoes/conexao_ambiente121.php";
    $campanha=$_GET['campanha'];
    $supervisor=$_GET['supervisor'];
    $solic=$_GET['solic'];

    if($campanha != "")
    {
        $filtroCampanha=" AND CAMPANHA LIKE '%".$campanha."%'";
    }
    else
    {
        $filtroCampanha = "";
    }

    if($supervisor != "")
    {
        $filtroSupervisor=" AND NOME_SUPERVISOR LIKE '%".$supervisor."%'";
    }
    else
    {
        $filtroSupervisor = "";
    }

    if($solic == 1)
    {
        $script = "SELECT COUNT(1)TOTAL FROM AUDITORIA_VENDAS.DBO.CONTROLE_FILA_AUDITORIA WITH(NOLOCK) WHERE DATEDIFF(D, INICIO_FILA, GETDATE()) = 0 AND FLAG_CONTROLE = 0 ".$filtroCampanha."".$filtroSupervisor;

        $result = mssql_query($script);
        $numRows = mssql_num_rows($result);
        $totalfilaAuditoria = mssql_fetch_array($result);

        echo json_encode($totalfilaAuditoria['TOTAL']);
    }
    else if($solic == 2)
    {
        $script = "SELECT MAX(CONVERT(VARCHAR(8), GETDATE()-INICIO_FILA, 108))TEMPO_MAXIMO FROM AUDITORIA_VENDAS.DBO.CONTROLE_FILA_AUDITORIA WITH(NOLOCK) WHERE DATEDIFF(D, INICIO_FILA, GETDATE()) = 0 AND FLAG_CONTROLE = 0 ".$filtroCampanha."".$filtroSupervisor;

        $result = mssql_query($script);
        $numRows = mssql_num_rows($result);
        $maxfilaAuditoria = mssql_fetch_array($result);

        echo json_encode($maxfilaAuditoria['TEMPO_MAXIMO']);
    }
?>