<?php
	require_once('config.php');
	require_once(DBAPI);
	session_start();
	if(!empty($_POST['login'])){
		$login = $_POST['login'];
		$usuario = findAnyThing('usuario','email', "'".$login["'email'"]."'");
		if(!empty($usuario)){
			$avaliador = findAnyThing('avaliador','fk_usuario',$usuario['id_usuario']);
			if(!empty($avaliador)){
				if($avaliador['senha'] === password_hash($login["'senha'"], PASSWORD_DEFAULT)){
					$_SESSION['tipo']=2;
					$_SESSION['user']=$usuario['nome'];
					$_SESSION['id_user'] = $usuario['id_usuario'];
				}else{
				    $_SESSION['type'] = "danger";
	                $_SESSION['msgNome'] = "Senha não confere";

				}
			}
			$administrador = findAnyThing('administrador','fk_usuario',$usuario['id_usuario']);
			if(!empty($administrador)){
				if(password_verify($login["'senha'"],$administrador['senha'])){
					$_SESSION['tipo']=1;
					$_SESSION['user']=$usuario['nome'];
					$_SESSION['id_user'] = $usuario['id_usuario'];
				}else{
				    $_SESSION['type'] = "danger";
	                $_SESSION['msgNome'] = "Senha não confere";

				}
			}
		}else{
		    $_SESSION['type'] = "danger";
	        $_SESSION['msgNome'] = "E-mail não encontrado";
		}
	}
	header("Location: index.php");exit;
?>
