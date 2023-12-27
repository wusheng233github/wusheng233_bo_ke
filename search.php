<html>
<head>
<title>
<?php
include "functions.php";
echo getconfig("config.txt", "标题:");
?>
</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=5.0">
<link rel="stylesheet" href="css/bootstrap.css"></link>
<script src="js/bootstrap.js"></script>
<meta charset="utf-8">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="light">
<div class="container-fluid">
<a class="navbar-brand" href="index.php"><?php echo getconfig("config.txt", "标题:"); ?></a>
<button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="navbar-collapse collapse" id="navbarColor03" style="">
<ul class="navbar-nav me-auto">
<li class="nav-item">
<a class="nav-link" href="index.php">首页
</a>
</li>
<li class="nav-item">
<a class="nav-link" href="submit.php">发布</a>
</li>
</ul>
<form class="d-flex" action="search.php" method="get">
<input class="form-control me-sm-2" type="search" name="s" placeholder="搜索">
<button class="btn btn-secondary my-sm-0" type="submit">搜索</button>
</form>
</div>
</div>
</nav>
<?php
if(isset($_GET["s"]) == true || empty($_GET["s"]) == false) {
function searchTitle($dir, $keyword, $searchPage) {
$it = new RecursiveIteratorIterator(
new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS),
RecursiveIteratorIterator::SELF_FIRST,
RecursiveIteratorIterator::CATCH_GET_CHILD
);
$results = array();
foreach($it as $path) {
if ($path->getFilename() == "config.json") {
$content = json_decode(file_get_contents($path->getPathname()), true);
if (strpos($content['title'], $keyword) !== false) {
$results[] = array(
'dir' => $path->getPath(),
'title' => $content['title']
);
}
}
}
$pageNumber = isset($searchPage) ? $searchPage : 1;
$itemsPerpage = 10;
$startIndex = ($pageNumber - 1) * $itemsPerpage;
$endIndex = $startIndex + $itemsPerpage;
for ($i = $startIndex; $i < $endIndex; $i++) {
if (!isset($results[$i])) {
break;
}
$result = $results[$i];
echo '
<div class="card">
<div class="card-body">
<h4 class="card-title">' . $result['title'] . '</h4>
<p class="card-text">' . getarticlecontent($result['dir'] . "/contents.md", 50) . '</p>
<a href="' . "viewer.php?w=" . str_replace("data", "", $result['dir']) . '" class="card-link">查看</a>
</div>
</div>
';
}
}
$search = $_GET["s"];
$searchPage = isset($_GET["page"]) ? $_GET["page"] : 1;
searchTitle('data', $search, $searchPage);
}
?>
</body>
</html>