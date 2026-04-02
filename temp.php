<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <style>


   
h1{
      text-align: center;
    }
 
   
</style>

</head>

<?php
include('../includes/connect.php');
if(isset($_POST['click']))
{
  $brandtype = $_POST['t1'];
  $type = $_POST['b2'];
  if(isset($_FILES['image']))
  { 
    
  //   echo "<pre>";
  //   print_r($_FILES);
  //  echo "<pre>";
     $file_name=$_FILES['image']['name'];
     $file_size=$_FILES['image']['size'];
     $file_tmp=$_FILES['image']['tmp_name'];
     $file_type=$_FILES['image']['type'];
    $mypath='image/'.$file_name;
move_uploaded_file($file_tmp,"image/". $file_name);
// move_uploaded_file($file_tmp,$mypath);

  }
 
  $insert_query = "insert into concert_gallery_table(concert_id,status,image) values ('$brandtype','$type','$file_name')";
  if($insert_query)

  {
    echo"<script>
    document.addEventListener('DOMContentLoaded',function(){ showToast('Processing...','info',2000); });
    </script>";
  }
  $result = mysqli_query($con,$insert_query);
  if($result) 
  {  
    echo "<script>document.addEventListener('DOMContentLoaded',function(){ showToast('Category added successfully!','success',3000); });
    </script>";
  }

  


}

?>
 <h1>Concert Gallery </h1>
<form action="" method="post" class="mb-2" enctype="multipart/form-data">
   
    <div class="container">
<div class="input-group w-90 mb-2">
  <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></span>
  
  <input type="text" class="form-control" name="t1" placeholder="concert_id" aria-label="First_name" aria-describedby="basic-addon1">

</div>

<div class="input-group w-90 mb-2">
  <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></span>
  
  <input type="text" class="form-control" name="b2" placeholder="status	" aria-label="First_name" aria-describedby="basic-addon1">
  
</div>
<div class="input-group w-90 mb-2">
  <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></span>
  
<input class="form-control" type="file" id="formFile" name="image"  >
  
</div>






      


<div class="input-group w-10 mb-2">
 
  <!-- <input type="submit" class="form-control" name="insert_categories" value="Insert Categories" aria-label="username"
  aria-describedby="basic-addon1" class="bg-nfo"> -->
    <input type="submit" class="bg-info border-0 p-2 my-3" name="click" value="save">
   
      


</div>
</div>
</table>
<?php include('includes/toast.php'); ?>
</form>
