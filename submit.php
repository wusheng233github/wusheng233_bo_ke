<?php
if(isset($_POST["contents"]) == true || empty($_POST["contents"]) == false) {
echo "错误日志(请提交给服务器管理员)<br />";
echo "执行了发布<br />";
function id() {
global $id;
$id = dechex(rand(1, 100000000));
echo $id;
if(is_dir("data/" . $id)) {
id();
} else {
echo "执行submit()<br />";
submit($id);
}
}
function submit($id) {
echo "开始执行submit()<br />";
mkdir("data/" . $id, 0777, true);
echo "创建文件夹data/$id<br />";
file_put_contents("data/" . $id . "/contents.md", str_replace("<?php", "-----", $_POST["contents"]));
echo "创建md文档<br />";
file_put_contents("data/" . $id . "/config.json", '
{
"title": "' . str_replace("\"", "-", str_replace("\'", "-", str_replace("<?php", "-----", $_POST["title"]))) . '",
"time": ' . time() . '
}
');
echo "创建配置json<br />";
header('Location: index.php');
echo "跳转首页(您不应该看到这个)<br />";
}
id();
}
?>
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
<div class="navbar-collapse collapse" id="navbarColor03">
<ul class="navbar-nav me-auto">
<li class="nav-item">
<a class="nav-link" href="index.php">首页
</a>
</li>
<li class="nav-item">
<a class="nav-link active" href="submit.php">发布</a>
</li>
</ul>
<form class="d-flex" action="search.php" method="get">
<input class="form-control me-sm-2" type="search" name="s" placeholder="搜索">
<button class="btn btn-secondary my-sm-0" type="submit">搜索</button>
</form>
</div>
</div>
</nav>
<h1>发布您的内容</h1>
<h2>尽情编写，无需审核，支持Markdown。普通用户无法删除和修改，请仔细检查。</h2>
<form action="submit.php" method="post">
<input class="m-3" name="title" rows="1" style="height: 5vh;width: calc(100vw - 2rem);" placeholder="标题"></input>
<textarea class="form-control m-3" name="contents" rows="99999999999999999999999" style="height: 50vh;width: calc(100vw - 2rem);" placeholder="内容"></textarea>
<div class="d-grid gap-2">
<button class="btn btn-lg btn-primary" type="submit">提交</button>
</div>
</form>
</body>
</html>