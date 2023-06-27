<?php
session_start();

if (isset($_SESSION['name']) && isset($_SESSION['user_name'])) {
include './config/koneksi.php';

$kode = $_GET['kodenya'];

mysqli_query($koneksi,"DELETE FROM tb_todolist WHERE kode='$kode='");

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
