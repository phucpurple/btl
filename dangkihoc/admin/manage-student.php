<?php include('partials/menu.php'); ?>

<div class="container-fluid ">
    <div class="text-center menu ">
        
        <h1>Manage Student</h1>


                <?php 
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                ?>
                   <form action="" class=" d-flex justify-content-center col-md-3 " method="POST">
                <input type="search" class="" name="search" placeholder="Search .." >

             </form>
               

                <table class="tbl-full text-center">
                    <tr>
                        <th class="text-center">S.N</th>
                        <th class="text-center">Full Name</th>
                        <th class="text-center">Age</th>
                        <th class="text-center">Phone</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Address</th>
                        <th class="text-center">Tuition</th>
                        <th class="text-center">Register Date</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Subject Name</th>
                        <th class="text-center">Schedule</th>
                        <th class="text-center">Study Time</th>
                        <th class="">Active</th>
                    </tr>
                    <tbody class="danhsach">
                    <?php 
                        //Get all the orders from database
                        $sql = "SELECT * FROM  tbl_subject AS SU, tbl_student AS ST WHERE ST.subject_name = SU.subject  "; // DIsplay the Latest Order at First
                        //Execute Query
                        $res = mysqli_query($conn, $sql);
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
                                                
                                                elseif($status=="Paid")
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
                                            <a href="<?php echo SITEURL; ?>admin/update-student.php?id=<?php echo $id; ?>" class="btn btn-primary"><i class="bi bi-gear-fill"></i></a>
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

                    </tbody>
                </table>
    </div>
    
</div>
<script type="text/javascript">
            $(document).ready(function(){
                $('.search').keyup(function(){
                  var txt =$('.search').val();
                  $.post('ajax.php',{data:txt},function(data){
                    $('.danhsach').html(data);
                  
                    })

                })
            
            })
         </script>

<?php include('partials/footer.php'); ?>