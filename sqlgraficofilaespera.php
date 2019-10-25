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
    1 <= 0.00138888888888889 == 00:02:00
    2 <= 0.00416666666666667 == 00:06:00
    3 >  0.00416666666666667 == 00:06:00
    */
   $script = "SELECT CASE WHEN CAST(GETDATE()-INICIO_FILA AS FLOAT) <= '0.00138888888888889' THEN 'Ate 2 min' WHEN CAST(GETDATE()-INICIO_FILA AS FLOAT) <= '0.00416666666666667' THEN 'Entre 2:01min e 6min' ELSE 'Acima de 6:01min' END Farol,COUNT(1) QTD FROM AUDITORIA_VENDAS.DBO.CONTROLE_FILA_AUDITORIA WITH (NOLOCK) WHERE DATEDIFF(D, INICIO_FILA, GETDATE()) = 0 AND FLAG_CONTROLE = 0 ".$filtroCampanha."".$filtroSupervisor." GROUP BY CASE WHEN CAST(GETDATE()-INICIO_FILA AS FLOAT) <= '0.00138888888888889' THEN 'Ate 2 min' WHEN CAST(GETDATE()-INICIO_FILA AS FLOAT) <= '0.00416666666666667' THEN 'Entre 2:01min e 6min' ELSE 'Acima de 6:01min' END ";

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