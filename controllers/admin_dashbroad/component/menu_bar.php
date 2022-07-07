<?
$PAGE_VAR["css"][] = "menu_bar";
$PAGE_VAR["js"][] = "login";
?>

	<nav class="side_menu">
		<div class="main-menu">
		<ul class='main-menu'>
			<li>
				<a href="<?echo WEB_META_BASE_URL?>home">
					
					<span class='glyphicon glyphicon-pushpin'><i class='fa fa-home'></i></span> Home
				</a>
			</li>
			<li class="link-active">
				<a href="<?echo WEB_META_BASE_URL?>admin_dashbroad/add_menu">
					<span class='glyphicon glyphicon-home'><i class="fa fa-area-chart"></i></span>Dashboard
				</a>
			</li>
			<li>
				<a href="#">
					<span class='glyphicon glyphicon-pushpin'><i class="fa fa-comment-o"></i></span>Chats
				</a>
			</li>
			<li>
				<a href="#">
					<span class='glyphicon glyphicon-picture'><i class='fa fa-clone'></i></span> Media
				</a>
			</li>
		</ul>
		</div>
 	<p class="copyright">&copy; 2022</p>
</nav>

<div class="hamburger-menu">
    <input id="menu__toggle" type="checkbox" />
    <label class="menu__btn" for="menu__toggle">
      <span></span>
    </label>

    <ul class="menu__box">
      		<li><a class="menu__item text-decoration-none" href="<?echo WEB_META_BASE_URL?>/Home">Home</a></li>
			<li><a class="menu__item text-decoration-none" href="<?echo WEB_META_BASE_URL?>/admin_dashbroad/add_enu">Add Menu</a></li>
			<li><a class="menu__item text-decoration-none" href="<?echo WEB_META_BASE_URL?>/admin_dashbroad/user_chat">User Chat Room</a></li>
    </ul>
</div>