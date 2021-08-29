<?php include('partials/menu.php'); ?>

<div class="">
    <div class="container">
        <h1>Manage Subject</h1>

        <br /><br />

                
                <a href="<?php echo SITEURL; ?>admin/add-subject.php" class="btn btn-primary">Add Subject</a>

                <br /><br /><br />

                <?php 
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }

                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }

                    if(isset($_SESSION['upload']))
                    {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }

                    if(isset($_SESSION['unauthorize']))
                    {
                        echo $_SESSION['unauthorize'];
                        unset($_SESSION['unauthorize']);
                    }

                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                
                ?>
                

                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Subject</th>
                        <th>Tuition</th>
                        <th>Image</th>
                        <th>Schedule</th>
                        <th>Study Time </th>
                      
                        <th>Actions</th>
                    </tr>

                    <?php 
                        //Create a SQL Query to Get all the Food
                        $sql = "SELECT * FROM tbl_category AS C,tbl_subject AS S WHERE S.category_id = C.id";

                        //Execute the qUery
                        $res = mysqli_query($conn, $sql);

                        //Count Rows to check whether we have foods or not
                        $count = mysqli_num_rows($res);

                        //Create Serial Number VAriable and Set Default VAlue as 1
                        $sn=1;

                        if($count>0)
                        {
                            //We have food in Database
                            //Get the Foods from Database and Display
                            while($row=mysqli_fetch_assoc($res))
                            {
                                //get the values from individual columns
                                $id = $row['id'];
                                $subject = $row['subject'];
                                $tuition = $row['tuition'];
                                $image_CA = $row['image_CA'];
                                
                                $schedule = $row['schedule'];
                                $study_time = $row['study_time'];
                               
                                
                                ?>

                                <tr>
                                    <td><?php echo $sn++; ?>. </td>
                                    <td><?php echo $subject; ?></td>
                                    <td><?php echo $tuition; ?></td>
                                    <td>

                                        <?php  
                                            //Chcek whether image name is available or not
                                            if($image_CA!="")
                                            {
                                                //Display the Image
                                                ?>
                                                
                                                <img src="<?php echo $image_CA; ?>" width="100px" >
                                                
                                                <?php
                                            }
                                            else
                                            {
                                                //DIsplay the MEssage
                                                echo "<div class='error'>Image not Added.</div>";
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $schedule; ?></td>
                                    <td><?php echo $study_time; ?></td>
                                
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-subject.php?id=<?php echo $id; ?>" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-subject.php?id=<?php echo $id; ?>" class="btn btn-primary"><i class="bi bi-trash-fill"></i></a>
                                    </td>
                                </tr>

                                <?php
                            }
                        }
                        else
                        {
                            //Food not Added in Database
                            echo "<tr> <td colspan='7' class='error'> Subject not Added Yet. </td> </tr>";
                        }

                    ?>

                    
                </table>
    </div>
    
</div>

<?php include('partials/footer.php'); ?>