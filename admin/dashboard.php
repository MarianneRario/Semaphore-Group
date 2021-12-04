<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Admin's Dashboard | Semaphore</title>
        <link rel="stylesheet" href="css/admin.css">

       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
       <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
       <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
       <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
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
                        date_default_timezone_set('Asia/Manila');
                        if (! empty($_SESSION['logged_in']) && ($_SESSION['user_type']) == "admin")
                        {
                            //select data of admin
                            include '../connection/connect.php';
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


                             //get total number of clients
                             $query_clients = "SELECT count(*) as total_clients FROM tb_users WHERE user_type = 'client'";
                             $result_clients = mysqli_query($conn,$query_clients);
                             $total_clients = mysqli_fetch_assoc($result_clients);


                             /* 
                               total number of projects and status
                             */

                             //projects
                             $query_projects = "SELECT count(*) as total_projects FROM tb_projects";
                             $result_projects = mysqli_query($conn,$query_projects);
                             $total_projects = mysqli_fetch_assoc($result_projects);

                            //pending
                             $query_pending = "SELECT count(*) as total_pending FROM tb_projects WHERE project_status ='Pending'";
                             $result_pending = mysqli_query($conn,$query_pending);
                             $total_pending = mysqli_fetch_assoc($result_pending);

                             //in-development
                             $query_in_develop = "SELECT count(*) as total_in_develop FROM tb_projects WHERE project_status ='In development'";
                             $result_in_develop = mysqli_query($conn,$query_in_develop);
                             $total_in_develop = mysqli_fetch_assoc($result_in_develop);

                             //finished
                             $query_finished = "SELECT count(*) as total_finished FROM tb_projects WHERE project_status ='Finished'";
                             $result_finished = mysqli_query($conn,$query_finished);
                             $total_finished = mysqli_fetch_assoc($result_finished);

                             //declined
                             $query_declined = "SELECT count(*) as total_declined FROM tb_projects WHERE project_status ='Declined'";
                             $result_declined = mysqli_query($conn,$query_declined);
                             $total_declined = mysqli_fetch_assoc($result_declined);
                            
                             /*
                               total type of projects                               
                             */

                             //web development
                             $query_webdev = "SELECT count(*) as total_webdev FROM tb_projects WHERE project_category ='Web Development'";
                             $result_webdev = mysqli_query($conn,$query_webdev);
                             $total_webdev = mysqli_fetch_assoc($result_webdev);

                             //digital marketing
                             $query_marketing = "SELECT count(*) as total_marketing FROM tb_projects WHERE project_category ='Digital Marketing'";
                             $result_marketing = mysqli_query($conn,$query_marketing);
                             $total_marketing = mysqli_fetch_assoc($result_marketing);

                             //app development
                             $query_appdev = "SELECT count(*) as total_appdev FROM tb_projects WHERE project_category ='App Development'";
                             $result_appdev = mysqli_query($conn,$query_appdev);
                             $total_appdev = mysqli_fetch_assoc($result_appdev);

                             //software development
                             $query_softdev = "SELECT count(*) as total_softdev FROM tb_projects WHERE project_category ='Software Development'";
                             $result_softdev = mysqli_query($conn,$query_softdev);
                             $total_softdev = mysqli_fetch_assoc($result_softdev);

                            
                            ?>
                           
                            <li class="menu-nav"><a href="dashboard.php">DASHBOARD</a></li>
                            <li class="menu-nav"><a href="clients/search_clients.php">CLIENTS</a></li>
                            <li class="menu-nav"><a href="projects/search_projects.php">PROJECTS</a></li>
                            <div class="dropdown">
                              <li class="menu-nav"><i class="arrow down"></i></li>
                                 <div class="dropdown-content">
                                   <p><span>Admin,</span> <?php echo $fname . ' ' . $lname;?></p>
                                   <p><a href="settings.php">Settings</a></p>
                                   <p><a href="../logout.php">Log out</a></p>
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

                         //date
                         $day = date('d');
                         $month = date('M');
                         $year  = date('y');
                    ?>
                </div>
            </ul>
        </div>

       <div class="container contact">
         <h4 class="sub">DASHBOARD</h4>
        	<div class="row">
          	<div class="col-md-3">
            	<div class="contact-info-date">
        				<p id="date-day"><?php echo $day;?></p>
        			  <p id="date-month-year"><?php echo $month . ' '.$year;?></p>
        			</div>
        		</div>
            <div class="col-md-3">
            	<div class="contact-info" id="top-in">
        			  <p><?php echo $total_clients['total_clients'];?></p>
        			  <h5>TOTAL CLIENTS</h5>
        			</div>
        		</div>
            <div class="col-md-3">
            	<div class="contact-info" id="top-in">
        			  <p><?php echo $total_projects['total_projects'];?></p>
        			  <h5>TOTAL PROJECTS</h5>
        			</div>
            </div>
            	<div class="col-md-3">
            	<div class="contact-info" id="top-in">
                     <br><label id="lable">In development: <?php echo $total_in_develop['total_in_develop'];?></label>
                     <br><label id="lable">Pending: <?php echo $total_pending['total_pending'];?></label>
                     <br> <label id="lable" class="finished">Finished: <?php echo $total_finished['total_finished'];?></label>
                     <br> <label id="lable" class="declined">Declined: <?php echo $total_declined['total_declined'];?></label>
        			</div>
        		</div>

           	<div class="col-md-4">
            	<div class="contact-info" id="contact-hello">
                <div class="mb-5 mt-5 pt-4">
                  TOTAL TYPE OF PROJECTS
                </div>

                <h4>Web Development</h4>
                 <div class="progress">
                   <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:100%;">
                     &nbsp;<?php echo $total_webdev['total_webdev']?>&nbsp;
                   </div>
                </div>
                

                <h4>Digital Marketing</h4>
                 <div class="progress">
                   <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:100%">
                     &nbsp;<?php echo $total_marketing['total_marketing']?>&nbsp;
                   </div>
                </div>

                <h4>App Development</h4>
                 <div class="progress">
                   <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:100%;">
                     &nbsp;<?php echo $total_appdev['total_appdev']?>&nbsp;
                   </div>
                </div>

                <h4>Software Development</h4>
                 <div class="progress">
                   <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:100%;">
                     &nbsp;<?php echo $total_softdev['total_softdev']?>&nbsp;
                   </div>
                </div>
             	</div>
            </div>

            <?php
                  $query = "SELECT * FROM tb_feedbacks";
                  $result = mysqli_query($conn, $query);

                   //total feedbacks
                   $query_feedack = "SELECT count(*) as total_feedback FROM tb_feedbacks";
                   $result_feedback = mysqli_query($conn,$query_feedack);
                   $total_feedback = mysqli_fetch_assoc($result_feedback);                


                   //delete feedback
                   if(isset($_POST['delete'])){
                     $id_feedback = $_POST['id'];

                       $queryfb = "DELETE FROM tb_feedbacks WHERE id_feedback = '$id_feedback'";  
                       if(mysqli_query($conn, $queryfb)){
                         $url = 'dashboard.php';
                          echo'<script>window.location.href = "'.$url.'";</script>';
                          } else{
                                   echo "ERROR: Could not able to execute $queryfb. " . mysqli_error($conn);
                            }
                   }
            ?>

            	<div class="col-md-7">
              	<div class="contact-info" id="feedback" style="background-color:transparent;">
                 <div class="panel panel-default widget">
                  <div class="panel-heading">
                    <span class="glyphicon glyphicon-comment"></span>
                     <h3 class="panel-title">Feedbacks</h3>
                     <span class="label label-info"><?php echo $total_feedback['total_feedback'];?></span>
                  </div>

           <?php

                   if(mysqli_num_rows($result) > 0){
                       while($row = mysqli_fetch_assoc($result)){
                       $id = $row["id_feedback"] ;
                       $fname = $row["fname"] ;
                       $lname = $row["lname"] ;
                       $email = $row["email"] ;
                       $contact = $row["contact_number"] ;
                       $comment = $row["comment"] ;
                       $date = $row["sent_date"] ;

             ?>
        
          <form action="dashboard.php" method="post">
            <div class="panel-body">
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-xs-2 col-md-1">
                            <img src="http://placehold.it/80" class="img-circle img-responsive" alt="" /></div>
                            <div class="col-xs-10 col-md-11">
                                <div>
                                    <a href="#">
                                        <br><?php echo $email;?>
                                    <div class="mic-info">
                                        By: <a href="#"><?php echo $fname . " " . $lname;?></a> on <?php echo $date;?> 
                                        <br><?php echo $contact;?>
                                        <input type="hidden" name="id" value="<?php echo $id;?>">
                                    </div>
                                </div>
                                <div class="comment-text">
                                      <?php echo $comment;?>
                                </div>
                                <div class="action">
                                    <button type="submit" name="delete" class="btn btn-danger btn-xs" title="Delete" onclick="return confirm('Are you sure you want to delete this feedback?')">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
               </div>
           </form>
            <?php /* <-- php resumes now */
                }
             }
          ?>
        </div>
             </div>
         	</div>
        </div>
    </body>
</html>
<script>
   //prevent form resubmission when page is refreshed
   if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
   }
</script>
