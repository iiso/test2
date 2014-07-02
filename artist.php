<?php
    
    require_once('config.php');
    require_once('functions.php');
    require_once('facebook/facebook.php');
    
    
    session_start();
    
  
    
    
    connectDb();
    mysql_query('set names UTF8');
    
    
    
    
$sql = 'SELECT musicians.*,musics.* FROM musicians,musics WHERE musicians.id = '.$_GET['id'].' AND musics.musician_id='.$_GET['id'];
    $res = mysql_query($sql) or die(mysql_error());
  //  $musics = mysql_fetch_assoc($res);
      
      
      $sql3 = 'SELECT COUNT(*) FROM users_musicians WHERE musician_id ='.$_GET['id'];
    $res3 = mysql_query($sql3) or die(mysql_error());
    $count = mysql_fetch_assoc($res3);
    
    $sql2 = 'SELECT musicians.* FROM musicians WHERE id = '.$_GET['id'];
    $res2 = mysql_query($sql2) or die(mysql_error());
    $musician = mysql_fetch_assoc($res2);
    
    ?>



<!DOCTYPE html>
<html lang="ja"><head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
<meta property="og:title" content="">
<meta property="og:description" content="">
<meta property="og:url" content="">
<meta property="og:image" content="">
<meta property="og:site_name" content="">
<meta property="og:type" content="article">
<link rel="stylesheet" href="./css/reset.css" media="all">
<link rel="stylesheet" href="./css/style.css">
<link rel="stylesheet" href="./css/pc.css">
<script type="text/javascript" src="&lt;?php bloginfo(" template_url');="" ?="">/js/jquery-1.8.2.min.js'></script>
</head>
<body>
  <article class="artist-page">
    <nav class="navigation">
      <div class="nav-wrap">
        <ul class="nav-static">
          <li class="home"><a href="./home.php"></a></li>
          <li class="search"><a href="./search-result-nothing.php">登録する</a></li>
          <li class="profile"><a href="./profile.php">マイリスト</a></li>
        </ul>
      </div>
    </nav>
    <section class="artist-top" style="min-height: 250px; background-image: url(<?php print($musician["image"]); ?>); position: relative; background-repeat: no-repeat; background-size: cover">
      <div class="artist-data">
          <div class="left">
            <p class="artist-name"><?php print($musician["name"]); ?></p><p class="added-number">登録数 : <span class="number"><?php print($count["COUNT(*)"]); ?></span></p>
          </div>
          <p class="right">
            <span class="add-button2-off"><a href="">登録中</a></span>
          </p>
      </div>
    </section>
    <section class="artist-works">
      <ul class="works-list">
	 <?php 
    if (!empty($res)) { ?>

<?php

    while ($music = mysql_fetch_assoc($res)) {
        ?>
	
           <li class="work">
	      <figure class="jacket"><img src="<?php if(empty($music[image_url]))
	    {print($music[image]);
	    }else{print($music[image_url]);}?>"></figure>
	       <div class="work-info">
            <p class="work-name"><?php print($music["name"]); ?></p>
            <div class="release-date">
              <p class="month"><span class"number"><?php print ($music["release_date"][5]); ?><?php print ($music["release_date"][6]); ?></span>月</p>
              <p class="date"><span class"number"><?php print ($music["release_date"][8]); ?><?php print ($music["release_date"][9]); ?></span>日</p>
              <p>発売</p>
            </div>
	    </div> 
	        <div class="link-area">
            <a class="amazon-button" href="<?php print ($music[url]); ?>">この新作の詳細を見る</a>
            <p><a class="facebook-button" href="">シェアする</a><a class="twitter-button" href="">シェアする</a></p>
          </div>

	   
          </li>
	  
	  <?php 
    }?>
    
     <?php
    
    }else{
        echo ('まだ作品情報がありません。');
    }

    ?>
	
	
	
      </ul>
    </section>    
  </article>
  <footer>
    <div class="footer-wrap">
      <div class="logo"><a href="./home.php"><p class="white-border"></p><p class="white-border"></p></a></div>
      <p class="logo-type"></p>
      <p class="copyright">copyright©2014 SHINSAK-SAN</p>
    </div>
  </footer>
​</body></html>