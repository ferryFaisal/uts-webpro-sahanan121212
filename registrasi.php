<!DOCTYPE HTML>
<html>

<head>
    <style>
        .error {
            color: #FF0000;
        }
    </style>
</head>

<body>

    <?php

    $nameErr = $priceErr = $photoErr = $descriptionErr = '';
    $name = $price = $photo = $description = '';
    $valid_name = $valid_price = $valid_photo = $valid_description = false;


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

    ?>





    <h2>Shopping List</h2>
    <p><span class="error">* Required Field</span></p>
    <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        Name: <input type="text" name="name" value="<?php echo $name; ?>">
        <span class="error">* <?php echo $nameErr; ?></span>
        <br><br>
        Description: <textarea name="description" rows="5" cols="40"><?php echo $description; ?></textarea>
        <span class="error">* <?php echo $descriptionErr; ?></span>
        <br><br>
        Price: <input type="text" name="price" value="<?php echo $price; ?>">
        <span class="error">* <?php echo $priceErr; ?></span>
        <br><br>
        Photo: <input type="file" name="file" accept="image/*">
        <br><br>
        <form method="post" enctype="multipart/form-data">
            <input type="submit" name="Upload" value="Upload">
        </form>
        <br><br>
    </form>

    <?php
    if ($valid_name && $valid_price && $valid_description  == true) {
        echo "<br>";
        echo "<h2>Your Input:</h2>";
        echo "<br>";
        echo  "Nama :";
        echo $name;
        echo "<br>";
        echo "Harga :";
        echo  $price;
        echo "<br>";
        echo "Deskripsi :";
        echo $description;
        echo "<br>";

         if (isset($_POST['Upload'])) {
            $dir = "image";
            $cek = mkdir($dir);
            if ($cek){
                echo "Direktori <b>$dir </b> berhasil dibuat";
            }else{
            }
            $dir_upload = "images/";
             $nama_file = $_FILES['file']['name'];
        
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

        include "insert.php";
        header('Location: read_data.php');
    }
    ?>




</body>

</html>