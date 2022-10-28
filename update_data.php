<?php
$nameErr = $priceErr = $photoErr = $descriptionErr = '';
$valid_name = $valid_price = $valid_photo = $valid_description = false;



require 'connect.php';
$sql = "SELECT * FROM products WHERE id = '$_GET[id]'";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $id1 = $_GET['id'];
    $name = $row['name'];
    $description = $row['description'];
    $price = $row['price'];
}

// $email1 = $_GET['email'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Registrasi</title>
    <style>
        .error {
            color: #FF0000;
        }
    </style>
</head>

<body>
    <!-- <h1>Update data Database </h1>
    <form action="" method="post"> -->
    <!-- Name :
        <input type="text" name="name" value="<?= $name ?>">
        <span class="error">* <?php echo $nameErr; ?></span>
        <br><br> -->

    <!-- <input type="hidden" name="email" value="<?= $email1 ?>"> -->

    <h2>Shopping List</h2>
    <p><span class="error">* Required Field</span></p>
    <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        Name: <input type="text" name="name" value="<?= $name ?>">
        <span class="error">* <?php echo $nameErr; ?></span>
        <br><br>

        <input type="hidden" name="id" value="<?= $id1 ?>">

        Description: <textarea name="description" rows="5" cols="40"><?= $description ?></textarea>
        <span class="error">* <?php echo $descriptionErr; ?></span>
        <br><br>
        Price: <input type="text" name="price" value="<?= $price ?>">
        <span class="error">* <?php echo $priceErr; ?></span>
        <br><br>
        Photo: <input type="file" name="file" accept="image/*">
        <br><br>
        <form method="post" enctype="multipart/form-data">
            <input type="submit" name="Upload" value="Upload">
        </form>
        <br><br>
    </form>


    <br><br>
    <!-- <input type="submit" name="update" value="Update">
    </form> -->

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($_POST["name"])) {
            $nameErr = "Masukkan nama";
        } else {
            $name = test_input($_POST["name"]);
            $valid_name = true;
            if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                $nameErr = "Hanya huruf dan spasi diperbolehkan";
                $valid_name = false;
            }
        }

        if (empty($_POST["description"])) {
            $descriptionErr = "Masukkan deskripsi";
        } else {
            $description = test_input($_POST["description"]);
            $valid_description = true;
        }

        if (empty($_POST["price"])) {
            $priceErr = "Masukkan harga";
        } else {
            $price = test_input($_POST["price"]);
            if (!preg_match("/^[ 0-9]*$/", $price)) {
                $priceErr = "Only number allowed";
            } else {
                $valid_price = true;
            }
        }
    }


    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if ($valid_name && $valid_price && $valid_description  == true) {

        if (isset($_POST['Upload'])) {
            $dir_upload = "images/";
            $nama_file = $_FILES['file']['name'];
            //
            if (is_uploaded_file($_FILES['file']['tmp_name'])) {
                $cek = move_uploaded_file(
                    $_FILES['file']['tmp_name'],
                    $dir_upload . $nama_file
                );
                if ($cek) {
                    echo "Photo berhasil diupload";
                } else {
                    echo "Photo gagal diupload";
                }
            }
        }

        $modified = date ('Y-m-d H:i:s');
        $photo = $nama_file;

        $sql1 = "UPDATE products SET 
                            name = '$name',
                            price = '$price',
                            photo = '$photo',
                          description = '$description',
                            modified = '$modified'
                      
                            where id = '$_POST[id]'";
        $result = $conn->query($sql1);

        if ($conn->query($sql1) === TRUE) {
            // echo "New record created successfully";
            header('Location: read_data.php');
    
        } else {
            echo "Error: " . $sql1 . "<br>" . $conn->error;
        }


      
    }
    $conn->close();


    ?>

</body>

</html>