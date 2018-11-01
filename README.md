# WeatherStationProject

# Main page
![alt text](https://user-images.githubusercontent.com/32328856/47870685-cc1c8980-de12-11e8-803e-77e3edbb8355.PNG)
# Introduction
The weather station is a temperature and humidity measuring device built on a breadboard connected to Raspberry Pi and Arduino Uno. It combines different programming languages paired with certain hardware.

# How does it work?
Arduino reads data from the sensors via the input pins. The alteration between voltage levels are driven through Arduinos built-in AD-converter. Then the digital value is handled by the program code to correspond current humidity and temperature levels.

Arduino is running on a Raspberry Pi that has Apache and MySQL servers running. Current temperature and humidity levels are stored in a database and the values are shown on a web page. PHP is used to fetch the values from the database and HTML and CSS are used for the visual layout of the web page. The web page also contains a graph where the temperature can be inspected over the last 24 hours. Additionally, values from the previous day can be checked with a button. The measurements are done once every hour. 



