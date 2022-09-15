<div class="modal fade" id="inst-modal">	  
	<div class="modal-dialog">	    
		<div class="modal-content">
        <div class="modal-header">
			<h4><span class="glyphicon glyphicon-lock"></span> Cadastro da Instituição</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
          <form action="add.php" method="post" >
            <div class="form-group">
              Nome: <input type="text" class="form-control" name="instituicao['nome']" autofocus>
            </div>
            <button type="submit" class="btn btn-success  pull-right">Cadastrar</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal">Sair</button>
        </div>
      </div>  
	</div>	
</div> 

