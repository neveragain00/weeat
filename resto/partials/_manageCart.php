<?php
include '_dbconnect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION['userId'];
    if (isset($_POST['addToCart'])) {
        $itemId = $_POST["itemId"];
        // Check whether this item exists
        $existSql = "SELECT * FROM `viewcart` WHERE pizzaId = '$itemId' AND `userId`='$userId'";
        $result = mysqli_query($conn, $existSql);
        $numExistRows = mysqli_num_rows($result);
        if ($numExistRows > 0) {
            echo "<script>alert('Item Already Added.');
                    window.history.back(1);
                    </script>";
        } else {
            $sql = "INSERT INTO `viewcart` (`pizzaId`, `itemQuantity`, `userId`, `addedDate`) VALUES ('$itemId', '1', '$userId', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>
                    window.history.back(1);
                    </script>";
            }
        }
    }
    if (isset($_POST['removeItem'])) {
        $itemId = $_POST["itemId"];
        $sql = "DELETE FROM `viewcart` WHERE `pizzaId`='$itemId' AND `userId`='$userId'";
        $result = mysqli_query($conn, $sql);
        echo "<script>alert('Removed');
                window.history.back(1);
            </script>";
    }
    if (isset($_POST['removeAllItem'])) {
        $sql = "DELETE FROM `viewcart` WHERE `userId`='$userId'";
        $result = mysqli_query($conn, $sql);
        echo "<script>alert('Removed All');
                window.history.back(1);
            </script>";
    }
    if (isset($_POST['checkout'])) {
        $amount = $_POST["amount"];
        $address = $_POST["address"];
        $phone = $_POST["phone"];

        $address = $address;

        // Insert order into the `orders` table
        $sql = "INSERT INTO `orders` (`userId`, `address`, `phoneNo`, `amount`, `paymentMode`, `orderStatus`, `orderDate`) VALUES ('$userId', '$address', '$phone', '$amount', '0', '0', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $orderId = $conn->insert_id;

        if ($result) {
            // Insert each item from the cart into `orderitems`
            $addSql = "SELECT * FROM `viewcart` WHERE userId='$userId'";
            $addResult = mysqli_query($conn, $addSql);
            while ($addrow = mysqli_fetch_assoc($addResult)) {
                $pizzaId = $addrow['pizzaId'];
                $itemQuantity = $addrow['itemQuantity'];
                $itemSql = "INSERT INTO `orderitems` (`orderId`, `pizzaId`, `itemQuantity`) VALUES ('$orderId', '$pizzaId', '$itemQuantity')";
                $itemResult = mysqli_query($conn, $itemSql);
            }

            // Clear the cart after checkout
            $deletesql = "DELETE FROM `viewcart` WHERE `userId`='$userId'";
            $deleteresult = mysqli_query($conn, $deletesql);

            // Notify the user of their order ID
            echo '<script>alert("Thanks for ordering with us. Your order id is ' . $orderId . '.");
                    window.location.href="http://localhost/resto/index.php";  
                    </script>';
            exit();
        }
    }

    // Handle AJAX requests for updating cart quantities
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        $pizzaId = $_POST['pizzaId'];
        $qty = $_POST['quantity'];
        $updatesql = "UPDATE `viewcart` SET `itemQuantity`='$qty' WHERE `pizzaId`='$pizzaId' AND `userId`='$userId'";
        $updateresult = mysqli_query($conn, $updatesql);
    }
}
?>
