<?php
    require_once('functions.php');
	require_once('../cdn/fpdf/fpdf.php');

	$certificado = $_POST['arquivo'];
	$pdf = new FPDF("L","pt","A4");
	$registro = $certificado["'ult_registro'"];
	$folha = $certificado["'pagina'"];
	$pularPagina = $certificado["'linha'"];

	$nome_temporario=$_FILES["arquivo1"]["tmp_name"];
	$nome_real_frente=$_FILES["arquivo1"]["name"];
	copy($nome_temporario,"imagens/$nome_real_frente");

	$nome_temporario=$_FILES["arquivo2"]["tmp_name"];
	$nome_real_verso=$_FILES["arquivo2"]["name"];
	copy($nome_temporario,"imagens/$nome_real_verso");

	getProjetos();

	foreach($projetos as $projeto){
		$registro++;
		if($folha){
			$pularPagina++;
			if($pularPagina > $certificado["'reg_pagina'"]){
				$folha++;
				$pularPagina = 1;
			}
		}
	

			//Frente do Certificado 1
		$pdf->AddPage();
		$pdf->Image('imagens/'.$nome_real_frente,0,0,$pdf->GetPageWidth(),$pdf->GetPageHeight());
		$pdf->Ln(30);
		        
		$pdf->SetFont("arial", "", 12);
		$pdf->SetY(240);
		$pdf->SetMargins(300,20,40,20);
		        
		$texto = "Certificamos que o trabalho";
		  
		$pdf->MultiCell(0,15, $texto,0,"C",false);
		$pdf->Ln(10);
      
		$pdf->SetFont("arial", "B", 14);
		$pdf->MultiCell(0,15, $projeto['titulo'],0,"C",false);	
		$pdf->Ln(10);
		
		getUsuarios($projeto['id_projeto']);
		$texto = " da autoria de ".$autores[1]['nome'];
		if(!empty($autores[2]['nome']) && !empty($autores[3]['nome'])){
			$texto .= ", ".$autores[2]['nome']." e ".$autores[3]['nome'];
		}else if(!empty($autores[2]['nome'])){
			$texto .= " e ".$autores[2]['nome'];
		}
		if(!empty($autores[4]['nome'])){
			$texto .=" orientados por ".$autores[5]['nome']." e ".$autores[4]['nome'];
		}else{
			$texto .=" orientado por ".$autores[5]['nome'];
		}
		$pdf->SetFont("arial", "", 14);
		$pdf->MultiCell(0,15, $texto,0,"C",false);
		$pdf->Ln(10);

		$pdf->SetFont("arial", "", 12);

		$pdf->MultiCell(0,15,$certificado["'texto'"],0,"C",false);	
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
				
		//Verso do Certificado	
		$pdf->addPage();
		$pdf->Image('imagens/'.$nome_real_verso,0,0,$pdf->GetPageWidth(),$pdf->GetPageHeight());
		        $pdf->SetMargins(40,20,20,20);
		$pdf->SetX(0);
		$pdf->SetY(140);
		$pdf->Ln(10);
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

    } 
        
	$pdf->Output("participacao.pdf", "I");
?>