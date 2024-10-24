<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Arial, sans-serif';
            background: linear-gradient(to right, #ffefba, #ffffff);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .weather-container {
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            margin-bottom: 20px;
        }
        input[type="text"] {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="weather-container">
        <h1><i class="fas fa-cloud-sun"></i> Weather Forecast</h1>
        <form id="weather-form" method="POST" action="">
            <input type="text" name="city" placeholder="Enter city" required>
            <button type="submit">Get Weather</button>
        </form>
        <div id="weather-result">
            <?php
                // Database connection (if needed)
                $conn = new mysqli('localhost', 'root', '', 'weather_app');
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                if (isset($_POST['city'])) {
                    $city = htmlspecialchars($_POST['city']);
                    $apiKey = '288a8d2cd0942eb52f818f96a8ff3735';
                    $apiUrl = "http://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric";
                    // Fetch data from the API
                    $weatherData = @file_get_contents($apiUrl); // Using @ to suppress warnings
                    if ($weatherData === FALSE) {
                        echo "<p>Failed to retrieve weather data. Please check your API key or internet connection.</p>";
                    } else {
                        $weatherArray = json_decode($weatherData, true);
                        // Check if the response is valid
                        if (isset($weatherArray['cod']) && $weatherArray['cod'] == 200) {
                            $temperature = $weatherArray['main']['temp'];
                            $description = $weatherArray['weather'][0]['description'];
                            $humidity = $weatherArray['main']['humidity'];
                            $windSpeed = $weatherArray['wind']['speed'];
                            echo "<h2>Weather in $city</h2>";
                            echo "<p>Temperature: $temperature °C</p>";
                            echo "<p>Description: $description</p>";
                            echo "<p>Humidity: $humidity%</p>";
                            echo "<p>Wind Speed: $windSpeed m/s</p>";
                            // Store data in MySQL (if needed)
                            $stmt = $conn->prepare("INSERT INTO weather_logs (city, temperature, description, humidity, wind_speed) VALUES (?, ?, ?, ?, ?)");
                            $stmt->bind_param("sdssi", $city, $temperature, $description, $humidity, $windSpeed);
                            $stmt->execute();
                            $stmt->close();
                        } else {
                            echo "<p>City not found. Please try again.</p>";
                        }
                    }
                }
                $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
