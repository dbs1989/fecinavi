<?php
	require_once('functions.php');
	include(HEADER_TEMPLATE);
	if(!isset($_SESSION['tipo'])){
		header('location: '.BASEURL);exit;
	}
	add();
	addInst();
?>
<script src="../cdn/js/instituicao.js" type="text/javascript"></script>
<div class="container">
<h2>Novo Usuário</h2>
	<form action="add.php" method="post">

	<!-- area de campos do form -->
	<hr/>	<!-- linha de separação -->
		<div class="row">
			<div class="form-group col-md-7">
				<label for="nome">Nome:</label>
				<input type="text" class="form-control" name="usuario['nome']" required>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-7">
				<label for="nome">E-mail:</label>
				<input type="email" class="form-control" name="usuario['email']" >
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-7">
				<label for="nome">Instituição:</label>
				<input type="text" class="form-control" id="instituicao" name="usuario['fk_instituicao']" required>
				<button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#inst-modal"><i class="fa fa-plus-circle fa-1x"></i> Adicionar </button>
			</div>
		</div>

		<div id="actions" class="row">
			<div class="col-md-12">
				<button type="submit" class="btn btn-primary">Salvar</button>
				<a href="index.php" class="btn btn-default">Voltar</a>
			</div>
		</div>
	</form>
	<br>
	<div class="container">
		<?php
			if (!empty($_SESSION['type'])) {
		?>
		<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<?php
				if(!empty($_SESSION['msgId']))
					echo $_SESSION['msgId'].'<br>';
				if(!empty($_SESSION['msgNome']))
					echo $_SESSION['msgNome'].'<br>';
				if(!empty($_SESSION['message']))
					echo $_SESSION['message'].'<br>';
			?>
		</div>

		<?php
			unset($_SESSION['type']);
			unset($_SESSION['msgId']);
			unset($_SESSION['msgNome']);
			unset($_SESSION['message']);
		?>

		<?php } ?>
	</div>
</div>
<?php include(FOOTER_TEMPLATE); ?>
