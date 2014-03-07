<?php require($_SERVER['DOCUMENT_ROOT'] . '/_/inc/init.php'); ?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js ie ie6 lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js ie ie7 lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js ie ie8 lt-ie9"> <![endif]-->
<!--[if IE 9]>         <html class="no-js ie ie9 lt-ie10"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <title></title>
    <meta name="description" content="">
    <?php require("_/inc/head.php"); ?>
    <style type="text/css">
        .post { 
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius:3px;
            border: 1px solid #ddd;
            padding: 10px;
            -webkit-box-shadow: 0 0 15px #d8d8d8;
            -moz-box-shadow: 0 0 15px #d8d8d8;
            box-shadow: 0 0 15px #d8d8d8;
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            border-radius: 5px;
        }
        .post.facebook .link{
            padding-top: 20px;
        }
        
        .post.twitter .body-thumb{
            cursor: pointer;
        }
        
        .post {margin-bottom: 10px;}
        
        @media (max-width: 40.5em) {
            .post { 
                width: 90%
            }
        }
        
        @media (min-width: 40.5em) {
            .post.facebook { 
                margin-bottom: 30px;
            }
            .post.facebook { 
                width: 42%
            }
        }
        
        .thumbnails {margin-top: 10px;}
    </style>
</head>
<body>
    <?php require('_/inc/header.php');?>


    <div id="PageBody">
        <h1>social-hub.com</h1>  Hello! Your site is already wired up with:
        <ul>
            <li>Modernizr</li>
            <li>Jquery (1.10)</li>
            <li>HTML 5 Boilerplate</li>
            <li>Twitter Bootstrap (v 3.0.0)</li>
        </ul>
        <p>Don't forget to setup your site-wide variables for DEV and LIVE in /_/inc/init.php</p>
        <div id="thumbnails"></div>
        <button onclick="loadPosts()">Load Posts</button> 

        <script data-id="social-posts" type="text/x-jquery-tmpl"> 
            {%if postClass == "CustomFacebookPost"%}
                <div class="facebook post">                        
                    {%if message && description%}
                    <h3><a href="${link}" target="_blank">${message}</a></h3>
                    {%/if%}     

                    {%if picture %}
                    <div class="head-pic">
                        <a href="${link}" target="_blank" class="display:block"><img class="image" src="${picture}" width="100%"></a>                    
                    </div>
                    {%/if%} 
                
                    {%if message && description%}
                        <div class="body-thumb">${description}</div>
                    {%else message %}
                        <div class="body-thumb">${message}</div>                            
                    {%/if%}
                    <div class="link">
                        <img src="https://plus.google.com/_/favicon?domain=www.facebook.com" width="16" height="16" title="www.facebook.com">
                        <small><a href="http://facebook.com/${post_link}" target="_blank" class="display:block">www.facebook.com</a></small>
                        <small class="pull-right">${date_str}</small>
                    </div>
                </div>  
            {%else postClass == "CustomTwitterPost"%}
                <div class="twitter post"> 
                    <a href="http://twitter.com/${owner}/statuses/${id}"  target="_blank" >
                    <div class="body-thumb">${text}</div>       
                    </a>                    
                    <div class="link">
                        <img src="https://plus.google.com/_/favicon?domain=www.twitter.es" width="16" height="16" title="www.twitter.es">
                        <small class="pull-right">${date_str}</small>
                    </div>
                </div>
            {%/if%} 
        </script>
    </div>


    <!--[if lt IE 9]>
        <p class="chromeframe">You are using an <strong>outdated</strong> browser. 
        Please <a href="http://browsehappy.com/">upgrade your browser</a> 
        or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
    <![endif]-->

    <?php require('_/inc/footer.php'); ?>

    <!-- JAVASCRIPT -->
    <?php require('_/inc/analytics.php'); ?>

    <?php require('_/inc/tail.php'); ?>

    <script type="text/javascript">
        var socialHub = {
            nextFacebook : "",
            nextTwitter : "",
            posts : []
        }
        var $thumbnails = $("#thumbnails");

        function loadPosts (){
            $.get("lib/social.php", function(res){
                var data = JSON.parse(res);
                socialHub.nextFacebook = data.nextFacebook;
                socialHub.nextTwitter = data.nextTwitter;
                socialHub.posts = data.posts;

                var render = $("[data-id=social-posts]").tmpl(socialHub.posts);
                $thumbnails.append(render);     
                $thumbnails.masonry( 'appended', render );
                $thumbnails.imagesLoaded( function() {
                    $thumbnails .masonry();
                });
            });
        }

        $(document).ready( function(){
           $thumbnails.masonry({
                columnWidth: 105,
                itemSelector: '.item',
                gutter: 20
            });            
        });
    </script>
</body>
</html>
