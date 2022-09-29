<!-- Classificação para os trabalhos do fundamental.-->
<div class="row">
    <div class="form-group col-md-12 bg-success text-white text-center">
        <label for="n1"> NÍVEL FUNDAMENTAL: </label>
    </div>
</div>
<div class="row">
    <div class="form-group col-md-12 bg-success text-white text-center">
        <label for="n1"> CIÊNCIAS BIOLÓGICAS E DA SAÚDE:</label>
    </div>
</div>
<table class="table table-hover">
    <thead>
        <tr>
            <th>Classificação</th>
            <th width="30%">Titulo</th>
            <th>Estudantes</th>
            <th>Orientadores</th>
            <th>Nota</th>
            <th>Desempate</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($resultado) { $cont=0;?>

        <?php foreach ($resultado as $res) {
                if($cont==5){
                    break;
                }
                if($res['fk_area'] == 1 && $res['nivel']==1 && $res['convidado']==0){
                    $cont++;
        ?>
        <tr>

            <td><?php echo $cont."º"; if($cont<=1){echo " Premiado";} ?></td>
            <td><?php echo $res['titulo']; ?></td>
            <td>
            <?php
                allAutores($res['usuarios']);
                echo ucwords(mb_strtolower($autores[1]['nome']."<br>".$autores[2]['nome']."<br>".$autores[3]['nome']));
            ?>
            </td>
            <td>
            <?php
                echo ucwords(mb_strtolower($autores[5]['nome']."<br>".$autores[4]['nome']));
            ?>
            </td>
            <td><?php echo number_format($res['nota'],5,',',''); ?></td>
            <td>
                <?php echo "1-Apresentação/Banner: ".number_format($res['banner'],2,',','')."<br>2-Resumo: ".number_format($res['resumo'],2,',','')."<br>3-Relatorio: ".number_format($res['relatorio'],2,',','')."<br>4-Diário: ".number_format($res['diario'],2,',',''); ?>
            </td>
        </tr>
                <?php }} ?>
        <?php } else { ?>
        <tr>

            <td colspan="6">Nenhum registro encontrado.</td>
        </tr>
    <?php }
    if($cont == 0){ ?>
        <td colspan="6" class="text-center">Nenhum projeto nessa categoria.</td>
    <?php } ?>
    </tbody>
</table>
<div class="row">
<div class="form-group col-md-12 bg-success text-white text-center">
    <label for="n1"> CIÊNCIAS EXATAS E DA TERRA:</label>
</div>
</div>
<table class="table table-hover">
    <thead>
        <tr>
            <th>Classificação</th>
            <th width="30%">Titulo</th>
            <th>Estudantes</th>
            <th>Orientadores</th>
            <th>Nota</th>
            <th>Desempate</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($resultado) { $cont=0;?>

        <?php foreach ($resultado as $res) {
                if($cont==5){
                    break;
                }
                if($res['fk_area'] == 2 && $res['nivel']==1 && $res['convidado']==0){
                    $cont++;
        ?>
        <tr>

            <td><?php echo $cont."º"; if($cont<=1){echo " Premiado";} ?></td>
            <td><?php echo $res['titulo']; ?></td>
            <td>
            <?php
                allAutores($res['usuarios']);
                echo ucwords(mb_strtolower($autores[1]['nome']."<br>".$autores[2]['nome']."<br>".$autores[3]['nome']));
            ?>
            </td>
            <td>
            <?php
                echo ucwords(mb_strtolower($autores[5]['nome']."<br>".$autores[4]['nome']));
            ?>
            </td>
            <td><?php echo number_format($res['nota'],5,',',''); ?></td>
            <td>
                <?php echo "1-Apresentação/Banner: ".number_format($res['banner'],2,',','')."<br>2-Resumo: ".number_format($res['resumo'],2,',','')."<br>3-Relatorio: ".number_format($res['relatorio'],2,',','')."<br>4-Diário: ".number_format($res['diario'],2,',',''); ?>
        </tr>
        </tr>
                <?php }} ?>
        <?php } else { ?>
        <tr>

            <td colspan="6">Nenhum registro encontrado.</td>
        </tr>
    <?php }
    if($cont == 0){ ?>
        <td colspan="6" class="text-center">Nenhum projeto nessa categoria.</td>
    <?php } ?>
    </tbody>
</table>

<div class="row">
<div class="form-group col-md-12 bg-success text-white text-center">
    <label for="n1"> CIÊNCIAS HUMANAS, SOCIAIS APLICADAS E LINGUÍSTICA:</label>
</div>
</div>
<table class="table table-hover">
    <thead>
        <tr>
            <th>Classificação</th>
            <th width="30%">Titulo</th>
            <th>Estudantes</th>
            <th>Orientadores</th>
            <th>Nota</th>
            <th>Desempate</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($resultado) { $cont=0;?>

        <?php foreach ($resultado as $res) {
                if($cont==5){
                    break;
                }
                if($res['fk_area'] == 3 && $res['nivel']==1 && $res['convidado']==0){
                    $cont++;
        ?>
        <tr>

            <td><?php echo $cont."º"; if($cont<=1){echo " Premiado";}?></td>
            <td><?php echo $res['titulo']; ?></td>
            <td>
            <?php
                allAutores($res['usuarios']);
                echo ucwords(mb_strtolower($autores[1]['nome']."<br>".$autores[2]['nome']."<br>".$autores[3]['nome']));
            ?>
            </td>
            <td>
            <?php
                echo ucwords(mb_strtolower($autores[5]['nome']."<br>".$autores[4]['nome']));
            ?>
            </td>
            <td><?php echo number_format($res['nota'],5,',',''); ?></td>
            <td>
                <?php echo "1-Apresentação/Banner: ".number_format($res['banner'],2,',','')."<br>2-Resumo: ".number_format($res['resumo'],2,',','')."<br>3-Relatorio: ".number_format($res['relatorio'],2,',','')."<br>4-Diário: ".number_format($res['diario'],2,',',''); ?>
        </tr>
        </tr>
                <?php }} ?>
        <?php } else { ?>
        <tr>

            <td colspan="6">Nenhum registro encontrado.</td>
        </tr>
    <?php }
    if($cont == 0){ ?>
        <td colspan="6" class="text-center">Nenhum projeto nessa categoria.</td>
    <?php } ?>
    </tbody>
</table>

<div class="row">
<div class="form-group col-md-12 bg-success text-white text-center">
    <label for="n1"> CIÊNCIAS AGRÁRIAS E ENGENHARIAS</label>
</div>
</div>
<table class="table table-hover">
    <thead>
        <tr>
            <th>Classificação</th>
            <th width="30%">Titulo</th>
            <th>Estudantes</th>
            <th>Orientadores</th>
            <th>Nota</th>
            <th>Desempate</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($resultado) { $cont=0;?>

        <?php foreach ($resultado as $res) {
                if($cont==5){
                    break;
                }
                if($res['fk_area'] == 4 && $res['nivel']==1 && $res['convidado']==0){
                    $cont++;
        ?>
        <tr>

            <td><?php echo $cont."º"; if($cont<=1){echo " Premiado";} ?></td>
            <td><?php echo $res['titulo']; ?></td>
            <td>
            <?php
                allAutores($res['usuarios']);
                echo ucwords(mb_strtolower($autores[1]['nome']."<br>".$autores[2]['nome']."<br>".$autores[3]['nome']));
            ?>
            </td>
            <td>
            <?php
                echo ucwords(mb_strtolower($autores[5]['nome']."<br>".$autores[4]['nome']));
            ?>
            </td>
            <td><?php echo number_format($res['nota'],5,',',''); ?></td>
            <td>
                    <?php echo "1-Apresentação/Banner: ".number_format($res['banner'],2,',','')."<br>2-Resumo: ".number_format($res['resumo'],2,',','')."<br>3-Relatorio: ".number_format($res['relatorio'],2,',','')."<br>4-Diário: ".number_format($res['diario'],2,',',''); ?>
            </td>
        </tr>
                <?php }} ?>
        <?php } else { ?>
        <tr>

            <td colspan="6">Nenhum registro encontrado.</td>
        </tr>
    <?php }
    if($cont == 0){ ?>
        <td colspan="6" class="text-center">Nenhum projeto nessa categoria.</td>
    <?php } ?>
    </tbody>
</table>

<div class="row">
<div class="form-group col-md-12 bg-success text-white text-center">
    <label for="n1"> MULTIDISCIPLINAR:</label>
</div>
</div>
<table class="table table-hover">
    <thead>
        <tr>
            <th>Classificação</th>
            <th width="30%">Titulo</th>
            <th>Estudantes</th>
            <th>Orientadores</th>
            <th>Nota</th>
            <th>Desempate</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($resultado) { $cont=0;?>

        <?php foreach ($resultado as $res) {
                if($cont==5){
                    break;
                }
                if($res['fk_area'] == 5 && $res['nivel']==1 && $res['convidado']==0){
                    $cont++;
        ?>
        <tr>

            <td><?php echo $cont."º"; if($cont<=1){echo " Premiado";} ?></td>
            <td><?php echo $res['titulo']; ?></td>
            <td>
            <?php
                allAutores($res['usuarios']);
                echo ucwords(mb_strtolower($autores[1]['nome']."<br>".$autores[2]['nome']."<br>".$autores[3]['nome']));
            ?>
            </td>
            <td>
            <?php
                echo ucwords(mb_strtolower($autores[5]['nome']."<br>".$autores[4]['nome']));
            ?>
            </td>
            <td><?php echo number_format($res['nota'],5,',',''); ?></td>
            <td>
                <?php echo "1-Apresentação/Banner: ".number_format($res['banner'],2,',','')."<br>2-Resumo: ".number_format($res['resumo'],2,',','')."<br>3-Relatorio: ".number_format($res['relatorio'],2,',','')."<br>4-Diário: ".number_format($res['diario'],2,',',''); ?>
            </td>
        </tr>
                <?php }} ?>
        <?php } else { ?>
        <tr>

            <td colspan="6">Nenhum registro encontrado.</td>
        </tr>
        <?php }
        if($cont == 0){ ?>
            <td colspan="6" class="text-center">Nenhum projeto nessa categoria.</td>
        <?php } ?>
    </tbody>
</table>
<!-- <table class="table table-hover">
    <thead>
        <tr>
            <th>Classificação</th>
            <th width="30%">Titulo</th>
            <th>Estudantes</th>
            <th>Orientadores</th>
            <th>Nota</th>
            <th>Desempate</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($resultado) { $cont=0;?>

        <?php foreach ($resultado as $res) {
                if($cont==10){
                    break;
                }
                if($res['nivel']==1 && $res['convidado']==0){

                    $cont++;
        ?>
        <tr>

            <td><?php echo $cont."º"; if($cont<=3){echo " Premiado";} ?></td>
            <td><?php echo $res['titulo']; ?></td>
            <td>
            <?php
                allAutores($res['usuarios']);
                echo ucwords(mb_strtolower($autores[1]['nome']."<br>".$autores[2]['nome']."<br>".$autores[3]['nome']));
            ?>
            </td>
            <td>
            <?php
                echo ucwords(mb_strtolower($autores[5]['nome']."<br>".$autores[4]['nome']));
            ?>
            </td>
            <td><?php echo number_format($res['nota'],5,',','');; ?></td>
            <td>
                <?php echo "1-Apresentação/Banner: ".number_format($res['banner'],2,',','')."<br>2-Resumo: ".number_format($res['resumo'],2,',','')."<br>3-Relatorio: ".number_format($res['relatorio'],2,',','')."<br>4-Diário: ".number_format($res['diario'],2,',',''); ?>
            </td>
        </tr>
                <?php }} ?>
        <?php } else { ?>
        <tr>

            <td colspan="6">Nenhum registro encontrado.</td>
        </tr>
    <?php }
    if($cont == 0){ ?>
        <td colspan="6" class="text-center">Nenhum projeto nessa categoria.</td>
    <?php } ?>
    </tbody>
</table> -->