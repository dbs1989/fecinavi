<?php
	require_once('../config.php');
	require_once(DBAPI);
	session_start();
	$resultadoFinal = array();
	$resultado = null;
	$resultadoTodos = notasTodos();

	 function compararNotas($a, $b){
		if($a['nota']==$b['nota']){
			if($a['banner']==$b['banner']){
				if($a['resumo']==$b['resumo']){
					if($a['relatorio']==$b['relatorio']){
						return $a['diario']<$b['diario'];
					}
					return $a['relatorio']<$b['relatorio'];
				}
				return $a['resumo']<$b['resumo'];
			}
			return $a['banner']<$b['banner'];
		}
        return $a['nota']< $b['nota'];
    }

     function melhorBanner($a, $b){
			if($a['banner']==$b['banner']){
				if($a['nota']==$b['nota']){
					if($a['resumo']==$b['resumo']){
						if($a['relatorio']==$b['relatorio']){
							return $a['diario']<$b['diario'];
						}
						return $a['relatorio']<$b['relatorio'];
					}
					return $a['resumo']<$b['resumo'];
				}
				return $a['nota']<$b['nota'];
			}
      return $a['banner']< $b['banner'];
    }

		function melhorRelatorio($a, $b){
		 if($a['relatorio']==$b['relatorio']){
			 if($a['nota']==$b['nota']){
				 if($a['banner']==$b['banner']){
					 if($a['resumo']==$b['resumo']){
						 return $a['diario']<$b['diario'];
					 }
					 return $a['resumo']<$b['resumo'];
				 }
				 return $a['banner']<$b['banner'];
			 }
			 return $a['nota']<$b['nota'];
		 }
		 return $a['relatorio']< $b['relatorio'];
	 }

     function melhorAmbiental($a, $b){
		if($a['ambiental']==$b['ambiental']){
			if($a['banner']==$b['banner']){
				if($a['resumo']==$b['resumo']){
					if($a['relatorio']==$b['relatorio']){
						return $a['diario']<$b['diario'];
					}
					return $a['relatorio']<$b['relatorio'];
				}
				return $a['resumo']<$b['resumo'];
			}
			return $a['banner']<$b['banner'];
		}
        return $a['ambiental']< $b['ambiental'];
    }

		function melhorTecnologico($a, $b){
	 if($a['tecnologico']==$b['tecnologico']){
		 if($a['banner']==$b['banner']){
			 if($a['resumo']==$b['resumo']){
				 if($a['relatorio']==$b['relatorio']){
					 return $a['diario']<$b['diario'];
				 }
				 return $a['relatorio']<$b['relatorio'];
			 }
			 return $a['resumo']<$b['resumo'];
		 }
		 return $a['banner']<$b['banner'];
	 }
			 return $a['tecnologico']< $b['tecnologico'];
	 }

	 function melhorConvidado($a, $b){
	if($a['convidado']==$b['convidado']){
		if($a['nota']==$b['nota']){
			if($a['banner']==$b['banner']){
				if($a['resumo']==$b['resumo']){
					if($a['relatorio']==$b['relatorio']){
						return $a['diario']<$b['diario'];
					}
					return $a['relatorio']<$b['relatorio'];
				}
				return $a['resumo']<$b['resumo'];
			}
			return $a['banner']<$b['banner'];
		}
        return $a['nota']< $b['nota'];
	}
	return $a['convidado']<$b['convidado'];
}

	foreach($resultadoTodos as $res){
		$soma = 0;
		$relatorio=0;
		$resumo = 0;
		$banner = 0;
		$diario = 0;
		foreach($res as $key => $valor){
			if($key=="fk_area"){
				$resultado['fk_area'] = $valor;
			}else if($key=="fk_projeto"){
				$resultado['fk_projeto'] = $valor;
			}else if($key=="nivel"){
				$resultado['nivel'] = $valor;
			}else if($key=="convidado"){
				$resultado['convidado'] = $valor;
			}else if($key=="res"){
				$resultado['res'] = $valor;
			}else{
				if($key!="m8" && $key!="m9" ){
					$soma += $valor;
				}
				if($key=="m4"){
					$banner += $valor;
				}
				if($key=="m5"){
					$resumo += $valor;
				}
				if($key=="m6"){
					$relatorio += $valor;
				}
				if($key=="m7"){
					$diario += $valor;
				}
				if($key=="m8"){
					$resultado['ambiental'] = $valor;
				}
				if($key=="m9"){
					$resultado['tecnologico'] = $valor;
				}
			}
		}
		$resultado['nota'] = $soma/7;
		$resultado['relatorio'] = $relatorio;
		$resultado['resumo'] = $resumo;
		$resultado['banner'] = $banner;
		$resultado['diario'] = $diario;
		$resultado['usuarios'] = projeto_usuario($resultado['fk_projeto']);
		$pesquisa =  findAnything('projeto','id_projeto',$resultado['fk_projeto']);
		$resultado['titulo'] = $pesquisa['titulo'];
		array_push($resultadoFinal,$resultado);
	}

	uasort($resultadoFinal,'compararNotas');
	$_SESSION['resultado'] = $resultadoFinal;
	uasort($resultadoFinal,'melhorBanner');
	$_SESSION['banner'] = $resultadoFinal;
	uasort($resultadoFinal,'melhorRelatorio');
	$_SESSION['relatorio'] = $resultadoFinal;
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
