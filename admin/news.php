<?php
// db connection
include '../lib/connection.php';

$result = null;

// data insert
if (isset($_POST['n_submit'])){

    $ntitle = $_POST['n_title'];
    $nicon  = $_POST['n_icon']; 
    $ndesc  = $_POST['n_desc'];
    $npass  = md5($_POST['n_pass']);
    $cpass  = md5($_POST['c_pass']);
    $cid    = $_POST['c_id'];
    

    if( $npass== $cpass ){
            // $result=" <h2 class='text-success'>Password Matched</h2>";
        $insert_sql="INSERT INTO news( title, icon, description, pass, c_id) VALUES('$ntitle','$nicon','$ndesc','$npass','$cid')";

        if( $conn -> query($insert_sql)){
                $result = "<h3 class='text-success'>Data Inserted Successfully</h3>";
        }else{
            die($conn -> error);
        }

    }else{
        $result=" <h2 class='text-danger'>Password not Matched</h2>";
    }

    // 

    // if($conn -> query($insert_sql)){
    //     $result = "<h3 class='text-success'>Data Inserted Successfully</h3>";
    // }else{
    //     die($conn -> error);
    // }
}

// select sql
$select_sql = "SELECT * from news";
$s_sql = $conn -> query($select_sql);
echo $s_sql -> num_rows;
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>NewsPaper</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="admin.php">NewsPaper</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li><hr class="dropdown-divider" /></li>
                    <li><a class="dropdown-item" href="#!">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="admin.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>

                        <a class="nav-link" href="category.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Categories
                        </a>
                        <a class="nav-link" href="news.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            News
                        </a>

                        <a class="nav-link" href="charts.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Charts
                        </a>
                    </div>
                </div>

            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">News</h1>
                    <!-- category insert -->
                    <div class="card p-3 mb-4">

                        <h3>Insert News</h3>
                     <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                         <div class="mb-3">
                             <label for="n_title" class="form-label">News Title</label>
                             <input type="text" class="form-control n_title" id="n_title" name="n_title" required>
                         </div>
                         <div class="mb-3">
                             <label for="n_icon" class="form-label">News Icon</label>
                             <input type="text" class="form-control n_icon" id="n_icon" name="n_icon" required>
                         </div>
                         <div class="mb-3">
                             <label for="n_desc" class="form-label">News Description</label>
                             <textarea name="n_desc" id="n_desc" class="form-control n_desc" required></textarea>
                         </div>
                         
                         <div class="mb-3">
                             <label for="n_pass" class="form-label">Password</label>
                             <input type="password" class="form-control n_pass" id="n_pass" name="n_pass" required>
                         </div>

                         <div class="mb-3">
                             <label for="c_pass" class="form-label">Confirm Password</label>
                             <input type="password" class="form-control c_pass" id="c_pass" name="c_pass" required>
                         </div> 

                         <div class="mb-3">
                             <label for="c_id" class="form-label">Category ID</label>
                             <input type="number" class="form-control c_id" id="c_id" name="c_id" required>
                         </div>

                         <div class="mb-3">
                          <button class="btn btn-success" type="submit" name="n_submit">Submit</button>
                          <button class="btn btn-danger" type="reset">Reset</button>
                      </div>
                  </form>
                  <div class="result">
                     <?php echo $result ; ?>
                 </div>
             </div>
             <!-- category info -->
             <div class="card mb-4">

                <div class="card-body">
                    <h3>News Details</h3>
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>News Title</th>
                                <th>News Icon</th>
                                <th>News DESC</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($s_sql -> num_rows > 0){ ?>
                            <?php while($final=$s_sql -> fetch_assoc()){?>
                            <tr>
                                <td><?php echo $final['title'];?></td>
                                <td><?php echo $final['icon'];?></td>
                                <td><?php echo $final['description'];?></td>
                                <td>
                                    <a href="news_edit.php?id=<?php echo $final['id'];?>">Edit</a>
                                    <a href="news_delet.php?id=<?php echo $final['id'];?>">Delete</a>
                                </td>
                                
                            </tr>
                        <?php } ?>
                            <?php } else { ?>
                            <tr>
                             
                                <td colspan="4">No Data To Show </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Copyright &copy; Your Website 2022</div>
                <div>
                    <a href="#">Privacy Policy</a>
                    &middot;
                    <a href="#">Terms &amp; Conditions</a>
                </div>
            </div>
        </div>
    </footer>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>
</body>
</html>