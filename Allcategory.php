<?php
include('includes/connect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ALL CATEGORIES</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
  <style>
    .card-deck {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    padding: 20px;
}

table {
    width: 30%;
    height: 60vh;
    border-radius: 12px;
    overflow: hidden;
    background: white;
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

table:hover {
    transform: scale(1.05);
    box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
}

table:hover img {
    transform: scale(1.1);
}

tr {
    height: 40vh;
}

td {
    width: 100%;
}

form {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;
    height: 100%;
    text-align: center;
    padding: 15px;
}

form img {
    width: 100%;
    height: 35vh;
    object-fit: cover;
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
    transition: transform 0.3s ease-in-out;
}

form h3 {
    font-size: 22px;
    font-weight: 600;
    transition: color 0.3s ease;
}

form h3:nth-child(3) {
    color: #e74c3c;
    font-weight: bold;
}

form h3:nth-child(2) {
    margin-top: 10px;
}

button {
    background: linear-gradient(135deg, #ff7eb3, #ff758c);
    border: none;
    padding: 12px 20px;
    font-size: 16px;
    font-weight: bold;
    color: white;
    border-radius: 8px;
    cursor: pointer;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

button:hover {
    transform: translateY(-3px);
    box-shadow: 5px 5px 15px rgba(255, 117, 140, 0.4);
}

button a {
    color: white;
    text-decoration: none;
}

h1 {
    text-align: center;
    font-size: 28px;
    font-weight: bold;
    color: #333;
    margin-bottom: 20px;
}

  </style>
</head>

<body>
  <h1>Our Menu </h1>
  <div class="card-deck">
    <?php
    $select_query = "SELECT * FROM category_table";
    $result_query = mysqli_query($con, $select_query);
    while ($row = mysqli_fetch_assoc($result_query)) {
      $id = $row['categoryid'];
      $category_name = $row['categoryname'];
      $image = $row['image'];
     
      echo "
      <table>
      
      <tr>
      <td>
      
      <form action='Manage_Card.php' method='POST'>
        
          <img src='Images/$image' alt='...' >
        
            <h3>$category_name</h3>  
           
          
            <input type='hidden' name='category_id' value='$id'>
            <button type='submit' class='my-2' name='Cart'> More Info</button>
           
          

            </form>
            
         </td>
         
     </tr>
  
     </table>
     ";
    }
    ?>
  </div>


</body>

</html>