<?php
include "./notesdb.php";
if(isset($_POST["hidden"])){
    $title=$_POST["edittitle"];
    $desci=$_POST["editdesc"];
    $id=$_POST["hidden"];
    $sql="UPDATE `notes` SET `Note_ID`='$id',`Title`='$title',`Notes`='$desci' WHERE Note_ID='$id'";
    $result=mysqli_query($conn,$sql);
}
echo '
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Note</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="POST">
        <input type="hidden" name="hidden" id="hidden">
      <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control" id="edittitle" placeholder="Enter Your Tile.." name="edittitle">
      </div>
      <div class="mb-3">
          <label for="area" class="form-label">Add Notes</label>
          <textarea class="form-control" id="editarea" rows="3" placeholder="type your notes..." name="editdesc"></textarea>
      </div>
      <button type="submit" class="btn btn-primary" name="submit">Update Note</button>
  </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>'
?>