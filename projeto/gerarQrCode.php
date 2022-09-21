
        <script type="text/javascript" src="qrcode.js"></script>

	<?php
  require_once('functions.php');
  $projeto = findAnyThing('projeto','id_projeto',$_GET['id']);
  echo "<script type='text/javascript' src='qrcode.js'></script>";
	?>
  <link rel="stylesheet" href="<?php echo BASEURL; ?>cdn/css/bootstrap.css">
  <link rel="stylesheet" href="<?php echo BASEURL; ?>cdn/css/jquery-ui.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">

    <input type="hidden" size="100%" id="<?php echo $projeto['id_projeto'];?>" value="https://projetosifms.com.br/fecifron/avaliacao/avaliacao.php?id=<?php echo $projeto['id_projeto'];?>">
    <center><div id="<?php echo $projeto['titulo'];?>"></div>
    <h2>
		<?php
    echo "<br>".$projeto['titulo'];
		?>
    </h2>
    <br>
    <a href="" id="botao1" onclick="esconder()"><button class="btn btn-info"><i class="fa fa-print"></i> Imprimir</button></a>
    <a href="index.php" id="botao2" ><button class="btn btn-secondary">Voltar</button></a>
    </center>

    <script>
    window.onload = createQrCode('<?php echo $projeto['titulo'];?>', '<?php echo $projeto['id_projeto'];?>');
    function createQrCode(nome,nome2)
    {
        var userInput = document.getElementById(nome2).value;

        var qrcode = new QRCode(nome, {
            text: userInput,
            width: 512,
            height: 512,
            colorDark: "black",
            colorLight: "white",
            correctLevel : QRCode.CorrectLevel.H
        });
    }
    function esconder(){
      document.getElementById("botao1").style.display = 'none';
      document.getElementById("botao2").style.display = 'none';
      window.print();
    }

    </script>
</html>
