<?php require_once 'config.php'; ?>
<?php require_once DBAPI; ?>
<?php include(HEADER_TEMPLATE); ?>
<?php
	unset($_SESSION['resultado']);
	?>
	<div class="container">

	<div class="container-fluid text-center">
		<h2>RESULTADOS FECIFRON 2020</h2>
		<img src="imagens/2020/resultados.png" width="100%">
	</div>
	<div class="container text-center text-white bg-success">
		<h2>CERTIFICADOS</h2>
		<a href="https://drive.google.com/drive/folders/1nC_rXi2Yn1EBP7Nq0OkpFtxkhvk6kZcB?usp=sharing"><button type="button" class="btn btn-success "><h3> Participação</h3></button></a>
		<a href="https://drive.google.com/drive/folders/11HQgUNxMhSRcZCA_CQoWUA5yTauial0k?usp=sharing"><button type="button" class="btn btn-success "><h3> Premiação</h3></button></a>
		<a href="https://drive.google.com/drive/folders/1AXsYOLsskC_KIM0AlLAzsi5C0jQqmbFX?usp=sharing"><button type="button" class="btn btn-success "><h3> Credencial</h3></button></a>
	</div>
</div>
<?php include(FOOTER_TEMPLATE); ?>
