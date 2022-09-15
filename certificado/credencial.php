<?php
	require_once('functions.php');
	require_once('../cdn/fpdf/fpdf.php');

	$certificado = $_POST['arquivo'];
	$nome_temporario=$_FILES["arquivo1"]["tmp_name"];
	$nome_real=$_FILES["arquivo1"]["name"];
	copy($nome_temporario,"imagens/$nome_real");

	$pdf = new FPDF("L","pt","A4");
	
	
	//Frente do Certificado 1
    $pdf->AddPage();
    $pdf->Image('imagens/'.$nome_real,0,0,$pdf->GetPageWidth(),$pdf->GetPageHeight());
	$pdf->Ln(30);
		
	getItens($certificado["'id_projeto'"]);
         $pdf->SetY(240);
    $pdf->SetMargins(320,20,40,20);
    $pdf->SetFont("arial", "", 12);
   
       
	$texto = "";
		$texto .= "                                                                                       O trabalho";
		$pdf->MultiCell(0,20, $texto,0,"C",false);
		$pdf->Ln(12);

		$pdf->SetFont("arial", "B", 14);
		$pdf->MultiCell(0,20,$projeto['titulo'],0,"C",false);	
		$pdf->Ln(12);

		$texto = " da autoria de ".$autores[1]['nome'];
		if(!empty($autores[2]['nome']) && !empty($autores[3]['nome'])){
			$texto .= ", ".$autores[2]['nome']." e ".$autores[3]['nome'];
		}else if(!empty($autores[2]['nome'])){
			$texto .= " e ".$autores[2]['nome'];
		}
		$texto .= " orientados por ";
		if(!empty($autores[4]['nome'])){
			$texto .= $autores[5]['nome']." e ".$autores[4]['nome'];
		}else{
			$texto .= $autores[5]['nome'];
		}
		$pdf->SetFont("arial", "", 12);
		$pdf->MultiCell(0,15, $texto,0,"C",false);

		if($certificado["'tipo'"]==1){
			$texto = "foi credenciado para o evento ";
			$pdf->MultiCell(0,20, $texto,0,"C",false);
			$pdf->Ln(12);
			$texto = $certificado["'evento'"]." em ".$certificado["'cidade'"].".";
		}else{
			$texto = "foi premiado com a cortesia de ";
			$pdf->MultiCell(0,20, $texto,0,"C",false);
			$pdf->Ln(12);
			$texto = $certificado["'evento'"]." fornecido pela empresa ".$certificado["'cidade'"].".";

		}         
    	$pdf->SetFont("arial", "B", 14);
		$pdf->MultiCell(0,20, $texto,0,"C",false);
		$pdf->Ln(10);

		    $data = date_create($certificado["'data'"]); 
			$texto4 = $certificado["'campus'"].", MS, ".date_format($data,'d')." de ";
			switch(date_format($data,'m')){
				case '1': $texto4.="janeiro "; break;
				case '2': $texto4.="fevereiro "; break;
				case '3': $texto4.="mar�o "; break;
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
			$pdf->SetFont("arial", "", 14);
			$pdf->MultiCell(0,20,$texto4,0,"R",false);	
			$pdf->Ln(10);
			$pdf->SetFont("arial", "", "12");
			$pdf->Ln(10);

        
	$pdf->Output("credencial_premios.pdf", "I");
?>