<?php
	require_once('functions.php');
	include(HEADER_TEMPLATE);
	if(!isset($_SESSION['tipo'])){
		header('location: '.BASEURL);exit;
	}
	add();
	getAreas();
?>

<script src="../cdn/js/usuarios.js" type="text/javascript"></script>
<div class="container">
<h2>Novo projeto</h2>
	<form action="add.php" method="post">

	<!-- area de campos do form -->
	<hr/>	<!-- linha de separação -->
		<div class="row">
			<div class="form-group col-md-9">
				<label for="nome">Título:</label>
				<input type="text" class="form-control" name="projeto['titulo']" required>
			</div>
		</div>

		<div class="row">
			<div class="form-group col-md-3">
				<label for="nome">Área:</label>
				<select class="form-control" id="sel1" name="projeto['fk_area']">
					<?php foreach ($areas as $area) : ?>
						<option value="<?php echo $area['id_area']?>"><?php echo $area['nome'];?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="form-group col-md-3">
				<label for="nome">Nível:</label>
				<select class="form-control" id="sel1" name="projeto['nivel']">
						<option value="1">Fundamental</option>
						<option value="2">Médio</option>
				</select>
			</div>
			<div class="form-group col-md-3">
				<label for="nome">Eixo:</label>
				<select class="form-control" id="sel1" name="projeto['eixo']">
						<option value="1">Científico</option>
						<option value="2">Tecnológico</option>
				</select>
			</div>
		</div>
		<div class="form-group form-check">
    	<label class="form-check-label">
      	<input class="form-check-input" type="checkbox" name="projeto['convidado']" value="1"> Convidado
    	</label>
		</div>
		<div class="row">
			<div class="form-group col-md-7">
				<label for="nome">Estudante 1:</label>
				<input type="text" class="form-control" id="estudante1" name="projeto['estudante1']" required>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-7">
				<label for="nome">Estudante 2 (Preencha se existir):</label>
				<input type="text" class="form-control" id="estudante2" name="projeto['estudante2']">
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-7">
				<label for="nome">Estudante 3 (Preencha se existir):</label>
				<input type="text" class="form-control" id="estudante3" name="projeto['estudante3']">
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-7">
				<label for="nome">Orientador:</label>
				<input type="text" class="form-control" id="orientador1" name="projeto['orientador1']" required>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-7">
				<label for="nome">Coorientador (Preencha se existir):</label>
				<input type="text" class="form-control" id="orientador2" name="projeto['orientador2']">
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
