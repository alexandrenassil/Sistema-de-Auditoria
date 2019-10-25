<?php

    $loginAuditor = $_POST['txLogin'];
    $senhaAuditor = $_POST['txSenha'];
    $ambiente = $_POST['cbAmbiente'];

    if($ambiente == "AMBIENTE_55")
    {
        include "../conexoes/conexao_ambiente53.php";
    }
    else
    {
        include "../conexoes/conexao_ambiente30.php";
    }
    $Id = $_POST['Id'];
 
    $script = "SELECT Prenom + ' ' + Nom as Nome FROM HN_ADMIN.dbo.Ident WHERE Ident = '".$loginAuditor."' AND password = '".$senhaAuditor."'";
    $result = mssql_query($script);
    $numRows = mssql_num_rows($result);
    $validacao = mssql_fetch_array($result);

    if($numRows > 0)
    {
        include "../conexoes/conexao_ambiente121.php";
        $script = "SELECT NOME_OPERADOR FROM AUDITORIA_VENDAS.DBO.CONTROLE_FILA_AUDITORIA WHERE ID = ".$Id;
        $result = mssql_query($script);
        $NomeOp = mssql_fetch_array($result);

        $script = "INSERT INTO AUDITORIA_VENDAS.DBO.CONTROLE_AUDITORIA_EM_TRANSITO (ID, INDICE_CUSTOMER, CAMPANHA,ID_AUDITOR,NOME_AUDITOR,NOME_SUPERVISOR,NOME_OPERADOR, INICIO_FILA,FLAG_CONTROLE,REPROVA) SELECT ID, INDICE_CUSTOMER, CAMPANHA, '".$loginAuditor."','".$validacao['Nome']."', NOME_SUPERVISOR, NOME_OPERADOR, GETDATE(), 0, REPROVA FROM AUDITORIA_VENDAS.DBO.CONTROLE_FILA_AUDITORIA WHERE ID = ".$Id;

        if(mssql_query($script))
        {
            echo "<script>alert('Auditor em transito!\\nFavor se dirigir ate o operador: ".$NomeOp['NOME_OPERADOR']."');document.location='../table/tableAnaliticos.php'</script>";
        }
        else
        {
            echo "<script>alert('Nao foi possivel validar a autenticacao!\\nFavor tentar novamente');history.back()</script>";
        }

    }
    else
    {
        echo "<script>alert('Login ou senha invalido!\\nVerifique o ambiente em qual o login esta vinculado');history.back()</script>";
    }
?>