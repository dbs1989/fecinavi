<?php require_once 'config.php'; ?>
<?php require_once DBAPI; ?>
<?php include(HEADER_TEMPLATE); ?>
<?php
	unset($_SESSION['resultado']);
	?>
	<div class="container">
		<?php
			if (!empty($_SESSION['type'])) {
		?>
		<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<?php
				if(!empty($_SESSION['msgNome']))
					echo $_SESSION['msgNome'].'<br>';
			?>
		</div>
		<?php
			unset($_SESSION['type']);
			unset($_SESSION['msgNome']);
		?>
		<?php } ?>
	</div>
	<?php
	if(empty($_SESSION['tipo'])){


?>

<!--
<div class="container jumbotron text-center font-weight-bold">
<h3>
		A equipe da FECIFRON 2021 agradece a todas e todos que participaram e contribuíram para o sucesso da feira.<br><br>
		No total, foram 79 trabalhos aprovados e esse sucesso só foi alcançado devido à participação de estudantes, orientadores, coorientadores, avaliadores e equipe responsável direta ou indiretamente ao evento.<br><br>
		MUITO OBRIGADO!!!</h3><br><img src="imagens/beijo.png" width="10%"><br><br>
		<a href="https://drive.google.com/drive/folders/1HugaGG4l5ZRwOVR_NJw5aKfX91FXTRIF?usp=sharing" target="_blank"><button type="button" class="btn btn-primary btn-lg btn-block">Baixe aqui o Certificado de Participação dos projetos </button></a>
		<br>
		<a href="https://drive.google.com/drive/folders/1Vt_FURyDgQJTw43T8y67104LXmcp6oq3?usp=sharing" target="_blank"><button type="button" class="btn btn-primary btn-lg btn-block">Baixe aqui o Certificado de Avaliador da Feira</button></a>
		<br>
		<a href="https://drive.google.com/drive/folders/1b1W-1g82TVsP5Z2lI7yNxd-v7PM7IOU3?usp=sharing" target="_blank"><button type="button" class="btn btn-primary btn-lg btn-block">Baixe aqui o Certificado de Avaliador AD HOC</button></a>
</div>
    <div class="container jumbotron text-center font-weight-bold display-4">

		PREMIAÇÃO FECIFRON 2021
<br><br>

<div id="demo" class="carousel carousel-dark slide" data-ride="carousel" data-interval="5000">


  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
    <li data-target="#demo" data-slide-to="3"></li>
    <li data-target="#demo" data-slide-to="4"></li>
    <li data-target="#demo" data-slide-to="5"></li>
    <li data-target="#demo" data-slide-to="6"></li>
    <li data-target="#demo" data-slide-to="7"></li>
    <li data-target="#demo" data-slide-to="8"></li>
    <li data-target="#demo" data-slide-to="9"></li>
  </ul>


  <div class="carousel-inner">
    <div class="carousel-item active">
        <img src="imagens/Slide1.PNG" width="100%">
    </div>
    <div class="carousel-item">
        <img src="imagens/Slide2.PNG" width="100%">
    </div>
    <div class="carousel-item">
        <img src="imagens/Slide3.PNG" width="100%">
    </div>
    <div class="carousel-item">
        <img src="imagens/Slide4.PNG" width="100%">
    </div>
    <div class="carousel-item">
        <img src="imagens/Slide5.PNG" width="100%">
    </div>
    <div class="carousel-item">
        <img src="imagens/Slide6.PNG" width="100%">
    </div>
    <div class="carousel-item">
        <img src="imagens/Slide7.PNG" width="100%">
    </div>
    <div class="carousel-item">
        <img src="imagens/Slide8.PNG" width="100%">
    </div>
    <div class="carousel-item">
        <img src="imagens/Slide9.PNG" width="100%">
    </div>
    <div class="carousel-item">
        <img src="imagens/Slide10.PNG" width="100%">
    </div>

  </div>


  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>

</div>
<a href="https://drive.google.com/drive/folders/1DEEtVlgtE_DAe-1oYcvbk-Sy-ADFhROR?usp=sharing" target="_blank"><button type="button" class="btn btn-primary btn-lg btn-block"> Baixe aqui o seu Certificado de Premiação </button></a>
</div>

<br>
    <div class="container jumbotron text-center font-weight-bold display-4">

		CREDENCIAIS FECIFRON 2021

<br><br>
<div id="demo2" class="carousel carousel-dark slide" data-ride="carousel" data-interval="5000">


  <ul class="carousel-indicators">
    <li data-target="#demo2" data-slide-to="0" class="active"></li>
    <li data-target="#demo2" data-slide-to="1"></li>
    <li data-target="#demo2" data-slide-to="2"></li>
    <li data-target="#demo2" data-slide-to="3"></li>
    <li data-target="#demo2" data-slide-to="4"></li>
    <li data-target="#demo2" data-slide-to="5"></li>
    <li data-target="#demo2" data-slide-to="6"></li>

  </ul>


  <div class="carousel-inner">
    <div class="carousel-item active">
        <img src="imagens/Slide11.PNG" width="100%">
    </div>
    <div class="carousel-item">
        <img src="imagens/Slide12.PNG" width="100%">
    </div>
    <div class="carousel-item">
        <img src="imagens/Slide13.PNG" width="100%">
    </div>
    <div class="carousel-item">
        <img src="imagens/Slide14.PNG" width="100%">
    </div>
    <div class="carousel-item">
        <img src="imagens/Slide15.PNG" width="100%">
    </div>
    <div class="carousel-item">
        <img src="imagens/Slide16.PNG" width="100%">
    </div>
    <div class="carousel-item">
        <img src="imagens/Slide17.PNG" width="100%">
    </div>


  </div>


  <a class="carousel-control-prev" href="#demo2" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo2" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>

</div>
<a href="https://drive.google.com/drive/folders/1lNzbLvKvk3xhDBnfvpRaRrVC4Eo3MaLz?usp=sharing" target="_blank"><button type="button" class="btn btn-primary btn-lg btn-block">Baixe aqui a sua Credencial </button></a>
</div>
-->



	<div class="container text-center">
		<button type="button" class="btn btn-primary btn-block " data-toggle="modal" data-target="#login-modal"><h2><i class="fa fa-sign-in fa-1x"></i> Login </h2></button>
	</div>
	<div class="container text-center font-weight-bold">

		<div class="text-danger">O login é o seu email e a sua senha inicial é mudar123 </div>

	</div>

<?php
	}else if($_SESSION['tipo']==2 ){

?>
    <div class="container">
		<div class = "col">
			<div class="col-xs-12 text-left">
				<a href="logout.php"><button type="button" class="btn btn-default pull-right">Logout <i class="fa fa-sign-out fa-1x"></i></button></a>
			</div>
		</div>
	</div>
	<div class="container jumbotron text-center font-weight-bold">

	    A avaliação chegou ao fim e agradecemos imensamente a sua participação no processo de avaliação da FECIFRON 2021.

	</div>

<?php
	}else if($_SESSION['tipo']==1){
?>
    	<div class="container">
		<div class = "col">
			<div class="col-xs-12 text-center">
				<button type="button" class="btn btn-default pull-left" data-toggle="modal" data-target="#trocarSenha-modal">Mudar Senha <i class="fa fa-exchange fa-1x"></i></button>
			</div>
			<div class="col-xs-12 text-left">
				<a href="logout.php"><button type="button" class="btn btn-default pull-right">Logout <i class="fa fa-sign-out fa-1x"></i></button></a>
			</div>
		</div>
	</div>
	<br><br>
	<div class="container">
		<div class = "col">
			<div class = "card">
				<a href="avaliacao/index.php" class="btn btn-success">
					<div class="col-xs-12 text-center">
						<i class="fa fa-edit fa-5x"></i>
					</div>
					<div class="col-xs-12 text-center">
						Realizar Avaliação
					</div>
				</a>
			</div>
		</div>
	</div>
<?php
	}else{
?>
    <div class="container">
		<div class = "col">
			<div class="col-xs-12 text-left">
				<a href="logout.php"><button type="button" class="btn btn-default pull-right">Logout <i class="fa fa-sign-out fa-1x"></i></button></a>
			</div>
		</div>
	</div>
	<br><br>
    <div class="container">
		<div class = "col">
			<div class = "card">
				<div class="col-xs-12 text-center">
					AVALIAÇÕES ENCERRADAS<br>
					AGRADECEMOS PELA SUA CONTRIBUIÇÃO =*
				</div>
			</div>
		</div>
	</div>
<?php
	}
	include ('modalTrocarSenha.php');
?>

<?php include(FOOTER_TEMPLATE); ?>
