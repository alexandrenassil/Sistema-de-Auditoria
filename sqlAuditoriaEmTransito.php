<?php

    include "../conexoes/conexao_ambiente121.php";
    $campanha=$_GET['campanha'];
    $supervisor=$_GET['supervisor'];

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
/* Parametros do farol
    1 <= 0.000115740740740741 == 00:00:10
    2 <= 0.000462962962962963 == 00:00:40
    3 >  0.000462962962962963 == 00:00:40
    */
    $script = "SELECT ID, INDICE_CUSTOMER [INDICE], CAMPANHA, NOME_AUDITOR, NOME_SUPERVISOR, NOME_OPERADOR, CONVERT(VARCHAR(8), GETDATE()-INICIO_FILA, 108) [Tempo_Espera], CASE WHEN CAST(GETDATE()-INICIO_FILA AS FLOAT) <= '0.000115740740740741' THEN 1 WHEN CAST(GETDATE()-INICIO_FILA AS FLOAT) <= '0.000462962962962963' THEN 2 ELSE 3 END Farol, REPROVA FROM AUDITORIA_VENDAS.DBO.CONTROLE_AUDITORIA_EM_TRANSITO WHERE DATEDIFF(D, INICIO_FILA, GETDATE()) = 0 AND FLAG_CONTROLE = 0 ".$filtroCampanha."".$filtroSupervisor." ORDER BY REPROVA DESC";

    $result = mssql_query($script);
    $numRows = mssql_num_rows($result);


    for($j=0;$j<$numRows;$j++)
    {
        $filaAuditoria = mssql_fetch_array($result);
        if($filaAuditoria['Farol'] == 3)
        {
            $farol = '#FF0000';
        }
        else if($filaAuditoria['Farol'] == 2)
        {
            $farol = '#FFFF00';
        }
        else
        {
            $farol = '#00FF00';
        }
        echo "<tr>";
            echo "<td name='".$filaAuditoria['ID']."'>".$filaAuditoria['ID']."</td>";
            echo "<td>".$filaAuditoria['INDICE']."</td>";
            echo "<td>".$filaAuditoria['CAMPANHA']."</td>";
            echo "<td>".$filaAuditoria['NOME_AUDITOR']."</td>";
            echo "<td>".$filaAuditoria['NOME_SUPERVISOR']."</td>";
            echo "<td>".$filaAuditoria['NOME_OPERADOR']."</td>";
            echo "<td>".$filaAuditoria['Tempo_Espera']."</td>";
            echo "<td BGCOLOR=".$farol."></td>";
            echo "<td>".$filaAuditoria['REPROVA']."</td>";
        echo "</tr>";
    }
?>