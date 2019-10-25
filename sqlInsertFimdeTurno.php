<?php
    include "../conexoes/conexao_ambiente121.php";
    $ident = $_POST["ident"];
    $status = $_POST["filtroStatus"];

    if($status == '')
    {
        echo "<script>alert('Favor selecionar um status!');history.back()</script>";
    }
    else
    {
        if(isset($_POST["ident"]))
        {
            $add=0;
            echo "<script>console.log(".$ident.")</script>";
            foreach($ident as $fimDeTurno)
            {
                $script = "INSERT INTO [Auditoria_Vendas].[dbo].[TABELA_PAUSAS] SELECT LOGIN_AUDITOR, ".$status."[COD_STATUS], CAMPANHA, AMBIENTE, GETDATE() DATA, NOME_AUDITOR,NULL DATA_FIM FROM [Auditoria_Vendas].[dbo].[STATUS_AUDITOR] WHERE DATEDIFF(DAY, DATA_INICIO, GETDATE()) = 0 AND LOGIN_AUDITOR = SUBSTRING('".$ident[$add]."',1,4) AND AMBIENTE = SUBSTRING('".$ident[$add]."',6,11) AND CAMPANHA = SUBSTRING('".$ident[$add]."',18,20)";
                if(mssql_query($script))
                {
                    $add=$add+1;
                }

            }
            if($add > 0)
            {
                echo "<script>alert('Foram atualizados ".$add." auditores!');document.location='../tables/tableListaStatusAuditor.php'</script>";
            }
            else
            {
                echo "<script>alert('Erro ao adicionar os auditores .Favor tentar novamente!');history.back()</script>";
            }
        }
        else
        {
            echo "<script>alert('Favor selecionar ao menos um auditor para colocar em status de Final de Turno!');history.back()</script>";
        }
    }
?>