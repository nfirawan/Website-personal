<?php
require "session.php";
require "koneksi.php";

$query=mysqli_query($con,"SELECT a.*,b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id=b.id");
$data=mysqli_fetch_array($query);
$queryKategori=mysqli_query($con,"SELECT * FROM kategori WHERE id!='$data[kategori_id]'");
function generateRandomString($length=10){
    $characters='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength=strlen($characters);
    $randomString='';
    for($i=0; $i<$length;$i++){
        $randomString.=$characters[rand(0,$charactersLength-1)];
    }
    return $randomString;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<style> 
    form div{
        margin-bottom: 10px;
    }
</style>

<body>
    <?php require "navbar.php"; ?>
    <div class="container mt-5">
    <h2>Detail Produk</h2>
        <div class="col-12 col-md-6 mb-5">
            <form action="" method="post" enctype="multipart/foorm-data">
                <div>
                    <label for="nama">Nama</label>
                    <input type="text" name="namma" id="nama" class="form-control" value="<?php echo $data['nama'];?>" autocomplete="off" required>
                </div>

                <div class="mt-3">
                        <label for="kategori">Kategori</label>
                        <select name="kategori" id="kategori" class="form-control" required>
                            <option value="<?php echo $data['kategori_id'];?>"><?phpecho $data['nama_kategori'];?></option>
                            <?php
                                while($dataKategori=mysqli_fetch_array($queryKategori)){
                            ?>
                                <option value="<?php echo $dataKatagori['id'];?>"><?php echo $dataKategori['nama'];?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control"  value="<?php echo $data['harga'];?>" name="harga" required>
                    </div>
                    <div>
                        <label for="currentFoto">Foto Produk Sekarang</label>
                        <img src="../image/<?php echo $data['foto']?>" alt="" width="300px">
                    </div>
                    <div>
                        <label for="foto">Foto</label>
                        <input type="file" class="form-control" name="foto" id="foto">
                    </div>
                    <div>
                        <label for="detail">Detail</label>
                        <textarea class="form-control" name="detail" id="detail" cols="30" rows="10"><?php echo $detail['detail'];?></textarea>
                    </div>
                    <div>
                        <label for="stok">Stok</label>
                        <select name="stok" id="stok" class="form-control">
                            <option value="<?php echo $data['stok']?>"><?php echo $data['stok']?></option>
                            <option value="habis">Habis</option>
                            <?php
                                if($data['stok']=='tersedia'){
                            ?>
                                <option value="habis">Habis</option>
                            <?php
                                }else{
                            ?>
                                    <option value="Tersedia">Tersedia</option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-primary" type="submit" name="simpan">Simpan</button>
                        <button class="btn btn-primary" type="submit" name="delete">Delete</button>
                    </div>
            </form>
            <?php
                if(isset($_POST['simpan'])){
                    $nama=htmlspecialchars($_POST['nama']);
                    $kategori=htmlspecialchars($_POST['kategori']);
                    $harga=htmlspecialchars($_POST['harga']);
                    $detail=htmlspecialchars($_POST['detail']);
                    $stok=htmlspecialchars($_POST['stok']);

                    $target_dir = "../image/";
                    $nama_file=basename($_FILES["foto"]["name"]);
                    $target_file=$target_dir.$nama_file;
                    $imageFileType=strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    $image_size=$_FILES["foto"]["size"];
                    $random_name=generateRandomString(20);
                    $new_name=$random_name. "." . $imageFileType;

                    if($nama=='' || $kategori=='' || $harga==''){
                        ?>
                            <div class="alert alert-warning mt-3" role="alert">
                                Nama, kategori dan harga wajib diisi
                            </div>
                        <?php
                    }else{
                        $queryUpdate=mysqli_query($con, "UPDATE produk SET kategori_id='$kategori', nama='$nama', harga='$harga', detail='$detail', stok='$stok' WHERE id=$id");
                        if($nama_file!=''){
                            if($image_size>500000){
                            ?>
                                <div class="alert alert-warning mt-3" role="alert">
                                    File tidak boleh lebih dari 500 kb
                                </div>
                            <?php
                            }else{
                                if($imageFileType!='jpg' && $imageFileType!='png' && $imageFileType!='gif'){
                            ?>
                                <div class="alert alert-warning mt-3" role="alert">
                                    File wajib bertipe jpg atau png atau gif
                                </div>
                            <?php
                            }else{
                                move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir.$new_name);
                                $queryUpdate=mysqli_query($con, "UPDATE produk SET foto='$new_name' WHERE id='$id'");
                                if($queryUpdate){
                            ?>
                                    <div class="alert alert-warning mt-3" role="alert">
                                        Produk Berhasil Diupdate
                                    </div>
                                    <meta http-equiv="refresh" content="2; url=kategori.php"/>
                            <?php
                                }
                            }else{
                                echo mysqli_error($con);
                            }
                        }
                    }
                }
                if(isset($_POST['delete'])){
                    $queryHapus=mysqli_query($con,"DELETE FROM produk WHERE id='$id'");
                    if($queryHapus){
                    ?>
                        <div class="alert alert-warning mt-3" role="alert">
                            Produk Berhasil Dihapus
                        </div>
                        <meta http-equiv="refresh" content="2; url=kategori.php"/>
                    <?php
                    }
                }
            ?>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
