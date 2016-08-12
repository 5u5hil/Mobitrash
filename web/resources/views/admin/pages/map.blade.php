@extends('admin.layouts.default')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Van Tracking Map
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border bg-green">
                    <h3 class="box-title">{{@$schedule->van->name}}</h3>                    
                </div>
                <div class="box-body">
                    <div id="map" style="width: 100%;height: 500px;">
                        <?php if(empty($locations)){
                            echo 'No Tracking Data Found.';
                        }?>
                    </div>
                </div>
            </div>
        </div>  
    </div>   
</section>

@stop
@section('myscripts')

<script>

<?php
$joureny = '[';
foreach ($locations as $key => $location) {
    if ($key != 0) {
        $joureny .= ',';
    }
    $joureny .= '{lat: ' . $location['latitude'] . ', lng: ' . $location['longitude'] . '}';
}
$joureny .= ']';
?>

    var jmap = {};
    var markerHeading = 0;
    var polyline;
    var marker;
    var position = [];
    var journey_path = <?php echo $joureny; ?>;
    var symbol = {
        path: 'M181.298,386.264c-29.77,0-53.915,24.145-53.915,53.827c0,29.769,24.145,53.914,53.915,53.914 c29.683,0,53.827-24.146,53.827-53.914C235.125,410.409,210.981,386.264,181.298,386.264z M181.298,467.091 c-14.885,0-27-12.115-27-27c0-14.798,12.115-26.914,27-26.914c14.797,0,26.913,12.115,26.913,26.914 C208.211,454.976,196.096,467.091,181.298,467.091z M134.888,386.287H14.228c-4.779,0-8.653,3.874-8.653,8.653v26.256 c0,4.779,3.874,8.653,8.653,8.653h96.714C113.468,412.524,122.212,397.219,134.888,386.287z M462.981,386.264 c-29.684,0-53.827,24.145-53.827,53.827c0,29.769,24.144,53.914,53.827,53.914c29.769,0,53.826-24.146,53.826-53.914 C516.808,410.409,492.75,386.264,462.981,386.264z M462.981,467.091c-14.885,0-26.914-12.115-26.914-27 c0-14.798,12.029-26.914,26.914-26.914c14.884,0,26.913,12.115,26.913,26.914C489.895,454.976,477.865,467.091,462.981,467.091z M603.347,386.264h-21.029V268.658c0-13.759-4.154-27.259-11.856-38.683l-52.701-78.057 c-12.809-19.039-34.356-30.462-57.375-30.462h-81.692c-9.52,0-17.308,7.702-17.308,17.308v247.5H227.683 c12.635,10.99,21.375,26.222,23.885,43.615h141.144c4.933-34.355,34.529-60.923,70.27-60.923c35.739,0,65.336,26.567,70.355,60.923 h70.01c4.847,0,8.653-3.895,8.653-8.654v-26.307C612,390.158,608.192,386.264,603.347,386.264z M517.153,245.552H409.327 c-4.76,0-8.654-3.808-8.654-8.654v-59.797c0-4.76,3.896-8.654,8.654-8.654h65.683c2.855,0,5.539,1.384,7.097,3.634l42.145,59.884 C528.317,237.677,524.163,245.552,517.153,245.552z M320.192,368.956H17.307C7.749,368.956,0,361.208,0,351.649v-77.885 c0-9.559,7.749-17.308,17.307-17.308h302.885c9.559,0,17.308,7.749,17.308,17.308v77.885 C337.5,361.208,329.751,368.956,320.192,368.956z M138.462,230.495H17.307C7.749,230.495,0,222.745,0,213.187v-77.884 c0-9.559,7.749-17.308,17.307-17.308h121.154c9.559,0,17.308,7.749,17.308,17.308v77.884		C155.77,222.745,148.021,230.495,138.462,230.495z M320.192,230.495H199.039c-9.559,0-17.308-7.749-17.308-17.307v-77.885 c0-9.559,7.749-17.307,17.308-17.307h121.154c9.559,0,17.308,7.749,17.308,17.307v77.885 C337.5,222.745,329.751,230.495,320.192,230.495z',
        scale: 0.05,
        fillColor: '#000',
        fillOpacity: 1,
        rotation: markerHeading
    }
    var initJMap = function () {
        var myLatLng = new google.maps.LatLng(<?php echo @$locations[0]['latitude']; ?>, <?php echo @$locations[0]['longitude']; ?>);
        position = [<?php echo @$locations[0]['latitude']; ?>, <?php echo @$locations[0]['longitude']; ?>];
        jmap = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            mapTypeControl: false,
            streetViewControl: false,
            panControl: false,
            scrollwheel: false,
            navigationControl: false,
            center: myLatLng
        });
        marker = new google.maps.Marker({
            position: myLatLng,
            map: jmap,
            icon: symbol,
        });
        //drawPolyline();
        }
    initJMap();
    
         ////////////////////////////////Marker
    var iconURLPrefix = 'http://maps.google.com/mapfiles/ms/icons/';
    var icons = [
        iconURLPrefix + 'red-dot.png',
        iconURLPrefix + 'green-dot.png',
        iconURLPrefix + 'blue-dot.png',
        iconURLPrefix + 'orange-dot.png',
        iconURLPrefix + 'purple-dot.png',
        iconURLPrefix + 'pink-dot.png',
        iconURLPrefix + 'yellow-dot.png'
    ];

    var locations = [
<?php
foreach ($pickups as $pickup):
    if ($pickup['subscription']['address']['latitude'] && $pickup['subscription']['address']['longitude']) {
        echo "['<h4>" . htmlspecialchars($pickup['subscription']['name'],ENT_QUOTES) . "</h4>', " . $pickup['subscription']['address']['latitude'] . ", " . $pickup['subscription']['address']['longitude'] . "],";
    }
endforeach;
?>
    ];

    var infowindow = new google.maps.InfoWindow({
        maxWidth: 160
    });
    var iconsLength = icons.length;
    var markers = new Array();
    var iconCounter = 0;
    for (var i = 0; i < locations.length; i++) {
        var marker1 = new google.maps.Marker({
            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
            map: jmap,
            icon: icons[iconCounter]
        });
        markers.push(marker1);
        google.maps.event.addListener(marker1, 'click', (function (marker, i) {
            return function () {
                infowindow.setContent(locations[i][0]);
                infowindow.open(jmap, marker);
            }
        })(marker1, i));
        iconCounter++;
        // We only have a limited number of possible icon colors, so we may have to restart the counter
        if (iconCounter >= iconsLength) {
            iconCounter = 0;
        }
    }
    function autoCenter() {
        var bounds = new google.maps.LatLngBounds();
        bounds.extend(marker.position);
        for (var i = 0; i < markers.length; i++) {
            bounds.extend(markers[i].position);
        }
        jmap.fitBounds(bounds);
    }
    autoCenter();
    var numDeltas = 100;
    var delay = 10; //milliseconds
    var i = 0;
    var deltaLat;
    var deltaLng;
    function journeyTransition(result) {
        i = 0;
        deltaLat = (result[0] - position[0]) / numDeltas;
        deltaLng = (result[1] - position[1]) / numDeltas;
        moveJMarker();
        if (!checkMarkerInside(marker)) {
            //jmap.setCenter(marker.getPosition()); //autocenter if out of bound
        }

    }
    function checkMarkerInside(marker) {
        if (jmap.getBounds()) {
            return jmap.getBounds().contains(marker.getPosition());
        } else {
            return false;
        }
    }
    function moveJMarker() {
        position[0] += deltaLat;
        position[1] += deltaLng;
        var latlng = new google.maps.LatLng(position[0], position[1]);
        marker.setPosition(latlng);
        marker.setIcon(symbol);
        if (i != numDeltas) {
            i++;
            setTimeout(moveJMarker, delay);
        }
    }

//    function drawPolyline() {
//        var poly_path = journey_path;
//        if (poly_path.length < 1) {
//            poly_path = [];
//        }
//        polyline = new google.maps.Polyline({
//            path: poly_path,
//            strokeColor: '#FF0000',
//            strokeOpacity: 1.0,
//            strokeWeight: 3
//        });
//        polyline.setMap(jmap);
//    }
    setInterval(function () {
        $.ajax({
            url: "<?= route('admin.location.get') ?>",
            type: "POST",
            data: {
                id: <?php echo $van->id ?>,
            },
            success: function (response) {
                //journey_path.push({lat: response.latitude, lng: response.longitude});
                journeyTransition([response.latitude, response.longitude]);
                //drawPolyline();
            }
        });
    }, 3000);


</script>

@stop