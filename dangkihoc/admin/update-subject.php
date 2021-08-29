<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="container">
        <h1>Update Subject</h1>

        <br><br>


        <?php 
        
            //Check whether the id is set or not
            if(isset($_GET['id']))
            {
                //Get the ID and all other details
                //echo "Getting the Data";
                $id = $_GET['id'];
                //Create SQL Query to get all other details
                $sql = "SELECT * FROM tbl_subject WHERE id=$id";

                //Execute the Query
                $res = mysqli_query($conn, $sql);

                //Count the Rows to check whether the id is valid or not
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    //Get all the data
                    $row = mysqli_fetch_assoc($res);
                    $subject = $row['subject'];
                    $tuition = $row['tuition'];
                    $schedule = $row['schedule'];
                    $study_time = $row['study_time'];
                    $category_id = $row['category_id'];
                   
                }
                else
                {
                    //redirect to manage category with session message
                    $_SESSION['no-category-found'] = "<div class='error'>Category not Found.</div>";
                    header('location:'.SITEURL.'admin/manage-subject.php');
                }

            }
            else
            {
                //redirect to Manage CAtegory
                header('location:'.SITEURL.'admin/manage-subject.php');
            }
        
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
               <tr>
                    <td>Subject: </td>
                    <td>
                        <input type="tuition" name="subject"value="<?php echo $subject; ?>">
                    </td>
                </tr>
               <tr>
                    <td>Tuition: </td>
                    <td>
                        <input type="tuition" name="tuition"value="<?php echo $tuition; ?>">
                    </td>
                </tr>
                                
              

                <tr>
                    <td>Schedule: </td>
                    <td>
                        <input type="text" name="schedule"value="<?php echo $schedule; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Study Time: </td>
                    <td>
                        <input type="stady_time" name="study_time" value="<?php echo $study_time; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Category ID </td>
                    <td>
                        <input type="text" name="category_id" value="<?php echo $category_id; ?>">
                    </td>
                </tr>
                


               

                <tr>
                    <td>
                        
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Subject" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        <?php 
        
            if(isset($_POST['submit']))
            {
                
                //echo "Clicked";
                //1. Get all the values from our form
                $subject = $_POST['subject'];
                $tuition = $_POST['tuition'];
                $schedule = $_POST['schedule'];
                $study_time = $_POST['study_time'];
                $category_id = $_POST['category_id'];
                

               
                //3. Update the Database
                $sql2 = "UPDATE tbl_subject SET 
                    subject = '$subject',
                    tuition = '$tuition',
                    schedule = '$schedule',
                    study_time = '$study_time',
                    category_id = '$category_id'

                    WHERE id=$id
                 
                ";
                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //4. REdirect to Manage Category with MEssage
                //CHeck whether executed or not
                if($res2==true)
                {
                    //Category Updated
                    $_SESSION['update'] = "<div class='success'>Subject Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-subject.php');
                }
                else
                {
                   
                    //failed to update category
                    $_SESSION['update'] = "<div class='error'>Failed to Update Subject.</div>";
                    header('location:'.SITEURL.'admin/manage-subject.php');
                }

            }
        
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>