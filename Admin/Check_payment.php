<?php
include('../includes/connect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Check Order</title>
    <style>
        * {
            font-family: system-ui;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        h1 {

            color: green;
        }


        table,
        tr,
        td {
            border: 2px solid green;
            border-collapse: collapse;
            padding: 0px 10px;
            text-align: center;

        }

        tr th {

            padding: 0px 20px;

        }

        button a {
            text-decoration: none;
            color: black;
        }

        .up {
            border: none;
            color: black;
            padding: .7rem;
            font-size: .9rem;
            border-radius: 30px;
            position: relative;
            overflow: hidden;
            outline: 1px solid green;
            background: transparent;
        }

        .up:hover {
            outline: none;
        }

        .up a {
            z-index: 100;
            position: relative;
            color: #004500;
        }

        .up:hover a {
            z-index: 99;
            color: white;

        }


        .up::before {
            position: absolute;
            content: '';
            top: 100%;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: green;
            border-radius: 30px;
            transition: .3s ease-in;
        }

        .up:hover::before {
            top: 0%;
            transition: .2s ease-out;
        }

        .del {
            border: none;
            color: black;
            padding: .7rem;
            font-size: .9rem;
            border-radius: 30px;
            position: relative;
            overflow: hidden;
            outline: 1px solid #770101;
            ;
            background: transparent;
        }

        .del:hover {
            outline: none;
        }

        .del a {
            z-index: 100;
            position: relative;
            color: #770101;
        }

        .del:hover a {
            z-index: 99;
            color: white;

        }


        .del::before {
            position: absolute;
            content: '';
            top: 100%;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: red;
            border-radius: 30px;
            transition: .3s ease-in;
        }

        .del:hover::before {
            top: 0%;
            transition: .2s ease-out;
        }






        .ac {
            border: none;
            color: black;
            padding: .7rem;
            font-size: .9rem;
            border-radius: 30px;
            position: relative;
            overflow: hidden;
            outline: 1px solid rgb(2, 85, 187);
            background: transparent;
        }

        .ac:hover {
            outline: none;
        }

        .ac a {
            z-index: 100;
            position: relative;
            color: darkblue;
            font-weight: 600;
        }

        .ac:hover a {
            z-index: 99;
            color: white;

        }


        .ac::before {
            position: absolute;
            content: '';
            top: 100%;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgb(0, 94, 255);
            border-radius: 30px;
            transition: .3s ease-in;
        }

        .ac:hover::before {
            top: 0%;
            transition: .2s ease-out;
        }
    </style>
</head>
<?php
include("admin.php");
?>
<body>

    <div class="container">
        <h1>Check Payment
        </h1>
        <!-- <button class="ac mt-2 mb-3">
            <a href="add_product.php" class="">Add Category</a>
        </button> -->
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                  
                    <th scope="col">Name</th>
                    <th scope="col">Card Type</th>
                 
                    <th scope="col">Amount</th>
                    <th scope="col">Card Number</th>
                    <th scope="col">Name On Card</th>
                    <th scope="col">Exp. Date</th>
                    <th scope="col">Cvv Code</th>
                   
                   
              
                  


                </tr>
            </thead>
            <tbody>

                <?php
                $sql = "Select * from payment";
                $result = mysqli_query($con, $sql);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['paymentid'];
                        
                       
                        $name = $row['name'];
                       
                        $ctype = $row['cardtype'];
                        $amt = $row['amount'];
                   $cno= $row['cardno'];
                   $name_on_card = $row['nameoncard'];

                   $expdate = $row['expdate'];
                   $cvs = $row['cvs'];
                    
                    
                        echo '<tr>
    <th scope="row">' . $id . '</th>
  
    <th scope="row">' . $name . '</th>
    <td>' . $ctype . '</td>
    <th scope="row">' . $amt . '</th>
      <th scope="row">' . $cno . '</th>

    <td>' . $name_on_card . '</td>
      <td>' . $expdate . '</td>
    <th scope="row">' . $cvs . '</th>

   
   
  </tr>';

                    }
                }
                ?>


            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>