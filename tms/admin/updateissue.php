<?php
include('includes/config.php');

if (isset($_GET['iid'])) {
    $iid = intval($_GET['iid']);

    if (isset($_POST['adminremark'])) {
        $adminremark = $_POST['adminremark'];
        $adminremarkdate = date('Y-m-d H:i:s');

        $sql = "UPDATE tblissues SET status='viewed', AdminRemark=:adminremark, AdminremarkDate=:adminremarkdate WHERE id=:iid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':adminremark', $adminremark, PDO::PARAM_STR);
        $query->bindParam(':adminremarkdate', $adminremarkdate, PDO::PARAM_STR);
    } else {
        $sql = "UPDATE tblissues SET status='viewed' WHERE id=:iid";
        $query = $dbh->prepare($sql);
    }

    $query->bindParam(':iid', $iid, PDO::PARAM_INT);
    $query->execute();

    echo "success";
}
?>
