<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        p {
            color: #2E8785;
        }
    </style>
</head>

<body>
    <?php

    foreach ($generator as $new) { ?>
        <p>
            <a href="articles/<?php echo $new->id; ?>">
                <?php echo $new->getHeading();  ?>
            </a>
        </p>
        <p><?php echo $new->getContent(); ?></p>

    <?php
    } ?>
    <p>
        <a href="articles/create">
            go to create page
        </a>
    </p>
</body>


</html>