<title><?= (isset($title) && $title!='') ? ($title) : env("APP_NAME") ?></title>
<!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 11]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
<!-- Meta -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<meta name="description" content=""/>
<meta name="keywords" content="">
<meta name="author" content=""/>

<meta name="csrf-token" content="{{ csrf_token() }}" />

<!-- Favicon icon -->
{{-- <link rel="icon" href="{{ asset('assets/images/logo/favicon.png') }}" type="image/x-icon"> --}}

<!-- fontawesome icon 
<link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome/css/fontawesome-all.min.css') }}">-->
<script src="https://kit.fontawesome.com/93db4d79e9.js" crossorigin="anonymous"></script>

<!-- animation css -->
<link rel="stylesheet" href="{{ asset('assets/plugins/animation/css/animate.min.css') }}">


<!-- notification css -->
<link rel="stylesheet" href="{{ asset('assets/plugins/notification/css/notification.min.css') }}">

<!-- vendor css -->
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">



<!-- custom css -->
<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
