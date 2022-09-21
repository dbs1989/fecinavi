<?php
	require_once('functions.php');

	if(!empty($_SESSION['tipo'])){
		findUsuario($_SESSION['id_user']);
		getAreas();
		index();
?>

<?php include(HEADER_TEMPLATE); ?>

	<div class="container">
	<h2 class="text-center">PROJETOS PARA AVALIAÇÃO</h2>
	<form action="index.php" method="post">
	<hr />
		<div class="row">
			<div class="form-group col-md-7">
				<label for="id_avaliador">Avaliador: <?php echo $_SESSION['user']; ?> </label>
				<input type="hidden" class="form-control"  name="avaliacao['fk_usuario']" value="<?php echo $_SESSION['id_user']; ?>">
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-3">
				<label for="area">Área:</label>
				<select class="form-control" id="area" name="avaliacao['fk_area']">
					<option value="0"> Selecione a Área </option>
					<?php foreach ($areas as $area) : ?>
					<option value="<?php echo $area['id_area'];?>"><?php echo $area['nome'];?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
		<div id="actions" class="row">
			<div class="col-md-12">
				<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Pesquisar Projetos</button>
				<a href="../index.php" class="btn btn-default">Voltar</a>
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
				if(!empty($_SESSION['message']))
					echo $_SESSION['message'].'<br>';
			?>
		</div>
		<?php
			unset($_SESSION['type']);
			unset($_SESSION['message']);
		?>

		<?php
		}
	}else{
		header('location: '.BASEURL);
	}

	?>
	</div>
	<!--<form action="https://projetosifms.com.br/qrcode" method="get"> -->
	<form action="avaliacao.php" method="get">
		<table class="table table-hover">
				<thead>
					<tr>
						<th width="60%">Titulo</th>
						<th>Nível</th>
						<th>Nº de Avaliações</th>
						<th>Avaliar</th>
					</tr>
				</thead>
				<tbody>
					<?php if ($projetos) { ?>
					<?php foreach ($projetos as $projeto) { ?>
					<tr>

						<td><?php echo ucwords(mb_strtolower($projeto['titulo'])); ?></td>
						<td><?php if($projeto['nivel']==1)
									echo "Fundamental";
								  else
									echo "Médio/Técnico";
							?></td>
						<td><?php echo $projeto['num_aval']; ?></td>
						<td class="actions text-left">
							<?php if($projeto['num_aval']==0/*true*/) {   ?>
							<button type="submit" class="btn btn-success" name="id" value="<?php echo $projeto['id_projeto']; ?>">Avaliar</button>

						<?php } else if($projeto['num_aval']==1) {   ?>
							<button type="submit" class="btn btn-warning" name="id" value="<?php echo $projeto['id_projeto']; ?>">Avaliar</button>

						<?php } else if($projeto['num_aval']==2) {   ?>
							<button type="submit" class="btn btn-danger" name="id" value="<?php echo $projeto['id_projeto']; ?>">Avaliar</button>

						<?php } else if($totalAval['total'] == $totalAval['projeto']  && $projeto['num_aval']<5) {   ?>
							<button type="submit" class="btn btn-default" name="id" value="<?php echo $projeto['id_projeto']; ?>">Avaliar</button>

						<?php } else {   ?>
							<span  class="bg-default text-black" name="id" value="<?php echo $projeto['id_projeto']; ?>">Inabilitado</span>

						<?php }  ?>
						</td>

					</tr>
							<?php } ?>
					<?php } else { ?>
					<tr>

						<td colspan="6">Nenhum registro encontrado.</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</form>
	</div>
<?php include(FOOTER_TEMPLATE); ?>
