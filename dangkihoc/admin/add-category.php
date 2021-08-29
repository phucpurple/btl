<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="container">
        <h1>Add Category</h1>

        <br><br>

        <?php 
        
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        
        ?>

        <br><br>

        <!-- Add CAtegory Form Starts -->
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
            <tr>
                    <td>ID: </td>
                    <td>
                        <input type="text" name="id" placeholder="">
                    </td>
                </tr>
                <tr>
                    <td>Subject: </td>
                    <td>
                        <input type="text" name="subject_CA" placeholder="">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="text" name="image_CA">
                    </td>
                </tr>

               

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn btn-primary">
                    </td>
                </tr>

            </table>

        </form>
        <!-- Add CAtegory Form Ends -->

        <?php 
        
            //CHeck whether the Submit Button is Clicked or Not
            if(isset($_POST['submit']))
            {
                //echo "Clicked";

                //1. Get the Value from CAtegory Form

                $id = $_POST['id'];
                $image_CA = $_POST['image_CA'];
                $subject_CA = $_POST['subject_CA'];
            

                //2. Create SQL Query to Insert CAtegory into Database
                $sql = "INSERT INTO tbl_category SET 
                    id = '$id ',
                   subject_CA='$subject_CA',
                    image_CA='$image_CA'
                    
                ";

                //3. Execute the Query and Save in Database
                $res = mysqli_query($conn, $sql);

                //4. Check whether the query executed or not and data added or not
                if($res==true)
                {
                    //Query Executed and Category Added
                    $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
                    //Redirect to Manage Category Page
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    //Failed to Add CAtegory
                    $_SESSION['add'] = "<div class='error'>Failed to Add Category.</div>";
                    //Redirect to Manage Category Page
                    header('location:'.SITEURL.'admin/add-category.php');
                }
            }
        
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>