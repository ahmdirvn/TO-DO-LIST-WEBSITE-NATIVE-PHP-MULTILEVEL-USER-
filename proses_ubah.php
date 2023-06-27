<?php
session_start();

if (isset($_SESSION['name']) && isset($_SESSION['user_name'])) {
include './config/koneksi.php';

$tugas = $_POST['isitugas'];
$kode = $_POST['kode'];

mysqli_query($koneksi,"UPDATE tb_todolist SET isi='$tugas' WHERE kode='$kode='");

if(mysqli_errno($koneksi)>0){
    //echo "Gagal ".mysqli_error($koneksi);
    header("Location: home_admin.php?pesan=Gagal Di Proses");
}else{
    //echo "Berhasil";
    header("Location: home_admin.php?pesan=Berhasil Di Proses");
}

}else{
    header("Location: home_user.php");
    exit();
}