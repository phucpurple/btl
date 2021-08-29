<?php include('partials/menu.php'); ?>


<div class="main-content">
    <div class="container">
        <h1>Update Order</h1>
        <br><br>


        <?php 
        
            //CHeck whether id is set or not
            if(isset($_GET['id']))
            {
                //GEt the Order Details
                $id=$_GET['id'];

                //Get all other details based on this id
                //SQL Query to get the order details
                $sql = "SELECT * FROM tbl_student AS ST WHERE id=$id  "; // DIsplay the Latest Order at First
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
                                $register_date = $row['register_date'];
                                $status = $row['status'];
                                $subject_name = $row['subject_name'];
                                
                            }
                }
                else
                {
                    //DEtail not Available/
                    //Redirect to Manage Order
                    header('location:'.SITEURL.'admin/manage-register.php');
                }
            }
            else
            {
                //REdirect to Manage ORder PAge
                header('location:'.SITEURL.'admin/manage-register.php');
            }
        
        ?>

        <form action="" method="POST">
        
            <table class="tbl-30">
                <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name"value="<?php echo $full_name; ?>">
                    </td>
                </tr>
               <tr>
                <td>Age: </td>
                    <td>
                        <input type="number" name="age"value="<?php echo $age; ?>">
                    </td>
                </tr>
                                
              

                <tr>
                    <td>Phone: </td>
                    <td>
                        <input type="text" name="number"value="<?php echo $number; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Email: </td>
                    <td>
                        <input type="text" name="email" value="<?php echo $email; ?>">
                    </td>
                </tr>
                <tr>
                <td>Address</td>
                    <td>
                        <input type="text" name="address" value="<?php echo $address; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                            <option <?php if($status=="Paid"){echo "selected";} ?> value="Paid">Paid</option>
                            <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Subject: </td>
                    <td>
                        <input type="text" name="subject_name" value="<?php echo $subject_name; ?>">
                    </td>
                </tr>
                
                
                    
                <tr>
                    <td clospan="2">

                        <input type="hidden" name="id" value="<?php echo $id; ?>">

                        <input type="submit" name="submit" value="Update " class="btn-secondary">
                    </td>
                </tr>
            </table>
        
        </form>


        <?php 
            //CHeck whether Update Button is Clicked or Not
            if(isset($_POST['submit']))
            {
                //echo "Clicked";
                //Get All the Values from Form
                $full_name = $_POST['full_name'];
                $email = $_POST['email'];
                $number = $_POST['number'];
                $age = $_POST['age'];
                $address = $_POST['address'];
                $register_date = date("Y-m-d h:i:sa"); //Order DAte
                $subject_name = $_POST['subject_name'];
  
                $status = $_POST['status'];  // Ordered, On Delivery, Delivered, Cancelled
              
                   
                //Save the Order in Databaase
                //Create SQL to save the data
                $sql2 = "UPDATE tbl_student SET 
                    full_name = '$full_name',
                    email = '$email',
                    number = '$number',
                    address = '$address',
                    age = '$age',
                    register_date = '$register_date',
                    status = '$status',
                    subject_name='$subject_name'
                    WHERE id='$id'
                ";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //CHeck whether update or not
                //And REdirect to Manage Order with Message
                if($res2==true)
                {
                    //Updated
                    $_SESSION['update'] = "<div class='success'> Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-student.php');
                }
                else
                {
                    //Failed to Update
                    $_SESSION['update'] = "<div class='error'>Failed to Update .</div>";
                    header('location:'.SITEURL.'admin/manage-student.php');
                }
            }
        ?>


    </div>
</div>

<?php include('partials/footer.php'); ?>
