<table class="table">
 <thead class="thead-dark"> 
    <tr> 
    <th>Nro</th>
    <th>Documento</th>
    <th>Fecha</th>
    <th>Participo ?</th>
    </tr> 
</thead> 
<tbody>
<?php $i = 1; ?>
<?php foreach(  $wikis_json as $wiki ) : ?>
    <tr> 
    <td><?= $i ?></td> 
    <td><?= 'ACTA DE REUNION '.substr( $wiki['title'], strlen( $wiki['title'] )-3 ) ?></td>
    <td><?='01/04/2019'?></td>
    <td>
        <?php if( strpos( $wiki['content'], $usernames[$selected_member] ) > -1 ): ?>
            <?= 'SI' ?>
        <?php else: ?>
            <?= 'N0' ?>
        <?php endif; ?> 
    </td>
    </tr>
    <?php $i++; ?>
<?php endforeach; ?> 
</tbody>
</table>
<button class="btn btn-success mr-sm-3" id="doreport">Generar reporte</button>