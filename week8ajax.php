
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define( 'DB_NAME', 'anaqvi4');
define( 'DB_USER', 'anaqvi4');
define( 'DB_PASSWORD', 'anaqvi4');
define( 'DB_HOST', 'localhost');

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  //check connection
  if(!$conn) {
    die("Connection failed: " .mysqli_connect_error());
  }

function DeletePeople($id) {
  global $conn;
  $del = "DELETE FROM People WHERE id = '$id'";

  $result = $conn->query($del);
}



function InsertName($firstName,$lastName,$telephone) {
  global $conn;
  
  $insert = "INSERT INTO People SET firstName = '$firstName', lastName='$lastName', telephone='$telephone'";
  $result = $conn->query($insert);

}

function showPeople() {
  global $conn;
  $sql = "SELECT id, firstName, lastName, telephone FROM People";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      $id=$row["id"];
      $delurl = "[<a href=''onclick=return(DeletePeople('$id'))>delete</a>]";
      
      echo "id: " . $row["id"]. " - Name: " . $row["firstName"]. " " . $row["lastName"]. " " . $row["telephone"]. "$delurl<br>";
    }
  } else {
    echo "0 results";
  }

 
}

$cmd = $_GET['cmd'];


if($cmd == 'create') {
  InsertName($_GET['firstName'],$_GET['lastName'],$_GET['telephone']);
}

else if($cmd == 'delete') {
  $id = $_GET['id'];
  DeletePeople($id);
  
}

showPeople();
mysqli_close($conn);



?>

