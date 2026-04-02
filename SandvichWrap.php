<?php
include('includes/connect.php');
include('menu_bar.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sandvich&Wrap</title>
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
            width: 100%;
            max-width: 350px;
            height: auto;
            border-radius: 12px;
            overflow: hidden;
            background: #f9fafb;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease, border 0.3s ease;
        }

        table:hover {
            border: 2px solid #007bff;
            box-shadow: 0px 8px 20px rgba(0, 123, 255, 0.3);
        }

        tr {
            height: auto;
        }

        td {
            width: 100%;
        }

        form {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            text-align: center;
            padding: 15px;
        }

        form img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            transition: transform 0.3s ease-in-out, filter 0.3s ease-in-out;
        }

        form img:hover {
            transform: scale(1.05);
            filter: brightness(1.1);
        }

        form h3 {
            font-size: 20px;
            font-weight: 600;
            color: #333;
        }

        form h3:nth-child(3) {
            color: #007bff;
            font-weight: bold;
        }

        form h3:nth-child(2) {
            margin-top: 10px;
        }

        button {
            background: linear-gradient(135deg, #0066ff, #0099ff);
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
            box-shadow: 0px 5px 15px rgba(0, 102, 255, 0.4);
        }

        button a {
            color: white;
            text-decoration: none;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .card-deck {
                flex-direction: column;
                align-items: center;
            }

            table {
                width: 90%;
            }

            form img {
                height: 200px;
            }

            button {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            form h3 {
                font-size: 18px;
            }

            button {
                padding: 10px 16px;
                font-size: 14px;
            }
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
    <h1>Sandvich&wrap</h1>
    <div class="card-deck">
        <?php
        $select_query = "SELECT * FROM food_table where category_name='Sandwich & Wrap'";
        $result_query = mysqli_query($con, $select_query);
        while ($row = mysqli_fetch_assoc($result_query)) {
            $id = $row['foodid'];
            $product_name = $row['foodname'];
            $image = $row['image'];
            $price = $row['price'];
            $classi = $row['classification'];
            $description = $row['description'];
            echo "
      <table>
      
      <tr>
      <td>
      
    <form action='managecard.php' method='POST'>
        
          <img src='Images/$image' alt='...' >
        
            <h3>$product_name</h3>  
           
            <h3>RS.$price</h3>
            <h3>$classi</h3> 
            
            <button type='submit' class='my-2' name='Cart'> Add to Cart</button>
            <input type='hidden' name='Item_Name' value='$product_name'>
            <input type='hidden' name='Price' value='$price'>

            </form>
            
         </td>
         
     </tr>
  
     </table>
     ";
        }
        ?>
    </div>


    <?php include 'footer.php'; ?>
</body>

</html>