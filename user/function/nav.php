<nav>
         <div id="nav" class="all">
         	<label>Mero Sahayatri - User</label>
			<div id="menu-bar">
					<?php require "function/menu-list.php"?>
			</div>
				
		</div>
		<div id="nav-menu">
	         <div class="side-menu">
		        <center id="user-img"> 
		        	<img src="img/<?=$_SESSION['image_user']?>">
		        </center>
		    </div>
		    <div class="side-menu">
		        <center> 
		            <h2>
		                <?php
		                    echo $_SESSION['user'];
		                ?>
		            </h2>
		        </center>
		    </div>
	        <ul>
	            <li>
	                <a href="logout.php" style="background-color: rgb(55, 34, 246);">Logout</a>
	            </li>
	        </ul>
	  
    	</div>
    </nav>