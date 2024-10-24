# Weather App

A simple web app to retrieve and display real-time weather data for any city using the OpenWeatherMap API.

## Description

This project allows users to search for a city's current weather, including temperature, weather conditions, humidity, and wind speed. It uses the OpenWeatherMap API to fetch the data and stores the search results in a MySQL database for logging.

## Getting Started

### Dependencies

* XAMPP/WAMP or any PHP-supported local server environment
* MySQL database
* Web browser
* OpenWeatherMap API key
* OS: Windows, macOS, or Linux

### Installing

* Clone the repository:
  ```bash
  git clone https://github.com/your-username/weather-app.git
  ```
* Set up a MySQL database named `weather_app`.
* Run the following SQL to create the necessary table:
  ```sql
  CREATE TABLE weather_logs (
      id INT AUTO_INCREMENT PRIMARY KEY,
      city VARCHAR(100),
      temperature FLOAT,
      description VARCHAR(255),
      humidity INT,
      wind_speed FLOAT,
      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
  );
  ```
* Insert your OpenWeatherMap API key in `getWeather.php`:
  ```php
  $apiKey = 'YOUR_OPENWEATHERMAP_API_KEY';
  ```

### Executing program

* Open the project folder in your local server (`htdocs` for XAMPP).
* In your browser, go to:
  ```url
  http://localhost/weather-app/index.html
  ```
* Enter the city name to fetch and display the weather data.

## Help

For common issues, ensure:
* Your API key is valid and not expired.
* Your MySQL server is running properly.
* Internet connectivity is stable.

## Authors

Shreyoshi Kar
[GitHub Profile](https://github.com/theSys12630)

## Version History

* 1.0
    * Initial Release



