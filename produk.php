<?php
require "koneksi.php"
$queryKategori=mysqli_query($con, "SELECT * FROM kategori");
if(isset($_GET['keyword'])){
$queryProduk=mysqli_query($con, "SELECT * FROM produk WHERE nama LIKE '%$_GET[keyword]%'");
}else if(isset($_GET['kategori'])){
$queryGetKategoriId=mysqli_query($con, "SELECT * FROM produk WHERE nama '$_GET[kategori]'");
$kategoriId=mysqli_fetch_array($queryGetKategoriId);
$queryProduk=mysqli_query($con, "SELECT * FROM produk WHERE kategori_id='$kategoriId[id]'");
}else{
$queryProduk=mysqli_query($con, "SELECT * FROM produk");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zalivella | Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php require "navbar.php"; ?>
    <div class="container-fluid banner-produk d-flex align-items-center">
        <div class="container">
            <h1 class="text-white text-center">Produk</h1>
        </div>
    </div>

    <div class="container py-5">
        <div class="row">
            <div class="col-lg-3 mb5">
                <h3>Kategori</h3>
                <ul class="list-group">
                    <?php while($kategori=mysqli_fetch_array($queryKategori)){?>
                    <a href="produk.php?kategori=<?php echo $kategori['nama'];?>">
                    <li class="list-group-item"><?php echo $kategori['nama'];?></li>
                    </a>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-lg-9">
                <h3 class="text-center mb-3">Produk</h3>
                <div class="row">
                    <div class="col-md-4 mb-4">

            </div>
        </div>
    </div>

<footer>
        <p>&copy; 2023 Online Shope. All rights reserved.</p>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/your-fontawesome-kit-code.js" crossorigin="anonymous"></script>
</body>
</html>