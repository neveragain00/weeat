
<div class="container-fluid" style="margin-top:98px">
    <div class="col-lg-12">
        <div class="row">
            <!-- FORM Panel -->
            <div class="col-md-4">
                <form action="partials/_categoryManage.php" method="post" enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-header" style="background-color: rgb(111 202 203);">
                            Create New Category
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="control-label">Category Name: </label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Category Desc: </label>
                                <input type="text" class="form-control" name="desc" required>
                            </div> 
                            <div class="form-group">
								<label for="image" class="control-label">Image</label>
								<input type="file" name="image" id="image" accept=".jpg" class="form-control" required style="border:none;">
								<small id="Info" class="form-text text-muted mx-3">Please .jpg file upload.</small>
							</div>  
                        </div>  
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" name="createCategory" class="btn btn-sm btn-primary col-sm-3 offset-md-4"> Create </button>
                                    <!-- Success Modal HTML -->
<div class="modal fade" id="createCategoryModal" tabindex="-1" role="dialog" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: rgb(111 202 203);">
                <h5 class="modal-title" id="createCategoryModalLabel">Category Created Successfully</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Your category has been created successfully. You can now add items to it.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="/your-category-page.php" class="btn btn-primary">Go to Category</a>
            </div>
        </div>
    </div>
</div>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Success Modal HTML -->

            </div>
            <!-- FORM Panel -->
    
            <!-- Table Panel -->
            <div class="col-md-8 mb-3">
                <div class="card">
                    <div class="card-body">
                    <table class="table table-bordered table-hover mb-0">
                        <thead style="background-color: rgb(111 202 203);">
                        <tr>
                            <th class="text-center" style="width:7%;">Id</th>
                            <th class="text-center">Img</th>
                            <th class="text-center" style="width:58%;">Category Detail</th>
                            <th class="text-center" style="width:18%;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php 
    $sql = "SELECT * FROM `categories`"; 
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $catId = $row['categorieId'];
        $catName = $row['categorieName'];
        $catDesc = $row['categorieDesc'];

        echo '<tr>
                <td class="text-center"><b>' .$catId. '</b></td>
                <td><img src="/resto/img/card-'.$catId. '.jpg" alt="image for this Category" width="150px" height="150px"></td>
                <td>
                    <p>Name : <b>' .$catName. '</b></p>
                    <p>Description : <b class="truncate">' .$catDesc. '</b></p>
                </td>
                <td class="text-center">
                    <div class="row mx-auto" style="width:112px">
                    <button class="btn btn-sm btn-primary edit_cat" type="button" data-toggle="modal" data-target="#updateCat' .$catId. '">Edit</button>
                    <!-- Delete button triggers the confirmation modal -->
                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteCat' .$catId. '" style="margin-left:9px;">Delete</button>
                    </div>
                </td>
            </tr>';

        // Warning Modal for Deletion
        echo '
        <div class="modal fade" id="deleteCat' .$catId. '" tabindex="-1" role="dialog" aria-labelledby="deleteCat' .$catId. '" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: rgb(111 202 203);">
                        <h5 class="modal-title">Confirm Deletion</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete the category <b>' .$catName. '</b>? This action cannot be undone.</p>
                    </div>
                    <div class="modal-footer">
                        <form action="partials/_categoryManage.php" method="POST">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" name="removeCategory" class="btn btn-danger">Delete</button>
                            <input type="hidden" name="catId" value="'.$catId. '">
                        </form>
                    </div>
                </div>
            </div>
        </div>';
        
    }
?>



<?php 
    $catsql = "SELECT * FROM `categories`";
    $catResult = mysqli_query($conn, $catsql);
    while($catRow = mysqli_fetch_assoc($catResult)){
        $catId = $catRow['categorieId'];
        $catName = $catRow['categorieName'];
        $catDesc = $catRow['categorieDesc'];
?>

<!-- Modal -->
<div class="modal fade" id="updateCat<?php echo $catId; ?>" tabindex="-1" role="dialog" aria-labelledby="updateCat<?php echo $catId; ?>" aria-hidden="true" style="width: -webkit-fill-available;">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: rgb(111 202 203);">
        <h5 class="modal-title" id="updateCat<?php echo $catId; ?>">Category Id: <b><?php echo $catId; ?></b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="partials/_categoryManage.php" method="post" enctype="multipart/form-data">
		    <div class="text-left my-2 row" style="border-bottom: 2px solid #dee2e6;">
		   		<div class="form-group col-md-8">
					<b><label for="image">Image</label></b>
					<input type="file" name="catimage" id="catimage" accept=".jpg" class="form-control" required style="border:none;" onchange="document.getElementById('itemPhoto').src = window.URL.createObjectURL(this.files[0])">
					<small id="Info" class="form-text text-muted mx-3">Please .jpg file upload.</small>
					<input type="hidden" id="catId" name="catId" value="<?php echo $catId; ?>">
					<button type="submit" class="btn btn-success my-1" name="updateCatPhoto">Update Img</button>
				</div>
				<div class="form-group col-md-4">
					<img src="/resto/img/card-<?php echo $catId; ?>.jpg" id="itemPhoto" name="itemPhoto" alt="Category image" width="100" height="100">
				</div>
			</div>
		</form>
        <form id="categoryUpdateForm<?php echo $catId; ?>" onsubmit="openUpdateModal(event, <?php echo $catId; ?>)">
    <div class="text-left my-2">
        <b><label for="name">Name</label></b>
        <input class="form-control" id="name<?php echo $catId; ?>" name="name" value="<?php echo $catName; ?>" type="text" required>
    </div>
    <div class="text-left my-2">
        <b><label for="desc">Description</label></b>
        <textarea class="form-control" id="desc<?php echo $catId; ?>" name="desc" rows="2" required minlength="6"><?php echo $catDesc; ?></textarea>
    </div>
    <button type="submit" class="btn btn-success">Update</button>
</form>
<!-- Update Confirmation Modal -->
<div class="modal fade" id="updateConfirm<?php echo $catId; ?>" tabindex="-1" role="dialog" aria-labelledby="updateConfirmLabel<?php echo $catId; ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: rgb(111 202 203);">
                <h5 class="modal-title">Confirm Update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to update the details for the category <b><?php echo $catName; ?></b>?</p>
                <form action="partials/_categoryManage.php" method="post" id="updateForm<?php echo $catId; ?>">
                    <input type="hidden" id="nameInput<?php echo $catId; ?>" name="name" value="">
                    <input type="hidden" id="descInput<?php echo $catId; ?>" name="desc" value="">
                    <input type="hidden" id="catIdInput<?php echo $catId; ?>" name="catId" value="<?php echo $catId; ?>">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" form="updateForm<?php echo $catId; ?>" class="btn btn-success" name="updateCategory">Confirm</button>
            </div>
        </div>
    </div>
</div>
<script>
    function openUpdateModal(event, catId) {
        event.preventDefault();
        const name = document.getElementById(`name${catId}`).value;
        const desc = document.getElementById(`desc${catId}`).value;

        document.getElementById(`nameInput${catId}`).value = name;
        document.getElementById(`descInput${catId}`).value = desc;

        $(`#updateConfirm${catId}`).modal('show');
    }
</script>

      </div>
    </div>
  </div>
</div>

<?php
    }
?>