<?php

    require($_SERVER['DOCUMENT_ROOT']."/blog/admin_menu/menu.php");
    
    $delete_record=False;
    $edit_record=False;
    $record_nbr=0;
    
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
    
        $dbroot = mysql_connect($DB_HOST, $DB_USER, $DB_PASS)
            or die("unable to connect to mysql");
        $db = mysql_select_db('blogapp', $dbroot) 
            or die("Unable to select db " . mysql_error());
        
        $new_access=$_POST['access_level'];
        $new_email=$_POST['email'];
        $id=$_POST['id'];
        
        $sql="UPDATE users SET email = '$new_email', access_level = '$new_access' WHERE id = '$id'";
        mysql_query($sql);
    }
    
    //incase a post request comes thru, we won't process the following:
    if ($_SERVER["REQUEST_METHOD"]=="GET"){
        if (htmlspecialchars($_GET["delete"]) == "YES"){
            $delete_record=True;
        }
        
        if (htmlspecialchars($_GET["edit"]) == "YES"){
            $edit_record=True;
        }
        
        if (htmlspecialchars($_GET["record"])){
            $record_nbr=htmlspecialchars($_GET["record"]);
        }
        
        if ($delete_record){
            $dbroot = mysql_connect($DB_HOST, $DB_USER, $DB_PASS)
                or die("unable to connect to mysql");
            $db = mysql_select_db('blogapp', $dbroot) 
                or die("Unable to select db " . mysql_error());
            if($record_nbr > 0){
                $sql = "DELETE FROM users WHERE id = '$record_nbr'";
                mysql_query($sql);
            }
            mysql_close($dbroot);
        }
    }

?>


    <div class="title">
    Welcome to the admin menu-Users!
    </div><br>
    
    <table>
        <tr>
            <th>Username</th>
            <th>Access Level</th>
            <th>Email Address</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    
    <?php
    
        $dbroot = mysql_connect($DB_HOST, $DB_USER, $DB_PASS) 
            or die("Unable to connect to mysql");
        $db = mysql_select_db('blogapp', $dbroot) 
            or die("Unable to select db " . mysql_error());
        
        //start by getting record for edit and creating a special first row with boxes
        if ($edit_record and $record_nbr > 0){
            //get result for edit record first
            $sql = "SELECT * FROM users WHERE id = '$record_nbr'";
            $results = mysql_query($sql);
            $row = mysql_fetch_array($results);
            
            //now lets create the row
            echo "<tr>";
            echo "<form method=\"post\">";
            echo "<input type=\"hidden\" name=\"id\" value=\"" . $row['id'] . "\">";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td><input type=\"text\" value=\"" . $row['access_level'] . "\" name=\"access_level\"></td>";
            echo "<td><input type=\"text\" value=\"" . $row['email'] . "\" name=\"email\"></td>";
            echo "<td>RESET PASSWORD (TBD)" . "</td>";
            echo "<td><input type=\"submit\" value=\"COMMIT\">" . "</td>";
            echo "</form>";
            echo "</tr>";
            
        }
        
        $sql = "SELECT * FROM users ORDER BY access_level, username";
        $results = mysql_query($sql);
        
        while($row = mysql_fetch_array($results)){
            echo "<tr>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['access_level'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            if ($row['access_level'] >= $userPrivs && $row['username'] != $loginID){
                echo "<td><center><a href=\"/blog/admin_menu/edit_user.php?delete=NO&edit=YES&record=" . $row[id] . "\">EDIT</a></center></td>";
                echo "<td><center><a href=\"/blog/admin_menu/edit_user.php?delete=YES&edit=NO&record=" . $row[id] . "\">DELETE</a></center></td>";
            }else{
                echo "<td>EDIT</td>";
                echo "<td>DELETE</td>";
            }
            echo "</tr>";
        }
    ?>
    
    </table>

    </body>
    
</HTML>