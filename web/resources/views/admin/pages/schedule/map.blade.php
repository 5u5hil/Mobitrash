@extends('admin.layouts.default')
@section('content')
<section class="content-header">
    <h1>
        Schedule
        <small>Map</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.schedule.view') }}"><i class="fa fa-coffee"></i>Schedule</a></li>
        <li class="active">Map</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">

                <div class="box-header with-border">
                    <h3 class="box-title"><b>{{$schedule->name}}</b></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div id="map" style="width: 100%; height: 500px;"></div>
                </div>

            </div>
        </div>
    </div>
</section>


@stop 

@section('myscripts')

<script>
    var locations = [
<?php
foreach ($pickups as $pickup):
    if ($pickup['subscription']['address']['latitude'] && $pickup['subscription']['address']['longitude']) {
        echo "['<h4>" . $pickup['subscription']['name'] . "</h4>', " . $pickup['subscription']['address']['latitude'] . ", " . $pickup['subscription']['address']['longitude'] . "],";
    }
endforeach;
?>
    ];
     var pickupCoordinates = [
    <?php
foreach ($pickups as $pickup):
    if ($pickup['subscription']['address']['latitude'] && $pickup['subscription']['address']['longitude']) {
        echo "{lat: ".$pickup['subscription']['address']['latitude'].", lng: ".$pickup['subscription']['address']['longitude']."},";
    }
endforeach;
?>  
  ];
    var iconURLPrefix = 'http://maps.google.com/mapfiles/ms/icons/';
    var icons = [
        iconURLPrefix + 'red-dot.png',
        iconURLPrefix + 'green-dot.png',
        iconURLPrefix + 'blue-dot.png',
        iconURLPrefix + 'orange-dot.png',
        iconURLPrefix + 'purple-dot.png',
        iconURLPrefix + 'pink-dot.png',
        iconURLPrefix + 'yellow-dot.png'
    ]
    var iconsLength = icons.length;
    
   
  var pickupPath = new google.maps.Polyline({
    path: pickupCoordinates,
    geodesic: true,
    strokeColor: '#FF0000',
    strokeOpacity: 1.0,
    strokeWeight: 3
  });

  
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 10,
        center: new google.maps.LatLng(-37.92, 151.25),
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        mapTypeControl: false,
        streetViewControl: false,
        panControl: false,
        zoomControlOptions: {
            position: google.maps.ControlPosition.LEFT_BOTTOM
        }
    });
    var infowindow = new google.maps.InfoWindow({
        maxWidth: 160
    });
    var markers = new Array();
    var iconCounter = 0;
    for (var i = 0; i < locations.length; i++) {
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
            map: map,
            icon: icons[iconCounter]
        });
        markers.push(marker);
        google.maps.event.addListener(marker, 'click', (function (marker, i) {
            return function () {
                infowindow.setContent(locations[i][0]);
                infowindow.open(map, marker);
            }
        })(marker, i));
        iconCounter++;
        // We only have a limited number of possible icon colors, so we may have to restart the counter
        if (iconCounter >= iconsLength) {
            iconCounter = 0;
        }
    }
    
    pickupPath.setMap(map);

    function autoCenter() {
        var bounds = new google.maps.LatLngBounds();
        for (var i = 0; i < markers.length; i++) {
            bounds.extend(markers[i].position);
        }
        map.fitBounds(bounds);
    }
    autoCenter();
</script>

@stop