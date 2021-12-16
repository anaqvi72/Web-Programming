
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define( 'DB_NAME', 'anaqvi4');
define( 'DB_USER', 'anaqvi4');
define( 'DB_PASSWORD', 'anaqvi4');
define( 'DB_HOST', 'localhost');


function DeletePeople($id) {

  $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  //check connection
  if(!$conn) {
    die("Connection failed: " .mysqli_connect_error());
  }

  $del = "DELETE FROM People WHERE id = '$id'";

  $result = $conn->query($del);
  
  mysqli_close($conn);
}



function InsertName($firstName,$lastName,$telephone) {
  $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  // Check connection
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }
  
  $insert = "INSERT INTO People SET firstName = '$firstName', lastName='$lastName', telephone='$telephone'";
  

  

  $result = $conn->query($insert);

  mysqli_close($conn);

}


function showPeople() {
// Create connection
  $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  $sql = "SELECT id, firstName, lastName, telephone FROM People";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      $delurl = "[<a 
      href='https://codd.cs.gsu.edu/~anaqvi4/week5.php?cmd=delete&id={$row['id']}'>delete</a>]";
      echo "id: " . $row["id"]. " - Name: " . $row["firstName"]. " " . $row["lastName"]. " " . $row["telephone"]. "$delurl<br>";
    }
  } else {
    echo "0 results";
  }

  mysqli_close($conn);

}



?>

<form method="get">
  First Name: <input type="text" name="firstName"><br>
  Last Name: <input type="text" name="lastName"><br>
  Telephone: <input type="text" name="telephone"><br>
  <input type="submit" value="Submit">
</form>

<?php 

if($_GET['firstName'] != '' && $_GET['lastName'] != '' && $_GET['telephone'] != '') {
  InsertName($_GET['firstName'],$_GET['lastName'],$_GET['telephone']);
}

if($_GET['cmd'] == 'delete') {
  $id = $_GET['id'];
  DeletePeople($id);
  
}

showPeople();

?>