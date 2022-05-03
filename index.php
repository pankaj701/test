<?php

$insert = false;
$update = false;
$delete = false;


// creating connection to database

    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "notes";
    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db);
    // Check connection
    if (!$conn) {
       die("Connection failed: " . mysqli_connect_error());
    }

 
    
   // echo "Connected successfully";


    if(isset($_GET['delete'])){
        $sno = $_GET['delete'] ;
        $delete = true;
        $sql = "DELETE FROM `notes` WHERE `sno` =$sno";
        $result = mysqli_query($conn,$sql);
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){  
        //isset fun start 

        if(isset($_POST['snoEdit'])){
            // update the record
            $sno = $_POST["snoEdit"];
            $title = $_POST["titleEdit"];
            $description = $_POST["descriptionEdit"];
            
            // sql query to be executed 
        
            $sql = "UPDATE `notes` SET `title` = '$title' , `description` = '$description' WHERE `notes`.`sno` = $sno";
            $result = mysqli_query($conn,$sql);
            if($result){
                $update = true;
            }

        }
        else{
        
    $title = $_POST["title"];
    $description = $_POST["description"];
    
    // sql query to be executed 

    $sql = "INSERT INTO `notes` (`title`, `description`)  VALUES ('$title','$description')";
    $result = mysqli_query($conn,$sql);

    // 
  
}
}

    ?>

    <!doctype html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <!-- datatables css -->

        <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

        <!-- jquery    -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

        <!-- datatables script -->

        <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#myTable').DataTable();
            });
        </script>

        <title>iNotes -Notes taking made up easy</title>



    </head>

    <body>

        <!-- edit modal -->
        <!-- 
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
  Edit Modal 
</button> -->

        <!-- Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModal">Edit This Note</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/crud/index.php" method="POST">

                            <input type="hidden" name="snoEdit" id="snoEdit">
                            <div class="mb-3">
                                <label for="title" class="form-label">Note Title</label>
                                <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">

                            </div>

                            <div class="mb-3">
                                <label for="desc" class="form-label">Note Descriptiion</label>
                                <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Note</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Navbar by bootstrap -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">PHP CRUD</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact us</a>
                        </li>

                    </ul>
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>



        <?php

        
if($insert){
    echo "<div class='alert alert-Success alert-dismissible fade show' role='alert'>
    <strong>Success</strong> your note has been inserted successfully;
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
}
?>


            <!-- container for form  -->

            <div class="container my-5">
                <h1>Add a Note</h1>
                <form action="/crud/index.php" method="POST">
                    <div class="mb-3">
                        <label for="title" class="form-label">Note Title</label>
                        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">

                    </div>

                    <div class="mb-3">
                        <label for="desc" class="form-label">Note Descriptiion</label>
                        <textarea class="form-control" id="desc" name="description" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add User</button>
                </form>
            </div>

            <!-- Adding a new container for Php -->
        

            <div class="container" my-4>

                <!-- <?php

$sql = "SELECT * FROM `notes`";
$result = mysqli_query($conn,$sql);
// fetching data

while($row = mysqli_fetch_assoc($result)){
    echo $row['sno'] . " Title is " . $row['title']. " Description is " . $row['description'];
    echo "<br>";
}

?> -->
                <!-- tables  -->

                <table class="table" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">S.No</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>


                        <?php

$sql = "SELECT * FROM `notes`";
$result = mysqli_query($conn,$sql);
// fetching data
$sno = 0;
while($row = mysqli_fetch_assoc($result)){

    $sno = $sno +1;
    echo "<tr>
    <th scope='row'>". $sno . " </th>
    <td>". $row['title'] . "</td></td>
    <td>". $row['description'] . "</td>
    <td><button class='edit btn btn-sm btn-primary' id=". $row['sno'].">Edit</button>
        <button class='delete btn btn-sm btn-primary' id=d".$row['sno']." >Delete</button>
    </a></td>
  </tr>";
    
}
?>

                    </tbody>
                </table>

            </div>


            <!-- Optional JavaScript; choose one of the two! -->

            <!-- Option 1: Bootstrap Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

            <!-- Option 2: Separate Popper and Bootstrap JS -->
            <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
            <!-- script for dom -->
            <script>
                edits = document.getElementsByClassName('edit');
                Array.from(edits).forEach((element) => {
                    element.addEventListener("click", (e) => {
                        console.log("edit", );
                        tr = e.target.parentNode.parentNode;
                        // console.log(tr);
                        title = tr.getElementsByTagName("td")[0].innerText;
                        description = tr.getElementsByTagName("td")[1].innerText;
                        console.log(title, description);
                        titleEdit.value = title;

                        descriptionEdit.value = description;
                        snoEdit.value = e.target.id;
                        console.log(e.target.id);
                        $('#editModal').modal('toggle');
                    })
                })

                // for delete 

                deletes = document.getElementsByClassName('delete');
                Array.from(deletes).forEach((element) => {
                    element.addEventListener("click", (e) => {
                        console.log("edit", );
                        tr = e.target.parentNode.parentNode;

                        sno = e.target.id.substr(1, );

                        if (confirm("Are you sure want to delete?")) {
                            console.log("yes");
                            window.location = `/crud/index.php?delete=${sno}`;
                        } else {
                            console.log("no");
                        }
                    })
                })
            </script>
    </body>

    </html>