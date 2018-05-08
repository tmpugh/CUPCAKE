<?php
/**
 * Created by PhpStorm.
 * User: Taylor
 * Date: 4/5/18
 * Time: 11:50 AM
 */
$page_title="Add Cupcake";
include('includes/header.php');

if(!isset($_SESSION['adminID'])) {
    echo "<p>You do not have access to this content.";
} else {


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $msg = "<p>";

        //Check if cupcake is gluten free
        if (isset($_POST['GF'])) {
            $GFOption = $_POST['GF'];
        }

        require("db_connect.php");
        if ($GFOption == "yes") {
            $q = "SELECT size_id FROM size WHERE size_id LIKE '%GF'";
            $r = mysqli_query($dbc, $q);
            if ($r) {
                while ($row = mysqli_fetch_all($r, MYSQLI_NUM)) {
                    $regSize = $row[0][0];
                    $miniSize = $row[1][0];
                }
            }
        }

        if ($GFOption == "no") {
            $q1 = "SELECT size_id FROM size WHERE size_id NOT LIKE '%GF'";
            $r1 = mysqli_query($dbc, $q1);
            if ($r1) {
                while ($row = mysqli_fetch_all($r1, MYSQLI_NUM)) {
//                print_r($row1);
                    $regSize = $row[0][0];
                    $miniSize = $row[1][0];
                }
            }
        }


//Check to see if information is in name and description

        if (isset($_POST['cupName'])) {
            $cupName = $_POST['cupName'];
        } else {
            $msg .= "You must submit a name for the new cupcake.<br/>";
        }

        if (isset($_POST['cupDesc'])) {
            $cupDesc = $_POST['cupDesc'];
        } else {
            $msg .= "You must submit a description for the new cupcake.<br/>";
        }

        //Check and load image file
        if (isset($_FILES['upload'])) {
            $target_name = $_FILES['upload']['name']; //holds file name
            $target_dir = "cupcakes/"; //where the file will be placed
            $target_file = $target_dir . $target_name;
            $target_fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            $uploadOk = 1;

            //Check to make sure image is actually an image
            if ($target_fileType != "jpeg" && $target_fileType != "gif" && $target_fileType != "png" && $target_fileType != "jpg") {

                $uploadOk = 0;
                echo "Sorry - only JPEG, JPG, PNG or GIF files are allowed.";
            }

            if ($uploadOk == 0) {
                echo "Sorry - your file could not be uploaded because:";
                switch ($_FILES['upload']['error']) {
                    case 1:
                        print "The file exceeds the maximum file size.";
                        break;
                    case 2:
                        print "The file exceeds the maximum file size set in the form.";
                        break;
                    case 3:
                        print "The file was only partially uploaded.";
                        break;
                    case 4:
                        print "No file was uploaded.";
                        break;
                    case 6:
                        print "No temporary folder was found.";
                        break;
                    case 7:
                        print "Unable to write to disk.";
                        break;
                    case 8:
                        print "File upload stopped.";
                        break;
                    default:
                        print "A system error occured.";
                        break;
                } //end of switch statement

            } else {
                if ($cupDesc && $cupName) {
                    if (move_uploaded_file($_FILES['upload']['tmp_name'], $target_file)) {
                        $msg .= "The file " . basename($_FILES['upload']['name']) . " has been uploaded.";

                    } //move uploaded file
                    $readytocommit = true;
                    if (file_exists($_FILES['upload']['tmp_name']) && is_file($_FILES['upload']['tmp_name'])) {
                        unlink($_FILES['upload']['tmp_name']);
                    }
                } //ends the if name and desc
            }
        }//ends if file was uploaded

        if ($readytocommit) {
            mysqli_autocommit($dbc, false);
            $flag = true;

            $q = "INSERT INTO cupcakes (cupcake_name, cupcake_desc, cupcake_img) 
        VALUES('$cupName', '$cupDesc', '$target_name')";

            $r = mysqli_query($dbc, $q);
            if (!$r) {
                $flag = false;
                echo "First insert query:" . mysqli_error($dbc);
            }

            $q2 = "SELECT cupcake_id FROM cupcakes WHERE cupcake_name='$cupName'";

            $r2 = mysqli_query($dbc, $q2);

            if (!$r2) {
                $flag = false;
                echo "Couldn't get id" . mysqli_error($dbc);
            } else {
                $row2 = mysqli_fetch_array($r2, MYSQLI_ASSOC);
                $newCupID = $row2['cupcake_id'];
            }

            $q3 = "INSERT INTO size (cupcake_id, size_id) VALUES ('$newCupID', '$regSize'), ('$newCupID', '$miniSize')";

            $r3 = mysqli_query($dbc, $q3);

            if (!$r3) {
                $flag = false;
                echo "Could not insert:" . mysqli_error($dbc);
            }

            if ($flag) {
                mysqli_commit($dbc);
                echo "All queries were executed successfully";
            } else {
                mysqli_rollback($dbc);
                echo "All queries were rolled back";
            }
        }
    }
    ?>

    <div id="addCupcake">

        <h2>Add Cupcake</h2>

    <form action="addCupcake.php" method="post" enctype="multipart/form-data">
        <label for="cupName">Cupcake Name:</label>
        <input type="text" name="cupName" id="cupName" required/><br/>
        <label for="cupDesc">Cupcake Description:</label>
        <textarea name="cupDesc" id="cupDesc" placeholder="Please describe product here." required></textarea><br/>
        <label for="glutenFree">Is this cupcake gluten free?</label>
        <input type="radio" name="GF" value="yes" id="yes"/>
        <label class="radio" for="yes">Yes</label>
        <input type="radio" name="GF" value="no" id="no" checked/>
        <label class="radio" for="no">No</label><br/>
        <input type="hidden" name="MAX_FILE_SIZE" value="500000"/>
        <label for="cupImg">Cupcake Image:</label>
        <input type="file" name="upload" id="cupImg"/><br/>
        <input id="add" type="submit" name="submit" value="Add Cupcake"/>
    </form>

    </div>

    <?php

}
    include('includes/footer.php');

?>