<html>
<head>
<title>
<?php
include "functions.php";
echo getconfig("config.txt", "标题:");
?>
</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=5.0">
<link rel="stylesheet" href="css/bootstrap.css" id="style"></link>
<script src="js/bootstrap.js"></script>
<script src="js/marked.min.js"></script>
<meta charset="utf-8">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="light">
<div class="container-fluid">
<a class="navbar-brand" href="index.php"><?php echo getconfig("config.txt", "标题:"); ?></a>
<button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="navbar-collapse collapse" id="navbarColor03">
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
<div id="oarticle" style="display:none;">
<?php
if(isset($_GET["w"]) == true || empty($_GET["w"] == false)) {
$contents = file_get_contents("data/" . $_GET["w"] . "/contents.md");
if(empty($contents) !== true) {
echo $contents;
} else {
echo "# 页面不存在 [返回主页](index.php)";
}
} else {
header('Location: index.php');
}
?>
</div>
<div id="article"></div>
</body>
<script>
oarticle = document.getElementById('oarticle');
article = document.getElementById('article');
article.innerHTML = marked.parse(oarticle.innerHTML||'');
</script>
</html>