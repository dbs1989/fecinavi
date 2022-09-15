<?php 	  
	require_once('functions.php'); 	  
	index();
	add();	
?>
<?php include(HEADER_TEMPLATE); ?>	
<script src="../cdn/js/usuarios.js" type="text/javascript"></script>
	<div class="container">
		<h1 class="text-center">ADMINISTRADORES</h1>

		
	<h3 class="text-left">Adicionar administradores</h3>
		<br>
		<form action="index.php" method="post">
			<div class="row">	
				<div class="form-group col-md-7">
					<input type="text" class="form-control" id="estudante1" name="administrador['fk_usuario']" required>
					<input type="hidden" class="form-control" name="administrador['senha']" value="mudar123">
				</div>       
				<div class="form-group col-md-3">	      
					<button type="submit" class="btn btn-primary">Enviar</button>	      	    
				</div>	  
			</div>
		</form>
		<a href="index.php" class="btn btn-default">Voltar</a></center>
		<hr>
		<h3 class="text-center">Administradores Cadastrados</h3>
		<table class="table table-hover">	
			<thead>		
				<tr>			
					<th class="actions text-center">Nome</th>			
					<th class="actions text-center">Ação</th>							
				</tr>	
			</thead>
			<tbody>	
				<?php if ($administradores) : ?>	
				<?php foreach ($administradores as $administrador) : ?>		
				<tr>			
					<td><?php echo $administrador['nome']; ?></td>
					<?php if($administrador['fk_usuario']!=1){ ?>														
					<td class="actions text-center">				
						<a href="delete.php?id=<?php echo $administrador['fk_usuario']; ?>" class="btn btn-sm btn-danger"><i class="fa fa-pencil"></i> Excluir</a>							
					</td>
					<?php } ?>		
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

