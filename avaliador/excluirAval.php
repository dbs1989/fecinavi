<?php
	require_once('functions.php');
	pesquisaAval($_GET['id']);
  excluir();
?>
<?php include(HEADER_TEMPLATE); ?>
	<div class="container">
    <h3 class="text-center">Projetos Avaliados</h3>
    <h4 class="text-center">Avaliador: <?php echo $avaliador['nome'];?></h4>
		<table class="table table-hover">
			<thead>
				<tr>
					<th class="actions text-center">Título</th>
					<th class="actions text-center">Ação</th>
				</tr>
			</thead>
			<tbody>
				<?php if ($projetos) : ?>
				<?php foreach ($projetos as $projeto) : ?>
				<tr>
					<td><?php echo $projeto['titulo']; ?></td>
					<td class="actions text-center">
						<a href="excluirAval.php?id=<?php echo $avaliador['id_usuario']?>&excluir=<?php echo $projeto['id_avaliacao']; ?>&id_projeto=<?php echo $projeto['id_projeto']; ?>" class="btn btn-sm btn-danger"><i class="fa fa-close"></i> Excluir Avaliação</a>
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
    <div class="text-center">
    <a href="index.php"> <button class="btn btn-secondary">Voltar</button> </a>
  </div>
  </div>

<?php include(FOOTER_TEMPLATE); ?>
