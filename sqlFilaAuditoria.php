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
    $total = 0;
    /* Parametros do farol
    1 <= 0.00138888888888889 == 00:02:00
    2 <= 0.00416666666666667 == 00:06:00
    3 >  0.00416666666666667 == 00:06:00
    */
    $script = "SELECT ID, NOME_OPERADOR,INDICE_CUSTOMER [INDICE], CAMPANHA, NOME_SUPERVISOR, CONVERT(VARCHAR(8), GETDATE()-INICIO_FILA, 108) [Tempo_Espera], CASE WHEN CAST(GETDATE()-INICIO_FILA AS FLOAT) <= '0.00138888888888889' THEN 1 WHEN CAST(GETDATE()-INICIO_FILA AS FLOAT) <= '0.00416666666666667' THEN 2 ELSE 3 END Farol, REPROVA FROM AUDITORIA_VENDAS.DBO.CONTROLE_FILA_AUDITORIA WHERE DATEDIFF(D, INICIO_FILA, GETDATE()) = 0 AND FLAG_CONTROLE = 0 ".$filtroCampanha."".$filtroSupervisor." ORDER BY REPROVA DESC";

    $result = mssql_query($script);
    $numRows = mssql_num_rows($result);


    for($j=0;$j<$numRows;$j++)
    {
        $filaAuditoria = mssql_fetch_array($result);
        $total++;
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
        $modal = $filaAuditoria['ID'];
        echo "<tr>";
            echo "<td name='".$filaAuditoria['ID']."'>".$filaAuditoria['ID']."</td>";
            echo "<td>".$filaAuditoria['INDICE']."</td>";
            echo "<td>".$filaAuditoria['CAMPANHA']."</td>";
            echo "<td>".$filaAuditoria['NOME_SUPERVISOR']."</td>";
            echo "<td>".$filaAuditoria['Tempo_Espera']."</td>";
            echo "<td BGCOLOR=".$farol."></td>";
            echo "<td>".$filaAuditoria['REPROVA']."</td>";
            echo "<td><button name='btnAuditar' type='button' data-toggle='modal' data-target='#myModal' onclick='ajaxModal(".$modal.")'>Auditar</button></td>";
        echo "</tr>";
    }
?>