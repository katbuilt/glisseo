<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>MCM Dynamic Image Gallery test</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<style type="text/css">
<!--
* {margin: 0; padding: 0;}
body {font: 0.8125em Arial, sans-serif; line-height: 1; color: #333; background: #FFFFFF;}
.addClearance {
	clear: both;
}

#container {
	margin: 0px;
	text-align: left;
	background: #e5e5e5;
	border: none;
	font-size: 100%;
	width: 100%;
	}

#navigation {
	float: left;
	margin-left: 0px;
	margin-right: 0px;
	margin-top: 13px;
	margin-bottom: 0px;
	padding: 1px;
	width: 150px;
	}

#navigation ul {
	list-style: none;
	}

#navigation li {
	display: block;
	border: none;
	width: 140px;
	padding: 4px;
	}

#navigation a {
	background: #b7b7b7;
	color: #ffffff;
	font-weight: bold;
	text-decoration: none;
	display: block;
	width: 140px;
	padding: 4px;
	}

#navigation a:hover {
	color: #333;
	padding: 4px;
	}

#navigation #currentpage a {
	background: #8e8e8e;
	color: #fff;
	display: block;
	width: 140px;
	padding: 4px;
	}

#thumbnail
{
	margin-left: 5px;
	margin-right: 0px;
	margin-top: 15px;
	margin-bottom: 0px;
	float: left;
	width: 45px;
}
#thumbnail ul {
	list-style: none;
	padding: 1px;
}
#thumbnail li {
	background: none;
	display: block;
	border: none;
	margin: 0px;
	padding: 2px;
	width: 40px;
}

#display_pic {
	float: left;
	margin-left: 4px;
	margin-top: 14px;
	padding: 4px;
	}

#caption {
	font-size: 9px;
	background: #8e8e8e;
	margin-top: 5px;
	width: 640px;
}

/*** IE Fix ***/
* html #navigation {
	left: 150px;
}
-->
</style>
</head>

<body>
<img src="MCMlogoGallery.jpg"/>
<div id="container">

  <div id="navigation">
  <!-- here we're going to create a div with all of the categories in it -->
  <ul>
  <?php
	// BDS - Change the picture gallery if it is not called GalleryImages
  	$dir    = 'GalleryImages';
  	$cat_dir = $_GET['thisPage'];


	// BDS - This sets the default directory when the page is first loaded. Enter folder between quotes.  The page will break if this folder is not present.
	if (!(isset($cat_dir))) { $cat_dir="01_Institutional"; }



  	// get the folders from the GalleryImages folder
  	$dh  = opendir($dir);
	while (false !== ($filename = readdir($dh))) {
	    $categories[] = $filename;
}

	sort($categories);
  	foreach ($categories as $value) {
		// exclude the . and .. entries
		if (($value != "..") && ($value != ".") && ($value != "Default")) {
				$format_cat = substr($value, 3);
				echo "<li";
				if ($cat_dir==$value)
      			echo " id=\"currentpage\"";
                echo "><a href=\"image-gallery.php?thisPage=" . rawurlencode($value) . "\">$format_cat</a></li>";

		}
	}



  ?>
  </ul>
  </div>
  <div style="display:none">

  <?php

	$th_dir = $dir . '/' . $cat_dir;


	$dh2  = opendir($th_dir);
	while (false !== ($f_lename = readdir($dh2))) {
	    $thumbnails[] = $f_lename;
}

    sort($thumbnails);
    $default_thumb = $thumbnails[2];

  // using this loop to preload the images
    foreach ($thumbnails as $th) {
		if (($th != "..") && ($th != ".")) {
	    echo '<img src="GalleryImages/' . $cat_dir . '/' . $th .'" alt="" />';
	    }
    }
  ?>
   </div>
   <div id="thumbnail">
    <!-- grab thumbnails based on actions in category -->
    <ul>
   <?php
       foreach ($thumbnails as $th) {
   		if (($th != "..") && ($th != ".")) {
   		$th_filename = substr($th, 3, -4);
   	    echo "<li><a href=\"#\" onmouseover=\"javascript:window.document.form_label.text_label.value=
'$th_filename';document.images['big_pic'].src='GalleryImages/$cat_dir/$th'; \"><img src=\"imagethumb.php?s=GalleryImages/" . rawurlencode($cat_dir) . "/$th&amp;w=40\" border=\"0\" alt=\"\" /></a></li>";
   	    }
    }
    ?>
    </ul>
	</div>



  <div id="display_pic" class="picture">
  <!-- onHover of thumbnails, place -->
  <img src="GalleryImages/<?php echo $cat_dir . "/" . $default_thumb ?>" name="big_pic" width="640" border="0" alt="" /><br />
  <form name="form_label" action="">
    <div id="caption"><input type="text" name="text_label" value="" style='color: #ffffff;background: #8e8e8e;border: none;padding:2px;font-weight: bold;width: 600px;' /></div>
  </form>
  </div>

</div>

</body>
</html>