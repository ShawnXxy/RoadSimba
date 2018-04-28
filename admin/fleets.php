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
                        <small>Information about your fleets.</small>
                    </h1>
                    <?php
                        if ($_SESSION['role'] == 1 || $_SESSION['role'] == 99) {
                            if (isset($_GET['source'])) {
                                $source = $_GET['source'];
                            } else {
                                $source = '';
                            }
                            switch($source) {
                                case 'add_fleet':
                                    include 'includes/add_fleet.php';
                                    break;
                                case 'edit_fleet':
                                    include 'includes/edit_fleet.php';
                                    break;   
                                case 'update_loc':
                                    include 'includes/update_loc.php';
                                    break;                    
                                default:
                                    include 'includes/all_fleets.php';
                                    break;
                            }
                        } else {
                            echo "<p class='bg-warning'>You cannot access this session! </p>";
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