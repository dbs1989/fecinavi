<?php
	require_once('../config.php');
	require_once(DBAPI);
	session_start();
	$resultadoFinal = array();
	$resultado = null;
	$resultadoTodos = notasTodos();

	 function compararNotas($a, $b)
    {
		if($a['nota']==$b['nota']){
			if($a['video']==$b['video']){
				return $a['resumo']<$b['resumo'];
			}
			return $a['video']<$b['video'];
		}
        return $a['nota']< $b['nota'];
    }

     function melhorVideo($a, $b)
    {
			if($a['video']==$b['video']){
				if($a['nota']==$b['nota']){
					return $a['resumo']<$b['resumo'];
				}
				return $a['nota']<$b['nota'];
			}
      return $a['video']< $b['video'];
    }

     function melhorAmbiental($a, $b)
    {
		if($a['ambiental']==$b['ambiental']){
			if($a['video']==$b['video']){
				return $a['resumo']<$b['resumo'];
			}
			return $a['video']<$b['video'];
		}
        return $a['ambiental']< $b['ambiental'];
    }

		function melhorTecnologico($a, $b)
	 {
	 if($a['tecnologico']==$b['tecnologico']){
		 if($a['video']==$b['video']){
			 return $a['resumo']<$b['resumo'];
		 }
		 return $a['video']<$b['video'];
	 }
			 return $a['tecnologico']< $b['tecnologico'];
	 }

	 function melhorConvidado($a, $b)
	{
	if($a['convidado']==$b['convidado']){
		if($a['video']==$b['video']){
			return $a['resumo']<$b['resumo'];
		}
		return $a['video']<$b['video'];
	}
			return $a['convidado']< $b['convidado'];
	}
	foreach($resultadoTodos as $res){
		$soma = 0;
		$somavideo=0;
		$resumo = 0;
		foreach($res as $key => $valor){
			if($key=="fk_area"){
				$resultado['fk_area'] = $valor;
			}else if($key=="fk_projeto"){
				$resultado['fk_projeto'] = $valor;
			}else if($key=="nivel"){
				$resultado['nivel'] = $valor;
			}else if($key=="convidado"){
				$resultado['convidado'] = $valor;
			}else{
				if($key!="m6" && $key!="m7" ){
					$soma += $valor;
				}
				if($key=="m4"){
					$resumo += $valor;
				}
				if($key=="m5"){
					$somavideo += $valor;
				}

				if($key=="m6"){
					$resultado['ambiental'] = $valor;
				}
				if($key=="m7"){
					$resultado['tecnologico'] = $valor;
				}
			}
		}
		$resultado['nota'] = $soma/5;
		$resultado['video'] = $somavideo;
		$resultado['resumo'] = $resumo;
		$resultado['usuarios'] = projeto_usuario($resultado['fk_projeto']);
		$pesquisa =  findAnything('projeto','id_projeto',$resultado['fk_projeto']);
		$resultado['titulo'] = $pesquisa['titulo'];
		array_push($resultadoFinal,$resultado);
	}

	uasort($resultadoFinal,'compararNotas');
	$_SESSION['resultado'] = $resultadoFinal;
	uasort($resultadoFinal,'melhorVideo');
	$_SESSION['video'] = $resultadoFinal;
	uasort($resultadoFinal,'melhorAmbiental');
	$_SESSION['ambiental'] = $resultadoFinal;
	uasort($resultadoFinal,'melhorTecnologico');
	$_SESSION['tecnologico'] = $resultadoFinal;
	uasort($resultadoFinal,'melhorConvidado');
	$_SESSION['convidado'] = $resultadoFinal;
	if(isset($_SESSION['certificado'])){
		header("Location:../certificado/premiacao.php");exit;
	}
	header("Location: index.php");exit;
?>
