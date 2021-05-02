<?php //echo var_dump($values);
//echo var_dump($libelle);
//echo var_dump($fieldsTable1);
//echo var_dump($fieldsTable2);
//echo var_dump($fieldsTable3);
?>

<h5 class="text-center mb-5"><?= ($op == 'add')? 'CREATION' : 'MODIFICATION' ;?></h5>

<form method="post" action="" class="col-md-6 mx-auto">
    <?php foreach ($fieldsTable1 as $colonne) : ?>
        <div class="form-group">
            <label for=""><?= $colonne['Field'] ?></label>
            <?php
            if( $colonne['Type'] == 'datetime'):
                $type = "datetime-local";
            elseif($colonne['Type'] == 'date'):
                $type = "date";
            elseif (substr($colonne['Type'], 0, 3) == 'int') :
                $type = 'number';
            else :
                $type = 'text';

            endif;
            ?>
            <input type="<?= $type ?>" name="<?= $colonne['Field'] ?>" class="form-control" value="<?= ($op == 'update') ? $values[$colonne['Field']] : ' '; ?>">
        </div>
    <?php endforeach ?>

    <?php foreach ($fieldsTable2 as $colonne) : ?>
        <div class="form-group">
            <label for=""><?= $colonne['Field'] ?></label>
            <?php 
            if( $colonne['Type'] == 'datetime'):
                $type = "datetime-local";
            elseif($colonne['Type'] == 'date'):
                $type = "date";
            elseif(substr($colonne['Type'], 0, 3) == 'int' || $colonne['Type'] == 'float'):
                $type = "number";
            else:
                $type = "text";
            endif;
            ?>
            <input type="<?= $type ?>" name="<?= $colonne['Field'] ?>" class="form-control" value="<?= ($op == 'update') ? $values[$colonne['Field']] : ' '; ?>">
        </div>
    <?php endforeach ?>
    <?php foreach ($fieldsTable3 as $colonne) : ?>
        <div class="form-group">
            <label for=""><?= $colonne['Field'] ?></label>
            <select class="form-control" name="<?= $colonne['Field'] ?>">
                <?php foreach($libelle as $key) :?>
                    <option value="">
                    <?php foreach($key as $val) echo $val?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>
    <?php endforeach ?>

    <input type="submit" class="btn btn-info mt-2 mb-5">

</form>