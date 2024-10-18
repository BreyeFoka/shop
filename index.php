<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- link a bootstrap css file -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <title>My shop</title>
</head>

<body>
    <div class="container my-5">
        <h2>
            List of clients
        </h2>
        <a class="btn btn-primary" href="/shop/insert.php">New Client</a>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Address</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "myshop";

                // create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                // read all row from database table
                $sql = "SELECT * FROM clients";
                $result = $conn->query($sql);
                if (!$result) {
                    die("" . $conn->error);
                }

                // read data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                    <td>$row[id]</td>
                    <td>$row[name]</td>
                    <td>$row[email]</td>
                    <td>$row[phone]</td>
                    <td>$row[address]</td>
                    <td>$row[created_at]</td>
                    <td>
                        <a class='btn btn-primary btn-sm' href='/shop/update.php?id=$row[id]'>Edit</a>
                        <a href='/shop/delete.php?id=$row[id]' class='btn btn-danger btn-sm'>Delete</a>
                    </td>
                    </tr>
                    ";
                }

                ?>
            </tbody>
        </table>
    </div>
    
</body>

</html>