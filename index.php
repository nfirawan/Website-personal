<?php
require "koneksi.php";
$queryProduk=mysqli_query($con, "SELECT id, nama, harga, foto, detail FROM produk Limit 8");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zalivella | Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php require "navbar.php"; ?>

    <div class="container-fluid banner d-flex align-items-center">
        <div class="container text-center text-white">
            <h1>Zalivella</h1>
            <h3>Mau cari apa?</h3>
            <div class="col-md-8 offset-md-2">
                <form method="get" action="produk.php">
                <div class="input-group input-group-lg my-4">
                    <input type="text" class="form-control" placeholder="Nama produk . . ." aria-label="Recipient's username" aria-describedby="basic-addon2" name="keyword">
                    <button type="submit" class="btn warna4">Telusuri</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Kategori Pilihan</h3>
            <div class="row mt-5">
                <div class="col-md-4 mb-3">
                    <div class="highlighted-kategori kategori-dress d-flex justify-content-center align-items-center">
                        <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=dress">Dress</a></h4>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="highlighted-kategori kategori-clothes d-flex justify-content-center align-items-center">
                    <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=clothes">Clothes</a></h4>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="highlighted-kategori kategori-bags d-flex justify-content-center align-items-center">
                    <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=bags">Bags</a></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--tentang kami-->
    <div class="container-fluid warna2 py-5">
        <div class="container text-center">
            <h3>Tentang Kami</h3>
            <p class="fs-5">
                Selamat datang di Zalivella, destinasi utama Anda untuk gaya dan kecantikan yang menginspirasi.
                Kami bangga menyajikan koleksi eksklusif pakaian, aksesori, sepatu, dan produk kecantikan terbaik untuk memenuhi kebutuhan fashionista modern.
                Di Zalivella, kami mengutamakan kualitas, desain terkini, dan pelayanan pelanggan yang unggul. Dengan semangat inovasi, 
                kami berkomitmen untuk memberikan pengalaman berbelanja online yang memuaskan dan memastikan setiap produk yang kami tawarkan 
                memberikan nilai tambah dalam penampilan dan perawatan diri Anda. Selamat berbelanja di Zalivella dan temukan gaya yang memancarkan keindahan Anda!
            </p>
        </div>
    </div>

    <!--produk-->
    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Produk</h3>
            <div class="row mt-5">
            <?php while($data=mysqli_fetch_array($queryProduk)){ ?>
            <div class="col-sm-6 col-md-3 mb-4">
                <div class="card" style="width: 18rem;">
                    <img src="image/<?php echo $data['foto'];?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $data['nama'];?></h5>
                        <p class="card-text text-truncate"><?php echo $data['detail'];?></p>
                        <p class="card-text text-harga">Rp <?php echo $data['harga'];?></p>
                        <a href="produk-detail.php?nama=<?php echo $data['nama'];?>" class="btn warna4 text-white">Detail</a>
                    </div>
                </div>
            </div>
            <?php } ?>
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