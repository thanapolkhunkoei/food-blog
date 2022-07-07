<?php
	$PAGE_VAR["js"][] = "route";
	$PAGE_VAR["js"][] = "chat";
	$PAGE_VAR["css"][] = "userChat";

$theme = "admin";
?>

<div class="row">

    <div  class="col-2">
    <?php include('component/menu_bar.php')  ;?>
    </div>
    <div class="container col-9 mt-4 rounded  p-0">
        <div class="row">
            <div class="col-3 user_list">
                <div id="user"></div>
                
            </div>
            <div class="col-8 chat_box">
                <div class="header">
                <img src="stocks/salad3.jpeg" alt="">
                    <h5>Name</h5>
                </div>
                <div class="chat_area">
                    <div id="chat">
                        <div class="you">
                            <div class="user_detail">
                                <span class="status green"></span>
                                <h2>Vincent</h2>
                                <h3>10:12AM, Today</h3>
                            </div>
                            <div class="triangle"></div>
                            <div class="message">
                                Lorem ipsum dolor sit amet, 
                            </div>
                        </div>
                        <div class="me">
                            <div class="user_detail">
                                <h3>10:12AM, Today</h3>
                                <h2>Vincent</h2>
                                <span class="status blue"></span>
                            </div>
                            <div class="triangle"></div>
                            <div class="message">
                                Lorem ipsum dolor sit amet, 
                            </div>
                        </div>
                    </div>
                    <footer>
                        <textarea placeholder="Type your message"></textarea>
                        <button >Send</button>
                    </footer>
                </div>
            </div>
        </div>



    </div>

</div>