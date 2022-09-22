<?php
// INSERT INTO `notes` (`s_no`, `title`, `description`, `tstamp`) VALUES (NULL, 'firstnote', 'this is my first notes', current_timestamp());
 

// connect to the database
$servername="localhost";
$username="root";
$password="";
$database='todolist';
$insert=false;
$update=false;
$delete=false;
$blank=false;
$con=mysqli_connect($servername,$username,$password,$database);
if(!$con){
  die("Sorry we failed to Connect". mysqli_connect_error());
}
else{
  
}
 
// echo $_POST['snoEdit'];    
// echo $_GET['update'];
// exit();
if(isset($_GET['del'])){
  $s_no=$_GET['del'];
  
  $sql="DELETE FROM notes WHERE `notes`.`s_no` = '$s_no'";
  $result=mysqli_query($con,$sql);
  if($result){
    $delete=true;
  }
  
}


  // && $_POST['title'] !="" && $_POST['description'] !=""
if($_SERVER['REQUEST_METHOD']=='POST' ){


  if(isset($_POST['snoEdit'])){
    
    if($_POST['titleEdit'] !="" && $_POST['descriptionEdit'] !=""){

    
    $s_no=$_POST['snoEdit'];

       // update the record 
       $title=$_POST['titleEdit'];
      $description=$_POST['descriptionEdit'];
      $sql="UPDATE `notes` SET `title` = '$title' , `description`='$description' WHERE `notes`.`s_no` = $s_no;";
      $result=mysqli_query($con, $sql);
      if($result){
        $update=true;
      }
      
    }
    else{
      $blank=true;
    }
  }
  else{
if( $_POST['title'] !="" && $_POST['description'] !=""){

 $title=$_POST['title'];
 $description=$_POST['description'];
 $sql="INSERT INTO `notes` ( `title`, `description`) VALUES ( '$title', '$description')";
 $result=mysqli_query($con, $sql);
 if($result){
  // echo "Note is added sucessfully";
  $insert=true;
 }
 else{
  echo "Note is not added--->". mysqli_connect_error();
 }

}else{


  $blank=true;
}

}

}
// 


?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible"
      content="IE=edge" />
    <meta name="viewport"
      content="width=device-width, initial-scale=1.0" />
    <title>Todo-list</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT"
      crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.6.1.js"
      integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
      crossorigin="anonymous"></script>
    <link rel="stylesheet"
      href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <script>
      $(document).ready(function () {
        $('#myTable').DataTable();
      });
    </script>
  </head>

  <body>


    <!--  edit Modal  -->
    <div class="modal fade"
      id="EditmyModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"
              id="exampleModalLabel">Edit Note</h5>
            <button type="button"
              id='#EditmyModald'
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="/todolist/index.php"
              method="post">
              <input type="hidden"
                name="snoEdit"
                id="snoEdit">
              <div class="mb-3">
                <label for="titleEdit"
                  class="form-label">Title</label>
                <input type="text"
                  class="form-control"
                  id="titleEdit"
                  aria-describedby="emailHelp"
                  name="titleEdit" />
              </div>
              <div class="mb-3">
                <label for="Description"
                  class="form-label">Description</label>
                <div class="form-floating">
                  <textarea class="form-control"
                    placeholder="Leave a comment here"
                    id="descriptionEdit"
                    style="height: 100px"
                    name="descriptionEdit"></textarea>
                </div>
              </div>
              <button type="submit"
                class="btn btn-primary">Update Notes</button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal">Close</button>
            <button type="button"
              class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
    <!-- modal end  -->
    <!-- // navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand"
          href="#">TodoList</a>
        <button class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse"
          id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active"
                aria-current="page"
                href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link"
                href="#">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link"
                href="#">Contact Us</a>
            </li>
          </ul>
          <form class="d-flex"
            role="search">
            <input class="form-control me-2"
              type="search"
              placeholder="Search"
              aria-label="Search" />
            <button class="btn btn-outline-success"
              type="submit">
              Search
            </button>
          </form>
        </div>
      </div>
    </nav>
    <?php 
        
    if($insert){
           
      echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
      <strong>Success</strong> Yours notes added sucessfully
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
    }
    if($update){
      echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
      <strong>Success</strong> Yours notes updated sucessfully
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
    }
    if($delete){
       echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
      <strong>Success</strong>Record is deleted sucessfully
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
    }
  if($blank)
  {
    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
      <strong>Warning</strong> fill the Title and discription
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
  }
       ?>



    <!-- navbar end  -->
    <!-- form Start  -->
    <div class="container my-3">
      <h2>Add Notes</h2>
      <form action="/todolist/index.php"
        method="post">
        <div class="mb-3">
          <label for="title"
            class="form-label">Title</label>
          <input type="text"
            class="form-control"
            id="title"
            aria-describedby="emailHelp"
            name="title" />
        </div>
        <div class="mb-3">
          <label for="Description"
            class="form-label">Description</label>
          <div class="form-floating">
            <textarea class="form-control"
              placeholder="Leave a comment here"
              id="Description"
              style="height: 100px"
              name="description"></textarea>
          </div>
        </div>
        <button type="submit"
          class="btn btn-primary">Add Notes</button>
      </form>
    </div>

    <!-- form end -->

    <!-- php start  -->
    <div class="container my-4">



      <table class="table"
        id="myTable">
        <thead>
          <tr>
            <th scope="col">S.no</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
  $sql='SELECT * FROM `notes` ORDER BY `tstamp` DESC';   
  $result=mysqli_query($con, $sql);
  $s_no=0;
  while($row=mysqli_fetch_assoc($result)){
    $s_no=$s_no+1;
    echo "<tr>
    <th scope='row'>".$s_no. "</th>
    <td>".$row['title']."</td>
    <td>".$row['description']."</td>
    <td>"." <button class='btn btn-sm btn-primary edit' id='$row[s_no]'>Edit</button>
    <button class='btn btn-sm btn-primary del' id='d.$row[s_no]'>Delete</button >"."</td>
  </tr>";
    
  }
  ?>


        </tbody>
      </table>
      <hr />

    </div>
  </body>
  <script
    src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
    crossorigin="anonymous"></script>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz"
    crossorigin="anonymous"></script>
  <script
    src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener('click', e => {

        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName('td')[0].innerText;
        discription = tr.getElementsByTagName('td')[1].innerText;
        titleEdit.value = title;
        descriptionEdit.value = discription;
        snoEdit.value = e.target.id;
        $('#EditmyModal').modal('toggle');

      })
    })
    deletes = document.getElementsByClassName('del');
    Array.from(deletes).forEach((element) => {
      element.addEventListener('click', e => {
        // console.log("edit", e.target.parentNode.parentNode)
        sno = e.target.id.substr(2,)
        
        if (confirm("Are you sure")) {
          // console.log("yes")
          window.location = `/todolist/index.php?del=${sno}`
        }
        else {
          console.log("no")
        }

      })
    })
  </script>

</html>