<?php require('../config/constants.php'); 
    $a = $_POST['data'];
    $sql = "SELECT * FROM  tbl_subject AS SU, tbl_student AS ST WHERE (( ST.subject_name = SU.subject ) AND  ( full_name LIKE '%$a%' OR number LIKE '%$a%' OR address LIKE '%$a%' OR status LIKE '%$a%' OR subject_name LIKE '%$a%' OR schedule LIKE '%$a%'))";
    $res = mysqli_query($conn, $sql);
    //Count the Rows
     //CHeck whether the Query is Executed of Not
     //Count the Rows
     $count = mysqli_num_rows($res);

     $sn = 1; //Create a Serial Number and set its initail value as 1

     if($count>0)
     {
         //Order Available
         while($row=mysqli_fetch_assoc($res))
         {
             //Get all the order details
             $id = $row['id'];
             $full_name = $row['full_name'];
             $age = $row['age'];
             $number = $row['number'];
             $email = $row['email'];
             $address = $row['address'];
             $tuition = $row['tuition'];
             $register_date = $row['register_date'];
             $status = $row['status'];
             $subject_name = $row['subject_name'];
             $schedule = $row['schedule'];
             $study_time = $row['study_time'];
            
             
             ?>

                 <tr>
                     <td><?php echo $sn++; ?>. </td>
                     <td><?php echo $full_name; ?></td>
                     <td><?php echo $age; ?></td>
                     <td><?php echo $number; ?></td>
                     <td><?php echo $email; ?></td>
                     <td><?php echo $address; ?></td>


                     <td><?php echo $tuition; ?></td>
                     <td><?php echo $register_date; ?></td>
                     <td>
                         <?php 
                             // Ordered, On Delivery, Delivered, Cancelled

                             if($status=="Ordered")
                             {
                                 echo "<label>$status</label>";
                             }
                             elseif($status=="On Delivery")
                             {
                                 echo "<label style='color: orange;'>$status</label>";
                             }
                             elseif($status=="Delivered")
                             {
                                 echo "<label style='color: green;'>$status</label>";
                             }
                             elseif($status=="Cancelled")
                             {
                                 echo "<label style='color: red;'>$status</label>";
                             }
                         ?>
                     </td>
                     <td><?php echo $subject_name; ?></td>
                     <td><?php echo $schedule; ?></td>
                     <td><?php echo $study_time; ?></td>
                     <td>
                         <a href="<?php echo SITEURL; ?>admin/update-register.php?id=<?php echo $id; ?>" class="btn btn-primary"><i class="bi bi-gear-fill"></i></a>
                     </td>
                 </tr>

             <?php

         }
     }
     else
     {
         //Order not Available
         echo "<tr><td colspan='12' class='error'>Student not Available</td></tr>";
     }
 ?>


</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>
</html>
