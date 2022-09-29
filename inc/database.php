<?php
mysqli_report(MYSQLI_REPORT_STRICT);
//abre o banco de dados
function open_database() {
	try {
		$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		$conn->set_charset('utf8');
		return $conn;
	} catch (Exception $e) {
		echo $e->getMessage();
		return null;
	}
}
//fecha o banco de dados
function close_database($conn) {
	try {
		mysqli_close($conn);
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}
//encontrar por ID ou retorna Todos
function find( $table = null, $id = null ) {
	$database = open_database();
	$found = null;
	try {
		if ($id) {
			$sql = "SELECT * FROM " . $table . " WHERE  id = " . $id;
			$result = $database->query($sql);
			if ($result->num_rows > 0) {
				$found = $result->fetch_assoc();
			}
		} else {
			$sql = "SELECT * FROM " . $table;
			$result = $database->query($sql);
			if ($result->num_rows > 0) {
				$found = $result->fetch_all(MYSQLI_ASSOC);
			}
		}
		//exibe a mensagem 'danger'
	} catch (Exception $e) {
		$_SESSION['message'] = $e->GetMessage();
		$_SESSION['type'] = 'danger';
	}
	close_database($database);
	return $found;
}

function totalDeRegistros( $table = null) {
	$database = open_database();
	$found = null;
	try {
			$sql = "SELECT * FROM " . $table;
			$result = $database->query($sql);
			$found = $result->num_rows;
	} catch (Exception $e) {
		$_SESSION['message'] = $e->GetMessage();
		$_SESSION['type'] = 'danger';
	}
	close_database($database);
	return $found;
}


function projeto_area($id = null) {
	$database = open_database();
	$found = null;
	try {
		$sql = "select p.titulo, a.nome, p.nivel, p.convidado, p.eixo, p.id_projeto from projeto as p join area as a on p.fk_area = a.id_area";
		if($id){
			$sql .= " where id_projeto = ".$id." ORDER BY p.titulo";
			$result = $database->query($sql);
			if ($result->num_rows > 0) {
				$found = $result->fetch_assoc();
			}
		}else{
			$sql .= " ORDER BY p.titulo";
			$result = $database->query($sql);
			if ($result->num_rows > 0) {
				$found = $result->fetch_all(MYSQLI_ASSOC);
			}
		}
		//exibe a mensagem 'danger'
	} catch (Exception $e) {
		$_SESSION['message'] = $e->GetMessage();
		$_SESSION['type'] = 'danger';
	}
	close_database($database);
	return $found;
}

function allAvalAdmin($table){
	$database = open_database();
	$found = null;
	try {
		$sql = "select fk_usuario, nome from usuario as u join ".$table." as a on a.fk_usuario = u.id_usuario ORDER BY nome";
		$result = $database->query($sql);
		if ($result->num_rows > 0) {
			$found = $result->fetch_all(MYSQLI_ASSOC);
		}
	} catch (Exception $e) {
		$_SESSION['message'] = $e->GetMessage();
		$_SESSION['type'] = 'danger';
	}
	close_database($database);
	return $found;
}

function allusers(){
	$database = open_database();
	$found = null;
	try {
		$sql = "select * from usuario ORDER BY nome";
		$result = $database->query($sql);
		if ($result->num_rows > 0) {
			$found = $result->fetch_all(MYSQLI_ASSOC);
		}
		//exibe a mensagem 'danger'
	} catch (Exception $e) {
		$_SESSION['message'] = $e->GetMessage();
		$_SESSION['type'] = 'danger';
	}
	close_database($database);
	return $found;
}

function allAvaliadores(){
	$database = open_database();
	$found = null;
	try {
		$sql = "select u.nome,u.id_usuario from usuario as u join avaliacao as a on a.fk_usuario = u.id_usuario GROUP BY a.fk_usuario ORDER BY u.nome";
		$result = $database->query($sql);
		if ($result->num_rows > 0) {
			$found = $result->fetch_all(MYSQLI_ASSOC);
		}
		//exibe a mensagem 'danger'
	} catch (Exception $e) {
		$_SESSION['message'] = $e->GetMessage();
		$_SESSION['type'] = 'danger';
	}
	close_database($database);
	return $found;
}

function avaliadorProjetos($id){
	$database = open_database();
	$found = null;
	try {
		$sql = "select p.titulo, a.id_avaliacao, p.id_projeto from projeto as p join avaliacao as a on a.fk_projeto = p.id_projeto WHERE a.fk_usuario = ".$id." ORDER BY p.titulo";
		$result = $database->query($sql);
		if ($result->num_rows > 0) {
			$found = $result->fetch_all(MYSQLI_ASSOC);
		}
		//exibe a mensagem 'danger'
	} catch (Exception $e) {
		$_SESSION['message'] = $e->GetMessage();
		$_SESSION['type'] = 'danger';
	}
	close_database($database);
	return $found;
}

function projeto_usuario($id = null) {
	$database = open_database();
	$found = null;
	try {
		$sql = "select u.nome, pu.tipo, u.id_usuario from projeto_usuario as pu join usuario as u on pu.fk_usuario = u.id_usuario";
		$sql .= " where fk_projeto = ".$id." ORDER BY pu.tipo DESC";
		$result = $database->query($sql);
		if ($result->num_rows > 0) {
			$found = $result->fetch_all(MYSQLI_ASSOC);
		}
		//exibe a mensagem 'danger'
	} catch (Exception $e) {
		$_SESSION['message'] = $e->GetMessage();
		$_SESSION['type'] = 'danger';
	}
	close_database($database);
	return $found;
}

//conta o numero de avaliações para cada avaliador.
function contarAvaliacao(){
	$database = open_database();
	$found = array();
	$sql = "Select a.nome as nome, count(av.fk_avaliador) as total from avaliacao as av join avaliador as a on av.fk_avaliador = a.id_avaliador group by av.fk_avaliador order by nome";
		$result = $database->query($sql);
		if ($result->num_rows > 0) {

			while ($row = $result->fetch_assoc()) {
				array_push($found, $row);
			}
		}
	close_database($database);
	return $found;

}

//todos os projetos por área
function listaTrabalhos(){
	$database = open_database();
	$found = array();
	$sql = "Select titulo, nome from projeto as p join area as a on p.fk_area=a.id_area order by nome";
		$result = $database->query($sql);
		if ($result->num_rows > 0) {

			while ($row = $result->fetch_assoc()) {
				array_push($found, $row);
			}
		}
	close_database($database);
	return $found;
}
function numAvaliacoes(){
	$database = open_database();
	$found = null;
	try{
		$sql = "SELECT count(id_projeto) as total from projeto WHERE num_aval < 3;";
		$result = $database->query($sql);
		$found = $result->fetch_assoc();
	}catch (Exception $e) {
		$_SESSION['message'] = $e->GetMessage();
		$_SESSION['type'] = 'danger';
	}
	return $found;
}


//Retorna o ultimo ID adicionado
function selectMaxId($table){
	$database = open_database();
	$found = null;
	try{
		$sql = "SELECT MAX(id_".$table.") as id_".$table." from ".$table.";";
		$result = $database->query($sql);
		$found = $result->fetch_assoc();
	}catch (Exception $e) {
		$_SESSION['message'] = $e->GetMessage();
		$_SESSION['type'] = 'danger';
	}
	return $found;
}
//busca os projetos no banco de dados
function findProjetos($table = null, $coluna = null, $id=null){
	$database = open_database();
	$found = null;
	try {
		$found = array();
		$sql = "SELECT * FROM " . $table . " WHERE ". $coluna ." = " . $id . " and num_aval = 0 order by titulo";
		$result = $database->query($sql);
		if ($result->num_rows > 0) {

			while ($row = $result->fetch_assoc()) {
				array_push($found, $row);
			}
		}
		$sql = "SELECT * FROM " . $table . " WHERE ". $coluna ." = " . $id . " and num_aval = 1 order by titulo";
		$result = $database->query($sql);
		if ($result->num_rows > 0) {

			while ($row = $result->fetch_assoc()) {
				array_push($found, $row);
			}
		}
		$sql = "SELECT * FROM " . $table . " WHERE ". $coluna ." = " . $id . " and num_aval = 2 order by titulo";
		$result = $database->query($sql);
		if ($result->num_rows > 0) {

			while ($row = $result->fetch_assoc()) {
				array_push($found, $row);
			}
		}
		$sql = "SELECT * FROM " . $table . " WHERE ". $coluna ." = " . $id . " and num_aval > 2 order by titulo";
		$result = $database->query($sql);
		if ($result->num_rows > 0) {

			while ($row = $result->fetch_assoc()) {
				array_push($found, $row);
			}
		}
	} catch (Exception $e) {
		$_SESSION['message'] = $e->GetMessage();
		$_SESSION['type'] = 'danger';
	}
	close_database($database);
	return $found;
}
//faz a contagem de avaliadores
function contarAval(){
	$database = open_database();
	$found = null;
	$resultado	= array();
	try {
		$sql = "SELECT count(num_aval) as total FROM projeto WHERE num_aval>=3";
		$result = $database->query($sql);
		if ($result->num_rows > 0) {
			$found = $result->fetch_assoc();
		}
		array_push($resultado,$found);
	} catch (Exception $e) {
		$_SESSION['message'] = $e->GetMessage();
		$_SESSION['type'] = 'danger';
	}
	try {
		$sql = "SELECT count(id_projeto) as projeto FROM projeto";
		$result = $database->query($sql);
		if ($result->num_rows > 0) {
			$found = $result->fetch_assoc();
		}
		array_push($resultado,$found);
	} catch (Exception $e) {
		$_SESSION['message'] = $e->GetMessage();
		$_SESSION['type'] = 'danger';
	}
	close_database($database);
	return $resultado;
}

//encontrar itens por igualdade em uma coluna
function findAnyThing($table = null, $coluna = null, $id = null){
	$database = open_database();
	$found = null;
	try {
		$sql = "SELECT * FROM " . $table . " WHERE ". $coluna ." = " . $id;
		$result = $database->query($sql);
		if ($result->num_rows > 0) {
			$found = $result->fetch_assoc();
		}
	} catch (Exception $e) {
		$_SESSION['message'] = $e->GetMessage();
		$_SESSION['type'] = 'danger';
	}
	close_database($database);
	return $found;
}

function pegarAreaAval($id = null){
	$database = open_database();
	$found = null;
	try {
		$sql = "SELECT id_area, nome FROM area as a join area_avaliador as av ON av.fk_area = a.id_area WHERE av.fk_usuario = " . $id;
		$result = $database->query($sql);
		if ($result->num_rows > 0) {
			$found = $result->fetch_all(MYSQLI_ASSOC);
		}
	} catch (Exception $e) {
		$_SESSION['message'] = $e->GetMessage();
		$_SESSION['type'] = 'danger';
	}
	close_database($database);
	return $found;
}

function pesquisaAvaliacao($table = null, $coluna = null, $id = null){
	$database = open_database();
	$found = null;
	try {
		$sql = "SELECT * FROM " . $table . " WHERE ". $coluna ." = " . $id;
		$result = $database->query($sql);
		if ($result->num_rows > 0) {
			$found = array();
				while ($row = $result->fetch_assoc()) {
					array_push($found, $row);
				}
		}
	} catch (Exception $e) {
		$_SESSION['message'] = $e->GetMessage();
		$_SESSION['type'] = 'danger';
	}
	close_database($database);
	return $found;
}

//retorna todos os itens da tabela
function find_all( $table ) {
	return find($table);
}
//adiciona uma avaliação
function addAvaliacao($id){
	$database = open_database();
	try {
		$sql = "UPDATE projeto SET num_aval = num_aval+1 WHERE id_projeto = " . $id;
		$database->query($sql);
	}catch (Exception $e) {
		$_SESSION['message'] = $e->GetMessage();
		$_SESSION['type'] = 'danger';
	}
	close_database($database);
}

//adiciona uma avaliação
function decrementaAvaliacao($id){
	$database = open_database();
	try {
		$sql = "UPDATE projeto SET num_aval = num_aval-1 WHERE id_projeto = " . $id;
		$database->query($sql);
	}catch (Exception $e) {
		$_SESSION['message'] = $e->GetMessage();
		$_SESSION['type'] = 'danger';
	}
	close_database($database);
}
//buscas as avaliações feitas
function findAvaliacoes($table){
	$database = open_database();
	$found = null;
	try {
		$sql = "SELECT fk_usuario,fk_projeto,n1,n2,n3,n4,n5,n6,n7,n8 FROM " . $table ." order by fk_projeto";
		$result = $database->query($sql);
		if ($result->num_rows > 0) {
			$found = $result->fetch_all(MYSQLI_ASSOC);
		}
	}catch (Exception $e) {
		$_SESSION['message'] = $e->GetMessage();
		$_SESSION['type'] = 'danger';
	}
	close_database($database);
	return $found;
}
//busca os estudantes do projeto
function findUsuariosProjetos($id=null,$tipo=null){
	$database = open_database();
	$found = null;

	try {
		$sql = "SELECT u.nome FROM usuario as u inner join projeto_usuario as pu on u.id_usuario = pu.fk_usuario
		inner join projeto as p on pu.fk_projeto = p.id_projeto where p.id_projeto = ".$id." and pu.tipo = ".$tipo.";";
		$result = $database->query($sql);
		if ($result->num_rows > 0) {
			$found = array();
			while ($row = $result->fetch_assoc()) {
				array_push($found, $row);
			}
		}

	} catch (Exception $e) {
		$_SESSION['message'] = $e->GetMessage();
		$_SESSION['type'] = 'danger';
	}
	close_database($database);
	return $found;
}

//faz a busca pelo 	titulo
function pegarTitulo($id=null){
	$database = open_database();
	$found = null;

	try {
		$sql = "SELECT titulo FROM projeto where id_projeto = ".$id;
		$result = $database->query($sql);
		if ($result->num_rows > 0) {
			$found = $result->fetch_assoc();

		}
	} catch (Exception $e) {
		$_SESSION['message'] = $e->GetMessage();
		$_SESSION['type'] = 'danger';
	}
	close_database($database);
	return $found;
}


//retorna pesquisa por coluna usando o LIKE
function findList($table=null, $coluna=null, $pesquisa=null){
	$database = open_database();
	$found = null;

	try {
		if ($pesquisa) {
			$sql = "SELECT * FROM " . $table . " WHERE ".$coluna." like '".$pesquisa."%'";
			$result = $database->query($sql);
			if ($result->num_rows > 0) {
				$found = array();
				while ($row = $result->fetch_assoc()) {
					array_push($found, $row);
				}
			}
		}
	} catch (Exception $e) {
		$_SESSION['message'] = $e->GetMessage();
		$_SESSION['type'] = 'danger';
	}
	close_database($database);
	return $found;
}
//pega a area do projeto
function pegarNomeArea($id){
	$database = open_database();
	$found = null;

	try {

			$sql = "SELECT nome FROM area where id_area = ".$id;
			$result = $database->query($sql);
			if ($result->num_rows > 0) {
				$found = $result->fetch_assoc();
			}

	} catch (Exception $e) {
		$_SESSION['message'] = $e->GetMessage();
		$_SESSION['type'] = 'danger';
	}
	close_database($database);
	return $found;
}
//retorna os 10 ultimos adicionados
function topDez($table=null){
	$database = open_database();
	$found = null;

	try {
		if ($table) {

			$sql = "SELECT * FROM ".$table." ORDER BY id DESC Limit 10;";
			$result = $database->query($sql);
			if ($result->num_rows > 0) {
				$found = array();
				while ($row = $result->fetch_assoc()) {
					array_push($found, $row);
				}
			}
		}
	} catch (Exception $e) {
		$_SESSION['message'] = $e->GetMessage();
		$_SESSION['type'] = 'danger';
	}
	close_database($database);
	return $found;
}

//media nota

function notasTodos(){
	$database = open_database();
	$found = null;

	try {
		$found = array();
		//medio, area 1 = ciências biologicas e da saúde, sem resultado
		$sql = "SELECT fk_area,a.fk_projeto, p.nivel,p.convidado, avg(n1) as m1, avg(n2) as m2, avg(n3) as m3,
						avg(n4) as m4, avg(n5) as m5,	avg(n6) as m6, avg(n7) as m7, avg(n8) as m8, avg(n9) as m9
						from avaliacao as a inner join projeto as p on a.fk_projeto = p.id_projeto
						where p.fk_area = 1 AND p.nivel = 2 AND p.convidado = 0 GROUP BY a.fk_projeto";
		$result = $database->query($sql);
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				array_push($found, $row);
			}
		}
			//médio, area 2 = Ciências Exatas e da Terra, sem resultado
		$sql = "SELECT fk_area,a.fk_projeto, p.nivel,p.convidado, avg(n1) as m1, avg(n2) as m2, avg(n3) as m3,
						avg(n4) as m4, avg(n5) as m5,	avg(n6) as m6, avg(n7) as m7, avg(n8) as m8, avg(n9) as m9
						from avaliacao as a inner join projeto as p on a.fk_projeto = p.id_projeto
						where p.fk_area = 2 AND p.nivel = 2  AND p.convidado = 0 GROUP BY a.fk_projeto";
		$result = $database->query($sql);
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				array_push($found, $row);
			}
		}
		//médio, area 3 = Ciências Humanas, Sociais Aplicadas e Linguística, sem resultado
		$sql = "SELECT fk_area,a.fk_projeto, p.nivel,p.convidado, avg(n1) as m1, avg(n2) as m2, avg(n3) as m3,
						avg(n4) as m4, avg(n5) as m5,	avg(n6) as m6, avg(n7) as m7, avg(n8) as m8, avg(n9) as m9
						from avaliacao as a inner join projeto as p on a.fk_projeto = p.id_projeto
						where p.fk_area = 3 AND p.nivel = 2 AND p.convidado = 0 GROUP BY a.fk_projeto";
		$result = $database->query($sql);
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				array_push($found, $row);
			}
		}
		//médio, area 4 = Ciências Agrárias e Engenharias, sem resultado
		$sql = "SELECT fk_area,a.fk_projeto, p.nivel,p.convidado, avg(n1) as m1, avg(n2) as m2, avg(n3) as m3,
						avg(n4) as m4, avg(n5) as m5,	avg(n6) as m6, avg(n7) as m7, avg(n8) as m8, avg(n9) as m9
						from avaliacao as a inner join projeto as p on a.fk_projeto = p.id_projeto
						where p.fk_area = 4 AND p.nivel = 2 AND p.convidado = 0 GROUP BY a.fk_projeto";
		$result = $database->query($sql);
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				array_push($found, $row);
			}
		}
		//médio, area 5 = Multidisciplinar, sem resultado
		$sql = "SELECT fk_area,a.fk_projeto, p.nivel,p.convidado, avg(n1) as m1, avg(n2) as m2, avg(n3) as m3,
						avg(n4) as m4, avg(n5) as m5,	avg(n6) as m6, avg(n7) as m7, avg(n8) as m8, avg(n9) as m9
						from avaliacao as a inner join projeto as p on a.fk_projeto = p.id_projeto
						where p.fk_area = 5 AND p.nivel = 2 AND p.convidado = 0 GROUP BY a.fk_projeto";
		$result = $database->query($sql);
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				array_push($found, $row);
			}
		}
		//fundamental geral
		$sql = "SELECT fk_area,a.fk_projeto, p.nivel,p.convidado, avg(n1) as m1, avg(n2) as m2, avg(n3) as m3,
						avg(n4) as m4, avg(n5) as m5,	avg(n6) as m6, avg(n7) as m7, avg(n8) as m8, avg(n9) as m9
						from avaliacao as a inner join projeto as p on a.fk_projeto = p.id_projeto
						where p.nivel = 1 AND p.convidado = 0  GROUP BY a.fk_projeto";
		$result = $database->query($sql);
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				array_push($found, $row);
			}
		}
		//convidado
		$sql = "SELECT fk_area,a.fk_projeto, p.nivel,p.convidado, avg(n1) as m1, avg(n2) as m2, avg(n3) as m3,
						avg(n4) as m4, avg(n5) as m5,	avg(n6) as m6, avg(n7) as m7, avg(n8) as m8, avg(n9) as m9
						from avaliacao as a inner join projeto as p on a.fk_projeto = p.id_projeto
						where p.convidado = 1  GROUP BY a.fk_projeto";
		$result = $database->query($sql);
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				array_push($found, $row);
			}
		}
	} catch (Exception $e) {
		$_SESSION['message'] = $e->GetMessage();
		$_SESSION['type'] = 'danger';
	}
	close_database($database);
	return $found;
}
//atualiza a senha
function atualizarSenha($tabela,$valor, $id){
	$database = open_database();
	try {

		$sql = "UPDATE ".$tabela." set senha = '".$valor."' where fk_usuario = ".$id;
		$result = $database->query($sql);
		if ($result->num_rows > 0) {
			$found = array();
			while ($row = $result->fetch_assoc()) {
				array_push($found, $row);
			}
		}

	} catch (Exception $e) {
		$_SESSION['message'] = $e->GetMessage();
		$_SESSION['type'] = 'danger';
	}
	close_database($database);
}
//visualiza os avaliadores
function verAvaliado($id=null){
	$database = open_database();
	$found = null;

	try {

		$sql = "SELECT fk_usuario FROM avaliacao where fk_projeto = ".$id;
		$result = $database->query($sql);
		if ($result->num_rows > 0) {
			$found = array();
			while ($row = $result->fetch_assoc()) {
				array_push($found, $row);
			}
		}

	} catch (Exception $e) {
		$_SESSION['message'] = $e->GetMessage();
		$_SESSION['type'] = 'danger';
	}
	close_database($database);
	return $found;
}
//salva os dados
function save($table = null, $data = null) {
	$database = open_database();
	$columns = null;
	$values = null;

	foreach ($data as $key => $value) {
		$columns .= trim($key, "'") . ",";
		if($value === null || $value==='')
			$values .= "null,";
		else
			$values .= "'$value',";
	}

	// remove a ultima virgula
	$columns = rtrim($columns, ',');
	$values = rtrim($values, ',');

	$sql = "INSERT INTO " . $table . "($columns)" . " VALUES " . "($values);";
	try {
		$database->query($sql);
		$_SESSION['message'] = 'Registro cadastrado com sucesso.';
		$_SESSION['type'] = 'success';
	} catch (Exception $e) {
		$_SESSION['message'] = 'Não foi possível realizar a operação.';
		$_SESSION['type'] = 'danger';
	}
	close_database($database);
}

function update($table = null, $id = 0, $data = null) {
	$database = open_database();
	$items = null;
	foreach ($data as $key => $value) {
		if($value == null)
			$items .= trim($key, "'") . "=null,";
		else
			$items .= trim($key, "'") . "='$value',";
	}
	// remove a ultima virgula

	$items = rtrim($items, ',');
	$sql  = "UPDATE " . $table;
	$sql .= " SET $items";
	$sql .= " WHERE id_".$table."=" . $id . ";";
	try {
		$database->query($sql);
		$_SESSION['message'] = 'Registro atualizado com sucesso.';
		$_SESSION['type'] = 'success';
	} catch (Exception $e) {
		$_SESSION['message'] = 'Nao foi possivel realizar a operacao.';
		$_SESSION['type'] = 'danger';
	}
	close_database($database);
}
//remover o registro do banco
function remove( $table = null, $atributo = null, $id = null ) {
	$database = open_database();
	try {
		if ($id) {
			$sql = "DELETE FROM " . $table . " WHERE ".$atributo." = " . $id;
			$result = $database->query($sql);
			if ($result = $database->query($sql)) {
				$_SESSION['message'] = "Registro Removido com Sucesso.";
				$_SESSION['type'] = 'success';
			}
		}
	} catch (Exception $e) {
		$_SESSION['message'] = $e->GetMessage();
		$_SESSION['type'] = 'danger';
	}
	close_database($database);
}
?>
