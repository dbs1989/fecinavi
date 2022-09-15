<?php
	require_once('functions.php');

	if(!empty($_SESSION['tipo']) && $_SESSION['tipo'] == 1){
		if(empty($_SESSION['resultado'])){
			header('location: ../index.php');
		}else{
			$resultado = $_SESSION['resultado'];
			$video = $_SESSION['video'];
			$ambiental = $_SESSION['ambiental'];
			$tecnologico = $_SESSION['tecnologico'];
			$cont = 0;

?>

<?php include(HEADER_TEMPLATE); ?>
<div class="container">
	<h2>RESULTADO GERAL</h2>

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
	}}else{
		header('location: '.BASEURL);
	}

	?>
	</div>
		<div class="row">
			<div class="form-group col-md-12 bg-primary text-white text-center">
				<label for="n1"> CIÊNCIAS BIOLÓGICAS E DA SAÚDE: </label>
			</div>
		</div>
		<table class="table table-hover">
				<thead>
					<tr>
						<th>Classificação</th>
						<th width="30%">Titulo</th>
						<th>Estudantes</th>
						<th>Orientadores</th>
						<th>Nota</th>
						<th>Desempate</th>
					</tr>
				</thead>
				<tbody>
					<?php if ($resultado) { $cont=0;?>

					<?php foreach ($resultado as $res) {
							if($cont==10){
								break;
							}
							if($res['fk_area'] == 1 && $res['nivel']==2 && $res['convidado']==0){
								$cont++;
					?>
					<tr>

						<td><?php echo $cont."º"; if($cont<=3){echo " Premiado";} ?></td>
						<td><?php echo $res['titulo']; ?></td>
						<td>
						<?php
							allAutores($res['usuarios']);
							echo ucwords(mb_strtolower($autores[1]['nome']."<br>".$autores[2]['nome']."<br>".$autores[3]['nome']));
						?>
						</td>
						<td>
						<?php
							echo ucwords(mb_strtolower($autores[5]['nome']."<br>".$autores[4]['nome']));
						?>
						</td>
						<td><?php echo number_format($res['nota'],2,',',''); ?></td>
						<td>
							<?php echo "1-Vídeo: ".number_format($res['video'],2,',','')."<br>2-Resumo: ".number_format($res['resumo'],2,',',''); ?>
						</td>
					</tr>
							<?php }} ?>
					<?php } else { ?>
					<tr>

						<td colspan="6">Nenhum registro encontrado.</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		<div class="row">
			<div class="form-group col-md-12 bg-primary text-white text-center">
				<label for="n1"> CIÊNCIAS EXATAS E DA TERRA: </label>
			</div>
		</div>
		<table class="table table-hover">
				<thead>
					<tr>
						<th>Classificação</th>
						<th width="30%">Titulo</th>
						<th>Estudantes</th>
						<th>Orientadores</th>
						<th>Nota</th>
						<th>Desempate</th>
					</tr>
				</thead>
				<tbody>
					<?php if ($resultado) { $cont=0;?>

					<?php foreach ($resultado as $res) {
							if($cont==10){
								break;
							}
							if($res['fk_area'] == 2 && $res['nivel']==2 && $res['convidado']==0){
								$cont++;
					?>
					<tr>

						<td><?php echo $cont."º"; if($cont<=3){echo " Premiado";} ?></td>
						<td><?php echo $res['titulo']; ?></td>
						<td>
						<?php
							allAutores($res['usuarios']);
							echo ucwords(mb_strtolower($autores[1]['nome']."<br>".$autores[2]['nome']."<br>".$autores[3]['nome']));
						?>
						</td>
						<td>
						<?php
							echo ucwords(mb_strtolower($autores[5]['nome']."<br>".$autores[4]['nome']));
						?>
						</td>
						<td><?php echo number_format($res['nota'],2,',',''); ?></td>
						<td>
							<?php echo "1-Vídeo: ".number_format($res['video'],2,',','')."<br>2-Resumo: ".number_format($res['resumo'],2,',',''); ?>
					</tr>
					</tr>
							<?php }} ?>
					<?php } else { ?>
					<tr>

						<td colspan="6">Nenhum registro encontrado.</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>

			<div class="row">
			<div class="form-group col-md-12 bg-primary text-white text-center">
				<label for="n1"> CIÊNCIAS HUMANAS, SOCIAIS APLICADAS E LINGUÍSTICA: </label>
			</div>
		</div>
		<table class="table table-hover">
				<thead>
					<tr>
						<th>Classificação</th>
						<th width="30%">Titulo</th>
						<th>Estudantes</th>
						<th>Orientadores</th>
						<th>Nota</th>
						<th>Desempate</th>
					</tr>
				</thead>
				<tbody>
					<?php if ($resultado) { $cont=0;?>

					<?php foreach ($resultado as $res) {
							if($cont==10){
								break;
							}
							if($res['fk_area'] == 3 && $res['nivel']==2 && $res['convidado']==0){
								$cont++;
					?>
					<tr>

						<td><?php echo $cont."º"; if($cont<=3){echo " Premiado";}?></td>
						<td><?php echo $res['titulo']; ?></td>
						<td>
						<?php
							allAutores($res['usuarios']);
							echo ucwords(mb_strtolower($autores[1]['nome']."<br>".$autores[2]['nome']."<br>".$autores[3]['nome']));
						?>
						</td>
						<td>
						<?php
							echo ucwords(mb_strtolower($autores[5]['nome']."<br>".$autores[4]['nome']));
						?>
						</td>
						<td><?php echo number_format($res['nota'],2,',',''); ?></td>
						<td>
							<?php echo "1-Vídeo: ".number_format($res['video'],2,',','')."<br>2-Resumo: ".number_format($res['resumo'],2,',',''); ?>
					</tr>
					</tr>
							<?php }} ?>
					<?php } else { ?>
					<tr>

						<td colspan="6">Nenhum registro encontrado.</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>

			<div class="row">
			<div class="form-group col-md-12 bg-primary text-white text-center">
				<label for="n1"> CIÊNCIAS AGRÁRIAS E ENGENHARIAS </label>
			</div>
		</div>
		<table class="table table-hover">
				<thead>
					<tr>
						<th>Classificação</th>
						<th width="30%">Titulo</th>
						<th>Estudantes</th>
						<th>Orientadores</th>
						<th>Nota</th>
						<th>Desempate</th>
					</tr>
				</thead>
				<tbody>
					<?php if ($resultado) { $cont=0;?>

					<?php foreach ($resultado as $res) {
							if($cont==10){
								break;
							}
							if($res['fk_area'] == 4 && $res['nivel']==2 && $res['convidado']==0){
								$cont++;
					?>
					<tr>

						<td><?php echo $cont."º"; if($cont<=3){echo " Premiado";} ?></td>
						<td><?php echo $res['titulo']; ?></td>
						<td>
						<?php
							allAutores($res['usuarios']);
							echo ucwords(mb_strtolower($autores[1]['nome']."<br>".$autores[2]['nome']."<br>".$autores[3]['nome']));
						?>
						</td>
						<td>
						<?php
							echo ucwords(mb_strtolower($autores[5]['nome']."<br>".$autores[4]['nome']));
						?>
						</td>
						<td><?php echo number_format($res['nota'],2,',',''); ?></td>
						<td>
								<?php echo "1-vídeo: ".number_format($res['video'],2,',','')."<br>2-Resumo: ".number_format($res['resumo'],2,',',''); ?>
						</td>
					</tr>
							<?php }} ?>
					<?php } else { ?>
					<tr>

						<td colspan="6">Nenhum registro encontrado.</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>

			<div class="row">
			<div class="form-group col-md-12 bg-primary text-white text-center">
				<label for="n1"> MULTIDISCIPLINAR: </label>
			</div>
		</div>
		<table class="table table-hover">
				<thead>
					<tr>
						<th>Classificação</th>
						<th width="30%">Titulo</th>
						<th>Estudantes</th>
						<th>Orientadores</th>
						<th>Nota</th>
						<th>Desempate</th>
					</tr>
				</thead>
				<tbody>
					<?php if ($resultado) { $cont=0;?>

					<?php foreach ($resultado as $res) {
							if($cont==10){
								break;
							}
							if($res['fk_area'] == 5 && $res['nivel']==2 && $res['convidado']==0){
								$cont++;
					?>
					<tr>

						<td><?php echo $cont."º"; if($cont<=3){echo " Premiado";} ?></td>
						<td><?php echo $res['titulo']; ?></td>
						<td>
						<?php
							allAutores($res['usuarios']);
							echo ucwords(mb_strtolower($autores[1]['nome']."<br>".$autores[2]['nome']."<br>".$autores[3]['nome']));
						?>
						</td>
						<td>
						<?php
							echo ucwords(mb_strtolower($autores[5]['nome']."<br>".$autores[4]['nome']));
						?>
						</td>
						<td><?php echo number_format($res['nota'],2,',',''); ?></td>
						<td>
							<?php echo "1-Vídeo: ".number_format($res['video'],2,',','')."<br>2-Resumo: ".number_format($res['resumo'],2,',',''); ?>
						</td>
					</tr>
							<?php }} ?>
					<?php } else { ?>
					<tr>

						<td colspan="6">Nenhum registro encontrado.</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		<div class="row">
			<div class="form-group col-md-12 bg-success text-white text-center">
				<label for="n1"> NÍVEL FUNDAMENTAL: </label>
			</div>
		</div>
		<table class="table table-hover">
				<thead>
					<tr>
						<th>Classificação</th>
						<th width="30%">Titulo</th>
						<th>Estudantes</th>
						<th>Orientadores</th>
						<th>Nota</th>
						<th>Desempate</th>
					</tr>
				</thead>
				<tbody>
					<?php if ($resultado) { $cont=0;?>

					<?php foreach ($resultado as $res) {
							if($cont==10){
								break;
							}
							if($res['nivel']==1 && $res['convidado']==0){

								$cont++;
					?>
					<tr>

						<td><?php echo $cont."º"; if($cont<=3){echo " Premiado";} ?></td>
						<td><?php echo $res['titulo']; ?></td>
						<td>
						<?php
							allAutores($res['usuarios']);
							echo ucwords(mb_strtolower($autores[1]['nome']."<br>".$autores[2]['nome']."<br>".$autores[3]['nome']));
						?>
						</td>
						<td>
						<?php
							echo ucwords(mb_strtolower($autores[5]['nome']."<br>".$autores[4]['nome']));
						?>
						</td>
						<td><?php echo number_format($res['nota'],2,',','');; ?></td>
						<td>
							<?php echo "1-vídeo: ".number_format($res['video'],2,',','')."<br>2-Resumo: ".number_format($res['resumo'],2,',',''); ?>
						</td>
					</tr>
							<?php }} ?>
					<?php } else { ?>
					<tr>

						<td colspan="6">Nenhum registro encontrado.</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<div class="row">
				<div class="form-group col-md-12 bg-warning text-black text-center">
					<label for="n1"> CONVIDADO: </label>
				</div>
			</div>
			<table class="table table-hover">
					<thead>
						<tr>
							<th>Classificação</th>
							<th width="30%">Titulo</th>
							<th>Estudantes</th>
							<th>Orientadores</th>
							<th>Nota</th>
							<th>Desempate</th>
						</tr>
					</thead>
					<tbody>
						<?php if ($resultado) { $cont=0;?>

						<?php foreach ($resultado as $res) {
								if($cont==10){
									break;
								}
								if($res['convidado']==1){
									$cont++;
						?>
						<tr>

							<td><?php echo $cont."º"; if($cont<=3){echo " Premiado";} ?></td>
							<td><?php echo $res['titulo']; ?></td>
							<td>
							<?php
								allAutores($res['usuarios']);
								echo ucwords(mb_strtolower($autores[1]['nome']."<br>".$autores[2]['nome']."<br>".$autores[3]['nome']));
							?>
							</td>
							<td>
							<?php
								echo ucwords(mb_strtolower($autores[5]['nome']."<br>".$autores[4]['nome']));
							?>
							</td>
							<td><?php echo number_format($res['nota'],2,',','');; ?></td>
							<td>
								<?php echo "1-vídeo: ".number_format($res['video'],2,',','')."<br>2-Resumo: ".number_format($res['resumo'],2,',',''); ?>
							</td>
						</tr>
								<?php }} ?>
						<?php } else { ?>
						<tr>

							<td colspan="6">Nenhum registro encontrado.</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>

			<div class="row">
			<div class="form-group col-md-12 bg-warning text-black text-center">
				<label for="n1"> IMPACTO SOCIOAMBIENTAL: </label>
			</div>
		</div>
		<table class="table table-hover">
				<thead>
					<tr>
						<th>Classificação</th>
						<th width="30%">Titulo</th>
						<th>Estudantes</th>
						<th>Orientadores</th>
						<th>Nota</th>
						<th>Desempate</th>
					</tr>
				</thead>
				<tbody>
					<?php if ($ambiental) { $cont=0;?>

					<?php foreach ($ambiental as $res) {
							if($cont==10){
								break;
							}
							if($res['nivel']==1)
								continue;
							if($res['convidado']==1)
								continue;
							$cont++;
					?>
					<tr>

						<td><?php echo $cont."º"; if($cont==1){echo " Premiado";}?></td>
						<td><?php echo $res['titulo']; ?></td>
						<td>
						<?php
							allAutores($res['usuarios']);
							echo ucwords(mb_strtolower($autores[1]['nome']."<br>".$autores[2]['nome']."<br>".$autores[3]['nome']));
						?>
						</td>
						<td>
						<?php
							echo ucwords(mb_strtolower($autores[5]['nome']."<br>".$autores[4]['nome']));
						?>
						</td>
						<td><?php echo number_format($res['ambiental'],2,',',''); ?></td>
						<td>
							<?php echo "1-vídeo: ".number_format($res['video'],2,',','')."<br>2-Resumo: ".number_format($res['resumo'],2,',',''); ?>
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
			<div class="row">
			<div class="form-group col-md-12 bg-warning text-black text-center">
				<label for="n1"> TECNOLÓGICO: </label>
			</div>
		</div>
		<table class="table table-hover">
				<thead>
					<tr>
						<th>Classificação</th>
						<th width="30%">Titulo</th>
						<th>Estudantes</th>
						<th>Orientadores</th>
						<th>Nota</th>
						<th>Desempate</th>
					</tr>
				</thead>
				<tbody>
					<?php if ($tecnologico) { $cont=0;?>

					<?php foreach ($tecnologico as $res) {
							if($cont==10){
								break;
							}
							if($res['nivel']==1)
								continue;
							if($res['convidado']==1)
								continue;
							$cont++;
					?>
					<tr>

						<td><?php echo $cont."º"; if($cont==1){echo " Premiado";}?></td>
						<td><?php echo $res['titulo']; ?></td>
						<td>
						<?php
							allAutores($res['usuarios']);
							echo ucwords(mb_strtolower($autores[1]['nome']."<br>".$autores[2]['nome']."<br>".$autores[3]['nome']));
						?>
						</td>
						<td>
						<?php
							echo ucwords(mb_strtolower($autores[5]['nome']."<br>".$autores[4]['nome']));
						?>
						</td>
						<td><?php echo number_format($res['tecnologico'],2,',',''); ?></td>
						<td>
							<?php echo "1-vídeo: ".number_format($res['video'],2,',','')."<br>2-Resumo: ".number_format($res['resumo'],2,',',''); ?>
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

			<div class="row">
			<div class="form-group col-md-12 bg-warning text-black text-center">
				<label for="n1"> MELHOR VÍDEO: </label>
			</div>
		</div>
		<table class="table table-hover">
				<thead>
					<tr>
						<th>Classificação</th>
						<th width="30%">Titulo</th>
						<th>Estudantes</th>
						<th>Orientadores</th>
						<th>Nota</th>
						<th>Desempate</th>
					</tr>
				</thead>
				<tbody>
					<?php if ($video) { $cont=0;?>

					<?php foreach ($video as $res) {
							if($cont==3){
								break;
							}
							if($res['nivel']==1)
								continue;
							if($res['convidado']==1)
								continue;
							$cont++;
					?>
					<tr>

						<td><?php echo $cont."º"; if($cont==1){echo " Premiado";}?></td>
						<td><?php echo $res['titulo']; ?></td>
						<td>
						<?php
							allAutores($res['usuarios']);
							echo ucwords(mb_strtolower($autores[1]['nome']."<br>".$autores[2]['nome']."<br>".$autores[3]['nome']));
						?>
						</td>
						<td>
						<?php
							echo ucwords(mb_strtolower($autores[5]['nome']."<br>".$autores[4]['nome']));
						?>
						</td>
						<td><?php echo number_format($res['video'],2,',',''); ?></td>
						<td>
							<?php echo "1-Nota: ".number_format($res['nota'],2,',','')."<br>2-Resumo: ".number_format($res['resumo'],2,',',''); ?>
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
		<div class="row">
			<div class="form-group col-md-12 bg-danger text-white text-center">
				<label for="n1"> MELHOR PROJETO DA CATEGORIA DE NÍVEL MÉDIO/TÉCNICO: </label>
			</div>
		</div>
		<table class="table table-hover">
				<thead>
					<tr>
						<th>Classificação</th>
						<th width="30%">Titulo</th>
						<th>Estudantes</th>
						<th>Orientadores</th>
						<th>Nota</th>
						<th>Desempate</th>
					</tr>
				</thead>
				<tbody>
					<?php if ($resultado) { $cont=0;?>

					<?php foreach ($resultado as $res) {
							if($cont==10){
								break;
							}
							if($res['nivel']==1){
								continue;
							}
							if($res['convidado']==1)
								continue;
							$cont++;
					?>
					<tr>

						<td><?php echo $cont."º"; if($cont==1){echo " Premiado";}?></td>
						<td><?php echo $res['titulo']; ?></td>
						<td>
						<?php
							allAutores($res['usuarios']);
							echo ucwords(mb_strtolower($autores[1]['nome']."<br>".$autores[2]['nome']."<br>".$autores[3]['nome']));
						?>
						</td>
						<td>
						<?php
							echo ucwords(mb_strtolower($autores[5]['nome']."<br>".$autores[4]['nome']));
						?>
						</td>
						<td><?php echo number_format($res['nota'],2,',','');?></td>
						<td>
							<?php echo "1-vídeo: ".number_format($res['video'],2,',','')."<br>2-Resumo: ".number_format($res['resumo'],2,',',''); ?>
					</tr>
							<?php } ?>
					<?php } else { ?>
					<tr>

						<td colspan="6">Nenhum registro encontrado.</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
<?php include(FOOTER_TEMPLATE); ?>
