<?php require('config/constants.php');?>
<!doctype html>
<html lang="en">
  <head>
    <title>Res</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="f.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
         <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Bootstrap CSS v5.0.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
  </head>
  <body>
      <div class="container">
        <h1>Dang Ki Hoc</h1>
      </div>
      <div class="container">
    <form class="row g-3" method="POST">
        <div class="col-md-6">
          <label  for=""  class="form-label needs-validation" novalidate >Full Name </label>
          <input type="name" class="form-control" placeholder="Nguyen Van A"  name="full_name"  id="" required   >
        </div>
        <div class="col-md-6">
          <label class="form-label">Email</label>
          <input type="email" class="form-control" placeholder="...@gmail.com" name="email"  required >
        </div>
        <div class="col-3">
          <label class="form-label">Number Phone</label>
          <input type="text" class="form-control" id="inputNumber" name="number" placeholder="0123456789" id="" required >
        </div>
        <div class="col-3">
          <label class="form-label">Age</label>
          <input type="number" class="form-control" id="age" name="age" placeholder="18" required>
        </div>
        <div class="col-6">
          <label  class="form-label">Address</label>
          <input type="text" class="form-control"  name="address" placeholder="Dong Da - Ha Noi">
        </div>
        <div class="col-md-5">
       
          <select name="subject"id="inputClass"  class="form-select idsub">

            <option >Choose Class</option>
            
  <?php
                //Truy vấn CSDL với PHP: 3 cách (mysqli_ thủ tục, mysqli_ oop, PDO)
                //Bước 01: Kết nối tới Server
                $conn = mysqli_connect('localhost','root','','dangkihoc');
                if(!$conn){
                    die("Không thể kết nối");
                }
                //Bước 02: Định nghĩa và thực hiện truy vấn
                //Chỉ muốn 3 bản ghi mới nhất > Theo các bạn, sửa thế nào?
                $sql = "SELECT * FROM tbl_subject ";
                $result = mysqli_query($conn,$sql);
                //Bước 03: Xử lý Dữ liệu trả về
                if(mysqli_num_rows($result) > 0){
                    //Lặp để lấy về từng bản ghi thông qua phương thức: mysqli_fetch_assoc
                    while($row = mysqli_fetch_assoc($result)){
                      $id = $row['id'];
                      $subject = $row['subject'];
                      $tuition = $row['tuition'];
                      $schedule = $row['schedule'];
                      $study_time = $row['study_time'];
            ?>               
                  
             
            <option value="<?php echo  $subject  ?>"><?php echo $subject  ?></option>
                      
            <?php
                    }
                }
              
              ?>
          </select>
        </div>
        <div class="col-2 ">
          <select id="inputClass" class="form-select idtuition">
                 <option >Tuition</option>
          </select>
        </div>
        <div class="col-3 ">
          <select id="inputClass" class="form-select idschedule">
                 <option >Schedule</option>
          </select>
        </div>
        <div class="col-2 ">
          <select id="inputClass" class="form-select idstudy_time">
                 <option >Study Time</option>
          </select>
        </div>
       
        <div class="col-12">
        <input type="submit" name="submit" value="Confirm " class="btn btn-primary">
        </div>
      </form>
      <?php 

          //CHeck whether submit button is clicked or not
          if(isset($_POST['submit']))
          {
              // Get all the details from the form

              $full_name = $_POST['full_name'];
              $email = $_POST['email'];
              $number = $_POST['number'];
              $age = $_POST['age'];
              $address = $_POST['address'];
              date_default_timezone_set('Asia/Bangkok');
              $register_date = date("Y-m-d H:i:sa"); //Order DAte
              $subject_name = $_POST['subject'];

              $status = "Ordered";  // Ordered, On Delivery, Delivered, Cancelled
            
                 
              //Save the Order in Databaase
              //Create SQL to save the data
              $sql2 = "INSERT INTO tbl_student SET 
                  full_name = '$full_name',
                  email = '$email',
                  number = '$number',
                  address = '$address',
                  age = '$age',
                  register_date = '$register_date',
                  status = '$status',
                  subject_name='$subject_name'
              ";

              //echo $sql2; die();

              //Execute the Query
              $res2 = mysqli_query($conn, $sql2);

              //Check whether query executed successfully or not
              if($res2==true)
              {
                  //Query Executed and Order Saved
                  $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully.</div>";
                  header('location:'.SITEURL);
              }
              else
              {
                  //Failed to Save Order
                  $_SESSION['order'] = "<div class='error text-center'>Failed to Order Food.</div>";
                  header('location:'.SITEURL);
              }

          }

?>
    </div>
    <script type="text/javascript">
      $(document).ready(function(){
          $(".idsub").change(function(){
          var txt = $(".idsub").val();
          $.post("ajax.php",{data:txt},function(data){
            $(".idtuition").html(data);

          })  
        var txt1 = $(".idsub").val();
          $.post("ajax.php",{data1:txt1},function(data){
            $(".idschedule").html(data);

          })
        var txt2 = $(".idsub").val();
        $.post("ajax.php",{data2:txt2},function(data){
          $(".idstudy_time").html(data);

        })  
        })
      })
      // Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()
</script>  
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
  </body>
</html>