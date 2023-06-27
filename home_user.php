<?php
session_start();

if (isset($_SESSION["id"]) && isset($_SESSION["name"])) { ?>

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
	display: flex;
	justify-content: center;
	align-items: center;
	flex-direction: column;
    style="size:1040px;
    height:960px;
    background:url('asstes/img/bg.jpg') no-repeat; 
    background-size: cover}

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
                <center></br>
                <h1 class="text-primary">Hello, <?php echo $_SESSION[
                    "name"
                ]; ?></h1> </br>
                    <table class="table table-striped table-hover">
                        <thread >
                            <tr class="thead-dark">
                                <th class="text-center" colspan = 4 > Daftar Tugas </th>
                                
                            </tr>
                        </thread>

                        
                    <tbody>
                        <?php
                        include "./config/koneksi.php";
                        $queryTugas = mysqli_query(
                            $koneksi,
                            "SELECT * FROM tb_todolist"
                        );
                        while ($resultTugas = mysqli_fetch_array($queryTugas)) {
                            if ($resultTugas["selesai"] == 1) {
                                $isitugas =
                                    "<s>" . $resultTugas["isi"] . "</s>";
                            } 
                            else {
                                $isitugas = $resultTugas["isi"];
                            } ?>

                            <tr class="text-center">
                                <td><?php echo $isitugas; ?> </td>
                            </tr>
                        <?php
                        }
                        ?>
                            
                    </tbody>

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
</html>
<?php } else {header("Location: index.php");
    exit();}
?>
