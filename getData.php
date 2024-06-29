<?php
  $conn = mysqli_connect("localhost", "root", "", "employee");
  if(isset($_POST['proID'])){
    $proCode = mysqli_real_escape_string($conn, $_POST['proID']);
    $sql="SELECT * FROM `district` WHERE PCode = '$proCode'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
      while($row = $result->fetch_assoc()){
        echo "<option value='".$row['DCode']."'>".$row['DName_en']."</option>";
      }
    }
  }
  if(isset($_POST['disID'])){
    $disCode = mysqli_real_escape_string($conn, $_POST['disID']);
    $sql="SELECT * FROM `commune` WHERE DCode = '$disCode'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
      while($row = $result->fetch_assoc()){
        echo "<option value='".$row['CCode']."'>".$row['CName_en']."</option>";
      }
    }
  }
?>
