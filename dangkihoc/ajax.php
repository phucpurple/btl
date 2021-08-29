<?php require('config/constants.php');
    $key = $_POST['data'];
    $sql = "SELECT * FROM tbl_subject  WHERE   subject ='$key' ";

    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0){

    while($row = mysqli_fetch_array($result)){

    ?>                   
    <option><?php echo  $row['tuition'];  ?></option>
<?php
    }
}

?>
<?php require('config/constants.php');
    $key = $_POST['data1'];
    $sql = "SELECT * FROM tbl_subject  WHERE  subject ='$key' ";

    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0){

    while($row = mysqli_fetch_array($result)){
    ?>               
    <option><?php echo  $row['schedule'];  ?></option>
<?php

    }
}

?>
<?php require('config/constants.php');
    $key = $_POST['data2'];
    $sql = "SELECT * FROM tbl_subject  WHERE  subject ='$key' ";

    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0){

    while($row = mysqli_fetch_array($result)){
    ?>               
    <option><?php echo  $row['study_time'];  ?></option>
<?php

    }
}

?>





<!-- Bootstrap JavaScript Libraries -->


</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>
</html>