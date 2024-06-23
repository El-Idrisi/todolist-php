<?php
  include "conn.php";

  // Proses mengambil data yang akan diedit
  $q_select = "select * from todo where id = '".$_GET['id']."'";
  $run_q_select = mysqli_query($conn, $q_select);
  $data = mysqli_fetch_object($run_q_select);

  // prose edit data
  if (isset($_POST['edit'])) {
    $q_update = "update todo set label = '".$_POST['task']."' where id = '".$_GET['id']."'";
    $run_q_update = mysqli_query($conn, $q_update);

    header('Refresh:0, url=index.php');
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
  <!-- Google Fonts -->

  <!-- Fonts Awesome -->
  <script src="https://kit.fontawesome.com/bd2b93a447.js" crossorigin="anonymous"></script>
  <!-- Fonts Awesome -->
  <link rel="stylesheet" href="css/style.css">

  <style>
    .header .title a{
      color: #fff;
      text-decoration: none;
    }
  </style>
  <title>To Do List - Projek Akhir</title>
</head>
<body>

  <div id="particles-js">
  <div class="container">
    <div class="header">
      <div class="title">
        <a href="index.php">
          <i class="fa-solid fa-angle-left"></i>
          <span>Back</span>
        </a>
      </div>
      <div class="description">
        <?= date("l, d-M-Y") ?>
      </div>
    </div>
    <div class="content">

      <div class="card">

        <form action="" method="POST">
          <div class="input-task">
            <input type="text" name="task" id="task" placeholder="Edit Task" class="input-control" value="<?= $data->label?>">
            <button type="submit" name="edit">Edit</button>
          </div>
        </form>

      </div>
        
    </div>
  </div>
  </div>


  <script src="js/particles.min.js"></script>
  <script src="js/app.js"></script>
</body>
</html>