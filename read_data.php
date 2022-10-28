<?php
require "connect.php";


$sql = "SELECT * FROM products";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <table class="table">
        <div class="page-header clearfix">
            <h2 class="pull-left">User Acount</h2>
            <a href="registrasi.php" class="btn btn-success pull-right">Tambah Produk</a>
        </div>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Deksripsi</th>
                <th>Harga</th>
                <th>Foto</th>
                <th>Date created</th>
                <th>Date Modified</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
            ?>
            <tr>
                <td><?=$row["id"];?></td>
                <td><?=$row["name"];?></td>
                <td><?=$row["description"];?></td>
                <td><?=$row["price"];?></td>
                <td><img src="Image/<?= $row['photo']?>" width="auto" height="100px"></td>
                <td><?=$row["created"];?></td>
                <td><?=$row["modified"];?></td>
                <?php echo
                "<td> <a href='update_data.php?id=$row[id]'>edit</a>|
                                  <a href='delate.php?id=$row[id]' onClick\retyrn confirm('Anda Yakin akan menghapus data ini?')\">Delete</a>
                           </td>";
                            ?>
            </tr>
            <?php
                }
                ?>

        </tbody>
    </table>
    <?php
            }
            $conn->close();
    ?>
</body>

</html>