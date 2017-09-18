<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1.0, user-scalable=0">
<link rel="shortcut icon" href="favicon.jpg">
<link rel="stylesheet" type="text/css" href="css/style.css">
<script type="text/javascript" src="js/angular.min.js"></script>
<title>PHP Session menu</title>

</head>
<body>
<div id="menu">
<?php

if (!isset($_SESSION['currentpage'])){ $_SESSION['currentpage'] = "index"; header ('Location: index.php?sivu=Firstpage'); exit; } 
elseif (isset($_SESSION['currentpage'])) { $_SESSION['currentpage'] = $_GET['sivu']; }
else $_SESSION['currentpage'] = $_GET['sivu'];

$page = $_SESSION["currentpage"];


$selfsite = $_SERVER['PHP_SELF'];
$info = pathinfo($selfsite);
$selffilename =  basename($selfsite,'.'.$info['extension']);

echo "<nav><ul class=\"topnav\" id=\"myTopnav\">";

$navigation_menu = array("Firstpage", "Secondpage", "Gallery", "Thirdpage", "Pagefour", "Fifthpage");
foreach ($navigation_menu as $menuitem) {
    if(file_exists("pages/" . $menuitem . ".xml"))
	{
		if ( $page == $menuitem ) {
		echo "<li><a class=\"active\" href=\"index.php?sivu=".$menuitem."\">".$menuitem."</a></li>"; }
				else {
			echo "<li><a href=\"index.php?sivu=".$menuitem."\">".$menuitem."</a></li>"; }
	}
}


echo "<li class=\"icon\"> <a href=\"javascript:void(0);\" onclick=\"myFunction()\">&#9776;</a></li></ul></nav>";
echo "<script type=\"text/javascript\" src=\"js/script.js\"></script>"; 
?>

<div id="main">
<?php

        switch($page)
        {
            case 'Firstpage';
                $_SESSION["currentpage"] = "Firstpage";
                break;  
            case 'Secondpage';
                $_SESSION["currentpage"] = "Secondpage";
                break;  
            case 'Gallery':
                $_SESSION["currentpage"] = "Gallery";
                break;
			case 'Thirdpage':
				$_SESSION["currentpage"] = "Thirdpage";
				break;
            case 'Pagefour':
                $_SESSION["currentpage"] = "Pagefour";
                break;      
            case 'Fifthpage':
                $_SESSION["currentpage"] = "Fifthpage";
                break;  
        }
        
function gallery() {
		$galleryimages = glob('gallery-images/*.jpg*');
		foreach ($galleryimages as $filename) {

		$next = next($galleryimages);

echo "<a class=\"lightbox\" href=\"#$filename\"><img src=\"$filename\"/></a> <div class=\"lightbox-target\" id=\"$filename\"><img src=\"$filename\"/><a class=\"lightbox-close\" href=\"#\"></a><a class=\"lightbox-next\" href=\"#$next\"></a></div>";
	 } 
}

$file = "pages/" . $_SESSION["currentpage"] . ".xml";

if ($file == "files/Gallery.xml") { gallery(); }
elseif (file_exists($file)) { $xml = file_get_contents($file); print_r($xml); } 
else { print_r(file_get_contents("pages/Firstpage.xml")); }

?>
</div>
</body>
</html>
