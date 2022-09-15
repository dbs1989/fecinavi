<?php
	require_once('functions.php');
	include(HEADER_TEMPLATE);
	if(!isset($_SESSION['tipo'])){
		header('location: '.BASEURL);exit;
	}
?>
<?php
	$pagina = null;
	if(isset($_GET['pagina'])){
		$pagina = $_GET['pagina'];
		index($_GET['pagina']);
	}else{
		index();
	}
	totalPaginas();
?>
<script src="../cdn/js/instituicao.js" type="text/javascript"></script>
<div class="container">
	<header>
		<div class="row">
			<div class="col-sm-6">
				<h2>Usuários</h2>
			</div>
			<div class="col-sm-6 text-right h2">
				<a class="btn btn-primary" href="add.php"><i class="fa fa-plus"></i> Novo Usuário</a>
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
		<table class="table table-hover">
			<thead>
				<tr>
					<th class="actions text-center">Nome</th>
					<th class="actions text-center">Email</th>
					<th class="actions text-center">Instituição</th>
					<th class="actions text-center">Ação</th>
				</tr>
			</thead>
			<tbody>
				<?php if ($usuarios) : ?>
				<?php foreach ($usuarios as $usuario) : ?>
				<tr>
					<td><?php echo $usuario['nome_u']; ?></td>
					<td><?php echo $usuario['email']; ?></td>
					<td><?php echo $usuario['nome_i']; ?></td>
					<td class="actions text-center">
						<a href="edit.php?id=<?php echo $usuario['id_usuario']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> Editar</a>
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
		<div class="row">
		<div class="col-sm-11 text-center">
		<nav aria-label="Navegação de página">
			<ul class="pagination">
				<li class="page-item"><a class="page-link" href="index.php?pagina=1">Primeira</a></li>
				<?php
						$total_pag = ceil($total_pag/10);
						for($i=1;$i<=$total_pag;$i++){
							$estilo = "";
							if($pagina == $i || $pagina == null && $i==1){
								$estilo = "active";
							}
							echo "<li class='page-item $estilo' ><a class='page-link' href='index.php?pagina=$i'>$i</a></li>";
						}
				 ?>
				<li class="page-item"><a class="page-link" href="index.php?pagina=<?php echo $total_pag; ?>">Última</a></li>
			</ul>
		</nav>
		</div>
		<div class="col-sm-1 text-center">
			<a href="<?php echo BASEURL;?>" class="btn btn-default">Voltar</a></center>
		</div>

	</div>
		</div>
<?php include(FOOTER_TEMPLATE); ?>
