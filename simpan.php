<?php
    include './koneksi.php';

    $judul = $_POST ['judul'];
    $penulis = $_POST ['penulis'];
    $jenis = $_POST['jenis'];

    // echo $first.'<br>';
    // echo $last. '<br>';
    // echo $nisn. '<br>';
    // echo $sekolah. '<br>';
    // echo $email. '<br>';
    // echo $pilihan. '<br>';

    $sql = "INSERT INTO buku(judul, penulis, jenis) VALUES ('$judul', '$penulis', '$jenis')";
    if($conn->query($sql) === TRUE){
        // echo "Anda terdaftar";
       header('location:tampil.php');
    }else{echo "Error:" . $sql . "<br>" . $conn->error;}
    $conn->close();

?>