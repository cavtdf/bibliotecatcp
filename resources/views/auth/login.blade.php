<!DOCTYPE html>
<html lang="en-us" id="extr-page">
	<head>
		<meta charset="utf-8">
		<title> Juzgado Federal de Primera Instancia de Ushuaia </title>
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<!-- #CSS Links -->
		<!-- Basic Styles -->
		<link rel="stylesheet" type="text/css" media="screen" href="tcp/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="tcp/css/font-awesome.min.css">

		<!-- SmartAdmin Styles : Caution! DO NOT change the order -->
		<link rel="stylesheet" type="text/css" media="screen" href="tcp/css/smartadmin-production-plugins.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="tcp/css/smartadmin-production.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="tcp/css/smartadmin-skins.min.css">

		<!-- SmartAdmin RTL Support -->
		<link rel="stylesheet" type="text/css" media="screen" href="tcp/css/smartadmin-rtl.min.css">

		<!-- We recommend you use "your_style.css" to override SmartAdmin
		     specific styles this will also ensure you retrain your customization with each SmartAdmin update.
		<link rel="stylesheet" type="text/css" media="screen" href="css/your_style.css"> -->

		<!-- Demo purpose only: goes with demo.js, you can delete this css when designing your own WebApp -->
		<link rel="stylesheet" type="text/css" media="screen" href="tcp/css/demo.min.css">

		<!-- #FAVICONS -->
		<link rel="shortcut icon" href="tcp/img/favicon/favicon.ico" type="image/x-icon">
		<link rel="icon" href="tcp/img/favicon/favicon.ico" type="image/x-icon">

		<!-- #GOOGLE FONT -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

	</head>

	<body class="animated fadeInDown">

		<header id="header">

			<div id="logo-group">
				
			</div>

		
		</header>

		<div id="main" role="main">

			<!-- MAIN CONTENT -->
			<div id="content" class="container">

				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-7 col-lg-8 hidden-xs hidden-sm">
						<h1 class="txt-color-red login-header-big">Juzgado Federal de Primera Instancia de Ushuaia</h1>
						<div class="hero">

							<div class="pull-left login-desc-box-l">
								<h4 class="paragraph-header">Este es el nuevo sistema de Biblioteca del Juzgado Federal de Primera Instancia de Ushuaia, en el podrá
                                    estar al tanto de cada nuevo material que se incorpora y tener posibilidad de solicitarlo cuando lo requiera.
                                    
                                </h4>

							</div>

							<img src="tcp/img/libros2.png" class="pull-right display-image" alt="" style="width:210px">

						</div>



					</div>
					<div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
						<div class="well no-padding">
							<form method="POST" action="{{ route('login') }}" id="login-form" class="smart-form client-form">
                              @csrf
								<header>
									Ingreso
								</header>

								<fieldset>
                                    <section>
                                       <label for="username" class="label">{{ __('Usuario') }}</label>
                                       <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus >

                                            @error('username')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </section>

									<section>
                                        <label for="password" class="label"> {{ __('Contraseña') }}</label>
                                        <label class="input"> <i class="icon-append fa fa-lock"></i>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
									</section>


								</fieldset>
								<footer>
									<button type="submit" class="btn btn-primary">
										Acceder
									</button>
								</footer>
							</form>

						</div>

					</div>
				</div>
			</div>

		</div>

		<!--================================================== -->

		<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
		<script src="tcp/js/plugin/pace/pace.min.js"></script>

	    <!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
	    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script> if (!window.jQuery) { document.write('<script src="js/libs/jquery-3.2.1.min.js"><\/script>');} </script>

	    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
		<script> if (!window.jQuery.ui) { document.write('<script src="tcp/js/libs/jquery-ui.min.js"><\/script>');} </script>

		<!-- IMPORTANT: APP CONFIG -->
		<script src="tcp/js/app.config.js"></script>

		<!-- JS TOUCH : include this plugin for mobile drag / drop touch events
		<script src="tcp/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script> -->

		<!-- BOOTSTRAP JS -->
		<script src="tcp/js/bootstrap/bootstrap.min.js"></script>

		<!-- JQUERY VALIDATE -->
		<script src="tcp/js/plugin/jquery-validate/jquery.validate.min.js"></script>

		<!-- JQUERY MASKED INPUT -->
		<script src="tcp/js/plugin/masked-input/jquery.maskedinput.min.js"></script>

		<!-- MAIN APP JS FILE -->
		<script src="tcp/js/app.min.js"></script>

		<script>
			runAllForms();

			$(function() {
				// Validation
				$("#login-form").validate({
					// Rules for form validation
					rules : {
						username : {
							required : true,
							username : true
						},
						password : {
							required : true,
							minlength : 3,
							maxlength : 20
						}
					},

					// Messages for form validation
					messages : {
						username : {
							required : 'Por favor ingrese un usuario',
							username : 'Ingrese un usuario valido'
						},
						password : {
							required : 'Por favor ingrese la contraseña'
						}
					},

					// Do not change code below
					errorPlacement : function(error, element) {
						error.insertAfter(element.parent());
					}
				});
			});
		</script>

	</body>
</html>
