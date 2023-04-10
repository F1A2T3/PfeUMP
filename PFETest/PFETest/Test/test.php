<?php 
.... 
$rows
?>
<table>
    <?php
    foreach($rows as $row)
    {?>
        <td><?= $row['nom'] ?></td>
        ... 
        <td><a href="supprimer.php?id=<?= $row['id'] ?>">supprimer</a></td>
    <?php
    } ?>
</table>


// la page supprimer.php 
$_GET['id']

pdo = new pdo 
pdo->exec("delete from users wherer id = ".$_GET['i'])
<div style="padding-left: 30%;padding-right: 20%;padding-top: 10px;">
                           <input type="text" placeholder="nomEquipe" style="height:30px; ">
