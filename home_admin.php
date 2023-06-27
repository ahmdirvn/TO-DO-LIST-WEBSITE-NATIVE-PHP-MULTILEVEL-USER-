<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To DO List App</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
   


    <style type="text/css">
    body {
	background-image:url('./assets/img/bg.jpg');
	display: flex;
	justify-content: center;
	align-items: center;
	height: 100vh;
	flex-direction: column;}

    .row div{
	border-radius: 15px;
   
    }

    .container div{
        background: white;
        border-radius : 20px
    } 
        </style>
</head>
<body>
    <div class="container"> 
        <div class="row" >
            <div class="col-md-3" ></div>
            <div class="col-md-6">

                <center>
</br>
                <h1 class="text-primary">Hello, <?php echo $_SESSION['name']; ?></h1> </br>
                    <form action ="./proses_simpan.php" method="post">
                    <div class="input-group mb-3">
                        <input type="text" name="isitugas" class="form-control" placeholder="Masukan Tugas" aria-label="Recipient's username" aria-describedby="basic-addon2" >
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">Tambahkan</button>
                        </div>
                        </div>
                    </form>
                    <table class="table table-striped table-hover">
                        <thread>
                            <tr class="thead-dark">
                                <th > Daftar Tugas </th>
                                <th colspan="3"> Proses </th>
                            </tr>
                        </thread>

                    <tbody>
                        <?php
                        include "./config/koneksi.php";
                        $queryTugas = mysqli_query($koneksi,"SELECT * FROM tb_todolist");
                        while($resultTugas = mysqli_fetch_array($queryTugas)){
                            if($resultTugas['selesai']==1){
                                $isitugas = '<s>'.$resultTugas['isi'].'</s>';
                            }else{
                                $isitugas = $resultTugas['isi'];
                            }
                        ?>
                            <tr>
                                <td><?php echo $isitugas;?> </td>
                                <?php   
                                     if($resultTugas['selesai']==1){
                                ?>
                                <td colspan="3" class="text-center"><a 
                                        href="./proses_hapus.php?kodenya=<?php echo $resultTugas['kode']; ?>" 
                                        class="btn btn-outline-danger"onclick="hapusdata(event)">
                                            <i class="fas fa-trash"></i></a></td>
                                <?php
                                     }else{
                                ?>
                                <td><a href="./proses_selesai.php?kodenya=<?php echo $resultTugas['kode']; ?>" class="btn btn-outline-success"><i class="fas fa-check"></td>
                                <td><a href="./ubah.php?kodenya=<?php echo $resultTugas['kode']; ?>" class="btn btn-outline-info"><i class="fas fa-edit"></i></a></td>
                                <td><a href="./proses_hapus.php?kodenya=<?php echo $resultTugas['kode']; ?>" class="btn btn-outline-danger"><i class="fas fa-trash"></i></a></td>
                                <?php } ?>

                            </tr>
                        <?php
                        }
                        ?>
                            
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4" class="text-center">
                                <a href = "./proses_hapus_semua.php?"
                                    class="btn btn-outline-danger"onclick="hapusdata(event)">Clear Item</a>
                            </th>
                        </tr>
                    </tfoot>

                    </table>
                           
                </center>
                
            </div>
            <div class="col-md-3"></div>
        </div>
                    </br>
        
        <a href="logout.php">
        <button style =" margin-left : 1000px" type="button" class="btn btn-danger">Logout</button>
        </a>
</body>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>

<?php if (isset($_GET['pesan'])){ ?>
    swal("Informasi", "<?php echo $_GET['pesan']; ?>", "success");
<?php } ?>

function hapusdata(ev) {
    ev.preventDefault();
    var urlToRedirect = ev.currentTarget.getAttribute('href');
    swal({
    title: "Are you sure?",
    text: "Once deleted, you will not be able to recover this imaginary file!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
    })
    .then((willDelete) => {
    if (willDelete) {
        /*swal("Poof! Your imaginary file has been deleted!", {
        icon: "success",
        }); */
        window.location.href = urlToRedirect
    } else {
        //swal("Your imaginary file is safe!");
    }
    });
}

</script>

</html>
<?php 
}else{
     header("Location: index.php");
     exit();
}
 ?>