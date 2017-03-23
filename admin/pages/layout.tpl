<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Administrace webu {block name=title}{/block}</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="/admin/www/img/favicon2.png">
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>

        {if $smarty.session.logged neq 1}
            <link href="/core/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
            <link href="/admin/css/signin.css" rel="stylesheet">
        {else}
            <link href="/core/font-awesome/css/font-awesome.min.css" rel="stylesheet">
            <link href="/core/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
            <link href="/core/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
            <link href="/admin/css/sb-admin-2.css" rel="stylesheet">
            <link href="/admin/css/dashboard.css" rel="stylesheet">
            <link href="/admin/css/styles.css" rel="stylesheet">  
            <link href="/admin/css/boxes.css" rel="stylesheet"> 
            <link href="http://fonts.googleapis.com/css?family=Aladin" rel="stylesheet" type="text/css">
            <link href="/admin/www/css/dropzone.css" rel="stylesheet">  
            <link href="/core/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" rel="stylesheet" >
            <link rel='stylesheet' href='/core/fullcalendar/fullcalendar.css' />
            <link href="/admin/css/colors.css" rel="stylesheet">
            <link href="/admin/css/knihovna.css" rel="stylesheet">
        {/if}

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        
        {block name=scripts_document_ready}{/block}
        
    </head>
    
    {block name=body}
        <body>
            <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                <!-- <form action="/admin/" method="post" role="form">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" name="hledat" placeholder="Hledej...">
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                    </div>
                </form> -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/admin/">Administrace webu</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right"> 
                        {include file="./horni_prave_menu.tpl"}                            
                    </ul>
                </div>
            </nav>

            <div id="page-wrapper">
                {block name=alert}{/block}
                <div class="row">
                    {assign var=userGroup value=$logged_user.admin_group}
                    {assign var=p1 value=$smarty.get.p1}
                    {assign var=p2 value=$smarty.get.p2}
                    {if $web_menu.$p1}
                        {block name=breadcrumb}{/block}
                        {if $web_menu.$p1.submenu.$p2}
                            {assign var=prava_nazev value=$web_menu.$p1.submenu.$p2.prava_nazev}
                            {if $logged_user.prava.$prava_nazev == 1}
                                {include file="./breadcrumb.tpl"}
                                {block name=content}{/block}
                            {else}
                                {include file="nepristupne.tpl"}
                            {/if}
                        {else}
                            {assign var=prava_nazev value=$web_menu.$p1.prava_nazev}
                            {if $logged_user.prava.$prava_nazev == 1}
                                {block name=content}{/block}
                            {else}
                                {include file="./nepristupne.tpl"}
                            {/if}
                        {/if}
                    {else}
                        {block name=content}
                            {include file="./dashboard.tpl"}
                        {/block}
                    {/if}
                </div>
            </div>
            
            <!-- <div id="footer"></div> -->
            
            {block name=modal}{/block}
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
            <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
            <script src="/core/bootstrap/dist/js/bootstrap.min.js"></script>
            <script src="/core/metisMenu/dist/metisMenu.min.js"></script>
            <script src="/core/ckeditor/ckeditor.js"></script>
            <script src="/core/dropzone/dropzone.js"></script>
            <script src='/core/js/moment.js'></script>
            <script src='/core/fullcalendar/fullcalendar.js'></script>
            <script src='/core/fullcalendar/lang/cs.js'></script>
            <script src="/core/bootstrap/dist/js/offcanvas.js"></script>
            <script src="/core/js/sb-admin-2.js"></script>
            <script type="text/javascript" src="/core/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>

            <script type="text/javascript">
                $(function () {
                    $('[data-toggle="tooltip"]').tooltip()
                });
                $(function () {
                    $('.dropdown-toggle').dropdown()
                })
            </script>
            {block name=scripts}{/block}
        </body>
    {/block}
</html>