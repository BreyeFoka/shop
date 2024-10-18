<?php 
    $id='';
    $name='';
    $email='';
    $phone= '';
    $address= '';
    $errorMessage="";
    $successMessage= "";

    $servername="localhost";
    $username= "root";
    $password= "";
    $dbname= "myshop";


    $connection = new mysqli($servername, $username, $password, $dbname);

    if ($connection->connect_error){
        die("Connection Error". $connection->connect_error);
    }

    if( $_SERVER['REQUEST_METHOD'] == 'Get'){

        if ( !isset($_GET["id"])){
            header("location: /shop/index.php");
        }
        $id=$_GET["id"];

        $sql = "SELECT * FROM clients WHERE id=$id";
        $result =$connection->query($sql);
        $row = $result->fetch_assoc();

        if(!$row) {
            header("location: /shop/index.php");
            exit;
        }

        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address']; 
    }
    else {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address']; 

        do {
            if( empty( $id ) || empty( $name ) || empty( $email ) || empty( $phone ) || empty( $address ) ) {
                $errorMessage = 'All fields are required';
                break;
            }
            $sql = "UPDATE clients" . "SET name='$name', email='$email', pjone='$phone', address='$address'" . "  WHERE id= $id"; 
            $result = $connection->query($sql);

            if (!$result) {
                $errorMessage = "Invalid query: " . $connection->error;
                break;
            }

            $successMessage = "Client updated correctly";
        } while(false);

    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- link bootstrap Css and Js cdn links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <title>Create New client</title>
</head>
<body>
    <div class="container my-5">
        <h2>Create New client</h2>

        <?php
            if (!empty($errorMessage)) {
                echo "
                    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        <strong>$errorMessage</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                ";
            }
        ?>

        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" name="email" value="<?php echo $email; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Phone</label>
                <div class="col-sm-6">
                    <input type="phone" class="form-control" name="phone" value="<?php echo $phone; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="address" <?php echo $address; ?>>
                </div>
            </div>
            <?php 
                            if (!empty($successMessage)) {
                                echo "
                                    <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                        <strong>$successMessage</strong>
                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                    </div>
                                ";
                            }
            ?>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                  <a href="/shop/index.php" class="btn btn-outlinr-danger" role="button">Cancel</a>
                </div>
            </div>
        </form>

    </div>
</body>
</html>