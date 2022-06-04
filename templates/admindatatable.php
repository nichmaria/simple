<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            border: 2px solid #A890D5;
            color: #007A6B;

        }

        td,
        th {
            border: 1px solid #A890D5;
            padding: 10px 20px;
        }

        th {
            background-color: rgb(235, 235, 235);
        }

        td {
            text-align: center;
        }

        tr:nth-child(even) td {
            background-color: rgb(250, 250, 250);

        }

        tr:nth-child(odd) td {
            background-color: rgb(245, 245, 245);

        }
    </style>
</head>

<body>
    <table>
        <?php
        foreach ($objects as $object) {
            echo "<tr>";
            foreach ($functions as $function) {
                echo "<td>" . $function($object) . "</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>
</body>

</html>