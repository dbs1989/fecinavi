<?php
	require_once('functions.php');
	index();
	add();
?>
<?php include(HEADER_TEMPLATE); ?>
<script src="../cdn/js/usuarios.js" type="text/javascript"></script>
	<div class="container">


	<h3 class="text-center">Adicionar Avaliadores</h3>
		<br>
		<form action="index.php" method="post">
			<div class="row">
				<div class="form-group col-md-4">
					<input type="text" class="form-control" id="estudante1" name="avaliador['fk_usuario']" required>
				</div>
				<div class="form-group col-md-6">
					<?php
					foreach ($areas as $area) {
					?>
					<input type="checkbox" class="form-check-input" name= "avaliador['area']['<?php echo $area['id_area']; ?>']" value="<?php echo $area['id_area']; ?>"> <?php echo $area['nome']; ?><br>
					<?php
					}
					?>
				</div>
				<div class="form-group col-md-2">
					<button type="submit" class="btn btn-primary">Enviar</button>
				</div>
			</div>
		</form>
		<a href="index.php" class="btn btn-default">Voltar</a></center>
		<hr>
		<h3 class="text-center">Avaliadores Cadastrados</h3>
		<table class="table table-hover">
			<thead>
				<tr>
					<th class="actions text-center">Nome</th>
					<th class="actions text-center">Áreas</th>
					<th class="actions text-center">Ação</th>
				</tr>
			</thead>
			<tbody>
				<?php if ($avaliadores) : ?>
				<?php foreach ($avaliadores as $avaliador) : ?>
				<tr>
					<td><?php echo $avaliador['nome']; ?></td>
					<?php areaAval($avaliador['fk_usuario']);
							echo "<td class='actions text-center'>";
							if(!empty($areaAval)){
								foreach ($areaAval as $av) {
									echo $av['nome']."<br>";
								}
							}
							echo "</td>";
					?>
					<td class="actions text-center">
						<?php if(temAval($avaliador['fk_usuario'])){
						?>
						<a href="excluirAval.php?id=<?php echo $avaliador['fk_usuario']; ?>" class="btn btn-sm btn-danger"><i class="fa fa-close"></i> Apagar Avaliações</a>
						<?php
						}else{
						?>
						<a href="delete.php?id=<?php echo $avaliador['fk_usuario']; ?>" class="btn btn-sm btn-danger"><i class="fa fa-close"></i> Excluir Avaliador</a>
						<?php
						}
						?>
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
</div>
<?php include(FOOTER_TEMPLATE); ?>
