<!DOCTYPE html>
<html lang="en-us">
	<head>
		<meta charset="utf-8">
		<!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
		<title> @yield('name' , 'Juzgado de Primera Instancia de Ushuaia') </title>
		<meta name="description" content="">
		<meta name="author" content="">

		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

      	<!-- Basic Styles -->
        <link rel="stylesheet" type="text/css" media="screen" href="{{asset("tcp/css/bootstrap.min.css")}}">
        <link rel="stylesheet" type="text/css" media="screen" href="{{asset("tcp/css/bootstrap-select.min.css")}}">
		<link rel="stylesheet" type="text/css" media="screen" href="{{asset("tcp/css/font-awesome.min.css")}}">

		<!-- SmartAdmin Styles : Caution! DO NOT change the order -->
		<link rel="stylesheet" type="text/css" media="screen" href="{{asset("tcp/css/smartadmin-production-plugins.min.css")}}">
		<link rel="stylesheet" type="text/css" media="screen" href="{{asset("tcp/css/smartadmin-production.min.css")}}">
		<link rel="stylesheet" type="text/css" media="screen" href="{{asset("tcp/css/smartadmin-skins.min.css")}}">

        @yield("estilos")

        <!-- SmartAdmin RTL Support -->
		<link rel="stylesheet" type="text/css" media="screen" href="{{asset("tcp/css/smartadmin-rtl.min.css")}}">

		<!-- FAVICONS -->
		<link rel="shortcut icon" href="{{asset("tcp/img/favicon/favicon.ico")}}" type="image/x-icon">
		<link rel="icon" href="{{asset("tcp/img/favicon/favicon.ico")}}" type="image/x-icon">

		<!-- GOOGLE FONT -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

		<!-- Specifying a Webpage Icon for Web Clip
			 Ref: https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html -->
		<link rel="apple-touch-icon" href="{{asset("tcp/img/splash/sptouch-icon-iphone.png")}}">
		<link rel="apple-touch-icon" sizes="76x76" href="{{asset("tcp/img/splash/touch-icon-ipad.png")}}">
		<link rel="apple-touch-icon" sizes="120x120" href="{{asset("tcp/img/splash/touch-icon-iphone-retina.png")}}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{asset("tcp/img/splash/touch-icon-ipad-retina.png")}}">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>

    </head>

    <body class="desktop-detected mobile-view-activated smart-style-2">

            <!-- Inico del Header -->
                @include('theme/header')
            <!-- Fin del Header -->

            <!-- Inicio del Aside -->
                @include('theme/aside')
            <!-- Fin del Aside -->

        <div id="main" role="main">
            <!-- RIBBON -->
		    	<div id="ribbon">
    			<!-- breadcrumb -->
    				{{--
                    <ol class="breadcrumb">
                        <a href="http://intranet.tcptdf.gob.ar/ords/f?p=107:1:13344394183931:::::" target="_blank" title="ir a Intranet">Intranet</a>
                    </ol>
					--}}
				<!-- end breadcrumb -->
			    </div>
            <!-- END RIBBON -->

            <!-- Inicio del Contenido -->
                 @yield("contenido")
              <!-- Fin del Contenido -->
        </div>
            <!-- Inicio del Footer -->
                @include('theme/footer')
            <!-- Fin del Footer -->

            <!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
            <script data-pace-options='{ "restartOnRequestAfter": true }' src="{{asset("tcp/js/plugin/pace/pace.min.js")}}"></script>

            <!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script>
                if (!window.jQuery) {
                    document.write('<script src="{{asset("tcp/js/libs/jquery-3.2.1.min.js")}}"><\/script>');
                }
            </script>

            <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
            <script>
                if (!window.jQuery.ui) {
                    document.write('<script src="{{asset("tcp/js/libs/jquery-ui.min.js")}}"><\/script>');
                }
            </script>

            <!-- IMPORTANT: APP CONFIG -->
            <script src="{{asset("tcp/js/app.config.js")}}"></script>

            <!-- JS TOUCH : include this plugin for mobile drag / drop touch events-->
            <script src="{{asset("tcp/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js")}}"></script>

            <!-- BOOTSTRAP JS -->
            <script src="{{asset("tcp/js/bootstrap/bootstrap.min.js")}}"></script>

            <!-- CUSTOM NOTIFICATION -->
            <script src="{{asset("tcp/js/notification/SmartNotification.min.js")}}"></script>

            <!-- JARVIS WIDGETS -->
            <script src="{{asset("tcp/js/smartwidgets/jarvis.widget.min.js")}}"></script>

            <!-- EASY PIE CHARTS -->
            <script src="{{asset("tcp/js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js")}}"></script>

            <!-- SPARKLINES -->
            <script src="{{asset("tcp/js/plugin/sparkline/jquery.sparkline.min.js")}}"></script>

            <!-- JQUERY VALIDATE -->
            <script src="{{asset("tcp/js/plugin/jquery-validate/jquery.validate.min.js")}}"></script>

            <!-- JQUERY MASKED INPUT -->
            <script src="{{asset("tcp/js/plugin/masked-input/jquery.maskedinput.min.js")}}"></script>

            <!-- JQUERY SELECT2 INPUT -->
            <script src="{{asset("tcp/js/plugin/select2/select2.min.js")}}"></script>

            <!-- JQUERY UI + Bootstrap Slider -->
            <script src="{{asset("tcp/js/plugin/bootstrap-slider/bootstrap-slider.min.js")}}"></script>

            <!-- browser msie issue fix -->
            <script src="{{asset("tcp/js/plugin/msie-fix/jquery.mb.browser.min.js")}}"></script>

            <!-- FastClick: For mobile devices -->
            <script src="{{asset("tcp/js/plugin/fastclick/fastclick.min.js")}}"></script>

            <!--[if IE 8]>

            <h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>

            <![endif]-->

            <!-- MAIN APP JS FILE -->
            <script src="{{asset("tcp/js/app.min.js")}}"></script>

            <!-- SmartChat UI : plugin -->
            <script src="{{asset("tcp/js/smart-chat-ui/smart.chat.ui.min.js")}}"></script>
            <script src="{{asset("tcp/js/smart-chat-ui/smart.chat.manager.min.js")}}"></script>

            <!-- Datatables : plugin -->
            <script src="{{asset("tcp/js/plugin/datatables/jquery.dataTables.min.js")}}"></script>
            <script src="{{asset("tcp/js/plugin/datatables/dataTables.colVis.min.js")}}"></script>
            <script src="{{asset("tcp/js/plugin/datatables/dataTables.tableTools.min.js")}}"></script>
            <script src="{{asset("tcp/js/plugin/datatables/dataTables.bootstrap.min.js")}}"></script>
            <script src="{{asset("tcp/js/plugin/datatable-responsive/datatables.responsive.min.js")}}"></script>
            <script src="{{asset("tcp/js/bootstrap/bootstrap-select.min.js")}}"></script>

            @yield("scriptsplugin")

            @yield("scripts")

    </body>
</html>
