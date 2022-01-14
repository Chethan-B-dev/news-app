<?php
    include_once("functions.php");
    include_once("config/db.php");

    if(!isset($_SESSION['isLoggedIn'])){
        header("Location: login.php");
    }


    $error = null;
    $success = null;
    $news = getMyLikes($conn);

    if(isset($_GET['delete'])){
        $deleteId = $_GET['delete'];
        $status = deleteLike($conn,$deleteId);
        if ($status == 1){
            header("Location: likes.php");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>News-App</title>
  </head>
  <body>

  <!-- <?php // print_r($_SESSION); ?> -->

    <?php include_once("fragments/header.php"); ?>


    <h3 class="text-center">
      News That I have Liked
      <?php if(isset($_SESSION['isLoggedIn'])): ?>
        <span><?php echo $_SESSION['username']; ?></span>
      <?php endif ?>
    </h3>

    <?php if($error != null): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error; ?>
        </div> 
    <?php endif ?>


    <?php if($success != null): ?>
        <div class="alert alert-success" role="alert">
            <?php echo $success; ?>
        </div> 
    <?php endif ?>


    <div class="container">
        <div class="row">
        <?php foreach($news as $key=>$value): ?>
            <div class="card m-2" style="width: 18rem;">
              <div class="card-body">
                <img src="<?php echo $value->get_image(); ?>" class="card-img-top" alt="<?php echo $value->get_title(); ?>">
                <h5 class="card-title"><?php echo $value->get_title(); ?></h5>
                <p class="card-text"><?php echo $value->get_description(); ?></p>
                <p class="text-muted"><?php echo $value->get_published_at(); ?></p>
                <a href="#" class="btn btn-primary disabled">Like</a>
                <a href="likes.php?delete=<?php echo $value->get_id(); ?>" class="btn btn-danger">Delete</a>
              </div>
            </div>
        <?php endforeach; ?>

        </div>
    </div>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>