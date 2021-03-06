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
                    </h1>
                    <?php
                        if (isset($_GET['source'])) {
                            $source = $_GET['source'];
                        } else {
                            $source = '';
                        }
                        switch($source) {
                            case 'details_load':
                                include "includes/details_load.php";
                                break;
                            case 'add_load':
                                include "includes/add_load.php";
                                break;
                            case 'edit_load':
                                include "includes/edit_load.php";
                                break;
                            default:
                                include 'includes/all_loads.php';
                                break;
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