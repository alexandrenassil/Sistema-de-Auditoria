<?php

    include "../conexoes/conexao_ambiente121.php";
    $supervisor=$_GET['supervisor'];
    $data=$_GET['data'];


    $script = "
    /*REPORT DE PAUSA MONITOR*/
SELECT
	CONVERT(VARCHAR(10), A.DATA, 103) [DATA],
	A.NOME_AUDITOR,
	C.DESCRICAO [STATUS],
	CASE WHEN ".$data." = 1 THEN CONVERT(VARCHAR(8), A.DATA-A.DATA, 108) ELSE CONVERT(VARCHAR(8), GETDATE()-A.DATA, 108) END [TEMPO],
	CONVERT(VARCHAR(8), CAST([1] AS DATETIME), 108) [INICIO DE TURNO],
	CONVERT(VARCHAR(8), CAST([5] AS DATETIME), 108) [DISPONIVEL],
	CONVERT(VARCHAR(8), CAST([10] AS DATETIME), 108) [ALMOCO],
	CONVERT(VARCHAR(8), CAST([15] AS DATETIME), 108) [CAFE],
	CONVERT(VARCHAR(8), CAST([20] AS DATETIME), 108) [WC],
	CONVERT(VARCHAR(8), CAST([25] AS DATETIME), 108) [AMBULATORIO],
	CONVERT(VARCHAR(8), CAST([30] AS DATETIME), 108) [TREINAMENTO],
	CONVERT(VARCHAR(8), CAST([35] AS DATETIME), 108) [EM OPERACAO],
	CONVERT(VARCHAR(8), CAST([40] AS DATETIME), 108) [PALESTRA DE QUALIDADE],
	CONVERT(VARCHAR(8), CAST([45] AS DATETIME), 108) [AQUECIMENTO],
	CONVERT(VARCHAR(8), CAST([50] AS DATETIME), 108) [WAR ROOM],
	CONVERT(VARCHAR(8), CAST([55] AS DATETIME), 108) [MONITORACAO],
	CONVERT(VARCHAR(8), CAST([60] AS DATETIME), 108) [OUTROS],
	CONVERT(VARCHAR(8), CAST([65] AS DATETIME), 108) [FINAL DE TURNO]
FROM
	[AUDITORIA_VENDAS].[DBO].[TABELA_PAUSAS] AS A
		JOIN
	(SELECT *
	FROM
		(
			SELECT
				LOGIN_AUDITOR,
				COD_STATUS,
				NOME_AUDITOR,
				(CAST(DATA_FIM - DATA AS FLOAT)) [TEMPO_STATUS]
			FROM
				[AUDITORIA_VENDAS].[DBO].[TABELA_PAUSAS]
			WHERE
				DATEDIFF(D, DATA, GETDATE()) = 0
				AND DATA_FIM IS NOT NULL
		) AS BASE
	PIVOT (SUM(TEMPO_STATUS) FOR COD_STATUS IN ([1],[5],[10],[15],[20],[25],[30],[35],[40],[45],[50],[55],[60],[65])) AS PVT) AS B
		ON A.LOGIN_AUDITOR = B.LOGIN_AUDITOR
		LEFT JOIN
		[AUDITORIA_VENDAS].[DBO].[LISTA_DE_PAUSA] AS C
			ON A.COD_STATUS = C.CODIGO
WHERE
	A.DATA_FIM IS NULL
	AND A.CAMPANHA = ''
	AND DATEDIFF(D, A.DATA, GETDATE()) = ".$data;
	if(trim($supervisor) != "")
	{
		$script.= " AND SUPERVISOR = ".$supervisor;
	}

    $result = mssql_query($script);
    $numRows = mssql_num_rows($result);

    for($j=0;$j<$numRows;$j++)
    {
        $AuditoriaFinalizada = mssql_fetch_array($result);
        echo "<tr>";
            echo utf8_encode("<td>".$AuditoriaFinalizada['DATA']."</td>");
            echo utf8_encode("<td>".$AuditoriaFinalizada['NOME_AUDITOR']."</td>");
            echo utf8_encode("<td>".$AuditoriaFinalizada['STATUS']."</td>");
            echo utf8_encode("<td>".$AuditoriaFinalizada['TEMPO']."</td>");
            echo utf8_encode("<td>".$AuditoriaFinalizada['INICIO DE TURNO']."</td>");
            echo utf8_encode("<td>".$AuditoriaFinalizada['DISPONIVEL']."</td>");
            echo utf8_encode("<td>".$AuditoriaFinalizada['ALMOCO']."</td>");
            echo utf8_encode("<td>".$AuditoriaFinalizada['CAFE']."</td>");
            echo utf8_encode("<td>".$AuditoriaFinalizada['WC']."</td>");
            echo utf8_encode("<td>".$AuditoriaFinalizada['AMBULATORIO']."</td>");
            echo utf8_encode("<td>".$AuditoriaFinalizada['TREINAMENTO']."</td>");
            echo utf8_encode("<td>".$AuditoriaFinalizada['EM OPERACAO']."</td>");
            echo utf8_encode("<td>".$AuditoriaFinalizada['PALESTRA DE QUALIDADE']."</td>");
            echo utf8_encode("<td>".$AuditoriaFinalizada['AQUECIMENTO']."</td>");
            echo utf8_encode("<td>".$AuditoriaFinalizada['WAR ROOM']."</td>");
            echo utf8_encode("<td>".$AuditoriaFinalizada['MONITORACAO']."</td>");
            echo utf8_encode("<td>".$AuditoriaFinalizada['OUTROS']."</td>");
            echo utf8_encode("<td>".$AuditoriaFinalizada['FINAL DE TURNO']."</td>");
        echo "</tr>";
    }
?>