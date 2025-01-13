<?php
include 'db_connect.php';
$classRoomData = [];

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $day = $_POST['day'];
    $time = $_POST['time'];
    $subject = $_POST['subject'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO class_schedule (day, time, subject) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $day, $time, $subject); // Assuming time is an integer

    if ($stmt->execute()) {
        echo "New record created successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch existing class schedule data
$sql = "SELECT day, time, subject FROM class_schedule"; 
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $classRoomData[$row['day']][$row['time']] = $row['subject'];
    }
} else {
    echo "No results found.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Schedule</title>
    <style>
        table, th, td {
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

    <!-- Form to add new class schedule data -->
    <h2>Add Class Schedule</h2>
    <form method="POST" action="">
        <label for="day">Day:</label>
        <select id="day" name="day" required>
            <option value="Monday">Monday</option>
            <option value="Tuesday">Tuesday</option>
            <option value="Wednesday">Wednesday</option>
            <option value="Thursday">Thursday</option>
            <option value="Friday">Friday</option>
            <option value="Saturday">Saturday</option>
            <option value="Sunday">Sunday</option>
        </select>
        
        <label for="time">Time (24-hour format):</label>
        <input type="number" id="time" name="time" min="8" max="16" required>
        
        <label for="subject">Subject:</label>
        <input type="text" id="subject" name="subject" required>
        
        <input type="submit" value="Add Schedule">
    </form>

    <table border="1" id="classroom">
        <thead>
            <tr>
                <th>Day/Time</th>
                <td>08.00-09.00</td>
                <td>09.00-10.00</td>
                <td>10.00-11.00</td>
                <td>11.00-12.00</td>
                <td>12.00-13.00</td>
                <td>13.00-14.00</td>
                <td>14.00-15.00</td>
                <td>15.00-16.00</td>
                <td>16.00-17.00</td>
            </tr>
        </thead>
        <tbody>
            <?php 
            // Define all days of the week
            $daysOfWeek = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
            
            // Loop through each day of the week
            foreach($daysOfWeek as $day) { ?>
            <tr>
                <th><?php echo htmlspecialchars($day); ?></th>
                <?php for($i = 8; $i < 17; $i++) { ?>
                <td>
                    <?php 
                    // Display the subject if it exists for the given day and time
                    echo !empty($classRoomData[$day][$i]) ? htmlspecialchars($classRoomData[$day][$i]) : ""; 
                    ?>
                </td>
                <?php } ?>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>