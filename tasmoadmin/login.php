<?php

	include_once( "./includes/top.php" );


	$Config = new Config();


	$register = FALSE;
	$msg      = FALSE;
	$user     = $Config->read( "username" );
	$password = $Config->read( "password" );
	$title    = __( "LOGIN", "PAGE_TITLES" );
	$page     = "login";
	if ( isset( $_GET[ "logout" ] ) ) {
		ob_start();

		session_unset();
		session_destroy();

		header( "Location: "._BASEURL_."login" );
		ob_end_flush();
	}

	if ( $Config->read( "login" ) == 0 ) {
		die( "in" );
		header( "Location: "._BASEURL_."" );
	}

	if ( isset( $_REQUEST ) && !empty( $_REQUEST ) ) {
		if ( isset( $_REQUEST[ "register" ] ) && ( $user == "" || $password == "" ) ) {
			$Config->write( "username", $_REQUEST[ "username" ] );
			$Config->write( "password", md5( $_REQUEST[ "password" ] ) );
			$_SESSION[ 'login' ] = "1";
			header( "Location: "._BASEURL_."start" );

		} else if ( isset( $_REQUEST[ "login" ] ) ) {
			if ( $user == $_REQUEST[ "username" ] && $password == md5( $_REQUEST[ "password" ] ) ) {
				$_SESSION[ 'login' ] = "1";
				header( "Location: "._BASEURL_."start" );
			} else {
				$msg = __( "LOGIN_INCORRECT", "LOGIN" );
			}
		}
	}

	if ( empty( $user ) || $user == "" || empty( $password ) || $password == "" ) {
		$register = TRUE;
	}

?>


<?php include_once( _INCLUDESDIR_."header.php" ); //always load header?>

<div class="container-fluid" id='content'>
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center text-white mb-4"><?php echo $title; ?></h2>
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <span class="anchor" id="formLogin"></span>
					<?php if ( isset( $msg ) && $msg != "" ): ?>
                        <div class="alert alert-danger alert-dismissible fade show mb-5"
                             data-dismiss="alert"
                             role="alert">
							<?php echo $msg; ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
					<?php endif; ?>
                    <!-- form card login -->
                    <div class="card rounded-0 bg-dark text-white">
                        <div class="card-body">
                            <form class="form" name='loginform' method='POST'>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text"
                                           class="form-control form-control-lg rounded-0"
                                           name="username"
                                           id="username"
                                           placeholder='<?php echo __( "LOGIN_USERNAME_PLACEHOLDER", "LOGIN" ); ?>'
                                           required="">


                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password"
                                           class="form-control form-control-lg rounded-0"
                                           id="password"
                                           name="password"
                                           required=""
                                           placeholder='<?php echo __( "LOGIN_PASSWORD_PLACEHOLDER", "LOGIN" ); ?>'
                                    >
                                </div>
                                <button type='submit'
                                        name='<?php echo $register ? "register" : "login"; ?>'
                                        class='btn btn-success btn-lg float-right'>
									<?php echo $register
										? __( "BTN_REGISTER", "LOGIN" )
										: __(
											"BTN_LOGIN",
											"LOGIN"
										); ?>
                                </button>
                            </form>
                        </div>
                        <!--/card-block-->
                    </div>
                    <!-- /form card login -->

                </div>


            </div>
            <!--/row-->

        </div>
        <!--/col-->
    </div>
    <!--/row-->
</div>
<!--/container-->


<?php include_once( _INCLUDESDIR_."footer.php" ); //always load header?>

