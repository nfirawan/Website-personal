<?php
require "session.php";
require "koneksi.php";

$id=$_GET['p'];
$query=mysqli_query($con, "SELECT * FROM kategori WHERE id='$id'");
$data=mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <?php require "navbar.php"; ?>
    <div class="container mt-5">
        <h2>Detail Kategori</h2>
        <div class="col-12 col-md-6">
            <form action="" method="post">
                <div>
                    <label for="kategori">Kategori</label>
                    <input type="text" name="kategori" id="kategori" class="form-control" value="<?php echo $data['nama'];?>">
                </div>

                <div class="mt-3 d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary" name="editbtn">Edit</button>
                    <button type="submit" class="btn btn-danger" name="deletebtn">Delete</button>
                </div>
            </form>

            <?php
            if(isset($_POST['editbtn'])){
                $kategori=htmlspecialchars($_POST['kategori']);

                if($data['nama']==$kategori){
                    ?>
                        <meta http-equiv="refresh" content="0; url=kategori.php"/>
                    <?php
                }
                else{
                    $query=mysqli_query($con, "SELECT * FROM kategori WHERE nama='$kategori'");
                    $jumlahData=mysqli_num_rows($query);

                    if($jumlahData > 0){
                        ?>
                        <div class="alert alert-warning mt-3" role="alert">
                            Kategori sudah ada
                        </div>
                        <?php
                    }else{
                        $querySimpan=mysqli_query($con,"UPDATE kategori Set nama='$kategori' WHERE id='$id'");
                        if($querySimpan){
                            ?>
                            <div class="alert alert-warning mt-3" role="alert">
                                Kategori Berhasil Diupdate
                            </div>

                            <meta http-equiv="refresh" content="2; url=kategori.php"/>
                            <?php    
                        }
                        else{
                            echo mysqli_error($con);
                        }
                    }
                }
            }

            if(isset($_POST['deletebtn'])){
                $queryCheck=mysqli_query($con, "SELECT * FROM produk WHERE kategori_id='$id'");
                $queryCount=mysqli_num_rows($queryCheck);

                if($dataCount>0){
                    ?>
                        <div class="alert alert-warning mt-3" role="alert">
                            Kategori tidak bisa dihapus karena sudah digunakan di produk
                        </div>
                    <?php
                    die();
                }

                $queryDelete=mysqli_query($con, "DELETE FROM kategori WHERE id='$id'");

                if($queryDelete){
                    ?>
                        <div class="alert alert-primary mt-3" role="alert">
                            Kategori Berhasil Dihapus
                        </div>

                        <meta http-equiv="refresh" content="2; url=kategori.php"/>
                        <?php 
                }else{
                    echo mysqli_error($con);
                }
            }
            ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>