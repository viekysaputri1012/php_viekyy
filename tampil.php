
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Daftar Buku</title>

        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="css/sb-admin-2.css" rel="stylesheet">

    </head>
        
    <body class="bg-flat">

        <!-- navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="tampil.php">Buku</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="tampil.php">Beranda <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0" method="GET">
                    <input class="form-control mr-sm-2" type="search" name="cari" placeholder="Cari Peserta" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Cari</button>
                </form>
            </div>
        </nav>
        <!-- navbar -->

        <!-- tabel data -->
        <div class="container pt-5">
            <?php
                if(isset($_GET['sukses'])){
                    echo "<div class='alert alert-success'>Data Berhasil Disimpan</div>";
                }
            ?>
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover" id="table-peserta">
                        <thead class="thead-dark">
                            <tr>
                                <th>No.</th>
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>Jenis</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                include './koneksi.php';
                                $sql = "SELECT * FROM buku";
                                if(isset($_GET['cari'])){
                                    $cari = $_GET['cari'];
                                    $sql = "SELECT * FROM buku WHERE judul LIKE '%$cari%' OR penulis LIKE '%$cari%' OR jenis LIKE '%$cari%' ";
                                }
                                $result = $conn->query($sql);
                                $counter = 1;
                                while($row = $result->fetch_array()){
                                         
                                    echo "<tr>";
                                        echo "<td>$counter</td>";
                                        echo "<td>".$row['judul']."</td>";
                                        echo "<td>".$row['penulis']."</td>";
                                        echo "<td>".$row['jenis']."</td>";
                                        echo "<td>";

                                            echo "<a href='./Update.php?id=$row[0]' class='btn btn-primary btn-sm mr-1'>Ubah</a>";
                                            echo "<a data-role='penghapus' class='btn btn-danger btn-sm' href='./hapus.php?id=$row[0]'>Hapus</a>";

                                            echo "<div class='d-none' id='table-row-$row[0]'>";
                                            echo "<input type='hidden' class='source-id' value='".$row['id']."' />";
                                            echo "<input type='hidden' class='source-firstname' value='".$row['first_name']."' />";
                                            echo "<input type='hidden' class='source-lastname' value='".$row['last_name']."' />";
                                            echo "<input type='hidden' class='source-nisn' value='".$row['nisn']."' />";
                                            echo "<input type='hidden' class='source-sekolah' value='".$row['asal_sekolah']."' />";
                                            echo "<input type='hidden' class='source-email' value='".$row['email']."' />";
                                            echo "<input type='hidden' class='source-lomba' value='".$row['lomba']."' />";

                                        echo "</div>";
                                        echo "</td>";
                                    echo "</tr>";
                                    $counter++;
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- tabel data end -->

        <!-- Tabel ubah -->
        <div class="modal fade" tabindex="-1" role="dialog" id="modal-ubah">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="user" action="Ubah.php" method="post" id="form-ubah">
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label style="left: 25px;">Nama Depan</label>
                                <input type="text" class="form-control form-control-user" id="input-firstname" name="first">
                            </div>
                            <div class="col-sm-6">
                                <label style="left: 25px;">Nama Belakang</label>
                                <input type="text" class="form-control form-control-user" id="input-lastname" name="last">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Asal Sekolah</label>
                            <input type="text" class="form-control form-control-user" id="input-sekolah" name="sekolah">
                        </div>
                        <div class="form-group">
                            <label>NISN</label>
                            <input type="text" class="form-control form-control-user" id="input-nisn" name="nisn">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control form-control-user" id="input-email" name="email">
                        </div>
                        <div class="form-group ">
                            <label>Lomba</label>
                            <select class="form-control form-control-user " style="padding: 1em; height:auto;" id="input-lomba" name="pilihan">
                                <option value="Menyanyi">Menyanyi</option>
                                <option value="Melukis">Melukis</option>
                                <option value="Membaca Puisi">Membaca Puisi</option>
                            </select>
                        </div>
                        <input type="hidden" id="input-id" name="id" value="" />
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default text-danger" data-dismiss="modal">Batal</button>
                    <button id="button-ubah-submit" type="button" class="btn btn-primary">Simpan</button>
                </div>
                </div>
            </div>
        </div>
        <!-- tabel ubah end-->

    </body>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        $("#table-peserta tbody tr button[data-table]").on("click", function(e){
            var dataTable = $(this).attr("data-table");
            dataTable = $(dataTable);
            
            $("#input-firstname").val(dataTable.find(".source-firstname").val());
            $("#input-lastname").val(dataTable.find(".source-lastname").val());
            $("#input-nisn").val(dataTable.find(".source-nisn").val());
            $("#input-sekolah").val(dataTable.find(".source-sekolah").val());
            $("#input-email").val(dataTable.find(".source-email").val());
            $("#input-id").val(dataTable.find(".source-id").val());

            $("#input-lomba option").each(function(){
                if($(this).attr("value") == dataTable.find(".source-lomba").val()){
                    $(this).prop("selected", true);
                } else {
                    $(this).prop("selected", false);
                }
            })

            $("#modal-ubah").modal("show");
        });

        $("#button-ubah-submit").on("click", function(e){
            $("#form-ubah").submit();
        });

        $("#table-peserta tbody tr a[data-role=penghapus]").on("click", function(e){
            var konfirmasi = confirm("Anda yakin menghapus data ini?");
            if(!konfirmasi){
                e.preventDefault();
            }
        })

        $("#modal-ubah").on("hidden.bs.modal", function(){
            $("#input-id, #input-email, #input-sekolah, #input-nisn, #input-lastname, #input-firstname").val("");
        });
    </script>

</html>