<?php require_once '../config.php';

 session_start();
$_SESSION['dados_certificado']=$_POST['arquivo'];

$nome_temporario=$_FILES["arquivo1"]["tmp_name"];
$nome_real=$_FILES["arquivo1"]["name"];
copy($nome_temporario,"imagens/$nome_real");
$_SESSION['frente'] = $nome_real;

$nome_temporario=$_FILES["arquivo2"]["tmp_name"];
$nome_real=$_FILES["arquivo2"]["name"];
copy($nome_temporario,"imagens/$nome_real");
$_SESSION['verso'] = $nome_real;

$_SESSION['certificado'] = 1; 
header("Location:../resultados/gerarResultados.php");		
?>