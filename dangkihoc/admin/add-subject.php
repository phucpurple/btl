<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="container">
        <h1>Add Subject</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
        
            <table class="tbl-30">
            <tr>
                    <td>Category: </td>
                    <td>
                          <select class="category" name="category">
                          <option value="">----Subject----</option>
                            <?php 
                                //Create PHP Code to display categories from Database
                                //1. CReate SQL to get all active categories from database
                                $sql = "SELECT * FROM tbl_category";
                                
                                //Executing qUery
                                $res = mysqli_query($conn, $sql);

                                //Count Rows to check whether we have categories or not
                                $count = mysqli_num_rows($res);

                                //IF count is greater than zero, we have categories else we donot have categories
                                if($count>0)
                                {
                                    //WE have categories
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        //get the details of categories
                                        $id = $row['id'];
                                        $subject_CA = $row['subject_CA'];
                                        $image_CA = $row['image_CA'];
                                       
                                        ?>     
                                        <option value="<?php echo $id; ?>"><?php echo $subject_CA; ?></option>
                                        <?php
                                    }
                                }
                                else
                                {
                                    //WE do not have category
                                    ?>
                                    <option  value="0">No Category Found</option>
                                    <?php
                                }
                            

                                //2. Display on Drpopdown
                            ?>

                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Subject: </td>
                    <td>
                        <input type="text" name="subject">
                    </td>
                </tr>

                <tr>
                    <td>Tuition: </td>
                    <td>
                        <input type="text" name="tuition">
                    </td>
                </tr>
                                
              

                <tr>
                    <td>Schedule: </td>
                    <td>
                        <input type="text" name="schedule">
                    </td>
                </tr>

                <tr>
                    <td>Study Time: </td>
                    <td>
                        <input type="text" name="study_time">
                    </td>
                </tr>
                <tr>
                    <td>Category ID </td>
                    <td>
                        <input type="text" name="category_id">
                    </td>
                </tr>
                


            

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Subject" class="btn btn-primary">
                    </td>
                </tr>

            </table>

        </form>

        
        <?php 

            //CHeck whether the button is clicked or not
            if(isset($_POST['submit']))
            {
                //Add the Food in Database
                //echo "Clicked";
                
                //1. Get the DAta from Form
                $subject = $_POST['subject'];
                $tuition = $_POST['tuition'];
                $schedule = $_POST['schedule'];
                $study_time = $_POST['study_time'];
                $category_id = $_POST['category_id'];

                //Check whether radion button for featured and active are checked or not
               

                //2. Upload the Image if selected
              
                $sql2 = "INSERT INTO tbl_subject SET 
                    subject = '$subject',
                    tuition = '$tuition',
                    schedule = '$schedule',
                    study_time = '$study_time',
                    category_id = '$category_id'
                   
                 
                ";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //CHeck whether data inserted or not
                //4. Redirect with MEssage to Manage Food page
                if($res2 == true)
                {
                    //Data inserted Successfullly
                    $_SESSION['add'] = "<div class='success'>Subject Added Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-subject.php');
                }
                else
                {
                    //FAiled to Insert Data
                    $_SESSION['add'] = "<div class='error'>Failed to Add Subject.</div>";
                    header('location:'.SITEURL.'admin/manage-subject.php');
                }

                
            }

        ?>


    </div>
</div>
<script type="text/javascript">
      $(document).ready(function(){
          $(".category").change(function(){
            var id_category = $(".category").val();
            alert(id_category);
          
          })
        })
</script>  

<?php include('partials/footer.php'); ?>