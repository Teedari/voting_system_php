<?php  ob_start()  ?>
<?php include("admin/includes/init.php")?>
<?php   
    if(!$session->is_signed_in() || $_SESSION['user_role'] > 0){ redirect("./login.php"); }
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>USER - SECTION</title>

  <!-- Custom fonts for this template-->
  <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="admin/css/sb-admin.css" rel="stylesheet">
  
  <!-- My Custom Style -->
  <link href="css/style.css" rel="stylesheet">

</head>

<body class="">