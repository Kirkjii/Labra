<?php // content="text/plain; charset=utf-8"



// Jpgraph includet
DEFINE("TTF_DIR",dirname(__FILE__) . "/ttf/");
define('__ROOT__', dirname(dirname(__FILE__)));
require_once ('src/jpgraph.php');
require_once ('src/jpgraph_line.php');
require_once ('src/jpgraph_error.php');
require_once( "src/jpgraph_date.php" );

 
 // Taulukon alustaminen
$x_axis = array();
$y_axis = array();
$i = 0;

// Mysql yhteyden muodostaminen
$con=mysqli_connect("localhost","root","root","sensordata");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
 
 // Mysql query
$result = mysqli_query($con,"SELECT Temperature, Humidity, Timestamp  FROM Sensordata ORDER BY Timestamp DESC LIMIT 24");
 
// Queryn tulosten pilkkominen arrayihin


while($row = mysqli_fetch_array($result)) {
$x_axis[$i] = strtotime($row["Timestamp"]);
$y_axis[$i] = $row["Temperature"];
$i++;
}
    mysqli_close($con);
 
 
 // Graphin asetukset
$graph = new Graph(2000,800);
$graph->img->SetMargin(100,100,100,100);  
$graph->img->SetAntiAliasing();
$graph->SetScale("datint"); // toinen datlin
$graph->SetShadow();
$graph->title->Set($Timestamp."Temperature during last 24 hours");
$graph->title->SetFont(FF_DV_SANSSERIF,FS_NORMAL,24);
$graph->xaxis->scale->ticks->Set(10);
$graph->xaxis->title->Set('Time');
$graph->xaxis->title->SetFont(FF_DV_SANSSERIF,FS_NORMAL, 20);
$graph->yaxis->title->Set('Temperature');
$graph->yaxis->title->SetMargin(25,25,25,25);
$graph->yaxis->title->SetFont(FF_DV_SANSSERIF,FS_NORMAL, 20);
$graph->yaxis->SetFont(FF_DV_SANSSERIF,FS_NORMAL, 20);
// Use 20% "grace" to get slightly larger scale then min/max of data
$graph->yaxis->scale->SetGrace( 20 , 20 );
$graph->xaxis->SetPos( 'min' );
$graph->xaxis->scale->SetDateFormat('H:i');
 
// Fontti
//$graph->SetUserFont();
//$graph->title->SetFont(FF_USERFONT,FS_NORMAL,18);
 
 // Graphin luominen
$p1 = new LinePlot($y_axis, $x_axis);
$p1->mark->SetType(MARK_FILLEDCIRCLE);
$p1->mark->SetFillColor("red");
$p1->mark->SetWidth(4);
$p1->SetColor("blue");
$p1->SetCenter();
$graph->Add($p1);
$graph->Stroke();

?>