<div class="search-list">
<?php
include "../connection/connect.php";
 session_start();
 $output = '';
   if(isset($_POST["query"]))
   {

       $sql_select = "SELECT * FROM tb_users WHERE email = '$_SESSION[email]'";
                            $result = mysqli_query($conn, $sql_select);

                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_assoc($result)){
                                            $id = $row["id"] ; //declare variable for id_user
                                }   
                            }


        $search = mysqli_real_escape_string($conn, $_POST["query"]);
        $query = "SELECT * FROM tb_projects WHERE project_name LIKE '%".$search."%' AND id_user = '$id'";
   
   }else{

       $sql_select = "SELECT * FROM tb_users WHERE email = '$_SESSION[email]'";
                            $result = mysqli_query($conn, $sql_select);

                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_assoc($result)){
                                            $id = $row["id"] ; //declare variable for id_user
                                }   
                            }


       //select projects of current user
        $query = "SELECT * FROM tb_projects WHERE id_user = '$id' ORDER BY id_project";
   }

        $result = mysqli_query($conn, $query);
         if(mysqli_num_rows($result) > 0) {
          $totalfound = mysqli_num_rows($result);
           $output .= '<h5>'.$totalfound.' Records Found</h5>
           <table class="table table-striped custab">
           <thead>
               <tr>
                  <th>Project Name</th>
                  <th>Category</th>
                  <th>Project Description</th>
                  <th>Status</th>
               </tr>
           </thead>
           <tbody>';
          while($row = mysqli_fetch_array($result))
          {
                  $output .= '
                  <tr>
                     <td>'.$row["project_name"].'</td>
                     <td>'.$row["project_category"].'</td>
                     <td>'.$row["project_description"].'</td>
                     <td>'.$row["project_status"].'</td>
                  </tr>';
          }
          echo $output;
         }else{
          echo 'No Record Found';
         }
         ?>
          </tbody>
            </table>
</div>
