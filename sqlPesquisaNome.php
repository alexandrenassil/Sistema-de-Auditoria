<?php
    session_start();
    include "../conexoes/conexao_ambiente53.php";

    $login = $_POST['LoginAuditor'];
    $senha = $_POST['SenhaAuditor'];
    $status = $_POST['StatusAuditor'];
    $campanha = $_POST['CampanhaAuditor'];
    $ambiente = $_POST['AmbienteAuditor'];
    $tipoFunc = $_POST['rdAuditor'];

    $script = "SELECT Prenom + ' ' + Nom as Nome FROM HN_ADMIN.dbo.Ident WHERE Ident = '".$login."' AND password = '".$senha."'";
    $result = mssql_query($script);
    $numRows = mssql_num_rows($result);
    $ValidaNome = mssql_fetch_array($result);

    $Nome = $ValidaNome['Nome'];

    $_SESSION['Nome'] = $Nome;
    $_SESSION['LoginAuditor'] = $login;
    $_SESSION['SenhaAuditor'] = $senha;
    $_SESSION['StatusAuditor'] = $status;
    $_SESSION['CampanhaAuditor'] = $campanha;
    $_SESSION['AmbienteAuditor'] = $ambiente;
    $_SESSION['rdAuditor'] = $tipoFunc;

    echo ("<script>window.location.href = 'sqlInsertControlePausa.php';</script>");
    #require "sqlInsertControlePausa.php";
?>
