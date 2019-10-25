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
   $script = "SELECT CASE WHEN CAST(GETDATE()-INICIO_FILA AS FLOAT) <= '0.000115740740740741' THEN 'Ate 10s' WHEN CAST(GETDATE()-INICIO_FILA AS FLOAT) <= '0.000462962962962963' THEN 'Entre 10s e 40s' ELSE 'Acima de 40s' END Farol,COUNT(1) QTD FROM AUDITORIA_VENDAS.DBO.CONTROLE_AUDITORIA_EM_TRANSITO WITH (NOLOCK) WHERE DATEDIFF(D, INICIO_FILA, GETDATE()) = 0 AND FLAG_CONTROLE = 0 ".$filtroCampanha."".$filtroSupervisor." GROUP BY CASE WHEN CAST(GETDATE()-INICIO_FILA AS FLOAT) <= '0.000115740740740741' THEN 'Ate 10s' WHEN CAST(GETDATE()-INICIO_FILA AS FLOAT) <= '0.000462962962962963' THEN 'Entre 10s e 40s' ELSE 'Acima de 40s' END ";

   $result = mssql_query($script);
   $numRows = mssql_num_rows($result);

   $col1=array();
   $col1["label"]="Farol";
   $col1["pattern"]="";
   $col1["type"]="string";

   $col2=array();
   $col2["label"]="QTD";
   $col2["pattern"]="";
   $col2["type"]="number";

    $cols = array($col1,$col2);
    $table = array();

   # $table[0] = array('Task', 'Hours per Day');
   for($j=0;$j<$numRows;$j++){
        $dados = mssql_fetch_array($result);
        $cell0["v"]=$dados['Farol'];
        $cell1["v"]=$dados['QTD'];
        $row0["c"]=array($cell0,$cell1);
        array_push($table, $row0);

    }
    $data=array("cols"=>$cols,"rows"=>$table);
    echo json_encode($data, true);

?>