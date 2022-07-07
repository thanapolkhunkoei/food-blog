<?php 
$con = mysqli_connect("localhost","root","bXlzcWw=","FOODBLOG");

if($con){
    echo "Connected";
}

?>

<!-- Editmenu modal -->
<div class="modal fade" id="editModal" role="dialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div style="max-width: 90%;min-width: 830px;" class="modal-dialog modal-xl">
                <div class="modal-content">
                <div class="modal-body">
                <div class="row">
                <div class="col-md-12">
                <div class="card border-white">
                    <div class="card-header  bg-white">
                        <h4 class="text-center">Edit menu</h4>
                    </div>
                    <div class="card-body ">
                    <div class="modal-body">
                    <div class="col d-flex flex flex-column  align-items-center">
                    <div class="d-flex justify-content-between">
                        <div id="uploadZone" style="max-width: 800px;" class="mx-4">
                            <button id="uploadImg" class="btn btn-warning">Select file</button>
                            <div id="upload-container"  class="upload-container">
                                <h3 class="text" >Drop your Image here</h3>
                                <h3 class="font"></h3>
                                <input  class="d-none" type="file" id="files" name="files[]" multiple onchange="img_select()" />
                                <div id="img_box" class="card-body d-flex flex-wrap justify-content-start">
                                </div>
                            </div>
                        </div>
                        <div style="min-width: 300px;" class="mx-3">
                            <select type="text" id="menu_type" name="menu_type" class="form-select mb-3" aria-label="Default select example">
                                <option selected>Menu Type</option>
                                <option value="Curry">Curry</option>
                                <option value="Pasta">Pasta</option>
                                <option value="Pizza">Pizza</option>
                                <option value="Salad">Salad</option>
                            </select>
                            <div class="mb-3">
                                <label class="form-label">Menu name</label>
                                <input type="text" class="form-control" require  name="menu_name" id="menu_name" placeholder="text...">
                            </div>
                            <div class="mb-3">
                                <label  class="form-label">Ingredients</label>
                                <textarea type="text" class="form-control" require  name="menu_ingredients" id="menu_ingredients" placeholder="text..."></textarea>
                            </div>
                            <div class="mb-3">
                                <label  class="form-label">Method</label>
                                <textarea type="text" class="form-control" id="menu_method" require  name="menu_method" rows="3" placeholder="text..."></textarea>
                            </div>
                            <div class="form-group">
                                <button data-bs-dismiss="modal" value="Upload" type="button" id="edit"  name="edit"  class="btn btn-dark">Submit</button>
                            </div>
                        </div>
                    </div> 
                    </div>
                    </div>
                    </div>
                </div>
                </div>
                </div>
                </div>
                </div>
            </div>
            </div>