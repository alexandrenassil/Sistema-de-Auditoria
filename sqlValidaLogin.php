<?php

    include "../conexoes/conexao_ambiente53.php";
    $login = $_POST['txLogin'];
    $senha = $_POST['txSenha'];

    $script = "SELECT Prenom + ' ' + Nom as Nome FROM HN_ADMIN.dbo.Ident WHERE Ident = '".$login."' AND password = '".$senha."'";
    $result = mssql_query($script);
    $numRows = mssql_num_rows($result);
    $validacao = mssql_fetch_array($result);

    if($numRows > 0)
    {
        echo "<script>alert('Acesso Permitido!');document.location='../view/filaauditoria.php'</script>";
    }
    else
    {
        echo "<script>alert('Acesso Negado!');history.back()</script>";
    }


?>