<?php // echo var_dump($data)  ?>

<h5 class="text-center mb-5"><?= $data['nom'] ."-" . $data['siren'] ?></h5>


<div class="container">
<table class="table table-bordered">
  <thead>
    <tr>
    <?php foreach($fieldsTable1 as $colonne) : ?>
        <th>
        <?= $colonne['Field'] ?>
        </th>
    <?php endforeach ?>
    <?php foreach($fieldsTable2 as $colonne) : ?>
        <th>
        <?= $colonne['Field'] ?>
        </th>
    <?php endforeach ?>

    </tr>
  </thead>
  <tbody>
    <tr>
    <th scope="row"><?php echo $data['idsocietes'] ?></th>
    <td><?php echo $data['nom'] ?></td>
    <td><?php echo $data['siren'] ?></td>
    <td><?php echo $data['villeImmatriculation'] ?></td>
    <td><?php echo $data['dateImmatriculation'] ?></td>
    <td><?php echo $data['capital'] ?></td>
    <td><?php echo $data['libelle'] ?></td>
    <td><?php echo $data['numero'] ?></td>
    <td><?php echo $data['typevoie'] ?></td>
    <td><?php echo $data['nomvoie'] ?></td>
    <td><?php echo $data['cp'] ?></td>
    <td><?php echo $data['ville'] ?></td>
    <td><?php echo $data['createdAt'] ?></td>
   
  </tbody>
</table>
</div>