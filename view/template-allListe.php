
 <?php // echo var_dump($data) ?> 

<div class="container">
<table class="table table-bordered text-center">
    <thead>
        <tr>
            <?php foreach($fields as $colonne) : ?>
            <th><?= strtoupper($colonne['Field']) ?></th>
            <?php endforeach ?>

            <th>voir</th>
            <th>modifier</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($data as $info): ?>
    <tr>
    <?php   $infoSociete = array_splice($info,0,-1); //echo var_dump($infoSociete) ?>
    <td><?= implode('</td><td>', $infoSociete) ?></td>
    <td><a class="btn btn-primary" href="?op=select&id=<?= $infoSociete[$id] ?>"><i class="far fa-eye"></i></a></td>
    <td><a class="btn btn-dark" href="?op=update&id=<?= $infoSociete[$id]?>"><i class="fa fa-edit"></i></a></td>
            
    </tr>
    <?php endforeach ?>
    </tbody>



</table>
</div>