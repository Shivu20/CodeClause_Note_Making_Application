<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body{
            margin: 0px;
            padding: 0px;
            font-family: poppins;
            background-color: rgba(255, 255, 255, 0.15);
        }
        .form{
            border: 2px solid rebeccapurple;
            padding: 6px;
            border-radius: 8px;
        }
        .container1{
            padding: 10px 10%;
            color: red;
        }
    </style>
    <title>Notes Making Application</title>
  </head>
  <body>
    <?php include "./notes1.php"?>
    <?php include "./notesdb.php"?>
    <?php include "./notesedit.php"?>
    <?php
        if(isset($_POST["submit"])){
            if(!isset($_POST["hidden"])){
                $title=$_POST["title"];
                $desc=$_POST["desc"];
                $sql="INSERT INTO `notes`(`Title`, `Notes`) VALUES ('$title','$desc')";
                $result=mysqli_query($conn,$sql);}
        }
    ?>
    <div class="container1">
        <div class="row justify-content-center">
            <div class="col-lg-10">
            <form class="form" method="POST">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" placeholder="Enter Your Tile.." name="title">
                </div>
                <div class="mb-3">
                    <label for="area" class="form-label">Add Notes</label>
                    <textarea class="form-control" id="area" rows="3" placeholder="type your notes..." name="desc"></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Add Note</button>
            </form>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h1>Your Notes</h1>
                <?php
                    $sql="SELECT * FROM `notes`";
                    $result=mysqli_query($conn,$sql);
                    $noNotes=true;
                    while($fetch=mysqli_fetch_assoc($result)){
                        $noNotes=false;
                        echo '<div class="card my-3">
                        <div class="card-body">
                          <h5 class="card-title">'.$fetch["Title"].'</h5>
                          <p class="card-text">'.$fetch["Notes"].'</p>
                          <button type="button" class="btn btn-primary edit" data-bs-toggle="modal" data-bs-target="#exampleModal" id="'.$fetch["Note_ID"].'">Edit</button>
                          <a href="./notesdel.php?id='.$fetch["Note_ID"].'" class="btn btn-danger">Delete</a>
                        </div>
                      </div>';}
                      if($noNotes){
                        echo '<div class="card my-3">
                        <div class="card-body">
                          <h5 class="card-title">Message:</h5>
                          <p class="card-text">Notes Empty</p>
                        </div>
                      </div>';
                      }
                ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        const edit=document.querySelectorAll(".edit");
        const edittitle=document.getElementById("edittitle");
        const editarea=document.getElementById("editarea");
        const hiddeninput=document.getElementById("hidden");
        const cardBody=document.querySelectorAll(".card-body");
        edit.forEach(element => {
            element.addEventListener("click",()=>{
                const titletext=element.children[0].innerText;
                const titledesc=element.children[1].innerText;
                edittitle.value=titletext;
                editarea.value=titledesc;
                hiddeninput.value=element.id;
            })
        });
        const search=document.getElementById('search');
        search.addEventListener("input",()=>{
            const value=search.value.toLowerCase();
            cardBody.forEach(element => {
                const titletext=element.children[0].innerText.toLowerCase();
                const titledesc=element.children[1].innerText.toLowerCase();
                if(titletext.includes(value) || titledesc.includes(value)){
                    element.parentElement.style.display="block";
                }
                else{
                    element.parentElement.style.display="none";
                }
            });

        })
    </script>
  </body>
</html>