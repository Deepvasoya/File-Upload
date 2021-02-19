<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "uploadfile";

$conn = new mysqli($servername, $username, $password, $db);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} else {
  if (isset($_POST['submit'])) {
    $fullname = $_POST['fullname'];
    $image = $_FILES['image'];

    $file_name = $_FILES['image']['name'];
    $file_type = $_FILES['image']['type'];
    $file_tmp_name = $_FILES['image']['tmp_name'];
    $file_size = $_FILES['image']['size'];
    $file_address = "Uploadimage/" . $file_name;


    $fileext = explode('.', $file_name);
    $filecheck = strtolower(end($fileext));
    $fileextstore = array("jpg", "png", "jpeg");
    if (in_array($filecheck, $fileext)) {
      move_uploaded_file($file_tmp_name, $file_address);

      $sql = "INSERT INTO `information`(`fullname`, `image`) VALUES ('$fullname','$file_address')";
      $result = mysqli_query($conn, $sql);
    }
  }
}
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

  <title>Upload File</title>
</head>

<body>
  <div class="container my-5">
    <h1 class="bg-dark text-center text-danger">Enter Your Information</h1>
  </div>
  <div class="container my-5">
    <form action="" method="POST" enctype="multipart/form-data">
      <div class="mb-3">
        <label class="form-label">Enter Full Name</label>
        <input type="text" class="form-control" id="fullname" name="fullname">
      </div>
      <div class="mb-3">
        <label class="form-label">Upload Your Photo</label>
        <input type="file" class="form-control" id="image" name="image">
      </div>
      <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
  </div>
  <div class="container my-5">
    <h1 class="bg-dark text-center text-danger">Verify Your Information</h1>
  </div>
  <div class="container my-5">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Sno</th>
          <th scope="col">Full Name</th>
          <th scope="col">Image</th>
        </tr>
      </thead>

      <?php

      $fetch = "SELECT * FROM `information`";
      $result2 = mysqli_query($conn, $fetch);
      $i = 0;
      while ($row = mysqli_fetch_assoc($result2)) {
        $i++;


        echo '
      <tbody>
        <tr>
        <th scope="row">' . $i . '</th>
        <td>' . $row['fullname'] . '</td>
        <td><img src=' . $row['image'] . '  width="100" height="100" ></td>
        
         </tr>
      ';
      }

      ?>
      </tbody>
    </table>
  </div>

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    -->
</body>

</html>