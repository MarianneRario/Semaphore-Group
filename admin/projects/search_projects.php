<!DOCTYPE html>
<html>
  <head> 
      <meta charset="utf-8">
      <title>Search Projects - Admin | Semaphore</title>

      <link rel="stylesheet" href="../css/search_projects.css">
      <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

      <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
<div class="container search-table">
<p><h2 align="left">Seach Projects</h2></p>
            <div class="search-box">
                <div class="row">
                    <div class="col-md-3">
                        <h5>Search All Fields</h5>
                    </div>
                    <div class="col-md-9">
                        <input type="text" name="search_text" id="search_text" class="form-control" placeholder="Search by project name, category, duration, description and status">
                    </div> 
                </div>
            </div>
   <div id="result"></div>
  </div>
 </body>
</html>
<script>
      $(document).ready(function(){
       load_data();
        function load_data(query)
        {
         $.ajax({
          url:"search_filter.php",
          method:"POST",
          data:{query:query},
          success:function(data)
          {
        $('#result').html(data);
          }
         });
        }
        $('#search_text').keyup(function(){
         var search = $(this).val();
         if(search != ''){
          load_data(search);
         }else{
          load_data();
         }
        });
      });
 </script>