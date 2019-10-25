<?php

    include "../conexoes/conexao_ambiente121.php";
    $supervisor=$_GET['supervisor'];
    $data=$_GET['data'];


    $script = "
    SELECT
	A.ID,
	A.INDICE_CUSTOMER INDICE,
	A.CAMPANHA,
	A.NOME_AUDITOR,
	B.NOME_OPERADOR,
	B.NOME_SUPERVISOR,
	CONVERT(VARCHAR(8), B.FIM_FILA - B.INICIO_FILA, 108) [TEMPO_ESPERA],
	CONVERT(VARCHAR(8), C.FIM_FILA - C.INICIO_FILA, 108) [TEMPO_EM_TRANSITO],
	CONVERT(VARCHAR(8), A.FIM_FILA - A.INICIO_FILA, 108) [TEMPO_AUDITORIA],
	A.STATUS_AUDITORIA,
	A.SUBSTATUS_AUDITORIA,
	CASE WHEN D.ULTIMA IS NOT NULL THEN 'SIM' ELSE 'NAO' END [Ultima Auditoria Contrato]
    FROM
	[Auditoria_Vendas].[dbo].[CONTROLE_AUDITORIA_STATUS] AS A
	LEFT JOIN
	[Auditoria_Vendas].[dbo].[CONTROLE_FILA_AUDITORIA] AS B
	ON A.ID = B.ID
	LEFT JOIN
	[Auditoria_Vendas].[dbo].[CONTROLE_AUDITORIA_EM_TRANSITO] AS C
	ON A.ID = C.ID
	LEFT JOIN
	(SELECT MAX(FIM_FILA) [ULTIMA], INDICE_CUSTOMER FROM [Auditoria_Vendas].[dbo].[CONTROLE_AUDITORIA_STATUS] WHERE FLAG_CONTROLE = 1 GROUP BY INDICE_CUSTOMER) AS D
	ON A.FIM_FILA = D.ULTIMA
    WHERE
    A.FLAG_CONTROLE = 1
    AND CONVERT(VARCHAR(10), A.FIM_FILA, 103) = '".$data."'
     ORDER BY ID
    ";

    $result = mssql_query($script);
    $numRows = mssql_num_rows($result);

    for($j=0;$j<$numRows;$j++)
    {
        $AuditoriaFinalizada = mssql_fetch_array($result);
        echo "<tr>";
            echo utf8_encode("<td>".$AuditoriaFinalizada['ID']."</td>");
            echo utf8_encode("<td>".$AuditoriaFinalizada['INDICE']."</td>");
            echo utf8_encode("<td>".$AuditoriaFinalizada['CAMPANHA']."</td>");
            echo utf8_encode("<td>".$AuditoriaFinalizada['NOME_AUDITOR']."</td>");
            echo utf8_encode("<td>".$AuditoriaFinalizada['NOME_OPERADOR']."</td>");
            echo utf8_encode("<td>".$AuditoriaFinalizada['NOME_SUPERVISOR']."</td>");
            echo utf8_encode("<td>".$AuditoriaFinalizada['TEMPO_ESPERA']."</td>");
            echo utf8_encode("<td>".$AuditoriaFinalizada['TEMPO_EM_TRANSITO']."</td>");
            echo utf8_encode("<td>".$AuditoriaFinalizada['TEMPO_AUDITORIA']."</td>");
            echo utf8_encode("<td>".$AuditoriaFinalizada['STATUS_AUDITORIA']."</td>");
            echo utf8_encode("<td>".$AuditoriaFinalizada['SUBSTATUS_AUDITORIA']."</td>");
            echo utf8_encode("<td>".$AuditoriaFinalizada['Ultima Auditoria Contrato']."</td>");
        echo "</tr>";
    }
?>