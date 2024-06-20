<?php
session_start();
include('includes/config.php');

if (!isset($_SESSION['login'])) {
    header('location:index.php');
    exit();
}

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $destination = $_POST['destination'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $created_by = $_SESSION['login'];

    $sql = "INSERT INTO itineraries (title, description, destination, start_date, end_date, created_by) VALUES (:title, :description, :destination, :start_date, :end_date, :created_by)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':title', $title, PDO::PARAM_STR);
    $query->bindParam(':description', $description, PDO::PARAM_STR);
    $query->bindParam(':destination', $destination, PDO::PARAM_STR);
    $query->bindParam(':start_date', $start_date, PDO::PARAM_STR);
    $query->bindParam(':end_date', $end_date, PDO::PARAM_STR);
    $query->bindParam(':created_by', $created_by, PDO::PARAM_STR);
    $query->execute();

    if ($dbh->lastInsertId()) {
        $msg = "Itinerary created successfully!";
    } else {
        $error = "Something went wrong. Please try again.";
    }
}
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Create Itinerary</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<link href="css/font-awesome.css" rel="stylesheet">
<script src="js/jquery-1.12.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<style>

    .form-group {
        margin-bottom: 20px;
    }
    .errorWrap {
        padding: 10px;
        margin-bottom: 20px;
        background: #fff;
        border-left: 4px solid #dd3d36;
        box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    }
    .succWrap {
        padding: 10px;
        margin-bottom: 20px;
        background: #fff;
        border-left: 4px solid #5cb85c;
        box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    }
    .btn-primary {
        background-color: #337ab7;
        border-color: #2e6da4;
    }
    .btn-primary:hover,
    .btn-primary:focus {
        background-color: #286090;
        border-color: #204d74;
    }
</style>
</head>
<body>
<?php include('includes/header.php'); ?>
<div class="container">
    <h2>Create Itinerary</h2>
    <?php if(isset($error)){?>
        <div class="errorWrap"><strong>ERROR</strong>: <?php echo htmlentities($error); ?></div>
    <?php } else if(isset($msg)){?>
        <div class="succWrap"><strong>SUCCESS</strong>: <?php echo htmlentities($msg); ?></div>
    <?php }?>

    <form method="post">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="destination">Destination</label>
            <input type="text" name="destination" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date" name="end_date" class="form-control" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Create</button>
    </form>
</div>
<?php include('includes/footer.php'); ?>
</body>
</html>

