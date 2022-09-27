<?php
	require_once('config.php');
	require_once(DBAPI);
	session_start();
	if(!empty($_POST['senha'])){
		$senha = $_POST['senha'];
		$tabela = null;
		if($senha["'nova'"] == $senha["'confnova'"]){
			if(isset($_SESSION['administrador'])){
				$tabela = 'administrador';
			}else{
				$tabela = 'avaliador';
			}
			$senha["'nova'"] = password_hash($senha["'nova'"], PASSWORD_DEFAULT);
			atualizarSenha($tabela,$senha["'nova'"],$_SESSION['id_user']);
			$_SESSION['atual'] = "success";
			$_SESSION['mensagem'] = "Troca de senha realizada com sucesso";
		}else{
			$_SESSION['atual'] = "danger";
			$_SESSION['mensagem'] = "As senhas não conferem";
		}
	}
	header("Location: index.php");exit;
?>
