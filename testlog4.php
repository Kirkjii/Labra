<?php

//$url1=$_SERVER['REQUEST_URI'];
//header("Refresh: 5; URL=$url1");



$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "sensordata";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT Temperature, Humidity FROM Sensordata ORDER BY Timestamp DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {       
	$temperature = $row["Temperature"];
	$humidity = $row["Humidity"];

    }
} else {
    echo "0 results";
}
$conn->close();

?>



  <section>
	<h1><div class="fontawesome-calendar"> &nbsp;&nbsp;&nbsp;<?php echo date("d.m.Y");?></h1>
    <h1><div class="entypo-location"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Oulu, FI</h1>
    <h1><div class="entypo-clock">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo date("H:i:s");?></h1>
	
      <h2><div class="entypo-thermometer"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $temperature;?><span class="degree-symbol"> °</span><span class="celcius">C</span></h2>               
        <h2>	 
	<div class="fontawesome-tint center">
	<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $humidity;?>%</span>

	<br><br><a href="testlog3.php">Previous day</a>


	
<IMG STYLE="position:absolute; TOP:46px; LEFT:350px; WIDTH:1000px; HEIGHT: 600px" SRC="graafi.php">
	</h2>
      </div>         
  </section>
  
</div>

<div class="result"></div>̈́

<style>

@import "compass/css3";

/* Import Icon fonts and web font */

@import "https://fonts.googleapis.com/css?family=Open+Sans:400,300,700";
@import "http://weloveiconfonts.com/api/?family=entypo";
@import url(http://weloveiconfonts.com/api/?family=fontawesome);


/* entypo */
[class*="entypo-"]:before {
  font-family: 'entypo', sans-serif;
}

/* fontawesome */
[class*="fontawesome-"]:before {
  font-family: 'FontAwesome', sans-serif;
}




/* Colors declarations */

$lighterGray:     #E0E1E3;

$lightGray:       #4b4e57;
$mediumGray:      #373B46;
$darkGray:        #1F222A;
$darkerGray:      black;
$pink:            rgba(#D23A51, 0.9);
$font:            #eee;
$darkFont:        #60646e;
$icon:            #3D414C;




/* General styles */

.wrapper {
  width: 600px;
  height: 480px;
  margin: 10% auto;
  
  background-color: #1F222A;
  border-radius: 7px;
}

body {
  color: #eee;
  font-family: 'Open Sans', sans-serif;
  
  background-color: #E0E1E3
}

nav {
  width: 120px;
  height: 100%;
  float: left; 

  background-color: #373B46;
  border-radius: 7px;
  
  ul li{
    width: 120px;
    height: 90px;
    float: left;
    
    text-align: center;
    line-height: 90px;
    
    background-color: #373B46;
    
    &.last{
      height: 100px;
    
      line-height: 140px;
    }
    
    &.active{
      background-color: #4b4e57;
      border-radius: 7px 0px 0px 0px;
    }
    
    a{
      color: #eee;
      font-size: 2.2em;
      text-decoration: none;
      
      transition: font-size 0.2s;
      
      &:hover {
        font-size: 2.6em;
      }
    }
  }
}

section {
  
  height: 100%;
  width: 100%;
  box-sizing: border-box;
  padding: 20px 100px;
  float: left;
  position: relative;
  
  background-color: #1F222A;
  border-radius: 15px;
  
  h1 {  
    width: 400px;
    padding: 20px 0px 35px 0px;
    position: relative;
    
    font-size: 1.5em;
    
    border-bottom: 2px solid #4b4e57;
    
    a.add {
      width: 50px;
      height: 50px;
      position: absolute;
      top: 10px;
      right: 0px;
      
      color: $lightGray;
      font-size: 2.4em;
      text-align: center;
      line-height: 45px;
      text-decoration: none;
      
      background-color: black;
      border-radius: 3px;
      
      transition: color 0.5s;
      
      &:hover {
        color: $font;
      }
    }
  }
  
  .temperature {
    padding: 40px 0px;  
  
    color: $icon;
    font-size: 6em;
    
    transition: color 0.5s ease;
    
    &:hover {
        color: yellow;
    }
    
    h2 {
      display: inline;
      
      color: #eee;
      font-weight: 300;
      
      span.degree-symbol {
        display: inline-block;
        margin: 0px 15px;
        
        font-size: 0.6em;
        vertical-align: top;
      }
      
      span.celcius {
        display: inline-block;
        margin: 10px 0px 0px 15px;
        
        color: $icon;
        font-size: 0.3em;
        vertical-align: top;
      }
    }
  }
  
  ul {
    padding: 5px;
    margin-bottom: 70px;
    
    li {
      display: block;
      float: left;
      margin-right: 60px;
      
      color: $icon; 
      font-size: 2em;
      
      &:last-child {
        margin-right: 0px;
      }
      
      span {
        padding-left: 10px;
        
        color: $font; 
        font-size: 0.6em;
        line-height: 30px;
        vertical-align: top;
      }
    }
  }
  
  .bullets {  
    height: 70px;
    
    color: $icon;
    text-align: center;
    
    span {
      margin-right: 10px;
      
      font-size: 0.6em;
      
      &.active {
        color: $font;
        font-size: 0.8em;
      }
    }
  }
  
  a {
    color: $darkFont;
    font-size: 1.2em;
    text-decoration: none;
    
    transition: color 0.5s;
    
    &:hover {
      color: #eee;
    }
    
    .external-link {
      padding-left: 5px;
      
      font-size: 0.6em;
      vertical-align: middle;
    }
  }
  
  .share {
    width: 100px;
    height: 90px;
    position: absolute;
    bottom: 20px;
    right: -10px;
    
    color: #eee;
    font-size: 2em;
    text-align: center;
    line-height: 90px;
    
    background-color: $pink;
    
    transition: right 0.2s;
    
    &:hover {
      right: -20px;
    }
  }

}


</style>
