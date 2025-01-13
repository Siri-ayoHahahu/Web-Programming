<?php
$classRoomData = [
    "Mon" => [
        13 => "Data Analytic",
        14 => "Data Analytic",
        15 => "Data Analytic",
        16 => "Data Analytic",
    ],
    "Tue" => "",
    "Wed" => "",
    "Thu" => "",
    "Fri" => "",
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table,th,td {
            width: 10%;
            border: white 2px solid;
            border-collapse: collapse;   
            min-width: 90px;
        }
        #classroom thead {
            background-color: black;
            color: white;
        }
        #classroom {
            background-color: lightgray;
        }
        #classroom tbody th {
            background-color: gray;
            color: white;
        }
        .holiday {
            background-color: red;
            color: white;
        }
    </style>
</head>
<body>
    <table border="1" id="classroom">
        <thead>
        <tr>
            <th>Day/Time </th>
            <td>08.00-09.00 </td>
            <td>09.00-10.00 </td>
            <td>10.00-11.00 </td>
            <td>11.00-12.00 </td>
            <td>12.00-13.00 </td>
            <td>13.00-14.00 </td>
            <td>14.00-15.00 </td>
            <td>15.00-16.00 </td>
            <td>16.00-17.00 </td>
        </tr>
        </thead>
        <tbody>
        <?php foreach($classRoomData as $day => $subject) { ?>
        <tr>
            <th><?php echo $day ?> </th>
            <?php for($i=8; $i<17; $i++) { ?>
            <td>
                <?php echo !empty($subject[$i]) ? $subject[$i] : "" ?>
            </td>
            <?php } ?>
        </tr>
        <?php } ?>
        </tbody>
    </table>
</body>
</html>