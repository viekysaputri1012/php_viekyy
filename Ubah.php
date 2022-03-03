<?php 
    include './koneksi.php';

    $id = $_POST ['id'];
    $judul = $_POST ['judul'];
    $penulis = $_POST ['penulis'];
    $jenis = $_POST['jenis'];

    $sql = sprintf("UPDATE buku SET judul='%s', penulis='%s', jenis='%s' WHERE id='%s'",
            $judul,
            $penulis,
            $jenis,
            $id
    );
    if($conn->query($sql) === TRUE){
        header("Location: tampil.php?sukses");
    } else {
        echo "Kesalahan: " . $conn->error;
        echo "<br><code>$sql</code>";
    }
?>