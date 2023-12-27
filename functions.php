<?php
function getconfig($file, $item) {
$file = fopen($file, "r") or die("Unable to open file!");
$found = false;
while(!feof($file)) {
$line = fgets($file);
if($found) {
return $line;
break;
}
if(strpos($line, $item) !== false) {
$found = true;
}
}
fclose($file);
}
function getarticlecontent($file, $count) {
$content = file_get_contents($file);
$content = mb_substr($content, 0, $count);
$content = str_replace("<?php", "-----", $content);
if (mb_strlen($content, 'UTF-8') > $count - 1) {
$content = mb_substr($content, 0, $count - 1, 'UTF-8') . "...";
}
return $content;
}