<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (!isset($_SESSION['login'])) {
    header('location:index.php');
    exit();
}

// Initialize variables
$msg = '';
$error = '';

// Edit itinerary logic
if (isset($_GET['edit']) && !empty($_GET['edit'])) {
    $edit_id = $_GET['edit'];

    // Fetch itinerary details from database
    $sql = "SELECT * FROM itineraries WHERE id = :id AND created_by = :created_by";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $edit_id, PDO::PARAM_INT);
    $query->bindParam(':created_by', $_SESSION['login'], PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if (!$result) {
        $error = "Itinerary not found or you don't have permission to edit.";
    }
}

// Update itinerary logic
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $destination = $_POST['destination'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $sql_update = "UPDATE itineraries SET title = :title, description = :description, destination = :destination, start_date = :start_date, end_date = :end_date WHERE id = :id AND created_by = :created_by";
    $query_update = $dbh->prepare($sql_update);
    $query_update->bindParam(':id', $id, PDO::PARAM_INT);
    $query_update->bindParam(':title', $title, PDO::PARAM_STR);
    $query_update->bindParam(':description', $description, PDO::PARAM_STR);
    $query_update->bindParam(':destination', $destination, PDO::PARAM_STR);
    $query_update->bindParam(':start_date', $start_date, PDO::PARAM_STR);
    $query_update->bindParam(':end_date', $end_date, PDO::PARAM_STR);
    $query_update->bindParam(':created_by', $_SESSION['login'], PDO::PARAM_STR);
    $query_update->execute();

    if ($query_update->rowCount() > 0) {
        $msg = "Itinerary updated successfully!";
    } else {
        $error = "Failed to update itinerary. Please try again.";
    }
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Manage Itineraries</title>
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
</head>
<body>
    <?php include('includes/header.php'); ?>
    <div class="container">
        <h2>Manage Itineraries</h2>
        <?php if ($error) { ?>
            <div class="errorWrap"><strong>ERROR</strong>: <?php echo htmlentities($error); ?></div>
        <?php } else if ($msg) { ?>
            <div class="succWrap"><strong>SUCCESS</strong>: <?php echo htmlentities($msg); ?></div>
        <?php } ?>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Destination</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch itineraries for the logged-in user
                    $sql_itineraries = "SELECT * FROM itineraries WHERE created_by = :created_by";
                    $query_itineraries = $dbh->prepare($sql_itineraries);
                    $query_itineraries->bindParam(':created_by', $_SESSION['login'], PDO::PARAM_STR);
                    $query_itineraries->execute();
                    $results = $query_itineraries->fetchAll(PDO::FETCH_ASSOC);

                    if ($query_itineraries->rowCount() > 0) {
                        foreach ($results as $result) {
                            ?>
                            <tr>
                                <td><?php echo htmlentities($result['title']); ?></td>
                                <td><?php echo htmlentities($result['description']); ?></td>
                                <td><?php echo htmlentities($result['destination']); ?></td>
                                <td><?php echo htmlentities($result['start_date']); ?></td>
                                <td><?php echo htmlentities($result['end_date']); ?></td>
                                <td>
                                    <a href="itineraries.php?edit=<?php echo htmlentities($result['id']); ?>">Edit</a>
                                </td>
                            </tr>
                        <?php }
                    } else { ?>
                        <tr>
                            <td colspan="6">No itineraries found.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <?php if (isset($_GET['edit']) && $result) { ?>
            <h2>Edit Itinerary</h2>
            <form method="post">
                <input type="hidden" name="id" value="<?php echo htmlentities($result['id']); ?>">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" value="<?php echo htmlentities($result['title']); ?>" required>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" class="form-control" required><?php echo htmlentities($result['description']); ?></textarea>
                </div>
                <div class="form-group">
                    <label>Destination</label>
                    <input type="text" name="destination" class="form-control" value="<?php echo htmlentities($result['destination']); ?>" required>
                </div>
                <div class="form-group">
                    <label>Start Date</label>
                    <input type="date" name="start_date" class="form-control" value="<?php echo htmlentities($result['start_date']); ?>" required>
                </div>
                <div class="form-group">
                    <label>End Date</label>
                    <input type="date" name="end_date" class="form-control" value="<?php echo htmlentities($result['end_date']); ?>" required>
                </div>
                <button type="submit" name="update" class="btn btn-primary">Update</button>
            </form>
        <?php } ?>
    </div>
    <?php include('includes/footer.php'); ?>
</body>
</html>

