<?php
    $conn = new mysqli('localhost', 'root', '', 'weather_app');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM weather_logs ORDER BY search_time DESC";
    $result = $conn->query($sql);

    echo "<h1>Weather Logs</h1>";
    echo "<table border='1'>
            <tr>
                <th>City</th>
                <th>Temperature (°C)</th>
                <th>Description</th>
                <th>Humidity (%)</th>
                <th>Wind Speed (m/s)</th>
                <th>Search Time</th>
            </tr>";

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['city']}</td>
                    <td>{$row['temperature']}</td>
                    <td>{$row['description']}</td>
                    <td>{$row['humidity']}</td>
                    <td>{$row['wind_speed']}</td>
                    <td>{$row['search_time']}</td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No records found.</td></tr>";
    }

    echo "</table>";

    $conn->close();
?>
