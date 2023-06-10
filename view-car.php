<?php //Page name 
?>
<?php $page = 'View Car';  ?>
<?php //include the header section 
?>
<?php include_once 'includes/header.php'; ?>
<?php
//decode the id 
$id = base64_decode($_GET['v']);
//get the selected car by the id
$stmt = $conn->prepare("SELECT * FROM cars WHERE id =? LIMIT 1");
//execute the query
$stmt->execute(array($id));
//fetch the car record
$row = $stmt->fetch();
//extract the record/result
extract($row, EXTR_PREFIX_ALL, "view");


$con = mysqli_connect("localhost", "root", "", "car_project_db") or die("Error: " . mysqli_error($con));
$sql_provinces = "SELECT * FROM provinces WHERE id='$view_provinces'";
$sql_districts = "SELECT * FROM districts WHERE id='$view_districts'";
$sql_subdistricts = "SELECT * FROM subdistricts WHERE id='$view_subdistricts'";
$query_provinces = mysqli_query($con, $sql_provinces);
$query_districts = mysqli_query($con, $sql_districts);
$query_subdistricts = mysqli_query($con, $sql_subdistricts);
$result_provinces = mysqli_fetch_assoc($query_provinces);
$result_districts = mysqli_fetch_assoc($query_districts);
$result_subdistricts = mysqli_fetch_assoc($query_subdistricts);
$view_provinces = $result_provinces['name_en'];
$view_districts = $result_districts['name_en'];
$view_subdistricts = $result_subdistricts['name_en'];
$view_zipcode = $result_subdistricts['zip_code'];

// ดึงรูปภาพ
$sql = "SELECT * FROM cars WHERE id='$id'";
$query = mysqli_query($con, $sql);
$result = mysqli_fetch_assoc($query);
$car_image = $result['car_image'];

?>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <?php //include the navigation bar section  
    ?>
    <?php include_once 'includes/nav.php'; ?>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <?php //include the top bar section 
        ?>
        <?php include_once 'includes/topbar.php'; ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <div class="row">
            <div class="col-xl-4">
              <div class="card mb-4 mb-xl-0">
                <div class="card-header py-3 ">
                  <h6 class="m-0 font-weight-bold text-primary">Car Image</h6>
                </div>
                <div class="card-body text-center">
                  <!-- Car Image Link -->
                  <a href="uploads/cars/<?php echo $car_image; ?>">
                    <!-- Display Car Image -->
                    <img class="img-fluid rounded mb-2" src="uploads/cars/<?php echo $car_image; ?>" alt="image-car">
                  </a>
                </div>
              </div>
            </div>
            <div class="col-xl-8">
              <div class="card mb-4 mb-xl-0">
                <div class="card-header py-3 ">
                  <h6 class="m-0 font-weight-bold text-primary">Car Details</h6>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-6 mb-4">
                      <label class="font-weight-bold text-gray-600 mb-0">Name :</label>
                      <h4 class="font-weight-bold text-gray-800"><?php echo $view_cus_name; ?></h4>
                    </div>
                    <div class="col-lg-6 mb-4">
                      <label class="font-weight-bold text-gray-600 mb-0">Last name :</label>
                      <h4 class="font-weight-bold text-gray-800"><?php echo $view_cus_lname; ?></h4>
                    </div>
                    <div class="col-lg-6 mb-4">
                      <label class="font-weight-bold text-gray-600 mb-0">Email :</label>
                      <h4 class="font-weight-bold text-gray-800"><?php echo $view_cus_email; ?></h4>
                    </div>
                    <div class="col-lg-6 mb-4">
                      <label class="font-weight-bold text-gray-600 mb-0">Tel :</label>
                      <h4 class="font-weight-bold text-gray-800"><?php echo $view_cus_tel; ?></h4>
                    </div>
                    <div class="col-lg-6 mb-4">
                      <label class="font-weight-bold text-gray-600 mb-0">Address :</label>
                      <h4 class="font-weight-bold text-gray-800"><?php echo $view_cus_address; ?></h4>
                    </div>
                    <div class="col-lg-6 mb-4">
                      <label class="font-weight-bold text-gray-600 mb-0">Province :</label>
                      <h4 class="font-weight-bold text-gray-800"><?php echo $view_provinces; ?></h4>
                    </div>
                    <div class="col-lg-6 mb-4">
                      <label class="font-weight-bold text-gray-600 mb-0">District :</label>
                      <h4 class="font-weight-bold text-gray-800"><?php echo $view_districts; ?></h4>
                    </div>
                    <div class="col-lg-6 mb-4">
                      <label class="font-weight-bold text-gray-600 mb-0">Subdistricts :</label>
                      <h4 class="font-weight-bold text-gray-800"><?php echo $view_subdistricts; ?></h4>
                    </div>
                    <div class="col-lg-6 mb-4">
                      <label class="font-weight-bold text-gray-600 mb-0">Zip code:</label>
                      <h4 class="font-weight-bold text-gray-800"><?php echo $view_zipcode; ?></h4>
                    </div>
                    <div class="col-lg-6 mb-4">
                      <label class="font-weight-bold text-gray-600 mb-0">Car name :</label>
                      <h4 class="font-weight-bold text-gray-800"><?php echo $view_car_name; ?></h4>
                    </div>
                    <div class="col-lg-6 mb-4">
                      <label class="font-weight-bold text-gray-600 mb-0">Car model:</label>
                      <h4 class="font-weight-bold text-gray-800"><?php echo $view_car_model; ?></h4>
                    </div>
                    <div class="col-lg-6 mb-4">
                      <label class="font-weight-bold text-gray-600 mb-0">Car manufacturer:</label>
                      <h4 class="font-weight-bold text-gray-800"><?php echo $view_car_manufacturer; ?></h4>
                    </div>
                    <div class="col-lg-6 mb-4">
                      <label class="font-weight-bold text-gray-600 mb-0">license plate number:</label>
                      <h4 class="font-weight-bold text-gray-800"><?php echo $view_license_plate_number; ?></h4>
                    </div>
                    <div class="col-lg-6 mb-4">
                      <label class="font-weight-bold text-gray-600 mb-0">vin number:</label>
                      <h4 class="font-weight-bold text-gray-800"><?php echo $view_vin_number; ?></h4>
                    </div>
                    <div class="col-lg-6 mb-4">
                      <l-abel class="font-weight-bold text-gray-600 mb-0">insurance company name:</l-abel>
                      <h4 class="font-weight-bold text-gray-800"><?php echo $view_insurance_company_name; ?></h4>
                    </div>
                    <div class="col-lg-6 mb-4">
                      <label class="font-weight-bold text-gray-600 mb-0">Other details :</label>
                      <h4 class="font-weight-bold text-gray-800"><?php echo $view_other_details; ?></h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->
      <?php //include the footer section 
      ?>
      <?php include_once 'includes/footer.php'; ?>