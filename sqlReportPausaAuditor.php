<?php

    include "../conexoes/conexao_ambiente121.php";
    $supervisor=$_GET['supervisor'];
    $data=$_GET['data'];


    $script = "
    /*REPORT DE PAUSA AUDITORIA*/
SELECT
	CONVERT(VARCHAR(10), A.DATA, 103) [DATA],
	A.NOME_AUDITOR,
	A.CAMPANHA,
	A.AMBIENTE,
	C.DESCRICAO [STATUS],
	CASE WHEN ".$data." = 1 THEN CONVERT(VARCHAR(8), A.DATA-A.DATA, 108) ELSE CONVERT(VARCHAR(8), GETDATE()-A.DATA, 108) END [TEMPO],
	CONVERT(VARCHAR(8), CAST([1] AS DATETIME), 108) [INICIO DE TURNO],
	CONVERT(VARCHAR(8), CAST([5] AS DATETIME), 108) [DISPONIVEL],
	CONVERT(VARCHAR(8), CAST([11] AS DATETIME), 108) [NR1],
	CONVERT(VARCHAR(8), CAST([12] AS DATETIME), 108) [NR2],
	CONVERT(VARCHAR(8), CAST([13] AS DATETIME), 108) [LANCHE],
	CONVERT(VARCHAR(8), CAST([20] AS DATETIME), 108) [WC],
	CONVERT(VARCHAR(8), CAST([25] AS DATETIME), 108) [AMBULATORIO],
	CONVERT(VARCHAR(8), CAST([30] AS DATETIME), 108) [TREINAMENTO],
	CONVERT(VARCHAR(8), CAST([31] AS DATETIME), 108) [FEEDBACK],
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
	PIVOT (SUM(TEMPO_STATUS) FOR COD_STATUS IN ([1],[5],[11],[12],[13],[20],[25],[30],[31],[65])) AS PVT) AS B
		ON A.LOGIN_AUDITOR = B.LOGIN_AUDITOR
		LEFT JOIN
		[AUDITORIA_VENDAS].[DBO].[LISTA_DE_PAUSA] AS C
			ON A.COD_STATUS = C.CODIGO
WHERE
	A.DATA_FIM IS NULL
	AND A.CAMPANHA <> ''
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
            echo utf8_encode("<td>".$AuditoriaFinalizada['CAMPANHA']."</td>");
            echo utf8_encode("<td>".$AuditoriaFinalizada['AMBIENTE']."</td>");
            echo utf8_encode("<td>".$AuditoriaFinalizada['STATUS']."</td>");
            echo utf8_encode("<td>".$AuditoriaFinalizada['TEMPO'].			"</td>");
            echo utf8_encode("<td>".$AuditoriaFinalizada['INICIO DE TURNO']."</td>");
            echo utf8_encode("<td>".$AuditoriaFinalizada['DISPONIVEL'].		"</td>");
            echo utf8_encode("<td>".$AuditoriaFinalizada['NR1'].			"</td>");
            echo utf8_encode("<td>".$AuditoriaFinalizada['NR2'].			"</td>");
            echo utf8_encode("<td>".$AuditoriaFinalizada['LANCHE'].			"</td>");
            echo utf8_encode("<td>".$AuditoriaFinalizada['WC'].				"</td>");
            echo utf8_encode("<td>".$AuditoriaFinalizada['AMBULATORIO'].	"</td>");
            echo utf8_encode("<td>".$AuditoriaFinalizada['TREINAMENTO'].	"</td>");
			echo utf8_encode("<td>".$AuditoriaFinalizada['FEEDBACK'].		"</td>");
			echo utf8_encode("<td>".$AuditoriaFinalizada['FINAL DE TURNO'].	"</td>");
        echo "</tr>";
    }
?>

