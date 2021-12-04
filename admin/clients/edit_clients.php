<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Edit Clients - Admin | Semaphore</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="../css/update_clients.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>
        <body style="background-color: #ECECEC;">
        <div class="banner">
            <ul>
                <div class="floatleft">
                     <li><h3>SEMAPHORE</h3></li>
                </div>
                <div class="floatright">
                    <?php
                        session_start();
                        date_default_timezone_set('Asia/Manila');
                        if (! empty($_SESSION['logged_in']) && ($_SESSION['user_type']) == "admin")
                        {
                            //select data of admin
                            include '../../connection/connect.php';
                            $query_admin = "SELECT * FROM tb_users WHERE email = '$_SESSION[email]'";
                            $result_admin = mysqli_query($conn, $query_admin);

                            if(mysqli_num_rows($result_admin) > 0){
                                while($row = mysqli_fetch_assoc($result_admin)){
                                            $fname = $row["fname"] ;
                                            $lname = $row["lname"] ;
                                            $email = $row["email"] ;
                                            $id = $row["id"] ;
                                }
                            }
                            ?>
                           
                            <li class="menu-nav"><a href="../dashboard.php">DASHBOARD</a></li>
                            <li class="menu-nav"><p>CLIENTS</p></li>
                            <li class="menu-nav" id="clients"><a href="search_clients.php">SEARCH</a></li>
                            <li class="menu-nav" id="clients"><a href="edit_clients.php">UPDATE</a></li>
                            <li class="menu-nav"><a href="../projects/search_projects.php">PROJECTS</a></li>
                            <div class="dropdown">
                              <li class="menu-nav"><i class="arrow down"></i></li>
                                 <div class="dropdown-content">
                                   <p><span>Admin,</span> <?php echo $fname . ' ' . $lname;?></p>
                                   <p><a href="../settings.php">Settings</a></p>
                                   <p><a href="../../logout.php">Log out</a></p>
                                 </div>
                           </div>
                         <?php
                       }
                        else
                        {
                            // access denied if user is not log in
                             header("location: ../index.php");
                             exit; 
                         }

                         //update
                         $alert= "";
                            if(isset($_POST['but_update'])){
                                if(isset($_POST['update'])){
                                    foreach($_POST['update'] as $updateid){
 
                                        $fname = $_POST['fname'.$updateid];
                                        $lname = $_POST['lname'.$updateid];
                                        $email = $_POST['email'.$updateid];
                                        $contact = $_POST['contact_number'.$updateid];
 
                                        if($fname !='' && $lname != '' && $email != '' ){
                                            $updateUser = "UPDATE tb_users SET 
                                                fname='".$fname."',lname='".$lname."' ,
                                                contact_number='".$contact."' ,email='".$email."'
                                            WHERE id=".$updateid;
                                            mysqli_query($conn,$updateUser);
                                        }

                                    }
                                    $alert = '<div class="alert alert-success" role="alert">Records successfully updated</div>';
                                }
                            }
                    ?>
                </div>
            </ul>
      </div>

       <div class='container'>
            <h3>Edit Users</h3>
            <form method='post' action='edit_clients.php'><?php echo $alert; ?>
                <p><input type='submit' value='Update Selected Records' class="btn btn-success" name='but_update'></p>
                <table class="table table-bordered">
                    <tr style='background: whitesmoke;'>
                        <!-- Check/Uncheck All-->
                        <th><input type='checkbox' id='checkAll' > Check</th>
                        <th>User ID</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Contact number</th>
                        <th>Email</th>
                    </tr>
                    <?php 
                    $query = "SELECT * FROM tb_users WHERE user_type = 'client'";
                    $result = mysqli_query($conn,$query);
 
                    while($row = mysqli_fetch_array($result) ){
                        $id = $row['id'];
                        $fname = $row['fname'];
                        $lname = $row['lname'];
                        $contact = $row['contact_number'];
                        $email = $row['email'];
                    ?>
                        <tr>
                            <td><input type='checkbox' name='update[]' value='<?= $id?>'></td>
                            <td><input type='text' name='id<?= $id ?>' value='<?= $id ?>'disabled ></td>
                            <td><input type='text' name='fname<?= $id ?>' value='<?= $fname ?>' ></td>
                            <td><input type='text' name='lname<?= $id ?>' value='<?= $lname ?>' ></td>
                            <td><input type='text' name='contact_number<?= $id ?>' value='<?= $contact ?>'></td>
                            <td><input type='text' name='email<?= $id ?>' value='<?= $email ?>'></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </form>
        </div>
        <script type="text/javascript">
            $(document).ready(function(){
                // Check/Uncheck ALl
                $('#checkAll').change(function(){
                    if($(this).is(':checked')){
                        $('input[name="update[]"]').prop('checked',true);
                    }else{
                        $('input[name="update[]"]').each(function(){
                            $(this).prop('checked',false);
                        }); 
                    }
                });
                // Checkbox click
                $('input[name="update[]"]').click(function(){
                    var total_checkboxes = $('input[name="update[]"]').length;
                    var total_checkboxes_checked = $('input[name="update[]"]:checked').length;
 
                    if(total_checkboxes_checked == total_checkboxes){
                        $('#checkAll').prop('checked',true);
                    }else{
                        $('#checkAll').prop('checked',false);
                    }
                });
            });
        </script>
    </body>
</html>