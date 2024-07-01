<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {    
header('location:index.php');
}
else{ 
    if(isset($_REQUEST['eid']))
    {
        $eid=intval($_GET['eid']);
        $status=1;

        $sql = "UPDATE tblenquiry SET Status=:status WHERE id=:eid";
        $query = $dbh->prepare($sql);
        $query -> bindParam(':status', $status, PDO::PARAM_STR);
        $query-> bindParam(':eid', $eid, PDO::PARAM_STR);
        $query -> execute();

        $msg="Enquiry successfully read";
    }
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Horizon | Admin manage Issues</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/morris.css" type="text/css"/>
<link href="css/font-awesome.css" rel="stylesheet"> 
<script src="js/jquery-2.1.4.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/table-style.css" />
<link rel="stylesheet" type="text/css" href="css/basictable.css" />
<script type="text/javascript" src="js/jquery.basictable.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#table').basictable();

        $('#table-breakpoint').basictable({
            breakpoint: 768
        });

        $('#table-swap-axis').basictable({
            swapAxis: true
        });

        $('#table-force-off').basictable({
            forceResponsive: false
        });

        $('#table-no-resize').basictable({
            noResize: true
        });

        $('#table-two-axis').basictable();

        $('#table-max-height').basictable({
            tableWrapper: true
        });
    });

    var popUpWin = 0;
    function popUpWindow(URLStr, left, top, width, height) {
        if (popUpWin) {
            if (!popUpWin.closed) popUpWin.close();
        }
        popUpWin = open(URLStr,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+600+',height='+600+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
    }

    function markAsViewed(eid, element) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                element.innerHTML = "Viewed";
                element.onclick = null; // disable the link after clicking
            }
        };
        xhttp.open("GET", "updateissue.php?iid=" + eid, true);
        xhttp.send();
    }

    function addAdminRemark(eid) {
        var adminremark = document.getElementById("adminremark_" + eid).value;

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("adminremarkstatus_" + eid).innerHTML = "Remark Added";
                document.getElementById("adminremarkstatus_" + eid).style.color = "green";
            }
        };
        xhttp.open("POST", "updateissue.php?iid=" + eid, true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("adminremark=" + adminremark);
    }
</script>
<style>
    .errorWrap {
        padding: 10px;
        margin: 0 0 20px 0;
        background: #fff;
        border-left: 4px solid #dd3d36;
        -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    }
    .succWrap {
        padding: 10px;
        margin: 0 0 20px 0;
        background: #fff;
        border-left: 4px solid #5cb85c;
        -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    }
</style>
</head> 
<body>
   <div class="page-container">
   <div class="left-content">
       <div class="mother-grid-inner">
            <?php include('includes/header.php');?>
            <div class="clearfix"> </div>    
        </div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a><i class="fa fa-angle-right"></i>Manage Issues</li>
        </ol>
        <div class="agile-grids">    
            <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
            else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
            <div class="agile-tables">
                <div class="w3l-table-info">
                    <h2>Manage Issues</h2>
                    <table id="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Mobile No.</th>
                                <th>Email Id</th>
                                <th>Issues</th>
                                <th>Description</th>
                                <th>Posting date</th>
                                <th>Action</th>
                                <th>Admin Remark</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT tblissues.id as id, tblusers.FullName as fname, tblusers.MobileNumber as mnumber, tblusers.EmailId as email, tblissues.Issue as issue, tblissues.Description as Description, tblissues.PostingDate as PostingDate, tblissues.status as status, tblissues.AdminRemark as adminremark, tblissues.AdminremarkDate as adminremarkdate FROM tblissues JOIN tblusers ON tblusers.EmailId=tblissues.UserEmail";
                            $query = $dbh->prepare($sql);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            if($query->rowCount() > 0) {
                                foreach($results as $result) {
                            ?>        
                            <tr>
                                <td width="120">#00<?php echo htmlentities($result->id);?></td>
                                <td width="50"><?php echo htmlentities($result->fname);?></td>
                                <td width="50"><?php echo htmlentities($result->mnumber);?></td>
                                <td width="50"><?php echo htmlentities($result->email);?></td>
                                <td width="200"><?php echo htmlentities($result->issue);?></a></td>
                                <td width="400"><?php echo htmlentities($result->Description);?></td>
                                <td width="50"><?php echo htmlentities($result->PostingDate);?></td>
                                <td>
                                    <a href="javascript:void(0);" onClick="markAsViewed(<?php echo $result->id; ?>, this); popUpWindow('updateissue.php?iid=<?php echo ($result->id);?>');">View</a>
                                </td>
                                <td>
                                    <textarea id="adminremark_<?php echo $result->id; ?>" rows="3" cols="30"><?php echo htmlentities($result->adminremark);?></textarea>
                                    <button onclick="addAdminRemark(<?php echo $result->id; ?>)">Submit</button>
                                    <div id="adminremarkstatus_<?php echo $result->id; ?>"></div>
                                </td>
                            </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    var navoffeset = $(".header-main").offset().top;
                    $(window).scroll(function() {
                        var scrollpos = $(window).scrollTop();
                        if (scrollpos >= navoffeset) {
                            $(".header-main").addClass("fixed");
                        } else {
                            $(".header-main").removeClass("fixed");
                        }
                    });
                });
            </script>
            <?php include('includes/footer.php');?>
        </div>
    </div>
    <?php include('includes/sidebarmenu.php');?>
    <div class="clearfix"></div>        
</div>
<script>
var toggle = true;
$(".sidebar-icon").click(function() {
    if (toggle) {
        $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
        $("#menu span").css({"position":"absolute"});
    } else {
        $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
        setTimeout(function() {
            $("#menu span").css({"position":"relative"});
        }, 400);
    }
    toggle = !toggle;
});
</script>
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php } ?>
