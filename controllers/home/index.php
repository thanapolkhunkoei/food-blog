<?php
	$PAGE_VAR["css"][] = "home";
	$PAGE_VAR["css"][] = "menu_bar";
	$PAGE_VAR["js"][] = "home";
	$PAGE_VAR["js"][] = "login";
	$PAGE_VAR["js"][] = "route";

$theme = "user";

?>

<!-- Filter type  -->
<section id="home_slide_showcase" class="container-fluid mt-3 mb-4 d-flex justify-content-center">
  <div id="home_carousel" class="slide_main_box carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="<?echo WEB_META_BASE_URL?>image/cauliflower.jpeg" class="d-block w-100" alt="...">
      </div>
       <div class="carousel-item">
        <img src="<?echo WEB_META_BASE_URL?>image/pasta.jpeg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="<?echo WEB_META_BASE_URL?>image/pizza2.jpeg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="<?echo WEB_META_BASE_URL?>image/salad3.jpeg" class="d-block w-100" alt="...">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#home_carousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#home_carousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
  </div>
</section>

<section id="home_about">
      <div class="home_about_wrapper container">
        <div class="home_about_text">
          <p class="small">About Us</p>
          <h2>We've beem making food blog last for 10 years</h2>
          <p>
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Esse ab
            eos omnis, nobis dignissimos perferendis et officia architecto,
            fugiat possimus eaque qui ullam excepturi suscipit aliquid optio,
            maiores praesentium soluta alias asperiores saepe commodi
            consequatur? Perferendis est placeat facere aspernatur!
          </p>
        </div>
        <div class="home_about_img">
          <img src="https://i.postimg.cc/mgpwzmx9/about-photo.jpg" alt="" />
        </div>
      </div>
  </section>

<section id="home_filter" class="container-fluid my-5 d-flex justify-content-center">
  <div id="filter_box" class="d-flex justify-content-between">
    <div class="d-flex justify-content-center mb-3">
      <ul class="nav me-4">
          <li class="nav-item me-4">
            <div class="type" onclick="getlist_home_data(page,menu_type='curry')" >
              <img class="filter_img" src="<?echo WEB_META_BASE_URL?>image/currytype.jpeg" alt="">
              <a type="button" class="text-type"  value="curry">Curry</a>
            </div>
          </li>
          <li class="nav-item me-4">
          <div class="type" onclick="getlist_home_data(page,menu_type='pasta')">
              <img class="filter_img" src="<?echo WEB_META_BASE_URL?>image/pastatype.jpeg" alt="">
              <a type="button" class="text-type"  value="pasta" >Pasta</a>
          </div>
            </li>
          <li class="nav-item me-4">
          <div class="type" onclick="getlist_home_data(page,menu_type='pizza')">
              <img class="filter_img" src="<?echo WEB_META_BASE_URL?>image/pizzatype.jpeg" alt="">
              <a type="button" class="text-type"  value="pizza" >Pizza</a>
            </div>
            </li>
          <li class="nav-item me-4">
          <div class="type"  onclick="getlist_home_data(page,menu_type='salad')">
              <img class="filter_img" src="<?echo WEB_META_BASE_URL?>image/saladtype.jpeg" alt="">
              <a type="button" class="text-type"   value="salad" >Salad</a>
            </div>
            </li>
      </ul>
    </div>
    <div>
      <form action="" method="POST" class="d-flex ">
          <input require class="search form-control me-2" type="search" name="search"  placeholder="Search" aria-label="Search">
          <button require class="btn" type="button" id="search_menu_btn"  type="submit">Search</button>
      </form>
    </div>
  </div>
</section>


<!-- Content -->
  <section id="home_content"  class="container-fluid d-flex justify-content-center align-items-center">
    <div  id="menu_list_show" class=" mt-3 px-3 pb-2 gap-4 d-flex flex-wrap align-items-center justify-content-center">
    </div>
  </section>

<!-- If no item -->
<div id="no_item"></div>

<!-- Pagination -->
<div id="paginate" class="align-items-center container d-flex justify-content-center mb-4"></div>

<!-- login Modal -->
<div class="modal fade" id="login_modal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="d-flex justify-content-between">
          <h3 class="text-center">ADMIN LOGIN</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <div class="mb-3 mt-4">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" >
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password">
            </div>
            <button  type="submit" id="login_btn_submit" class="btn btn-outline-dark">Login</button>
      </div>
    </div>
  </div>
</div>

