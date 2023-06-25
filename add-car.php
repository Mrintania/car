<?php $page = 'Add Car'; ?>
<?php include_once 'includes/header.php'; ?>

<body id="page-top">
  <?php
  //หากมีการคลิกปุ่มบันทึก
  if (isset($_POST['save'])) {


    $valid = 1;
    $errors = array();

    //ตัวแปรรับค่า
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


    //ตรวจสอบว่าค่าอินพุตว่างเปล่าหรือไม่
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

    //ตัวแปรภาพ
    $car_image     = $_FILES['car_image']['name'];
    $car_image_tmp = $_FILES['car_image']['tmp_name'];
    //ตรวจว่าภาพว่างหรือไม่
    if (empty($car_image)) {
      $valid = 0;
      $errors[] = "Car Image can not be empty";
    }
    //หากรูปไม่ว่าง
    if ($car_image != '') {

      $car_image_ext = pathinfo($car_image, PATHINFO_EXTENSION);
      //get the file name of the image
      $file_name = basename($car_image, '.' . $car_image_ext);
      //ตรวจนามสกุลไฟล์ภาพรถ 
      if ($car_image_ext != 'jpg' && $car_image_ext != 'png' && $car_image_ext != 'jpeg' && $car_image_ext != 'gif') {
        $valid = 0;
        $errors[] = 'You must have to upload jpg, jpeg, gif or png file<br>';
      }
    }

    //if everthing is fine
    if ($valid == 1) {
      //Upload Car Image
      $car_image_file = rand(1000, 1000000) . "-" . $car_image;
      move_uploaded_file($car_image_tmp, "uploads/cars/" . $car_image_file);
      

      //แทรกลงในแบบสอบถามรถยนต์
      // $stmt = $conn->prepare("INSERT INTO cars (cus_name, cus_lname, cus_email, cus_tel, cus_address, provinces, districts, subdistricts, zipcode car_name, car_model, car_manufacturer, license_plate_number, vin_number, insurance_company_name, other_details, car_image, date_created) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
      $stmt = $conn->prepare("INSERT INTO cars (cus_name, cus_lname, cus_email, cus_tel, cus_address, provinces, districts, subdistricts, zipcode, car_name, car_model, car_manufacturer, license_plate_number, vin_number, insurance_company_name, other_details, car_image, date_created) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

      //ใส่ในการประมวลผลข้อมูลรถยนต์
      // $run = $stmt->execute(array($cus_name, $cus_lname, $cus_email, $cus_tel, $cus_address, $provinces, $districts, $subdistricts, $zipcode, $car_name, $car_model, $car_manufacturer, $license_plate_number, $vin_number, $insurance_company_name, $other_details, $car_image_file, $date_created));
      $run = $stmt->execute(array($cus_name, $cus_lname, $cus_email, $cus_tel, $cus_address, $provinces, $districts, $subdistricts, $zipcode, $car_name, $car_model, $car_manufacturer, $license_plate_number, $vin_number, $insurance_company_name, $other_details, $car_image_file, $date_created));

      //if car data is inserted
      if ($run) {
        //เก็บข้อมูลสำเร็จ
        $_SESSION['success'] = "Car has been added successfully!";
        //redirect to the cars page
        header('location: cars.php');
        exit();
      } else {
        $errors[] = "Failed to add new car";
      }
    }
  }


  ?>
  <!-- Page Wrapper -->
  <div id="wrapper">
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
              <?php if (isset($errors)) :
                //loop through all the errors
                foreach ($errors as $error) :
              ?>
                  <div class="alert with-close alert-danger alert-dismissible fade show">
                    <span class="badge badge-pill badge-danger">Error</span> <?php echo $error; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true"></span>
                    </button>
                  </div>
                <?php endforeach; ?>
              <?php endif; ?>
              <?php
              $con = mysqli_connect("localhost", "root", "", "car_project_db") or die("Error: " . mysqli_error($con));
              mysqli_query($con, "SET NAMES 'utf8' ");
              error_reporting(error_reporting() & ~E_NOTICE);
              date_default_timezone_set('Asia/Bangkok');

              $sql_provinces = "SELECT * FROM provinces";
              $query = mysqli_query($con, $sql_provinces);
              ?>

              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Add Car</h6>
                </div>
                <div class="card-body">
                  <form class="" method="POST" action="" enctype="multipart/form-data">
                    <div class="row">
                      <!-- Name Lname Address Email Tel City State Zipstate -->
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="cus_name">Customer Name</label>
                          <input type="text" class="form-control form-control-user" id="cus_name" placeholder="Enter Customer Name" name="cus_name">
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="cus_lname">Customer Last name</label>
                          <input type="text" class="form-control form-control-user" id="cus_lname" placeholder="Enter Customer Last Name" name="cus_lname">
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="cus_name">Customer E-mail</label>
                          <input type="email" class="form-control form-control-user" id="cus_email" placeholder="Enter Customer E-mail" name="cus_email">
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="cus_name">Customer Phone Number</label>
                          <input type="tel" class="form-control form-control-user" id="cus_tel" placeholder="Enter Customer Phone Number" name="cus_tel">
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="cus_address">Customer Address</label>
                          <input type="text" class="form-control form-control-user" id="cus_address" placeholder="Enter Customer address" name="cus_address">
                        </div>
                      </div>

                      <!-- ที่อยู่ดึงจากฐานข้อมูล -->
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="sel1">Provinces</label>
                          <select class="form-control" name="Ref_prov_id" id="provinces">
                            <option value="" selected disabled>-Choose provinces-</option>
                            <?php foreach ($query as $value) { ?>
                              <option value="<?= $value['id'] ?>"><?= $value['name_en'] ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="sel1">Districts</label>
                          <select class="form-control" name="Ref_dist_id" id="districts" value="<?  ?>">
                          </select>
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="sel1">Subdistricts</label>
                          <select class="form-control" name="Ref_subdist_id" id="subdistricts" value="<?  ?>" >
                          </select>
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="sel1">Zip code</label>
                          <input type="text" name="zip_code" id="zip_code" class="form-control">
                        </div>
                      </div>
                      <!-- End address database -->

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="car_name">Car Name</label>
                          <input type="text" class="form-control form-control-user" id="car_name" placeholder="Enter Car Name" name="car_name">
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="car_model">Car Model</label>
                          <input type="text" class="form-control form-control-user" id="car_model" placeholder="Enter Car Model" name="car_model">
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="car_manufacturer">Car Manufacturer</label>
                          <input type="text" class="form-control form-control-user" id="car_manufacturer" placeholder="Enter Car Manufacturer" name="car_manufacturer">
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="license_plate_number">License Plate Number</label>
                          <input type="text" class="form-control form-control-user" id="license_plate_number" placeholder="Enter License Plate Number" name="license_plate_number">
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="vin_number">VIN Number</label>
                          <input type="text" class="form-control form-control-user" id="vin_number" placeholder="Enter VIN Number" name="vin_number">
                        </div>
                      </div>

                      <!-- Insurance -->
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="insurance_company_name">Insurance Company Name</label>
                          <select name="insurance_company_name" class="form-control" id="insurance_company_name">
                            <option value="">กรุณาเลือกบริษัทประกันภัย</option>
                            <option value="กรุงเทพประกันภัย"> กรุงเทพประกันภัย</option>
                            <option value="เคเอสเค ประกันภัย"> เคเอสเค ประกันภัย</option>
                            <option value="ทิพยประกันภัย"> ทิพยประกันภัย</option>
                            <option value="ไทยวิวัฒน์"> ไทยวิวัฒน์</option>
                            <option value="นวกิจประกันภัย"> นวกิจประกันภัย</option>
                            <option value="เมืองไทยประกันภัย"> เมืองไทยประกันภัย</option>
                            <option value="อลิอันซ์ อยุธยา"> อลิอันซ์ อยุธยา</option>
                            <option value="เอ็มเอสไอจี"> เอ็มเอสไอจี</option>
                            <option value="กรุงไทยพานิชประกันภัย"> กรุงไทยพานิชประกันภัย</option>
                            <option value="เจมาร์ท ประกันภัย"> เจมาร์ท ประกันภัย</option>
                            <option value="เทเวศประกันภัย"> เทเวศประกันภัย</option>
                            <option value="ไทยศรี"> ไทยศรี</option>
                            <option value="บริษัทกลางฯ"> บริษัทกลางฯ</option>
                            <option value="วิริยะประกันภัย"> วิริยะประกันภัย</option>
                            <option value="อลิอันซ์ อยุธยา ประกันภัย (เดิมเอ็นที)"> อลิอันซ์ อยุธยา ประกันภัย (เดิม) </option>
                            <option value="เอ็นที">เอ็นที</option>
                            <option value="แอกซ่าประกันภัย"> แอกซ่าประกันภัย</option>
                            <option value="คุ้มภัยโตเกียวมารีน"> คุ้มภัยโตเกียวมารีน</option>
                            <option value="ชับบ์สามัคคีประกันภัย"> ชับบ์สามัคคีประกันภัย</option>
                            <option value="ไทยไพบูลย์"> ไทยไพบูลย์</option>
                            <option value="ไทยเศรษฐฯ"> ไทยเศรษฐฯ</option>
                            <option value="แปซิฟิค ครอส"> แปซิฟิค ครอส</option>
                            <option value="สินมั่นคง"> สินมั่นคง</option>
                            <option value="อินทรประกันภัย"> อินทรประกันภัย</option>
                            <option value="แอลเอ็มจี ประกันภัย"> แอลเอ็มจี ประกันภัย</option>
                          </select>

                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="car_image">Car Image</label>
                          <input type="file" class="form-control form-control-user" id="car_image" name="car_image" style="padding-bottom: 36px;">
                        </div>
                      </div>
                      <div class="col-lg-12">
                        <div class="form-group">
                          <label for="other_details">Other Details <small style="color:tomato">(If any)</small></label>
                          <textarea class="form-control form-control-user" id="other_details" name="other_details"></textarea>
                        </div>
                      </div>

                    </div>
                    <button type="submit" class="btn btn-primary btn-user" name="save">
                      Save
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </div>


      <?php //include the footer section 
      ?>
      <?php include_once 'includes/footer.php'; ?>