<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List App</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
</head>

<body>
<div class="container"> 
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">

                <center>
                <?php
                    $kode = $_GET['kodenya'];
                    include './config/koneksi.php';
                    $queryAmbil = mysqli_query($koneksi, "SELECT * FROM tb_todolist WHERE kode='$kode'");
                    $resultAmbil = mysqli_fetch_array($queryAmbil);
                ?>
                    <h1 class="text-primary"> To Do List </h1>
                    <form action ="./proses_ubah.php" method="post">
                    <div class="input-group mb-3">
                        <input type="text" name="isitugas" class="form-control" placeholder="Masukan Tugas Anda" 
                            value="<?php echo $resultAmbil['isi']; ?>"> 
                        <input type ="hidden" name="kode" value="<?php echo $resultAmbil['kode']; ?>">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">Change Item</button>
                        </div>
                        </div>
                    </form>                                             
                </center>               
            </div>
            <div class="col-md-3"></div>
        </div>   
</body>

</html>