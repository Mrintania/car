<?php $page = 'export-car'; ?>

<?php
// เรียกใช้ไลบรารี Mpdf
require_once __DIR__ . '/../vendor/autoload.php';

use Mpdf\Mpdf;

// รับค่า ID ของรถจาก URL
$id = base64_decode($_GET['vex']);
$conn = 
$stmt = $conn->prepare("SELECT * FROM cars WHERE id = ?");
$stmt->execute([$id]);
$row = $stmt->fetch();


// สร้างเนื้อหา HTML สำหรับไฟล์ PDF
$html = '
<html>
<head>
  <style>
    /* รูปแบบ CSS สำหรับเนื้อหา PDF */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
    }
    h2 {
      color: #333;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    th, td {
      padding: 10px;
      border: 1px solid #ccc;
    }
  </style>
</head>
<body>
  <h2>Car Details</h2>
  <table>
    <tr>
      <th>Car Name</th>
      <td>' . $row['car_name'] . '</td>
    </tr>
    <tr>
      <th>Car Model</th>
      <td>' . $row['car_model'] . '</td>
    </tr>
    <tr>
      <th>Car Manufacturer</th>
      <td>' . $row['car_manufacturer'] . '</td>
    </tr>
    <tr>
      <th>License Plate No.</th>
      <td>' . $row['license_plate_number'] . '</td>
    </tr>
    <tr>
      <th>VIN No.</th>
      <td>' . $row['vin_number'] . '</td>
    </tr>
    <tr>
      <th>Insurance Company</th>
      <td>' . $row['insurance_company_name'] . '</td>
    </tr>
    <tr>
      <th>Other Details</th>
      <td>' . $row['other_details'] . '</td>
    </tr>
  </table>
</body>
</html>
';
// สร้างอ็อบเจ็กต์ Mpdf
$mpdf = new Mpdf();

// กำหนดเนื้อหา HTML ให้กับ Mpdf
$mpdf->WriteHTML($html);


$mpdf->Output('car_details.pdf', 'D');
