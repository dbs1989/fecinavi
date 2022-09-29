<?php
	require_once('functions.php');

	if(!empty($_SESSION['tipo']) && $_SESSION['tipo'] == 1){
		if(empty($_SESSION['resultado'])){
			header('location: ../index.php');
		}else{
			$resultado = $_SESSION['resultado'];
			$banner = $_SESSION['banner'];
			$relatorio = $_SESSION['relatorio'];
			$ambiental = $_SESSION['ambiental'];
			$tecnologico = $_SESSION['tecnologico'];
			$cont = 0;

?>

<?php include(HEADER_TEMPLATE); ?>
<div class="container">
	<h2>CLASSIFICAÇÃO GERAL</h2>

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
			<!-- CHAMADA DA CLASSIFICAÇÃO DO ENSINO MEDIO -->
			<?php include  'ensinoMedio.php'?>

			<!-- CHAMADA DA CLASSIFICAÇÃO DO ENSINO MEDIO -->
			<?php include  'ensinoFundamental.php'?>
		

			<!-- Classificação para os convidados-->
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
							<td><?php echo number_format($res['nota'],5,',','');; ?></td>
							<td>
								<?php echo "1-Apresentação/Banner: ".number_format($res['banner'],2,',','')."<br>2-Resumo: ".number_format($res['resumo'],2,',','')."<br>3-Relatorio: ".number_format($res['relatorio'],2,',','')."<br>4-Diário: ".number_format($res['diario'],2,',',''); ?>
							</td>
						</tr>
								<?php }} ?>
						<?php } else { ?>
						<tr>

							<td colspan="6">Nenhum registro encontrado.</td>
						</tr>
					<?php }
					if($cont == 0){ ?>
						<td colspan="6" class="text-center">Nenhum projeto nessa categoria.</td>
					<?php } ?>
					</tbody>
				</table>

				

			<!-- Classificação para melhor projeto médio-->
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
							if($cont==5){
								break;
							}
							if($res['nivel']==1){
								continue;
							}
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
						<td><?php echo number_format($res['nota'],5,',','');?></td>
						<td>
							<?php echo "1-Apresentação/Banner: ".number_format($res['banner'],2,',','')."<br>2-Resumo: ".number_format($res['resumo'],2,',','')."<br>3-Relatorio: ".number_format($res['relatorio'],2,',','')."<br>4-Diário: ".number_format($res['diario'],2,',',''); ?>
					</tr>
							<?php } ?>
					<?php } else { ?>
					<tr>

						<td colspan="6">Nenhum registro encontrado.</td>
					</tr>
				<?php }
				if($cont == 0){ ?>
					<td colspan="6" class="text-center">Nenhum projeto nessa categoria.</td>
				<?php } ?>
				</tbody>
			</table>

			<!-- Classificação para melhor projeto Fundamental-->
		<div class="row">
			<div class="form-group col-md-12 bg-danger text-white text-center">
				<label for="n1"> MELHOR PROJETO DA CATEGORIA DE NÍVEL FUNDAMENTAL/TÉCNICO: </label>
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
							if($cont==5){
								break;
							}
							if($res['nivel']==2){
								continue;
							}
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
						<td><?php echo number_format($res['nota'],5,',','');?></td>
						<td>
							<?php echo "1-Apresentação/Banner: ".number_format($res['banner'],2,',','')."<br>2-Resumo: ".number_format($res['resumo'],2,',','')."<br>3-Relatorio: ".number_format($res['relatorio'],2,',','')."<br>4-Diário: ".number_format($res['diario'],2,',',''); ?>
					</tr>
							<?php } ?>
					<?php } else { ?>
					<tr>

						<td colspan="6">Nenhum registro encontrado.</td>
					</tr>
				<?php }
				if($cont == 0){ ?>
					<td colspan="6" class="text-center">Nenhum projeto nessa categoria.</td>
				<?php } ?>
				</tbody>
			</table>
		</div>
<?php include(FOOTER_TEMPLATE); ?>
