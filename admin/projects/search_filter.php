<div class="search-list">

<?php
// Turn on output buffering
ob_start();

// include() - include the db connection and data
include "../../connection/connect.php";
$output = '';
if(isset($_POST["query"]))
{

//search projects
$search = mysqli_real_escape_string($conn, $_POST["query"]);
$query = "SELECT * FROM tb_projects WHERE project_name LIKE '%".$search."%' OR project_category LIKE '%".$search."%'
OR project_duration LIKE '%".$search."%'  OR created_date LIKE '%".$search."%' OR project_status LIKE '%".$search."%'";
 
}else{
 $query = "SELECT * FROM tb_projects ORDER BY id_project";
}
// mysqli_query() - does not actually return the result of the query only the number that identifies the result set
$result = mysqli_query($conn, $query);
//  mysqli_num_rows() - returns integer; how many rows have been returned by a select query.
if(mysqli_num_rows($result) > 0) {
 $totalfound = mysqli_num_rows($result);
  $output .= '<h3>'.$totalfound.' Records Found</h3>
  <table class="table table-striped custab">
  <thead>
      <tr>
         <th>Project ID</th>
         <th>User ID</th>
         <th>Project Name</th>
         <th>Category</th>
         <th>Duration</th>
         <th>Description</th>
         <th>Registered On</th>
         <th>Status</th>
         <th>Delete</th>
      </tr>
  </thead>
  <tbody>';
// mysqli_fetch_array() - function to retrieve the rows 
// from a query. By default, mysql_fetch_array() will 
// return each column in a row twice: the first will have 
// an associative key, the second will have a numeric 
// key.

 while($row = mysqli_fetch_array($result))
 {
         $id_project = isset($_GET['id_project'])?$_GET['id_project']:"";

         echo '<form action="search_filter.php" method="post">';

         $output .= '
         <tr>
            <td>'.$row["id_project"].'</td>
            <td>'.$row["id_user"].'</td>
            <td>'.$row["project_name"].'</td>
            <td>'.$row["project_category"].'</td>
            <td>'.$row["project_duration"].'</td>
            <td>'.$row["project_description"].'</td>
            <td>'.$row["created_date"].'</td>
            <td>'.$row["project_status"].'</td>
            <td>
              <a href="search_filter.php?id='.$row['id_project'].'" id="delete" onclick="return confirm(\'Are you sure you want to delete this project?\');">
              <span class="glyphicon glyphicon-trash"></span></a>
            </td>
         </form>
       </tr>';
      }
 echo $output;
}else{
 echo 'No Record Found';
}

   //delete project
   if(isset($_GET["id"])){
              $id = $_GET['id'];
              $query4 = "DELETE FROM tb_projects WHERE id_project = '$id'";  
              $result4 = mysqli_query($conn,$query4);  
              if ($result4) {  
                     header("Refresh:0;url=search_projects.php");
           } 
      }
// ob_flush() function outputs the contents of the topmost output buffer and then clears the buffer of the contents.

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
   background-color: #D2322D;
   border-radius: 4px;
   margin-left: 10px;
   padding:5px;}
</style>
