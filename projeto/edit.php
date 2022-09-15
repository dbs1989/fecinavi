<?php
	require_once('functions.php');
	include(HEADER_TEMPLATE);
	if(!isset($_SESSION['tipo'])){
		header('location: '.BASEURL);exit;
	}
	edit();
?>

<script src="../cdn/js/usuarios.js" type="text/javascript"></script>
<div class="container">
	<h2>Atualizar Projeto</h2>
	<form action="edit.php?id=<?php echo $projeto['id_projeto']; ?>" method="post">
	<hr />
		<div class="row">
			<div class="form-group col-md-9">
				<label for="nome">Título:</label>
				<input type="text" class="form-control" name="projeto['titulo']" value="<?php echo $projeto['titulo']; ?>" required>
				<input type="hidden" class="form-control" name="projeto['id_projeto']" value="<?php echo $projeto['id_projeto']; ?>">
			</div>
		</div>

		<div class="row">
			<div class="form-group col-md-3">
				<label for="nome">Área:</label>
				<select class="form-control" id="sel1" name="projeto['fk_area']">
					<?php foreach ($areas as $area) :
						if($area['nome']==$projeto['nome']){
					?>
						<option value="<?php echo $area['id_area']?>" selected><?php echo $area['nome'];?></option>
					<?php
						}else{
					?>
						<option value="<?php echo $area['id_area']?>"><?php echo $area['nome'];?></option>
					<?php } endforeach; ?>
				</select>
			</div>
			<div class="form-group col-md-3">
				<label for="nome">Nível:</label>
				<select class="form-control" id="sel1" name="projeto['nivel']">
						<option value="1" <?php if($projeto['nivel']==1) echo "selected"; ?> >Fundamental</option>
						<option value="2" <?php if($projeto['nivel']==2) echo "selected"; ?> >Médio</option>
				</select>
			</div>
			<div class="form-group col-md-3">
				<label for="nome">Eixo:</label>
				<select class="form-control" id="sel1" name="projeto['eixo']">
						<option value="1" <?php if($projeto['eixo']==1) echo "selected"; ?> >Científico</option>
						<option value="2" <?php if($projeto['eixo']==2) echo "selected"; ?> >Tecnológico</option>
				</select>
			</div>
		</div>
		<div class="form-group form-check">
        	<label class="form-check-label">
          	    <input class="form-check-input" type="checkbox" name="projeto['convidado']" value="1" <?php if($projeto['convidado']==1) echo "checked"; ?>> Convidado
        	</label>
        	
		</div>
		<?php
			$i = 0;
			$autores = null;
			foreach ($usuarios as $usuario){
				if($usuario['tipo']==3){
					$i++;
					$autores[$i] = $usuario;
				}else if($usuario['tipo']==2){
					while($i<3){
						$i++;
						$autores[$i]['nome']="";
					}
					$i++;
					$autores[$i] = $usuario;
				}else{
					while($i<4){
						$i++;
						$autores[$i]['nome']="";
					}
					$i++;
					$autores[$i] = $usuario;
				}
			}
		?>
		<div class="row">
			<div class="form-group col-md-7">
				<label for="nome">Estudante 1:</label>
				<input type="text" class="form-control" id="estudante1" name="projeto['estudante1']" value="<?php echo $autores['1']['nome']; ?>" required>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-7">
				<label for="nome">Estudante 2 (Preencha se existir):</label>
				<input type="text" class="form-control" id="estudante2" name="projeto['estudante2']" value="<?php echo $autores['2']['nome']; ?>">
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-7">
				<label for="nome">Estudante 3 (Preencha se existir):</label>
				<input type="text" class="form-control" id="estudante3" name="projeto['estudante3']" value="<?php echo $autores['3']['nome']; ?>">
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-7">
				<label for="nome">Orientador:</label>
				<input type="text" class="form-control" id="orientador1" name="projeto['orientador1']" value="<?php echo $autores['5']['nome']; ?>" required>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-7">
				<label for="nome">Coorientador (Preencha se existir):</label>
				<input type="text" class="form-control" id="orientador2" name="projeto['orientador2']" value="<?php echo $autores['4']['nome']; ?>">
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
