<?php
  include "conn.php";

  // proses insert data ke database
  if (isset($_POST['add'])) {

    $q_insert = "insert into todo (label, status) value (
      '".$_POST['task']."', 
      'open'
    )";

    $run_q_insert = mysqli_query($conn, $q_insert);

    if($run_q_insert) {
      header("Refresh:0; url=index.php");
    }
  }

  // Proses mengambil data dari database
  $q_select = "select * from todo order by id desc";
  $run_q_select = mysqli_query($conn, $q_select);

  // proses remove data
  if (isset($_GET['delete'])) {
    $q_delete = "delete from todo where id = '".$_GET['delete']."'";
    $run_q_delete = mysqli_query($conn, $q_delete);

    header('Refresh:0, url=index.php');
  }

  // prose update data
  if (isset($_GET['done'])) {
    $status = "close";

    if($_GET['status'] == 'open') {
      $status = "close";
    } else {
      $status = "open";
    }

    $q_update = "update todo set status = '".$status."' where id = '".$_GET['done']."'";
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
  <title>To Do List - Projek Akhir</title>
</head>
<body>

  <div id="particles-js">
    <div class="container">

      <div class="header">
        <div class="title">
          <i class="fa-solid fa-sun"></i>
          <span>To Do List</span>
        </div>
        <div class="description">
          <?= date("l, d-M-Y") ?>
        </div>
      </div>

      <div class="content">

        <div class="card">

          <form action="" method="POST">
            <div class="input-task">
              <input type="text" name="task" id="task" placeholder="Add Task" class="input-control" autocomplete="off">
              <button type="submit" name="add">Tambah</button>
            </div>
          </form>

        </div>

        <?php
          
          if(mysqli_num_rows($run_q_select) > 0) {
            while ($row = mysqli_fetch_array($run_q_select)) {

        ?>

        <div class="card">
          <div class="task-item <?= $row['status'] == 'close' ? 'done': ''?>">
            <div class="">
              <input type="checkbox" onclick="window.location.href = '?done=<?= $row['id'] ?>&status=<?= $row['status']?>'" <?= $row['status'] == 'close' ? 'checked' : '' ?>>
              <span><?= $row['label'] ?></span>
            </div>

            <div class="func-button">
              <a href="edit.php?id=<?= $row['id']?>" class="text-edit" title="Edit"><i class="fa-solid fa-edit"></i></a>
              <a href="?delete=<?= $row['id']?>" class="text-delete" title="Remove" onclick="confirm('Kamu Yakin')"><i class="fa-solid fa-trash"></i></a>
            </div>
          </div>
        </div>

        <?php
          }} else{
        ?>
          <div class="card">
            <span>belum ada tugas</span>
          </div>
        <?php
          }
        ?>
          
      </div>

    </div>
  </div>

  <script src="js/particles.min.js"></script>
  <script src="js/app.js"></script>
</body>
</html>