<?php
  require_once '../config.php';
  require_once 'functions.php';
  include(HEADER_TEMPLATE); 
  index();
?>
<script type="text/javascript">
 function esconderTudo(){
        desativar("formpremios");
        desativar("credencial");
        desativar("avaliadores");
        desativar("participacao");
 }
 function mudarAction(escolha){
    if(escolha.value=="0"){
      esconderTudo();
    }else if(escolha.value=="1"){
      desativar("credencial");
      desativar("participacao");
      desativar("avaliadores");
      ativar("formpremios");
    }else if(escolha.value=="2"){
      desativar("formpremios");
      desativar("participacao");
      desativar("avaliadores");
      ativar("credencial");
    }else if(escolha.value=="3"){
      desativar("credencial");
      desativar("formpremios");
      desativar("participacao");
      ativar("avaliadores");
    }else if(escolha.value=="4"){
      desativar("credencial");
      desativar("formpremios");
      desativar("avaliadores");
      ativar("participacao");
    }
  }

  function ativar(el) {
        document.getElementById(el).style.display = 'block';

    }
    function desativar(el) {
        document.getElementById(el).style.display = 'none';
    }

    function mudarEstado(el) {
        var display = document.getElementById(el).style.display;
        if(display == "none")
            document.getElementById(el).style.display = 'block';
        else
            document.getElementById(el).style.display = 'none';
    }

  window.onload=function(){
    esconderTudo();
    desativar("registro1");
    desativar("registro2");
    desativar("registro3");
  }
 </script>
	  
	  <!-- tentando arrumar o fomulario-->
    <div class="container" >
      <h3 class="text-center">MODELO DE CERTIFICADO</h3>
      <div class="form-group">
        <select class="form-control" id="sel1" onchange="mudarAction(this)">
          <option value="0">Escolha um modelo de certificado</option>
          <option value="1">Colocação</option>
          <option value="2">Credenciais</option>
          <option value="3">Avaliadores</option>
          <option value="4">Participação</option>
        </select>
      </div>

      <!-- COLOCAÇÃO -->
      <div id="formpremios">
      <form action="intermedio.php" method="post" enctype="multipart/form-data" >
        <div class="row">
          <div class="form-group col-md-6">
            Frente:
            <img src="../imagens/1premio.jpg" width="100%">
          </div>
          <div class="form-group col-md-6">
            Verso:
            <img src="../imagens/2premio.jpg" width="100%">
          </div>
        </div>
  	    <div class="form-group">
    	     <label>Texto:</label>
    	     <textarea class="form-control" rows="4" id="comment" name="arquivo['texto']" required>Exemplo: A VIII Feira de Ciências e Tecnologia da Fronteira, FECIFRON 2020, realizada nos dias 19 e 20 de outubro de 2020 confere o presente certificado aos participantes do projeto</textarea>
  	    </div>
        <div class="row">
          <div class="form-group col-md-4">
            <label>Local/Campus:</label>
            <input type="text" class="form-control" name="arquivo['campus']" required>
          </div>
          <div class="form-group col-md-4">
            <label>Data:</label>
            <input type="date" class="form-control" placeholder="dd/mm/aaaa" name="arquivo['data']" required>
          </div>
       
          <div class="form-group col-md-4">
            <label>Último Registro:</label>
            <input type="number" class="form-control" name="arquivo['ult_registro']">
          </div>
        </div>
        <div class="form-check" >
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input" onclick="mudarEstado('registro1')" id="check1">Registrar no Livro
          </label>
        </div>
        <div id="registro1">
          <div class="row">
            <div class="form-group col-md-3">
              <label>Registros por página:</label>
                <input type="number" class="form-control"  name="arquivo['reg_pagina']">
            </div>
            <div class="form-group col-md-3">
              <label>Linha da pagina atual:</label>
              <input type="number" class="form-control"  name="arquivo['linha']">
            </div>
            <div class="form-group col-md-3">
              <label>Página:</label>
              <input type="number" class="form-control"  name="arquivo['pagina']">
            </div>
            <div class="form-group col-md-3">
              <label>Livro:</label>
              <input type="number" class="form-control"  name="arquivo['livro']">
            </div>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="form-group col-md-6">
		        <p>Frente do Certificado:</p>
    	      <input type="file" class="form-control-file"  name="arquivo1" required>
          </div>
	        <div class="form-group col-md-6">
            <p>Verso do Certificado:</p>
            <input type="file" class="form-control-file"  name="arquivo2" required>
  	 
          </div>
        </div>
        <div class="mt-3">
          <button type="submit" class="btn btn-primary" formtarget="_blank">Enviar</button>
        </div>
    </form>
  </div>

  <!-- CREDENCIAL -->
  <div id="credencial">
      <form action="credencial.php" method="post" enctype="multipart/form-data" >
        <center>
           <div class="form-group">
              Frente:<br>
              <img src="../imagens/credencial.jpg" width="50%">
            </div>
        </center>

          <div class="form-group">
            <label>Credencial/Premio:</label>
            <select class="form-control" name="arquivo['tipo']" required>
              <option value="">Escolha Credencial/Prêmio</option>
              <option value="1">Credencial</option>
              <option value="2">Prêmio</option>
            </select>
          </div>
          <div class="form-group">
            <label>Trabalho:</label>
            <select class="form-control" name="arquivo['id_projeto']" size="7" required>
              <?php
                foreach ($projetos as $projeto) {
                  echo "<option value='".$projeto['id_projeto']."'>";
                  echo $projeto['titulo']."</option>";
                }
              ?>
            </select>
          </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label>Evento/Cortesia:</label>
            <input type="text" class="form-control" name="arquivo['evento']" required>
          </div>
          <div class="form-group col-md-6">
            <label>Cidade/Empresa:</label>
            <input type="text" class="form-control" name="arquivo['cidade']" required>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label>Local/Campus:</label>
            <input type="text" class="form-control" name="arquivo['campus']" required>
          </div>
          <div class="form-group col-md-6">
            <label>Data:</label>
            <input type="date" class="form-control" placeholder="dd/mm/aaaa" name="arquivo['data']" required>
          </div>
        </div>
        
        <br>
        <div class="row">
          <div class="form-group col-md-6">
            <p>Frente do Certificado:</p>
            <input type="file" class="form-control-file"  name="arquivo1" required>
          </div>
        </div>
        <div class="mt-3">
          <button type="submit" class="btn btn-primary" formtarget="_blank">Enviar</button>
        </div>
    </form>
  </div>

  <!-- CERTIFICADO AVALIADORES -->
      <div id="avaliadores">
      <form action="avaliadores.php" method="post" enctype="multipart/form-data" >
        <div class="row">
          <div class="form-group col-md-6">
            Frente:
            <img src="../imagens/avalfrente.jpg" width="100%">
          </div>
          <div class="form-group col-md-6">
            Verso:
            <img src="../imagens/avalverso.jpg" width="100%">
          </div>
        </div>
        <div class="form-group">
           <label>Texto:</label>
           <textarea class="form-control" rows="4" name="arquivo['texto']" required>Exemplo: participou como avaliador(a) na VIII Feira de Ciências e Tecnologia da Fronteira, FECIFRON 2020, realizada pelo Instituto Federal de Educação, Ciência e Tecnologia de Mato Grosso do Sul, campus Ponta Porã, nos dias 19 e 20 de outubro de 2020.</textarea>
        </div>
        <div class="row">
          <div class="form-group col-md-4">
            <label>Local/Campus:</label>
            <input type="text" class="form-control" name="arquivo['campus']" required>
          </div>
          <div class="form-group col-md-4">
            <label>Data:</label>
            <input type="date" class="form-control" placeholder="dd/mm/aaaa" name="arquivo['data']" required>
          </div>
       
          <div class="form-group col-md-4">
            <label>Último Registro:</label>
            <input type="number" class="form-control" name="arquivo['ult_registro']">
          </div>
        </div>
        <div class="form-check" >
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="arquivo['trabalhos']">Mostrar Trabalhos Avaliados
          </label>
        </div>
        <div class="form-check" >
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input" onclick="mudarEstado('registro2')" id="check2">Registrar no Livro
          </label>
        </div>
        <div id="registro2">
          <div class="row">
            <div class="form-group col-md-3">
              <label>Registros por página:</label>
                <input type="number" class="form-control"  name="arquivo['reg_pagina']">
            </div>
            <div class="form-group col-md-3">
              <label>Linha da pagina atual:</label>
              <input type="number" class="form-control"  name="arquivo['linha']">
            </div>
            <div class="form-group col-md-3">
              <label>Página:</label>
              <input type="number" class="form-control"  name="arquivo['pagina']">
            </div>
            <div class="form-group col-md-3">
              <label>Livro:</label>
              <input type="number" class="form-control"  name="arquivo['livro']">
            </div>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="form-group col-md-6">
            <p>Frente do Certificado:</p>
            <input type="file" class="form-control-file"  name="arquivo1" required>
          </div>
          <div class="form-group col-md-6">
            <p>Verso do Certificado:</p>
            <input type="file" class="form-control-file"  name="arquivo2" required>
     
          </div>
        </div>
        <div class="mt-3">
          <button type="submit" class="btn btn-primary" formtarget="_blank">Enviar</button>
        </div>
    </form>
  </div>

    <!-- CERTIFICADO PARTICIPAÇÃO -->
      <div id="participacao">
      <form action="participacao.php" method="post" enctype="multipart/form-data" >
        <div class="row">
          <div class="form-group col-md-6">
            Frente:
            <img src="../imagens/partfrente.jpg" width="100%">
          </div>
          <div class="form-group col-md-6">
            Verso:
            <img src="../imagens/2premio.jpg" width="100%">
          </div>
        </div>
        <div class="form-group">
           <label>Texto:</label>
           <textarea class="form-control" rows="4" name="arquivo['texto']" required>Exemplo: foi apresentado na VIII Feira de Ciências e Tecnologia da Fronteira, FECIFRON 2020, realizada nos dias 19 e 20 de outubro 2020.</textarea>
        </div>
        <div class="row">
          <div class="form-group col-md-4">
            <label>Local/Campus:</label>
            <input type="text" class="form-control" name="arquivo['campus']" required>
          </div>
          <div class="form-group col-md-4">
            <label>Data:</label>
            <input type="date" class="form-control" placeholder="dd/mm/aaaa" name="arquivo['data']" required>
          </div>
       
          <div class="form-group col-md-4">
            <label>Último Registro:</label>
            <input type="number" class="form-control" name="arquivo['ult_registro']">
          </div>
        </div>
        <div class="form-check" >
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input" onclick="mudarEstado('registro3')" id="check3">Registrar no Livro
          </label>
        </div>
        <div id="registro3">
          <div class="row">
            <div class="form-group col-md-3">
              <label>Registros por página:</label>
                <input type="number" class="form-control"  name="arquivo['reg_pagina']">
            </div>
            <div class="form-group col-md-3">
              <label>Linha da pagina atual:</label>
              <input type="number" class="form-control"  name="arquivo['linha']">
            </div>
            <div class="form-group col-md-3">
              <label>Página:</label>
              <input type="number" class="form-control"  name="arquivo['pagina']">
            </div>
            <div class="form-group col-md-3">
              <label>Livro:</label>
              <input type="number" class="form-control"  name="arquivo['livro']">
            </div>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="form-group col-md-6">
            <p>Frente do Certificado:</p>
            <input type="file" class="form-control-file"  name="arquivo1" required>
          </div>
          <div class="form-group col-md-6">
            <p>Verso do Certificado:</p>
            <input type="file" class="form-control-file"  name="arquivo2" required>
     
          </div>
        </div>
        <div class="mt-3">
          <button type="submit" class="btn btn-primary" formtarget="_blank">Enviar</button>
        </div>
    </form>
  </div>
	</div>
	
	  <!-- tentando arrumar o fomulario-->
	

<?php include(FOOTER_TEMPLATE); ?>
