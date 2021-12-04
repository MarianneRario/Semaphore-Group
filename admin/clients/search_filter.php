<div class="search-list">
<?php
ob_start();

include "../../connection/connect.php";
$output = '';
if(isset($_POST["query"]))
{

 //search clients
 $search = mysqli_real_escape_string($conn, $_POST["query"]);
 $query = "SELECT * FROM tb_users WHERE user_type = 'client' AND (fname LIKE '%".$search."%' OR lname LIKE '%".$search."%'
 OR business_type LIKE '%".$search."%'  OR email LIKE '%".$search."%' OR contact_number LIKE '%".$search."%'  
 OR country LIKE '%".$search."%' OR company LIKE '%".$search."%')";
 
}else{
 $query = "SELECT * FROM tb_users WHERE user_type = 'client' ORDER BY id";
}
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0) {
 $totalfound = mysqli_num_rows($result);
  $output .= '<h3>'.$totalfound.' Records Found</h3>
  <table class="table table-striped custab">
  <thead>
      <tr>
         <th>ID</th>
         <th>Name</th>
         <th>Email</th>
         <th>Password</th>
         <th>Contact Number</th>
         <th>Country</th>
         <th>Company</th>
         <th>Business Type</th>
         <th>Registered On</th>
         <th>Action</th>
      </tr>
  </thead>
  <tbody>';
 while($row = mysqli_fetch_array($result))
 {
      $client = $row["id"];
      $query3 = "SELECT * FROM tb_users WHERE id = '$client'";
      $result3 = mysqli_query($conn, $query3);
      if(mysqli_num_rows($result3) > 0) {
             while($row1 = mysqli_fetch_array($result3)){
                $client_name = $row1["fname"] . " " . $row1["lname"];

             }
      }

         echo '<form action="search_filter.php" method="post">';
         $confirm = 'onclick="if(confirm("Are you sure?")) saveandsubmit(event);"';
         $output .= '
         <tr>
            <td>'.$row["id"].'</td>
            <td>'.$client_name.'</td>
            <td>'.$row["email"].'</td>
            <td>'.$row["password"].'</td>
            <td>'.$row["contact_number"].'</td>
            <td>'.$row["country"].'</td>
            <td>'.$row["company"].'</td>
            <td>'.$row["business_type"].'</td>
            <td>'.$row["created_date"].'</td>
             <td><a href="search_filter.php?id='.$row['id'].'" id="btn" onclick="return confirm(\'Are you sure you want to delete this client?\');">
              <span class="glyphicon glyphicon-trash"></span></a></td>  
         </form>
       </tr>';
      }
 echo $output;
}else{
 echo 'No Record Found';
}

  //delete clients
   if(isset($_GET['id'])){
              $id = $_GET['id'];
              $query4 = "DELETE FROM tb_users WHERE id = '$id' AND user_type ='client'";  
              $result4 = mysqli_query($conn,$query4);  
              if ($result4) {  
                     header("Refresh:0;url=search_clients.php");
         }
      }

       ob_end_flush();
?>
    </tbody>
  </table>
</div>
<script>
   //prevent form resubmission when page is refreshed
   if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
   }
</script>
<style>
.glyphicon-trash{
   color: white;
   margin-left: 30%;
   background-color: #D2322D;
   border-radius: 4px;
   padding:5px;}
.a{
   margin:0;
   padding: 0;
}
</style>