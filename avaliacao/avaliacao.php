<?php
	require_once('functions.php');
	
	if(!empty($_SESSION['tipo'])){
		findUsuario($_SESSION['id_user']);
		if(!empty($_POST['projeto'])){
			$projeto = $_POST['projeto'];
			getItens($projeto["'id_projeto'"]);
		}
?>

<?php include(HEADER_TEMPLATE); 
header('location: '.BASEURL.'index.php');
?>
<script src="../cdn/js/avaliacao.js" type="text/javascript"></script>
<script>
function desativar(el1,el2) {
  document.getElementById(el1).style.display = 'none';
  document.getElementById(el2).value = '';
  document.getElementById(el2).required = false;
}
function mudarEstado(el1,el2) {
  var display = document.getElementById(el1).style.display;
  if(display == "none"){
    document.getElementById(el1).style.display = 'block';
    document.getElementById(el2).required = true;
  }else{
   document.getElementById(el1).style.display = 'none';
   document.getElementById(el2).value = '';
   document.getElementById(el2).required = false;
	}
}
window.onload=function(){
  desativar("ambiental","campoambiental");
}
</script>
<div class="container">
	<h2 class="text-center">AVALIAÇÃO</h2>

	<hr />
		<div class="row">
			<div class="form-group col-md-7">
				<label for="id_avaliador">Avaliador: <?php echo ucwords(mb_strtolower($_SESSION['user'])); ?> </label>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-7">
				<label for="id_area">Área: <?php echo $area['nome']; ?> </label>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-7">
				<label for="id_Titulo">Nível:
					<?php if($projetoAval['nivel']==1)
							echo "Fundamental";
						  else
							echo "Médio/Técnico";
					?>
				</label>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-7">
				<label for="id_Titulo">Eixo:
					<?php if($projetoAval['eixo']==1)
							echo "Científico";
						  else
							echo "Tecnológico";
					?>
				</label>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-7">
				<label for="id_Titulo">Título: <?php echo $projetoAval['titulo']; ?> </label>
			</div>
		</div>

		<div class="row">
			<div class="form-group col-md-7">
				<label for="id_avaliador">Estudante(s):<br>
					<?php
						echo $autores[1]['nome']."<br>".$autores[2]['nome']."<br>".$autores[3]['nome'];
					?>
				</label>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-7">
				<label for="id_avaliador">Orientador: <?php echo ucwords(mb_strtolower($autores[5]['nome'])); ?> </label>
			</div>
		</div>
		<?php if($autores[4]['nome']){ ?>
		<!-- SE TIVER COOERIENTADOR -->
			<div class="row">
				<div class="form-group col-md-7">
					<label for="id_avaliador">Coorientador: <?php echo ucwords(mb_strtolower($autores[4]['nome'])); ?> </label>
				</div>
			</div>
		<?php } ?>


	<form  action="salvarAvaliacao.php" method="post">
		<div class="row">
			<div class="form-group col-md-5">
				<input type="hidden" class="form-control"  id="avaliador" name="avaliacao['fk_usuario']" value="<?php echo $_SESSION['id_user']; ?>">
				<input type="hidden" class="form-control"  id="projeto" name="avaliacao['fk_projeto']" value="<?php echo $projetoAval['id_projeto']; ?>">
			</div>
		</div>
	    <div class="row">
	    	<?php if($projetoAval['eixo']==1){ ?>
				<div class="form-group col-md-12 bg-success text-white text-center">
					<label for="n1"> CRITÉRIOS PARA AVALIAÇÃO DE PESQUISA CIENTÍFICA </label>
				</div>
			<?php }else{ ?>
				<div class="form-group col-md-12 bg-success text-white text-center">
					<label for="n1"> CRITÉRIOS PARA AVALIAÇÃO DE PESQUISA TECNOLÓGICA </label>
				</div>
			<?php } ?>
		</div>
		<div class="row">
			<div class="form col-md-12">
				<?php if($projetoAval['eixo']==1){ ?>
					<label for="n1" class="col-md-12 bg-info text-white" >
						<details>
							<summary>Problema/hipótese:</summary>
							  <div class="container-fluid bg-info">
							  	<p class="text-white">delimitação do tema, relação hipótese/problema/objetivo; clareza na formulação; originalidade; relevância social. </p>
							  </div>
						</details>
					</label>
				<?php }else{ ?>
					<label for="n1" class="col-md-12 bg-info text-white" >
						<details>
							<summary>Problema:</summary>
							<div class="container-fluid bg-info">
								<p class="text-white">definição clara do problema; alternativas de solução relacionando com teorias e conceitos tecnológicos; originalidade; relevância social.</p>
							</div>
						</details>
					</label>

				<?php } ?>

				<select class="form-control mb-2 col-md-12"  id="n1" name="avaliacao['n1']" required>
					<option value=""> Insira a nota </option>
					<option value="100"> EXCELENTE - Atende a todos os requisitos com perfeição</option>
					<option value="90"> EXCELENTE COM RESSALVAS – Atende a maioria dos requisitos com perfeição</option>
					<option value="80"> ÓTIMO – Atende alguns requisitos com perfeição</option>
					<option value="75"> MUITO BOM – Atende ao menos um item com perfeição</option>
					<option value="70"> BOM – Atende todos os requisitos parcialmente.</option>
					<option value="60"> BOM COM RESSALVAS – Atende a maioria dos requisitos parcialmente.</option>
					<option value="50"> REGULAR – Atende alguns requisitos parcialmente.</option>
					<option value="30"> INSUFICIENTE – Não atende aos itens.</option>
				</select>

				<?php if($projetoAval['eixo']==1){ ?>
					<label for="n2" class="col-md-12 bg-info text-white" >
						<details>
							<summary>Coleta de dados/metodologia:</summary>
							<div class="container-fluid bg-info">
								<p class="text-white">metodologia utilizada; seleção/aplicação de instrumentos de coleta; seleção da amostra (amostragem); análise e interpretação dos dados. </p>
							</div>
						</details>
					</label>
				<?php }else{ ?>
					<label for="n2" class="col-md-12 bg-info text-white" >
						<details>
							<summary>Elaboração do projeto/metodologia:</summary>
							<div class="container-fluid bg-info">
								<p class="text-white">conhecimento científico e tecnológico; materiais e métodos; análises e interpretações de dados.</p>
							</div>
						</details>
					</label>
				<?php } ?>

				<select class="form-control mb-2 col-md-12"  id="n2" name="avaliacao['n2']" required>
					<option value=""> Insira a nota </option>
					<option value="100"> EXCELENTE - Atende a todos os requisitos com perfeição</option>
					<option value="90"> EXCELENTE COM RESSALVAS – Atende a maioria dos requisitos com perfeição</option>
					<option value="80"> ÓTIMO – Atende alguns requisitos com perfeição</option>
					<option value="75"> MUITO BOM – Atende ao menos um item com perfeição</option>
					<option value="70"> BOM – Atende todos os requisitos parcialmente.</option>
					<option value="60"> BOM COM RESSALVAS – Atende a maioria dos requisitos parcialmente.</option>
					<option value="50"> REGULAR – Atende alguns requisitos parcialmente.</option>
					<option value="30"> INSUFICIENTE – Não atende aos itens.</option>
				</select>

				<?php if($projetoAval['eixo']==1){ ?>
					<label for="n3" class="col-md-12 bg-info text-white" >
						<details>
							<summary>Considerações finais: </summary>
							<div class="container-fluid bg-info">
							 	<p class="text-white">relação com o problema e objetivos; pertinência com os resultados; análise a partir das hipóteses elaboradas.</p>
							 </div>
						</details>
					</label>
				<?php }else{ ?>
					<label for="n3" class="col-md-12 bg-info text-white " >
						<details>
							<summary>Produto/Processo: </summary>
						 	<div class="container-fluid bg-info">
							  	<p class="text-white">definição do produto e/ou processo; construção do protótipo e/ou gestão de processo; resposta à necessidade inicial; viabilidade técnica do projeto/custo-benefício; nível de inovação/ impacto técnico-científico. </p>
							</div>
						</details>
					</label>
				<?php } ?>

				<select class="form-control mb-2 col-md-12"  id="n3" name="avaliacao['n3']" required>
					<option value=""> Insira a nota </option>
					<option value="100"> EXCELENTE - Atende a todos os requisitos com perfeição</option>
					<option value="90"> EXCELENTE COM RESSALVAS – Atende a maioria dos requisitos com perfeição</option>
					<option value="80"> ÓTIMO – Atende alguns requisitos com perfeição</option>
					<option value="75"> MUITO BOM – Atende ao menos um item com perfeição</option>
					<option value="70"> BOM – Atende todos os requisitos parcialmente.</option>
					<option value="60"> BOM COM RESSALVAS – Atende a maioria dos requisitos parcialmente.</option>
					<option value="50"> REGULAR – Atende alguns requisitos parcialmente.</option>
					<option value="30"> INSUFICIENTE – Não atende aos itens.</option>
				</select>

			</div>
		</div>

		<div class="row">

			<div class="form col-md-12">
				<label for="n4" class="col-md-12 bg-info text-white" >
					<details>
						<summary>Resumo Expandido:</summary>
							<div class="container-fluid bg-info">
							  <p class="text-white">clareza na redação; linguagem científica; conteúdo. </p>
							</div>
					</details>
				</label>
				<select class="form-control mb-2 col-md-12" id="n4" name="avaliacao['n4']" required>
					<option value=""> Insira a nota </option>
					<option value="100"> EXCELENTE - Atende a todos os requisitos com perfeição</option>
					<option value="90"> EXCELENTE COM RESSALVAS – Atende a maioria dos requisitos com perfeição</option>
					<option value="80"> ÓTIMO – Atende alguns requisitos com perfeição</option>
					<option value="75"> MUITO BOM – Atende ao menos um item com perfeição</option>
					<option value="70"> BOM – Atende todos os requisitos parcialmente.</option>
					<option value="60"> BOM COM RESSALVAS – Atende a maioria dos requisitos parcialmente.</option>
					<option value="50"> REGULAR – Atende alguns requisitos parcialmente.</option>
					<option value="30"> INSUFICIENTE – Não atende aos itens.</option>
				</select>
				<label for="n5" class="col-md-12 bg-info text-white" >
					<details>
						<summary>Vídeo Produzido:</summary>
							<div class="container-fluid bg-info">
							  <p class="text-white">deve ser produzido com boa qualidade visual, áudio e imagens claros e definidos. Apresentar domínio do assunto; capacidade de síntese; uso adequado da linguagem; disposição para defesa do trabalho. </p>
							</div>
					</details>
				</label>
				<select class="form-control mb-2 col-md-12"  id="n5" name="avaliacao['n5']" required>
					<option value=""> Insira a nota </option>
					<option value="100"> EXCELENTE - Atende a todos os requisitos com perfeição</option>
					<option value="90"> EXCELENTE COM RESSALVAS – Atende a maioria dos requisitos com perfeição</option>
					<option value="80"> ÓTIMO – Atende alguns requisitos com perfeição</option>
					<option value="75"> MUITO BOM – Atende ao menos um item com perfeição</option>
					<option value="70"> BOM – Atende todos os requisitos parcialmente.</option>
					<option value="60"> BOM COM RESSALVAS – Atende a maioria dos requisitos parcialmente.</option>
					<option value="50"> REGULAR – Atende alguns requisitos parcialmente.</option>
					<option value="30"> INSUFICIENTE – Não atende aos itens.</option>
				</select>

				<div class="form-group col-md-12 bg-success text-white text-center">
					<label for="n1"> CRITÉRIOS DE AVALIAÇÕES ESPECIAIS </label>
				</div>
				<?php if($projetoAval['eixo']==2){ ?>
					<label for="n7" class="col-md-12 bg-info text-white" >
						<details>
							<summary>Inovação Tecnológica:</summary>
								<div class="container-fluid bg-info">
								  <p class="text-white">Projetos de inovação tecnológica, especificamente, trabalham com a criação de novos produtos ou processos a partir dos avanços em ferramentas, as quais podem ser incorporadas à organização ou criadas por ela. </p>
								</div>
						</details>
					</label>
					<select class="form-control mb-2 col-md-12"  id="n7" name="avaliacao['n7']" required>
						<option value=""> Insira a nota </option>
						<option value="0"> NÃO SE APLICA </option>
						<option value="100"> EXCELENTE - Atende a todos os requisitos com perfeição</option>
						<option value="90"> EXCELENTE COM RESSALVAS – Atende a maioria dos requisitos com perfeição</option>
						<option value="80"> ÓTIMO – Atende alguns requisitos com perfeição</option>
						<option value="75"> MUITO BOM – Atende ao menos um item com perfeição</option>
						<option value="70"> BOM – Atende todos os requisitos parcialmente.</option>
						<option value="60"> BOM COM RESSALVAS – Atende a maioria dos requisitos parcialmente.</option>
						<option value="50"> REGULAR – Atende alguns requisitos parcialmente.</option>
						<option value="30"> INSUFICIENTE – Não atende aos itens.</option>
					</select>
				<?php } ?>
				<label for="n6" class="col-md-12 bg-info text-white" >
					<details>
						<summary>Impacto Socioambiental:</summary>
							<div class="container-fluid bg-info">
							  <p class="text-white">Projetos que tenham um cunho ambiental e social que visem conscientizar e minimizar os impactos ambientais causados pela ação do homem </p>
							</div>
					</details>
				</label>
				<select class="form-control mb-2 col-md-12"  id="campoambiental" name="avaliacao['n6']">
					<option value=""> Insira a nota </option>
				    <option value="0"> NÃO SE APLICA </option>
					<option value="100"> EXCELENTE - Atende a todos os requisitos com perfeição</option>
					<option value="90"> EXCELENTE COM RESSALVAS – Atende a maioria dos requisitos com perfeição</option>
					<option value="80"> ÓTIMO – Atende alguns requisitos com perfeição</option>
					<option value="75"> MUITO BOM – Atende ao menos um item com perfeição</option>
					<option value="70"> BOM – Atende todos os requisitos parcialmente.</option>
					<option value="60"> BOM COM RESSALVAS – Atende a maioria dos requisitos parcialmente.</option>
					<option value="50"> REGULAR – Atende alguns requisitos parcialmente.</option>
					<option value="30"> INSUFICIENTE – Não atende aos itens.</option>
				</select>
			</div>
		</div>
		<br/>
		<div id="actions" class="row">
			<div class="col-md-12">
				<button type="submit" id="enviar" class="btn btn-primary" onclick="return confirm('Deseja enviar essa avaliação?')"><i class="fa fa-envelope"></i> Enviar Avaliação</button>

				<a href="index.php" class="btn btn-default">Cancelar</a>
			</div>
		</div>
	</form>

	<br>
	<div class="container">
	<?php

	}else{
		header('location: '.BASEURL);
	}
	?>
	</div>
</div>
<?php include(FOOTER_TEMPLATE); ?>
