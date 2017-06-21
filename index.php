<?
require 'page.class.php';
$Page = new Page($_GET['id']);
?>
<!DOCTYPE html>
<html>
<head>
    <title><?=$Page->title?></title>
</head>
<body>
    <h1><?=$Page->name?></h1>
    <p>Дата публикации: <?=$Page->formatDate?></p>
    <p>
        <?=$Page->content?>
    </p>
</body>
</html>
