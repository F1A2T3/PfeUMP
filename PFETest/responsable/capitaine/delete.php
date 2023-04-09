<?php 
    include('connection.php');

    if (isset($_GET['id'])) {
        $id=$_GET['id'];
        $requet="DELETE from user WHERE id=:id";
        $statement=$connection->prepare($requet);
        $statement->execute(array(':id'=>$id));
    }
    header('location: indx.php');
    
?>