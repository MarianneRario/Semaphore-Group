<?php 
include "../../connection/connect.php";
    $alert= "";
        if(isset($_POST['but_update'])){
            if(isset($_POST['update'])){
                foreach($_POST['update'] as $updateid){
 
                    $status = $_POST['status'.$updateid];
 
                    //update projects
                    if($status !=''){
                        $updateProject = "UPDATE tb_projects SET project_status='".$status."'
                        WHERE id_project=".$updateid;
                        mysqli_query($conn,$updateProject);
                    }
                     
                }
                $alert = '<div class="alert alert-success" role="alert">Records successfully updated</div>';
            }
        }
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Edit Project</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/update_projects.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body style="background-color: #ECECEC;">
        <div class="banner">
            <ul>
                <div class="floatleft">
                     <li><h3>SEMAPHORE</h3></li>
                </div>
                <div class="floatright">
                    <?php
                        session_start();
                        if (! empty($_SESSION['logged_in']) && ($_SESSION['user_type']) == "admin")
                        {
                            //select data of admin
                            include '../../connection/connect.php';
                            $query_admin = "SELECT * FROM tb_users WHERE email = '$_SESSION[email]'";
                            $result_admin = mysqli_query($conn, $query_admin);

                            if(mysqli_num_rows($result_admin) > 0){
                                while($row = mysqli_fetch_assoc($result_admin)){
                                            $id = $row["id"] ;
                                            $fname = $row["fname"] ;
                                            $lname = $row["lname"] ;
                                            $email = $row["email"] ;
                                }
                            }
                            ?>
                           
                            <li class="menu-nav"><a href="../dashboard.php">DASHBOARD</a></li>
                            <li class="menu-nav"><p>PROJECTS</p></li>
                            <li class="menu-nav" id="clients"><a href="search_projects.php">SEARCH</a></li>
                            <li class="menu-nav" id="clients"><a href="update_projects.php">UPDATE</a></li>
                            <li class="menu-nav"><a href="../clients/search_clients.php">CLIENTS</a></li>
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
                    ?>
                </div>
            </ul>
      </div>
          <div class='container'>
            <h3 style="text-align: left;">Update Projects</h3>
            <form method='post' action='update_projects.php'><?php echo $alert; ?>
                <p><input type='submit' value='Update Selected Records' class="btn btn-success" name='but_update'></p>
                <table class="table table-bordered">
                    <tr style='background: whitesmoke;'>
                        <!-- Check/Uncheck All-->
                        <th><input type='checkbox' id='checkAll' > Check</th>
                        <th>Project ID</th>
                        <th>User ID</th>
                        <th>Status</th>
                        <th>Project Name</th>
                        <th>Project Description</th>
                        <th>Project Duration</th>
                        <th>Registered Date</th>
                    </tr>
                    <?php 
                    $query = "SELECT * FROM tb_projects order by id_project";
                    $result = mysqli_query($conn,$query);
 
                    while($row = mysqli_fetch_array($result) ){
                        $id_project = $row['id_project'];
                        $id_user = $row['id_user'];
                        $status = $row['project_status'];
                        $project_name = $row['project_name'];
                        $project_description = $row['project_description'];
                        $project_duration = $row['project_duration'];
                        $registered_date = $row['created_date'];
                    ?>
                        <tr>
                            <td><input type='checkbox' name='update[]' value='<?= $id_project ?>' ></td>
                            <td><input type='text' name='id_project<?= $id_project ?>' value='<?= $id_project ?>' disabled></td>
                            <td><?php echo $id_user ?></td>
                            <td><select class='form-select' name='status<?= $id_project ?>'>
                                <option value='<?php echo $status?>' selected><?php echo $status ?></option>
                                <option value='In development'>In development</option>
                                <option value='Pending'>Pending</option>
                                <option value='Finished'>Finished</option>
                                <option value='Declined'>Declined</option>
                              </select></td>
                            <td><?php echo $project_name?></td>
                            <td><?php echo $project_description?></td>
                            <td><?php echo $project_duration?></td>
                            <td><?php echo $registered_date?></td>
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