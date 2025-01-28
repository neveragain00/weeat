<?php
    include '_dbconnect.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['createCategory'])) {
        $name = $_POST["name"];
        $desc = $_POST["desc"];

        $sql = "INSERT INTO `categories` (`categorieName`, `categorieDesc`, `categorieCreateDate`) VALUES ('$name', '$desc', current_timestamp())";   
        $result = mysqli_query($conn, $sql);
        $catId = $conn->insert_id;
        if($result) {
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check !== false) {
                
                $newfilename = "card-".$catId.".jpg";

                $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/resto/img/';
                $uploadfile = $uploaddir . $newfilename;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
                    echo "<script>
                            window.location=document.referrer;
                        </script>";
                } else {
                    echo "<script>
                            window.location=document.referrer;
                        </script>";
                }

            }
            else{
                echo '<script>alert("Please select an image file to upload.");
                    </script>';
            }
        }
    }
    if (isset($_POST['removeCategory'])) {
        $catId = $_POST["catId"];
        $filename = $_SERVER['DOCUMENT_ROOT'] . "/resto/img/card-" . $catId . ".jpg";
        $sql = "DELETE FROM `categories` WHERE `categorieId`='$catId'";   
        $result = mysqli_query($conn, $sql);
        
        if ($result) {
            if (file_exists($filename)) {
                unlink($filename);
            }
            // Directly redirect to the same page without showing any alert
            echo "<script>
                    window.location.href = document.referrer;
                  </script>";
        } else {
            // If deletion failed, still redirect but no alert
            echo "<script>
                    window.location.href = document.referrer;
                  </script>";

        }
    }
    if (isset($_POST['updateCategory'])) {
        $catId = $_POST['catId'];
        $catName = $_POST['name'];
        $catDesc = $_POST['desc'];
    
        // SQL query to update category
        $sql = "UPDATE `categories` SET `categorieName`='$catName', `categorieDesc`='$catDesc' WHERE `categorieId`='$catId'";   
        $result = mysqli_query($conn, $sql);
    
        // Check if the query was successful
        if ($result) {
            // If update is successful, redirect to the previous page without a pop-up
            echo "<script>
                    window.location.href = document.referrer; // Redirect to the previous page
                  </script>";
        } else {
            // If update fails, still redirect without a pop-up
            echo "<script>
                    window.location.href = document.referrer; // Redirect to the previous page
                  </script>";
        }
    }
    if(isset($_POST['updateCatPhoto'])) {
        $catId = $_POST["catId"];
        $check = getimagesize($_FILES["catimage"]["tmp_name"]);
        if($check !== false) {
            $newName = 'card-'.$catId;
            $newfilename=$newName .".jpg";

            $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/resto/img/';
            $uploadfile = $uploaddir . $newfilename;

            if (move_uploaded_file($_FILES['catimage']['tmp_name'], $uploadfile)) {
                echo "<script>alert('success');
                        window.location=document.referrer;
                    </script>";
            } else {
                echo "<script>alert('failed');
                        window.location=document.referrer;
                    </script>";
            }
        }
        else{
            echo '<script>alert("Please select an image file to upload.");
            window.location=document.referrer;
                </script>';
        }
    }
}
?>