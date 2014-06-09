<?php

error_reporting(1);

class Point{
    public $x;
    public $y;
    
    public function __construct($x=NULL,$y=NULL){
        if($x){
            $this->x = $x;
        }
        if($y){
            $this->y = $y;
        }
    }
    public function SetXY($lat,$lon){
        $this->x = $lon;
        $this->y = $lat;
    }
    public function GetXY(){
        return array('Lat'=>$this->y,'Y'=>$this->y,'Lon'=>$this->x,'X'=>$this->x);
    }
};

$P = array();
$P[] = new Point(33.185692,76.541748);
$P[] = new Point(21.818158,89.296875);
$P[] = new Point(5.975997,80.551758);

?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Simple Polygon</title>
    <style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
    <script>
// This example creates a simple polygon representing the Bermuda Triangle.

function initialize() {
  var mapOptions = {
    zoom: 5,
    center: new google.maps.LatLng(21.818158,89.296875),
    mapTypeId: google.maps.MapTypeId.TERRAIN
  };

  var bermudaTriangle;

  var map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);

  // Define the LatLng coordinates for the polygon's path.
  var triangleCoords = [
    <?php
    $coords = "";
    for($i=0;$i<sizeof($P);$i++){
        $ll = $P[$i]->GetXY();
        $coords .= "new google.maps.LatLng({$ll['Lon']}, {$ll['Lat']}),\n";
    }
    $coords = trim($coords,",\n");
    echo $coords;
    ?>
  ];

  // Construct the polygon.
  bermudaTriangle = new google.maps.Polygon({
    paths: triangleCoords,
    strokeColor: '#FF0000',
    strokeOpacity: 0.8,
    strokeWeight: 2,
    fillColor: '#FF0000',
    fillOpacity: 0.35
  });

  bermudaTriangle.setMap(map);
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
  </head>
  <body>
    <div id="map-canvas"></div>
  </body>
</html>
