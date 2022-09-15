<?php
    require_once('../config.php');
	require_once(DBAPI);
	require_once('../cdn/fpdf/fpdf.php');

	session_start();
	unset($_SESSION['certificado']);
	$certificado = $_SESSION['dados_certificado'];
    $resultado = $_SESSION['resultado'];
	$pdf = new FPDF("L","pt","A4");
	$registro = $certificado["'ult_registro'"];
	$folha = $certificado["'pagina'"];
	$pularPagina = $certificado["'linha'"];

	//Fundamental
	premiosAreas(1,0,$resultado,$certificado,1);
	//Biologicas
	premiosAreas(1,1,$resultado,$certificado,0);
	//Exatas
	premiosAreas(1,2,$resultado,$certificado,0);
	//Humanas
	premiosAreas(1,$resultado,3,$certificado,0);
	//Agrarias
	premiosAreas(1,4,$resultado,$certificado,0);
	//Multidisciplinar
	premiosAreas(1,5,$resultado,$certificado,0);
	//melhor_tecnologico
	premiosAreas(2,6,$_SESSION['tecnologico'],$certificado,0);
	//melhor_convidado
	premiosAreas(3,7,$resultado,$certificado,0);
	//melhor_socioambiental
	premiosAreas(4,8,$_SESSION['ambiental'],$certificado,0);
	//melhor_video_medio
	premiosAreas(5,9,$_SESSION['video'],$certificado,0);
	//melhor_trabalho_medio
	premiosAreas(6,10,$resultado,$certificado,0);

	function premiosAreas($tipo,$area,$resultado,$certificado,$fundamental){
		$aceita = false;
		global $registro;
		global $folha;
		global $pularPagina;
		global $pdf;
		$cont = 0;
		foreach($resultado as $res){

		if($tipo == 1){
		    if($area != 5){
		        if($cont==3){
				break;
			}
		    }else{
		        if($cont==4){
				break;
		        }
		    }
		    
		    if($res['convidado']==1)
		        continue;
			
			if($res['fk_area'] == $area && $res['nivel']==2 || $res['nivel']==$fundamental){
				$aceita=true;
				$cont++;
				//variavel para dois primeiro
				$repetido = 1;
				$registro++;
				if($folha){
					$pularPagina++;
					if($pularPagina > $certificado["'reg_pagina'"]){
						$folha++;
						$pularPagina = 1;
					}
				}
			}
		}else if ($tipo==2){
			if($cont==1){
				break;
			}
			if($res['convidado']==1)
		        continue;
			if($res['nivel']==1)
				continue;
			$aceita=true;
			$cont++;
			$registro++;
			if($folha){
				$pularPagina++;
				if($pularPagina > $certificado["'reg_pagina'"]){
					$folha++;
					$pularPagina = 1;
				}

			}
		}else if($tipo==3){
			if($cont==3){
				break;
			}
			if($res['convidado']==0)
		        continue;
			$aceita=true;
			$cont++;
			$registro++;
			if($folha){
				$pularPagina++;
				if($pularPagina > $certificado["'reg_pagina'"]){
					$folha++;
					$pularPagina = 1;
				}

			}
		}else if($tipo==4){
			if($cont==3){
				break;
			}
			if($res['convidado']==1)
		        continue;
			if($res['nivel']==1)
				continue;
			$aceita=true;
			$cont++;
			if($cont<3)
			    continue;
			$registro++;
			if($folha){
				$pularPagina++;
				if($pularPagina > $certificado["'reg_pagina'"]){
					$folha++;
					$pularPagina = 1;
				}

			}
		}else if($tipo==5){
			if($cont==2){
				break;
			}
			if($res['convidado']==1)
		        continue;
			if($res['nivel']==1)
				continue;
			$aceita=true;
			$cont++;
			$registro++;
			if($folha){
				$pularPagina++;
				if($pularPagina > $certificado["'reg_pagina'"]){
					$folha++;
					$pularPagina = 1;
				}

			}
		}else if($tipo==6){
			if($cont==1){
				break;
			}
			if($res['convidado']==1)
		        continue;
			if($res['nivel']==1)
				continue;
			$aceita=true;
			$cont++;
			$registro++;
			if($folha){
				$pularPagina++;
				if($pularPagina > $certificado["'reg_pagina'"]){
					$folha++;
					$pularPagina = 1;
				}

			}
		}

			if($aceita){
			//Frente do Certificado 1
		        $pdf->AddPage();
		        $pdf->Image('imagens/'.$_SESSION["frente"],0,0,$pdf->GetPageWidth(),$pdf->GetPageHeight());
				$pdf->Ln(30);

				$projeto = $res["titulo"];
				$posicao = 1;

		        $pdf->SetFont("arial", "", 14);
		        $pdf->SetY(240);
		        $pdf->SetMargins(300,20,40,20);

		        $texto=$certificado["'texto'"];

			    $pdf->Ln(10);
		        $pdf->MultiCell(0,15, $texto,0,"C",false);
		        $pdf->Ln(10);


			$pdf->SetFont("arial", "B", 16);
			$pdf->MultiCell(0,20, $projeto,0,"C",false);
			$pdf->Ln(10);

		        $pdf->SetFont("arial", "", 14);
		        if($area == 5 && $cont>1){
		            $texto3 = "pelo ".($cont-$repetido)."º lugar ";
		        }else if($tipo == 4 || $tipo == 5){
		            $texto3 = "pelo 1º lugar ";
		        }else{
		            $texto3 = "pelo ".$cont."º lugar ";
		        }
		        
		        switch($area){
		        	case "0": $texto3.="do nível Fundamental"; break;
		        	case "1": $texto3.="na categoria Ciências Biológicas e da Saúde do nível Médio";break;
		        	case "2": $texto3.="na categoria Ciências Exatas e da Terra do nível Médio";break;
		        	case "3": $texto3.="na categoria Ciências Humanas, Sociais Aplicadas e Linguistica do nível Médio";break;
		        	case "4": $texto3.="na categoria Ciências Agrárias e engenharias do nível Médio";break;
		        	case "5": $texto3.="na categoria Multidisciplinar do nível Médio";break;
		        	case "6": $texto3.="pelo melhor trabalho tecnológico";break;
		        	case "7": $texto3.="na categoria convidado";break;
		        	case "8": $texto3.="pelo melhor trabalho com impacto socioambiental";break;
		        	case "9": $texto3.="pelo melhor Vídeo";break;
		        	case "10": $texto3.="pelo melhor projeto do nível Médio";break;
		        }
		       // $texto3 = converte($texto3);
		        $pdf->MultiCell(0,20,$texto3,0,"C",false);
			$pdf->Ln(10);
		    $data = date_create($certificado["'data'"]);
			$texto4 = $certificado["'campus'"].", MS, ".date_format($data,'d')." de ";
			switch(date_format($data,'m')){
				case '1': $texto4.="janeiro "; break;
				case '2': $texto4.="fevereiro "; break;
				case '3': $texto4.="março "; break;
				case '4': $texto4.="abril "; break;
				case '5': $texto4.="maio "; break;
				case '6': $texto4.="junho "; break;
				case '7': $texto4.="julho "; break;
				case '8': $texto4.="agosto "; break;
				case '9': $texto4.="setembro "; break;
				case '10': $texto4.="outubro "; break;
				case '11': $texto4.="novembro "; break;
				case '12': $texto4.="dezembro "; break;
			}
			$texto4.= "de ".date_format($data,'Y').".";

			$pdf->MultiCell(0,20,$texto4,0,"R",false);
			$pdf->Ln(10);
			$pdf->SetFont("arial", "", "12");
			$pdf->Ln(10);

			//Verso do Certificado
			$pdf->addPage();
		        $pdf->Image('imagens/'.$_SESSION["verso"],0,0,$pdf->GetPageWidth(),$pdf->GetPageHeight());
            $pdf->SetMargins(40,20,20,20);
		        $pdf->SetX(0);
		        $pdf->SetY(200);
		        $pdf->MultiCell(0,15,"Instituto Federal de Educação, Ciência e",0,"J",false);
		        $pdf->MultiCell(0,15,"Tecnologia de Mato Grosso do Sul - IFMS",0,"J",false);
		        $pdf->MultiCell(0,15,"                 Campus ".$certificado["'campus'"],0,"J",false);
		        $pdf->Ln(20);
		        $pdf->MultiCell(0,20,"Registro  nº ".$registro,0,"J",false);

		        if($folha){
					 $pdf->MultiCell(0,20,"Folha ".$folha,0,"J",false);
		        	 $pdf->MultiCell(0,20,"Livro ".$certificado["'livro'"],0,"J",false);
		        }else{
		        	$pdf->Ln(40);
		        }


		        $pdf->Ln(30);
		        $pdf->MultiCell(0,20,$texto4,0,"J",false);
		        $pdf->Ln(60);
		        $aceita=false;
	        }
	    }
    }

$pdf->Output("colocacao.pdf", "I");
?>
