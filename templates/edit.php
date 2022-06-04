<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <p><?php
        foreach ($errors as $error) {
            echo $error->getMessage();
        }
        ?></p>
    <p>
    <form action="edit" method="post">
        <p><textarea rows="2" cols="20" name="heading"><?php echo $new->getHeading(); ?></textarea></p>
        <p><textarea rows="11" cols="60" name="content"><?php echo $new->getContent(); ?></textarea></p>
        <p style="text-indent:210px"><input type="submit" value="submit"></p>
    </form>
    </p>

    <p>
    <form action="http://php2hw1/articles/delete" method="post">
        <input type="submit" value="delete article" name="<?php echo $new->id; ?>" />
    </form>
    </p>
</body>


</html>