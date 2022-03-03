<?php
    include './koneksi.php';

    $id = $_GET['id'];

    $sql = "DELETE FROM buku WHERE id= '$id' ";

    if($conn->query($sql)===TRUE){
        header('location:tampil.php?terhapus');
        
    }
    else{
        echo "Error :" .$sql. "<br>" . $conn->error;
    }

    $conn->close();



?>