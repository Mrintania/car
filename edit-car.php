<?php //page name 
?>
<?php $page = 'Edit-car-detail'; ?>
<?php //include the header section 
?>
<?php include_once 'includes/header.php'; ?>
<?php
//decode the id
$id = base64_decode($_GET['e']);
//get the selected car by the id
$stmt = $conn->prepare("SELECT * FROM cars WHERE id =? LIMIT 1");
//execute the query
$stmt->execute(array($id));
//fetch the user record
$row = $stmt->fetch();
//extract the record/result
extract($row, EXTR_PREFIX_ALL, "edit");
?>

<body id="page-top">
  <?php
  //if update button has been clicked
  if (isset($_POST['update'])) {

    $valid = 1;

    //getting form input values into variables in add-car.php
    $car_name               = $_POST['car_name'];
    $car_model              = $_POST['car_model'];
    $car_manufacturer       = $_POST['car_manufacturer'];
    $license_plate_number   = $_POST['license_plate_number'];
    $vin_number             = $_POST['vin_number'];
    $insurance_company_name = $_POST['insurance_company_name'];
    $other_details          = $_POST['other_details'];
    // รับค่าข้อมูลส่วนตัว Name Lname E-mail Tel
    $cus_name                   = $_POST['cus_name'];
    $cus_lname                  = $_POST['cus_lname'];
    $cus_email                  = $_POST['cus_email'];
    $cus_tel                    = $_POST['cus_tel'];

    $cus_address      = $_POST['cus_address'];
    $provinces = $_POST['Ref_prov_id'];
    $districts = $_POST['Ref_dist_id'];
    $subdistricts = $_POST['Ref_subdist_id'];
    $zipcode = $_POST['zip_code'];
    $date_created     = date('Y-m-d H:i:s');


    //checking if the input values are empty
    if (empty($cus_name)) {
      $valid = 0;
      $errors[] = "You must have to enter customer name";
    }
    if (empty($cus_lname)) {
      $valid = 0;
      $errors[] = "You must have to enter customer last name";
    }
    if (empty($cus_email)) {
      $valid = 0;
      $errors[] = "You must have to enter customer email";
    }
    if (empty($cus_tel)) {
      $valid = 0;
      $errors[] = "You must have to enter customer phone number";
    }
    if (empty($cus_address)) {
      $valid = 0;
      $errors[] = "You must have to enter customer address";
    }
    if (empty($provinces)) {
      $valid = 0;
      $errors[] = "You must have to enter customer provinces";
    }
    if (empty($districts)) {
      $valid = 0;
      $errors[] = "You must have to enter customer districts";
    }
    if (empty($subdistricts)) {
      $valid = 0;
      $errors[] = "You must have to enter customer subdistricts";
    }
    if (empty($zipcode)) {
      $valid = 0;
      $errors[] = "You must have to enter customer zip code";
    }
    if (empty($car_name)) {
      $valid = 0;
      $errors[] = "You must have to enter car name";
    }
    if (empty($car_model)) {
      $valid = 0;
      $errors[] = "You must have to enter car model";
    }
    if (empty($car_manufacturer)) {
      $valid = 0;
      $errors[] = "You must have to enter car manufacturer";
    }
    if (empty($license_plate_number)) {
      $valid = 0;
      $errors[] = "You must have to enter license plate number";
    }
    if (empty($vin_number)) {
      $valid = 0;
      $errors[] = "You must have to enter VIN number";
    }
    if (empty($insurance_company_name)) {
      $valid = 0;
      $errors[] = "You must have to enter insurance company name";
    }
    //End check empty

    //car image variables
    $car_image     = $_FILES['car_image']['name'];
    $car_image_tmp = $_FILES['car_image']['tmp_name'];

    //if car image is not empty
    if ($car_image != '') {
      //get the image extention, i.e jpg, png
      $car_image_ext = pathinfo($car_image, PATHINFO_EXTENSION);
      //get the file name of the image
      $file_name = basename($car_image, '.' . $car_image_ext);
      //check the car image file extention 
      if ($car_image_ext != 'jpg' && $car_image_ext != 'png' && $car_image_ext != 'jpeg' && $car_image_ext != 'gif') {
        $valid = 0;
        $errors[] = 'You must have to upload jpg, jpeg, gif or png file<br>';
      }
    }

    //if everthing is fine
    if ($valid == 1) {

      if ($car_image != '') {
        //Upload Car Image
        $car_image_file = $file_name . '-car-image-' . time() . '.' . $car_image_ext;
        move_uploaded_file($car_image_tmp, 'uploads/cars/' . $car_image_file);
        //delete the old image of the car
        unlink('uploads/cars/' . $edit_car_image);
      } else {
        //assgin old image file name
        $car_image_file = $edit_car_image;
      }
      //update cars query
      $stmt = $conn->prepare("UPDATE  cars  SET car_name = ?, car_model = ?, car_manufacturer = ?, license_plate_number = ?, vin_number = ?, insurance_company_name = ?, other_details = ?, car_image = ? WHERE id = ?");
      //update cars data execution
      $run  = $stmt->execute(array($car_name, $car_model, $car_manufacturer, $license_plate_number, $vin_number, $insurance_company_name, $other_details, $car_image_file, $id));
      //if car data is inserted
      if ($run) {
        //store a success message in the SESSION
        $_SESSION['success'] = "Car has been updated successfully!";
        //redirect to the cars page
        header('location: cars.php');
        exit();
      }
    }
  }
  ?>
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
          <!-- Content Row -->
          <div class="row">

            <div class="offset-lg- col-lg-12 mb-4">

              <?php //if success message is set 
              ?>
              <?php if (isset($_SESSION['success'])) : ?>
                <div class="col-lg-12">
                  <div class="alert with-close alert-danger alert-dismissible fade show">
                    <span class="badge badge-pill badge-danger">Success</span>
                    <?php //display the success message 
                    ?>
                    <?php echo $_SESSION['success']; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                </div>
                <?php //unset the success message 
                ?>
                <?php unset($_SESSION['success']); ?>
              <?php endif; ?>

              <?php //if there are any errors 
              ?>
              <?php if (isset($errors)) :
                //loop through all the errors
                foreach ($errors as $error) :
              ?>
                  <div class="alert with-close alert-danger alert-dismissible fade show">
                    <span class="badge badge-pill badge-danger">Error</span> <?php echo $error; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                <?php endforeach; ?>
              <?php endif; ?>

              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Edit Car</h6>
                </div>
                <div class="card-body">
                  <form class="" method="POST" action="" enctype="multipart/form-data">
                    <div class="row">
                      <!-- New version on edit -->
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="cus_name">Customer Name</label>
                          <input type="text" class="form-control form-control-user" id="cus_name" placeholder="Enter Customer Name" name="cus_name" value="<?php echo $edit_cus_name; ?>">
                        </div>
                      </div>
                      <!-- cus_lname -->
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="cus_name">Customer Last Name</label>
                          <input type="text" class="form-control form-control-user" id="cus_name" placeholder="Enter Customer Name" name="cus_name" value="<?php echo $edit_cus_lname; ?>">
                        </div>
                      </div>
                      <!-- cus_email -->
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="cus_email">Customer E-mail</label>
                          <input type="text" class="form-control form-control-user" id="cus_email" placeholder="Enter Customer E-mail" name="cus_email" value="<?php echo $edit_cus_email; ?>">
                        </div>
                      </div>
                      <!-- cus_tel -->
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="cus_tel">Customer Telephone nummber</label>
                          <input type="text" class="form-control form-control-user" id="cus_tel" placeholder="Enter Customer Tel" name="cus_tel" value="<?php echo $edit_cus_tel; ?>">
                        </div>
                      </div>
                      <!-- cus_address -->
                      <div class="col-lg-6">
                        <div class="form-group"> 
                          <label for="cus_address">Customer Address</label>
                          <input type="text" class="form-control form-control-user" id="cus_address" placeholder="Enter Customer Address" name="cus_address" value="<?php echo $edit_cus_address; ?>">
                        </div>
                      </div>
                      <!-- cus_provinces -->
                      <div class="col-lg-6">
                          <div class="form-group">
                            <label for="provinces">Provinces</label>
                            <select class="form-control form-control-user" id="provinces" name="Ref_prov_id">
                              <option value="<?php echo $edit_provinces; ?>"><?php echo $edit_provinces; ?></option>
                              <?php
                              $sql = "SELECT * FROM provinces";
                              $query = mysqli_query($con, $sql);
                              while ($result = mysqli_fetch_assoc($query)) {
                                echo "<option value='" . $result['id'] . "'>" . $result['name_en'] . "</option>";
                              }
                              ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <!-- cus_districts -->
                      <div class="col-lg-6">
                          <div class="form-group">
                            <label for="districts">Districts</label>
                            <select class="form-control form-control-user" id="districts" name="Ref_dist_id">
                              <option value="<?php echo $edit_districts; ?>"><?php echo $edit_districts; ?></option>
                            </select>
                            
                          </div>
                        </div>


                      <!-- End new version -->

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="car_name">Car Name</label>
                          <input type="text" class="form-control form-control-user" id="car_name" placeholder="Enter Car Name" name="car_name" value="<?php echo $edit_car_name; ?>">
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="car_model">Car Model</label>
                          <input type="text" class="form-control form-control-user" id="car_model" placeholder="Enter Car Model" name="car_model" value="<?php echo $edit_car_model; ?>">
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="car_manufacturer">Car Manufacturer</label>
                          <input type="text" class="form-control form-control-user" id="car_manufacturer" placeholder="Enter Car Manufacturer" name="car_manufacturer" value="<?php echo $edit_car_manufacturer; ?>">
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="license_plate_number">License Plate Number</label>
                          <input type="text" class="form-control form-control-user" id="license_plate_number" placeholder="Enter License Plate Number" name="license_plate_number" value="<?php echo $edit_license_plate_number; ?>">
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="vin_number">VIN Number</label>
                          <input type="text" class="form-control form-control-user" id="vin_number" placeholder="Enter VIN Number" name="vin_number" value="<?php echo $edit_vin_number; ?>">
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="insurance_company_name">Insurance Company Name</label>
                          <input type="text" class="form-control form-control-user" id="insurance_company_name" placeholder="Enter Insurance Company Name" name="insurance_company_name" value="<?php echo $edit_insurance_company_name; ?>">
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="car_image">Car Image</label>
                          <input type="file" class="form-control form-control-user" id="car_image" name="car_image" style="padding-bottom: 36px;">
                        </div>
                        <label for="car_image">Existing Image</label><br>
                        <a href="uploads/cars/<?php echo $edit_car_image; ?>">
                          <img class="img-thumbnail" width="200px" src="uploads/cars/<?php echo $edit_car_image; ?>" alt="car image">
                        </a>
                      </div>
                      <div class="col-lg-12 mt-4">
                        <div class="form-group">
                          <label for="other_details">Other Details <small>If any</small></label>
                          <textarea class="form-control form-control-user" id="other_details" name="other_details"><?php echo $edit_other_details; ?></textarea>
                        </div>
                      </div>

                    </div>
                    <button type="submit" class="btn btn-primary btn-user" name="update">
                      Update
                    </button>
                  </form>
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