<?
	$PAGE_VAR["js"][] = "route";
	$PAGE_VAR["js"][] = "login";
	$PAGE_VAR["css"][] = "home";
	$PAGE_VAR["css"][] = "menu_bar";

?>

<header class="header_admin">
  <nav class="navbar_admin navbar d-flex justify-content-between">
  <a id="logo_brand" type="button" onclick="backToHome()" class="logo navbar-brand text-white ms-5">Secret Foods</a>
      <div class="hamburger-menu-admin">
          <input id="menu__toggle" type="checkbox" />
          <label class="menu__btn hamber_admin" for="menu__toggle">
            <span></span>
          </label>
          <ul class="menu__box">
              <li><a class="menu__item text-decoration-none" href="<?WEB_META_BASE_URL?>/Home">Home</a></li>
              <li><a class="menu__item text-decoration-none" href="#">About</a></li>
              <li><a class="menu__item text-decoration-none" href="<?WEB_META_BASE_URL?>/addmenu">Dashboard</a></li>
              <li><a class="menu__item text-decoration-none" href="#">Chats</a></li>
              <li><a class="menu__item text-decoration-none" href="#">Media</a></li>
              <?
                if(!isset($user_status->isAdmin)){
                  ?>
                      <li><a type="button" class="menu__item text-decoration-none" data-bs-toggle="modal" data-bs-target="#login_modal">Log in</a></li>
              <?  } elseif($user_status->isAdmin == 'admin') {
                ?>
                      <li><a type="button" class="menu__item text-decoration-none" onclick="logout()">Logout</a></li>
                      <li><a type="button" class="menu__item text-decoration-none" onclick="adminDashbroad()">Admin Dashboard</a></li>
              <? 
              } elseif($user_status->isAdmin == 'user') {
                ?>
                      <li><a class="menu__item text-decoration-none">Logout</a></li>
              <? } ?> 
          </ul>
      </div>
      
      <div class="d-flex me-5">
          <?php 
              if(!isset($user_status->isAdmin)){
                ?>
                  <button id="login_btn" class="button btn me-2" data-bs-toggle="modal" data-bs-target="#login_modal" type="button">Log In</button>
                <?php
              } elseif($user_status->isAdmin == 'admin') {
                ?>
                    <div class="d-flex ">
                        <button class="button text-white btn-danger me-2" id="logout_btn" type="button">Log out</button>
                        <button class="button text-white btn-primary" id="admin_dashboard_btn" onclick="adminDashbroad()" type="button">Admin dashbroad</button>
                    </div>
                <?php 
            } elseif($user_status->isAdmin == 'user') {
                ?>
                <button class="button btn me-2" id="logout_btn" type="button">Log out</button>
        <?php  } ?> 
    </div>
  </div>
  </nav>
</header>

