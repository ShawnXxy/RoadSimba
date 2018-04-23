<?php
    include "functions.php";
?>

<!-- Header -->
<?php include 'includes/header.php'; ?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include 'includes/navigation.php'; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome, 
                        <small><?php echo $_SESSION['firstname']; ?></small> !
                        <br>
                        <small>Information about your dispatchers.</small>
                    </h1>
                    <?php
                        if ($_SESSION['role'] == 0) {
                            if (isset($_GET['source'])) {
                                $source = $_GET['source'];
                            } else {
                                $source = '';
                            }
                            switch($source) {
                                case 'add_dispatcher':
                                    include 'includes/add_dispatcher.php';
                                    break;
                                case 'edit_dispatcher':
                                    include 'includes/edit_dispatcher.php';
                                    break;                       
                                default:
                                    include 'includes/all_dispatchers.php';
                                    break;
                            }
                        } else {
                            echo "<p class='bg-warning'> You cannot access this session!</p>";
                        }
                    ?>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

<!-- Footer -->
<?php include "includes/footer.php"; ?>