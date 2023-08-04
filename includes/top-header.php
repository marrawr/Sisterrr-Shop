<?php
//session_start();

?>
<head>
    <!-- Other meta tags and links -->
    <link rel="stylesheet" href="styles.css">
</head>

<div class="top-bar animate-dropdown">
	<div class="container">
		<div class="header-top-inner">
			<div class="cnt-account">
				<ul class="list-unstyled">

					<?php if (strlen($_SESSION['login'])) {   ?>
						<li><a href="my-cart.php"><i class="icon fa fa-user"></i>Welcome -<?php echo htmlentities($_SESSION['username']); ?></a></li>
					<?php } ?>

					<li><a href="my-account.php"><i class="icon fa fa-user"></i>My Account</a></li>
					<li><a href="my-wishlist.php"><i class="icon fa fa-heart"></i>Wishlist</a></li>
					<li><a href="my-cart.php"><i class="icon fa fa-shopping-cart"></i>My Cart</a></li>
					<?php if (strlen($_SESSION['login']) == 0) {   ?>
						<li><a href="login.php"><i class="icon fa fa-sign-in"></i>Login</a></li>
						
						<!-- <div class="nav-collapse collapse navbar-inverse-collapse">
							<ul class="nav pull-right">
								<li><a href="#">
										Staff
									</a></li> -->
									<!-- <div class="nav-user dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    Login
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="login.php">Customer</a></li>
                    <li><a href="admin/index.php">Staff</a></li>
                    <li class="divider"></li>
                    <li><a href="manager/index.php">Manager</a></li>
                </ul>
            </div>
        </div> -->
					<?php } else { ?>

						<li><a href="logout.php"><i class="icon fa fa-sign-out"></i>Logout</a></li>
					<?php } ?>
				</ul>
			</div><!-- /.cnt-account -->




			</ul>
		</div>

		<div class="clearfix"></div>
	</div><!-- /.header-top-inner -->
</div><!-- /.container -->
</div><!-- /.header-top -->