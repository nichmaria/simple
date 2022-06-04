<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        p {
            color: #A7605A;
        }
    </style>
</head>

<body>
    <p> <?php echo $new->getHeading(); ?></p>
    <p> <?php if (!empty($new->author)) {
            echo 'written by ' . $new->author->getName();
        } ?>

    </p>
    <p> <?php echo $new->getContent(); ?></p>

    <p>
        <a href="<?php echo $new->id; ?>/edit">
            go to edit page
        </a>
    </p>


</body>


</html>