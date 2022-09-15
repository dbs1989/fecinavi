<?php
	require_once('functions.php');
	include(HEADER_TEMPLATE);
	if(!isset($_SESSION['tipo'])){
		header('location: '.BASEURL);exit;
	}
	index();

?>

<script src="../cdn/js/servidores.js" type="text/javascript"></script>
<div class="container">
	<header>
		<div class="row">
			<div class="col-sm-6">
				<h2>Projetos</h2>
			</div>
			<div class="col-sm-6 text-right h2">
				<a class="btn btn-primary" href="add.php"><i class="fa fa-plus"></i> Novo Projeto</a>
				<a class="btn btn-default" href="index.php"><i class="fa fa-refresh"></i> Atualizar</a>
			</div>
		</div>
	</header>

<?php
	if (!empty($_SESSION['message'])){
?>
	<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<?php echo $_SESSION['message']; ?>
	</div>

	<?php
		unset($_SESSION['type']);
		unset($_SESSION['message']);
	?>
	<?php } ?>
	<hr>
		<table class="table table-hover">
			<thead>
				<tr>
					<th class="actions text-center">Título</th>
					<th class="actions text-center">Área</th>
					<th class="actions text-center">Nível</th>
					<th class="actions text-center">Eixo</th>
					<th class="actions text-center">Ação</th>
				</tr>
			</thead>
			<tbody>
				<?php if ($projetos) : ?>
				<?php foreach ($projetos as $projeto) : ?>
				<tr>
					<td><?php echo $projeto['titulo']; ?></td>
					<td><?php echo $projeto['nome']; ?></td>
					<td>
						<?php
							if($projeto['nivel']==1)
								echo "Fundamental";
							else
								echo "Médio";
						?>
					</td>
					<td>
						<?php
							if($projeto['eixo']==1)
								echo "Científico";
							else
								echo "Tecnológico";
						?>
					</td>

					<td class="actions text-center">
						<a href="edit.php?id=<?php echo $projeto['id_projeto']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> Editar</a>
					</td>
				</tr>
				<?php endforeach; ?>
				<?php else : ?>
				<tr>
					<td colspan="6">Nenhum registro encontrado.</td>
				</tr>
				<?php endif; ?>
			</tbody>
		</table>
		<a href="<?php echo BASEURL;?>" class="btn btn-default">Voltar</a></center>
		</div>
<?php include(FOOTER_TEMPLATE); ?>
