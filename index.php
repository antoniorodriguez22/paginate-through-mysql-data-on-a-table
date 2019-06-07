<!DOCTYPE html>

<html>
<head>
<title>Paginating through</title>

</head>

<body>




        <p> 
        
        <h4> Directory</h4>

          <?php                                  //This script contains the logic to paginate the table
          
          
          if (isset($_GET['pageno'])) {          //This GET method sets the page number (1) initially. 
              $pageno = $_GET['pageno'];
          } else {
              $pageno = 1;
          }
          $no_of_records_per_page = 10;         //Number of records per page (10 rows).
          $offset = ($pageno-1) * $no_of_records_per_page;     //Limiting results of the query to number of records (10 rows)
          $total_pages_sql = "SELECT COUNT(*) FROM table";     //Query used to count records on a table. 
          $result = mysqli_query($db,$total_pages_sql);        //Executing the query
          $total_rows = mysqli_fetch_array($result)[0];        //Fetching through the array of results of the total of records.  
          $total_pages = ceil($total_rows / $no_of_records_per_page);     //Defining the total pages by creating a ceiling dividing the total 
                                                                          //of rows  (results/records) by the number of recordes per page we defined previously.
           ?>  
           
           <--!Header of the table-->
           
          <table>
              <thead>
                <tr>
                  <th scope="col">Name</th>
                  <th>Link</th>
                </tr>
              </thead>
              <tbody>


          <?php
             $db = mysqli_connect('localhost', 'root', '', 'databasename');             //db connection

             $query = "SELECT * FROM table  LIMIT $offset, $no_of_records_per_page";    //EQuery to extract 10 records at a time
             $res_data= mysqli_query($db, $query);                                      //Executing the query
             if (!$result ||mysqli_num_rows($res_data) >= 1){                         
                                                                                        //Outputting results
             while($row= $res_data->fetch_array()){                                     //The code between these braces outputs your data,
                                                                                        //In this case, it is a table directory. 
                echo '<tr><td>'.$row["value1"].'</td>';
                echo '<td><a href="https://'.$row["value2"].'" target="_blank">Click to access this</a></td></tr>';

                }
            }

          ?>
        </tbody>
        </table>


       <--!Page control-->
            <p>
            
            <--!Previous (The key here is decreasing the page number by 1)-->
            
            <span class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
                <a href="YOURFILE.php<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">&lt;Previous</a> |
              </span>
              
              <--!Next (The key here is increasing the page number by 1)-->
            
              <span class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                <a href="YOURFILE.php<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next &gt;</a>
              </span>
            </p>



        </p>

</body>
</html>
