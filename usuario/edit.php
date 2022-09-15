<?php
	require_once('functions.php');
	include(HEADER_TEMPLATE);
	if(!isset($_SESSION['tipo'])){
		header('location: '.BASEURL);exit;
	}
	edit();
?>
<script src="../cdn/js/instituicao.js" type="text/javascript"></script>
<div class="container">
	<h2>Atualizar Usuário</h2>
	<form action="edit.php?id=<?php echo $usuario['id_usuario']; ?>" method="post">
	<hr />
		<div class="row">
			<div class="form-group col-md-7">
				<label for="id">Nome:</label>
				<input type="text" class="form-control" name="usuario['nome']" value="<?php echo $usuario['nome_u']; ?>" required>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-7">
				<label for="nome">Email:</label>
				<input type="text" class="form-control" name="usuario['email']" value="<?php echo $usuario['email']; ?>" required>
				<input type="hidden" class="form-control" name="usuario['id_usuario']" value="<?php echo $usuario['id_usuario']; ?>">
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-7">
				<label for="nome">Instituição:</label>
				<input type="text" class="form-control" id="instituicao" name="usuario['fk_instituicao']" value="<?php echo $usuario['nome_i']; ?>"required>
				<button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#inst-modal"><i class="fa fa-plus-circle fa-1x"></i> Adicionar </button>
			</div>
		</div>
		<div id="actions" class="row">
			<div class="col-md-12">
				<button type="submit" class="btn btn-primary">Salvar</button>
				<a href="index.php" class="btn btn-default">Cancelar</a>
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
				if(!empty($_SESSION['msgNome']))
					echo $_SESSION['msgNome'].'<br>';
				if(!empty($_SESSION['message']))
					echo $_SESSION['message'].'<br>';
			?>
		</div>
		<?php
			unset($_SESSION['type']);
			unset($_SESSION['msgNome']);
			unset($_SESSION['message']);
		?>

		<?php } ?>
	</div>
</div>
<?php include(FOOTER_TEMPLATE); ?>
