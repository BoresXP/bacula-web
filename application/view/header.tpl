<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bacula-Web - {$page_name}</title>
  <!-- Bootstrap front-end framework -->
  <link rel="stylesheet" type="text/css" href="application/assets/bootstrap/css/bootstrap.min.css">

  <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
</head>

<body>

<!-- Header -->
<div id="header">
 <div id="toolbar_top">
  <div class="toolbar_box right_box">
   <ul>
	<li> <a href="http://bugs.bacula-web.org" target="_blank" title="Bugs and features tracker">Bugs</a> </li>
	<li> <a href="http://www.bacula-web.org" target="_blank" title="Visit the official web site">About</a> </li>
	<li>Version 6.0.1</li>
   </ul>
  </div> 
  <div class="clear_both"></div>
 </div> <!-- end div toolbar_top -->

 <div id="header_main">
  <!-- Navigation page -->
  <div class="toolbar_box left_box">
    <a href="index.php" title="Dashboard"> <img src="application/view/style/images/home_w.png" alt=""> </a>
  </div>
  <!-- Page name -->
  <div class="toolbar_box left_box page_name">
    {$page_name}
  </div>
  
  <!-- Application name -->
  <div class="toolbar_box right_box">
   <div class="app_name">Bacula-Web</div>
  </div>
  <div class="clear_both"></div>
 </div>

<!-- Top Toolbar -->
<div id="top_controls">
  <!-- Back link -->
  <div class="toolbar_box left_box">
    <ul>
      <li>
        {php} 
	  $back	    = null;
          $referrer = $_SERVER['HTTP_REFERER'];
          $referrer = end( explode( "/", $referrer) );

          $current  = $_SERVER['SCRIPT_FILENAME'];
	  $current  = end( explode( "/", $current) );
  
          // If referrer and current are not equal and referrer isn't null/empty
	  if( strcmp($referrer, $current) != 0  ) 
 	    $back = $referrer;

          // If current is Dashboard
          if( $current == 'index.php' )
	    $back = null;

          if( !is_null($back) )
   	    echo "<a href='$back' title='back to previous page'>Back</a>";
	{/php}
      </li>
    </ul>
  </div>

  <div class="toolbar_box right_box">
   <!-- Condifitional catalog selection if more than 1 catalog is defined in the configuration -->
    {if $catalog_nb > 1}
      <form class="catalog_selector" method="post" action="index.php">
        Catalog {html_options name=catalog_id options=$catalogs selected=$catalog_current_id onchange="submit();"}
          <noscript><input type="submit" value="Select"></noscript>
      </form>
    {/if}
  </div>

  <div class="clear_both"></div>
</div>
<!-- end Top controls -->

</div> <!-- end header -->
