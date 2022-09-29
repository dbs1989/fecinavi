<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>FECINAVI</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
  		<script src='https://kit.fontawesome.com/a076d05399.js'></script>
		<link rel="stylesheet" href="<?php echo BASEURL; ?>cdn/css/bootstrap.css">
		<link rel="stylesheet" href="<?php echo BASEURL; ?>cdn/css/jquery-ui.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
	</head>
	<body>
		<div class="container-fluid h-100">
		    <div class="row h-100">
		        <?php
					if(!isset($_SESSION)){
						session_start();
				
					}
					if(!empty($_SESSION['tipo'])){
						if(isset($_SESSION['administrador'] )){
				?>

					<aside class="col-12 col-md-2 p-0 bg-dark">
		            	<nav class="navbar navbar-expand-xl navbar-dark bg-dark flex-md-column flex-row align-items-start sticky-top">
							<ul class="flex-md-column navbar-nav justify-content-between">
								<a class="navbar-brand" href="<?php echo BASEURL; ?>"><i class='fa fa-home' style='font-size:36px'></i></a>
								<li class="nav-item dropdown">
									<a class="nav-link nav-text" href="#" id="navbardrop"> <?php echo "Olá, ".$_SESSION['user']; ?> </a>
									
							 	</li>
							 	<br>
							</ul>
							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
   								<span class="navbar-toggler-icon"></span>
  							</button>
			                <div class="collapse navbar-collapse sticky-top" id="collapsibleNavbar">
			                    <ul class="flex-md-column navbar-nav justify-content-between">
									<li class="nav-item">
										<a href="<?php echo BASEURL; ?>usuario/index.php" class="nav-link" class="nav-link ">
											Usuários
										</a>
									</li>
									<li class="nav-item" >
										<a href="<?php echo BASEURL; ?>projeto/index.php" class="nav-link">
											Projetos
										</a>
									</li>
									<li class="nav-item">
										<a href="<?php echo BASEURL; ?>avaliador/index.php" class="nav-link ">
											Avaliadores
										</a>
									</li>
									<li class="nav-item">
										<a href="<?php echo BASEURL; ?>administrador/index.php" class="nav-link ">
											Administradores
										</a>
									</li>
									<li class="nav-item">
										<a href="<?php echo BASEURL; ?>avaliacao/index.php" class="nav-link ">
											Avaliar
										</a>
									</li>
									<li class="nav-item">
										<a href="<?php echo BASEURL; ?>resultados/gerarResultados.php" class="nav-link ">
											Resultados
										</a>
									</li>
									<li class="nav-item">
										<a href="<?php echo BASEURL; ?>certificado/index.php" class="nav-link ">
											Certificados
										</a>
									</li>
									<li class="nav-item">
										<a href="<?php echo BASEURL; ?>logout.php" class="nav-link text-danger">
										<i class="fa fa-sign-out"></i> SAIR
										</a>
									</li>
								</ul>

							</div>
		           		 </nav>
		        	</aside>
				            <?php
								}
							}

							?>


		        <main class="col h-100">
		        	<br>
		        	<div class="container-fluid">
						<a href="<?php echo BASEURL ?>index.php"><img width="70%" height="500px" src="<?php echo BASEURL; ?>imagens/facinavi2022.jpeg" class="mx-auto d-block"></a>
					</div>
					<hr>
