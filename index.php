<?php
/*
Copyright 2012 Josh "Cheeseness" Bush

This file is part of Para CMS.

Para CMS is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

Para CMS is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Para CMS.  If not, see <http://www.gnu.org/licenses/>.
*/

//This is a variable referenced in config.php. Don't play with it :3
$externalLinks = array();

include_once("config.php");

//Sets the time zone if the time zone has been set in the config file. Don't play with this either.
if( isset($timeZone) ) date_default_timezone_set($timeZone);

include_once("functions.php");


$currentPage = $defaultPage;
if (isset($_GET['page']))
{
	//TODO: Some sanitising please
	$currentPage = $_GET['page'];
}

$pageTitle = getPageTitle($currentPage);

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
	<meta charset=utf-8 />
	<meta name="viewport" content="width=device-width" />

	<title><?php echo $pageTitle; ?> &raquo; <?php echo $siteTitle; ?></title>

	<link rel="shortcut icon" href="images/fav.png" type="image/x-icon" />
	<link rel="stylesheet" href="styles/default.css" type="text/css" />
</head>
<body>
<div id = 'wrapper'>
<?php
echo "<hgroup>\n";
echo "\t<h1><a href = 'index.php'>" . $siteTitle . "</a></h1>\n";
echo "</hgroup>\n";

echo getNavMenu($externalLinks, $pageTitle);

echo getContentsMenu($currentPage);
?>

<div id = 'content'>
<?php
//TODO: Pagination?
$articleList = getArticleList($currentPage);
foreach ($articleList as $article)
{
	echo getArticleContent($currentPage, $article);
}

?>
</div>
<?php
if (isset($twitterAccount))
{
?>
<div id = 'twitterWidget'>
<script charset="utf-8" src="http://widgets.twimg.com/j/2/widget.js"></script>
<script>
new TWTR.Widget({
  version: 2,
  type: 'profile',
  rpp: 6,
  interval: 30000,
  width: 250,
  height: 550,
  theme: {
    shell: {
      background: '#000000',
      color: '#ffffff'
    },
    tweets: {
      background: '#000000',
      color: '#b8b8b8',
      links: '#787878'
    }
  },
  features: {
    scrollbar: false,
    loop: false,
    live: true,
    behavior: 'all'
  }
}).render().setUser('<?php echo $twitterAccount;?>').start();
</script>
</div>
<?php
}
?>
<footer>
<?php
echo $copyrightText;
?>
</footer>
</div>
</body>
</html>
