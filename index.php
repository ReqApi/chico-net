<?php

// Instantiating the markdown parser
require "php-markdown/Michelf/Markdown.inc.php";



$md = new \Michelf\Markdown();

$page["home"]["title"] = "HOME";
$page["home"]["body"] = "

# HELLO EVERYONE! MY NAME IS CHICO
I AM A DOG. HERE ARE SOME THINGS I LIKE

* [BARKING](/bark)
* [FOOD](/food)
* [TROMBONES](/trombone)

";

$page["bark"]["title"] = "BARKING";
$page["bark"]["body"] = "ARF WOOF BARK BORK BORK YIP BARK BORK YIP BARK.";


$page["stuff"]["title"] = "STUFF";
$page["stuff"]["body"] = "# I am Chico and I like stuff!
1. Food 
2. Chewing on things
3. Licking things
4. Chasing the cat

![Chico & Kat](/displayScaledImage.function.php)";

$page["licks"]["title"] = "LICKS";
$page["licks"]["body"] = "ARF WOOF BARK BORK BORK YIP BARK BORK YIP BARK.";

$page["tail-chasing"]["title"] = "TAIL CHASING";
$page["tail-chasing"]["body"] = "ARF WOOF BARK BORK BORK YIP BARK BORK YIP BARK.";

$page["butt-sniffs"]["title"] = "BUTTS";
$page["butt-sniffs"]["body"] = "ARF WOOF BARK BORK BORK YIP BARK BORK YIP BARK.";

$page["404"]["title"] = "404";
$page["404"]["body"] = "#404 \n File not found. \*sad whimper\*.";

//generate the nav bar variable from existing page names
$navbar = "";
$num = 0;
foreach($page as $key => $value){
	$num++;
	if ($key != "404"){
		$navbar .= " * [".$page[$key]["title"]."](/".$key.")\n";
		//if($num < count($page) - 1){
		//$navbar .= " | ";
		//}
	}
}
//$navbar .= "<br/>";
unset($num);

$style = '

body {
	background-color: #DED5BD;
	color: #191F36;
	font-family: "Verdana", sans-serif;
}

A:link {
	color: #353A4F;
}

A:visited {
	color: #353A4F;
}

h1 {
	color: #191F36;
}

p {
    font-family: "Verdana", sans-serif;
    font-size: 16px;
}



div.nav {

	min-height: 2em;
	margin: 0px;
}

div.nav > ul {
	padding: 0;
	margin: 0;
	overflow: hidden;
	background-color: #D6BF7D;
}

div.nav > ul > li {
    list-style-type: none;


}

div.nav > ul > li > a {
	float: left;
    display: block;
    padding: 8px;
    text-decoration: none;
    font-family: "Tahoma", sans-serif;
    font-weight: bold;
    
}

div.nav > ul > li > a:hover {
	background-color: #ADA794;
    

}

';

// Tags to wrap around the page
function makePage($nav, $title, $body, $style){
	$return = null;



	$tags["start"] = "<html><head><style>".
	$style
	."</style><title>".
	$title
	."</title></head><body>";
	$tags["end"] = "</body></html>";

	$return = $tags["start"]."<div class='nav'>".$nav."</div>".$body.$tags["end"];

	return $return;

	
}

// Get the current url and put it in a variable
$url = preg_replace("/^\//", '', $_SERVER['REQUEST_URI']); // strip slash with regex
if(!$url){
	$url = "home";
}
if (!isset($page[$url])){
	$url = "404";
	header("HTTP/1.0 404 File Not Found");
}

echo makePage($md->defaultTransform($navbar), $page[$url]["title"], $md->defaultTransform($page[$url]["body"]), $style);

/*if($url == "home"){
	// Display the home page
	echo makePage($page["home"]["title"], $md->defaultTransform($page["home"]["body"]));
	

}else if($url == "bark"){
	//display the "things I like to bark at" page
	echo makePage($page["bark"]["title"], $md->defaultTransform($page["bark"]["body"]));

}else{
	echo makePage("404", $md->defaultTransform("#404 \n File not found. \*sad whimper\*."));
}*/

?>

