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
        * { font-family: system-ui; }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        h1 { color: green; }

        table, tr, td {
            border: 2px solid green;
            border-collapse: collapse;
            padding: 6px 10px;
            text-align: center;
        }

        tr th { padding: 0px 20px; }

        /* ===== Status Badge ===== */
        .status-badge {
            display: inline-block;
            padding: 3px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: .82em;
            letter-spacing: .4px;
        }
        .status-Pending     { background: #fff3cd; color: #856404; border: 1px solid #ffc107; }
        .status-Delivered   { background: #d1e7dd; color: #0a5c36; border: 1px solid #198754; }
        .status-Cancelled   { background: #f8d7da; color: #842029; border: 1px solid #dc3545; }
        .status-InProgress  { background: #cfe2ff; color: #084298; border: 1px solid #0d6efd; }

        /* ===== Edit Status cell ===== */
        .status-cell { white-space: nowrap; }

        .status-select {
            display: none;
            padding: 4px 8px;
            border-radius: 6px;
            border: 1px solid #aaa;
            font-size: .82em;
            cursor: pointer;
            margin-right: 4px;
        }

        .btn-edit-status {
            border: none;
            color: #004500;
            padding: 5px 14px;
            font-size: .8rem;
            border-radius: 20px;
            position: relative;
            overflow: hidden;
            outline: 1px solid green;
            background: transparent;
            cursor: pointer;
            transition: .2s;
        }
        .btn-edit-status:hover { background: green; color: white; outline: none; }

        .btn-save-status {
            display: none;
            border: none;
            color: #fff;
            padding: 5px 14px;
            font-size: .8rem;
            border-radius: 20px;
            background: #198754;
            cursor: pointer;
            transition: .2s;
        }
        .btn-save-status:hover { background: #14703f; }

        .btn-cancel-edit {
            display: none;
            border: none;
            color: #fff;
            padding: 5px 10px;
            font-size: .8rem;
            border-radius: 20px;
            background: #6c757d;
            cursor: pointer;
            margin-left: 3px;
            transition: .2s;
        }
        .btn-cancel-edit:hover { background: #495057; }

        .btn-remove {
            border: none;
            background: #dc3545;
            color: #fff;
            padding: 5px 14px;
            border-radius: 20px;
            font-size: .8rem;
            cursor: pointer;
            transition: background .2s;
        }
        .btn-remove:hover { background: #a71d2a; }
    </style>
</head>

<?php include("admin.php"); ?>

<body>
    <div class="container">
        <h1>Check Order</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name of Person</th>
                    <th scope="col">Mobile Number</th>
                    <th scope="col">Address</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Status</th>
                    <th scope="col">Edit Status</th>
                    <th scope="col">Remove</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql    = "SELECT * FROM order_table";
                $result = mysqli_query($con, $sql);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id      = $row['orderid'];
                        $name    = htmlspecialchars($row['name']);
                        $mobile  = htmlspecialchars($row['mobile']);
                        $address = htmlspecialchars($row['address']);
                        $amount  = htmlspecialchars($row['totalamount']);
                        $status  = htmlspecialchars($row['status']);

                        $badge_class = 'status-' . str_replace(' ', '', $status);

                        $statuses = ['Pending', 'In Progress', 'Delivered', 'Cancelled'];
                        $options  = '';
                        foreach ($statuses as $opt) {
                            $sel      = ($opt === $status) ? 'selected' : '';
                            $options .= "<option value=\"$opt\" $sel>$opt</option>";
                        }

                        echo "
<tr id=\"row-$id\">
    <th scope=\"row\">$id</th>
    <th scope=\"row\">$name</th>
    <td>$mobile</td>
    <th scope=\"row\">$address</th>
    <td>$amount</td>

    <td>
        <span class=\"status-badge $badge_class\" id=\"badge-$id\">$status</span>
    </td>

    <td class=\"status-cell\">
        <select class=\"status-select\" id=\"select-$id\">$options</select>
        <button class=\"btn-edit-status\" id=\"btn-edit-$id\" onclick=\"startEdit($id)\">✏️ Edit</button>
        <form action=\"update_status.php\" method=\"post\" style=\"display:inline\" id=\"form-$id\">
            <input type=\"hidden\" name=\"orderid\" value=\"$id\">
            <input type=\"hidden\" name=\"status\" id=\"hidden-status-$id\" value=\"$status\">
            <button type=\"submit\" class=\"btn-save-status\" id=\"btn-save-$id\" name=\"update_status\" onclick=\"setStatus($id)\">💾 Save</button>
        </form>
        <button class=\"btn-cancel-edit\" id=\"btn-cancel-$id\" onclick=\"cancelEdit($id)\">✕</button>
    </td>

    <td>
        <form action=\"delete_order.php\" method=\"post\" style=\"display:inline\" id=\"delete-form-$id\">
            <input type=\"hidden\" name=\"orderid\" value=\"$id\">
            <button type=\"button\" class=\"btn-remove\" onclick=\"confirmRemove($id)\">🗑️ Remove</button>
        </form>
    </td>
</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function startEdit(id) {
            document.getElementById('badge-'    + id).style.display  = 'none';
            document.getElementById('btn-edit-' + id).style.display  = 'none';
            document.getElementById('select-'   + id).style.display  = 'inline-block';
            document.getElementById('btn-save-' + id).style.display  = 'inline-block';
            document.getElementById('btn-cancel-'+ id).style.display = 'inline-block';
        }

        function cancelEdit(id) {
            document.getElementById('badge-'    + id).style.display  = 'inline-block';
            document.getElementById('btn-edit-' + id).style.display  = 'inline-block';
            document.getElementById('select-'   + id).style.display  = 'none';
            document.getElementById('btn-save-' + id).style.display  = 'none';
            document.getElementById('btn-cancel-'+ id).style.display = 'none';
        }

        function setStatus(id) {
            var val = document.getElementById('select-' + id).value;
            document.getElementById('hidden-status-' + id).value = val;
        }
    </script>

    <script>
        function confirmRemove(id) {
            if (confirm('Remove order #' + id + ' permanently?')) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
    </script>

    <?php include '../includes/toast.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>