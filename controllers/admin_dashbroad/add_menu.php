<?php
	$PAGE_VAR["js"][] = "add_menu";
	$PAGE_VAR["js"][] = "login";
	$PAGE_VAR["js"][] = "route";
	$PAGE_VAR["css"][] = "add_menu";
	$PAGE_VAR["css"][] = "home";
    $PAGE_VAR["js"][] = "/core/uploadImage";

$theme = "admin";
?>


<!-- <div class="container"> -->

<div style="height: 100vh;" class="row">

    <div  class="admin_sidebar col-2">
        <?php include('component/menu_bar.php')  ;?>
    </div>

    <div class="main_box col-md-9 container mt-3 border rounded  p-3">
        <!-- Navbar -->
        <!-- <nav class="navbar navbar-expand-lg rounded-top bg-dark p-2">
            <div style="height: 40px;" class="container-md">
            </div>
        </nav> -->
         <table class="table ">
            <thead>
                <tr>
                        <th scope="col">No.</th>
                        <th scope="col">image</th>
                        <th class="row_type" scope="col">type</th>
                        <th scope="col">Name</th>
                        <th scope="col">Adjustment</th>
                </tr>
            </thead>

        <!-- Menu Table -->
        <tbody id="menu_list">
        </tbody>
        </table>
        
            <!-- Add Menu btn -->
            <div class="m-4">
                 <button type="button" class="btn btn-success mt-1" data-bs-toggle="modal" data-bs-target="#add_menu_modal">
                    Add Menu
                </button>
            
                <!-- Pagination -->
                <div id="paginate" class="align-items-center container d-flex justify-content-center">
        
                </div>

            </div>
            <h1 id="editShow"></h1>
    </div>
</div>
<!-- </div> -->
        
            <!-- Add Menu Modal -->
            <div  class="modal fade" id="add_menu_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div  class="addmenu_modal modal-dialog modal-xl">
                <div class="modal-content">
            
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body m-0">
                <div class="row">
                <div class="col-md-12">
                <div class="card border-white">
                    <div class="card-body">
                        <div class="modal-body ">
                            <div class="col d-flex flex flex-column align-items-center container-fluid">
                                <div class="form-group">
                                    <form action="" enctype="multipart/form-data" method="POST" class="flex-column d-flex" id="input_form">
                                    <div style="max-width: 800px;" class="upload_modal d-flex justify-content-between">
                                        <div id="uploadZone"  class="mx-4 mb-3">
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
                                                <option class="label_input" selected>Menu Type</option>
                                                <option value="Curry">Curry</option>
                                                <option value="Pasta">Pasta</option>
                                                <option value="Pizza">Pizza</option>
                                                <option value="Salad">Salad</option>
                                            </select>
                                            <div class="mb-3">
                                                <label class="label_input form-label">Menu name</label>
                                                <input type="text" class="form-control" require  name="menu_name" id="menu_name" placeholder="">
                                            </div>
                                            <div class="mb-3">
                                                <label  class="label_input form-label">Ingredients</label>
                                                <textarea type="text" class="form-control" require  name="menu_ingredients" id="menu_ingredients" placeholder=""></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label class="label_input form-label">Method</label>
                                                <textarea type="text" class="form-control" id="menu_method" require  name="menu_method" rows="3" placeholder=""></textarea>
                                            </div>
                                            <div class="form-group">
                                                <button data-bs-dismiss="modal" value="Upload" type="button" id="addMenu"  name="save_data"  class="btn btn-primary">Submit</button>
                    
                                            </div>
                                        </div>
                                    </div> 
                                    </form>
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


