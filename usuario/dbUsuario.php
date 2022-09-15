<?php
  require_once('../config.php');
  require_once(DBAPI);

  function usuario_inst( $id = null, $pagina=0, $quantidade=10) {
  	$database = open_database();
  	$found = null;
  	try {
  		$sql = "select u.nome as nome_u, u.id_usuario, u.email, i.nome as nome_i from instituicao as i join usuario as u on u.fk_instituicao = i.id_instituicao";
  		if($id){
  			$sql .= " where id_usuario = ".$id;
  			$result = $database->query($sql);
  			if ($result->num_rows > 0) {
  				$found = $result->fetch_assoc();
  			}
  		}else{
  			$sql .= " ORDER BY u.nome";
  			$sql .= " LIMIT $pagina, $quantidade ";
  			$result = $database->query($sql);
  			if ($result->num_rows > 0) {
  				$found = $result->fetch_all(MYSQLI_ASSOC);
  			}
  		}
  	} catch (Exception $e) {
  		$_SESSION['message'] = $e->GetMessage();
  		$_SESSION['type'] = 'danger';
  	}
  	close_database($database);
  	return $found;
  }



?>
