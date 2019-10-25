<?php

    include "../conexoes/conexao_ambiente121.php";
    $campanha=$_GET['campanha'];
    $acao=$_GET['acao'];

    $script = "SELECT LOGIN_AUDITOR,UPPER(NOME_AUDITOR) NOME_AUDITOR ,AMBIENTE,CAMPANHA ,A.COD_STATUS,B.DESCRICAO STATUS, CASE WHEN DATA_ALTERACAO IS NULL THEN DATA_INICIO ELSE DATA_ALTERACAO END ULTIMA_ALTERACAO FROM [Auditoria_Vendas].[dbo].[STATUS_AUDITOR] as a LEFT JOIN [Auditoria_Vendas].dbo.LISTA_DE_PAUSA AS B ON A.COD_STATUS = B.CODIGO WHERE DATEDIFF(D, DATA_INICIO, GETDATE()) = 0 AND CAMPANHA LIKE '%".$campanha."%' ";

    $result = mssql_query($script);
    $numRows = mssql_num_rows($result);
    for($j=0;$j<$numRows;$j++)
    {
        $listaAuditores = mssql_fetch_array($result);
        echo "<tr>";
            echo "<td name='".$listaAuditores['LOGIN_AUDITOR']."'>".$listaAuditores['LOGIN_AUDITOR']."</td>";
            echo "<td>".$listaAuditores['NOME_AUDITOR']."</td>";
            echo "<td>".$listaAuditores['AMBIENTE']."</td>";
            echo "<td>".$listaAuditores['CAMPANHA']."</td>";
            echo "<td>".$listaAuditores['STATUS']."</td>";
            echo "<td>".$listaAuditores['ULTIMA_ALTERACAO']."</td>";
            if($acao==1)
            {
                echo "<td><input type='checkbox' class='form-check-input' name='ident[]' value='".$listaAuditores['LOGIN_AUDITOR']."|".$listaAuditores['AMBIENTE']."|".$listaAuditores['CAMPANHA']."'></td>";
            }
        echo "</tr>";
    }
?>