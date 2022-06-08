<?php require "config.php";  ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Search Outlet</title>
    <link rel="shortcut icon" href="<?=WEB_URL?>assets/img/favicon.png" type="image/png">

    <link rel="stylesheet" href="<?=WEB_URL?>assets/css/bootstrap-4.5.0.min.css">
    <link rel="stylesheet" href="<?=WEB_URL?>assets/fonts/LineIcons.css">
    <link rel="stylesheet" href="<?=WEB_URL?>assets/css/animate.css">
    <link rel="stylesheet" href="<?=WEB_URL?>assets/css/style.css">

    <script src="<?=WEB_URL?>assets/js/vendor/jquery-3.5.1-min.js" type="text/javascript"></script>
</head>

<body>

    <div class="map">
        <div id="map"></div>
    </div>
    <div class="side-menu">
        <div class="sidebar_header">
            <a href="<?=WEB_URL?>"><img src="<?=WEB_URL?>assets/img/logo.png" alt=""></a>
            <button class="btnToggle"><i class="lni lni-close"></i></button>
        </div>
        <div class="options">
            <ul class="form-filter">
                <li>
                    <span>Search by</span>
                </li>
                <li>
                    <input type="radio" checked name="f_filter" id="outlet">
                    <label for="outlet" id="lblOutlet">
                        <i class="lni lni-map-marker"></i>
                        <b>Outlet</b>
                    </label>
                </li>
                <li>
                    <input type="radio" name="f_filter" id="route">
                    <label for="route" id="lblRoute">
                        <i class="lni lni-travel"></i>
                        <b>Route</b>
                    </label>
                </li>
            </ul>
            <div class="outletForm">
                <div class="location from">
                    <div class="icon"><i class="lni lni-search-alt"></i></div>
                    <input class="input" type="text" name="from" id="txtSearch1" placeholder="Search Location">
                    <!--button class="btnclear"><i class="lni lni-close"></i></button-->
                </div>
            </div>
            <div class="routeForm">
                <h4 class="title">Plan your route</h4>
                <div class="location from">
                    <div class="icon"><i class="lni lni-map-marker"></i></div>
                    <input class="input" type="text" name="from" id="routeFrom" placeholder="Start Location">
                    <input type="hidden" value="" id="routeStartVal" />
                    <!--button class="btnclear"><i class="lni lni-close"></i></button-->
                </div>
                <div id="viaLocation">
                    <div class="location to">
                        <div class="icon"><i class="lni lni-pin"></i></div>
                        <input class="input" type="text" name="to" id="routeTo" placeholder="Enter destination">
                        <input type="hidden" value="" id="routeEndVal" />
                        <!--button class="btnclear"><i class="lni lni-close"></i></button-->
                    </div>
                </div>
                <div class="location add">
                    <div class="icon"><i class="lni lni-circle-plus"></i></div>
                    <button class="input" id="btnAddDestination">Add destination</button>
                </div>
            </div>
        </div>
        <ul class="filters">
            <li>
                <input type="radio" checked name="filter" id="all">
                <label for="all"></label>
            </li>
            <li>
                <input type="radio" name="filter" id="coco">
                <label for="coco"></label>
            </li>
            <li>
                <input type="radio" name="filter" id="swagat">
                <label for="swagat"></label>
            </li>
        </ul>
        <div class="list" id="list">
            
        </div>
    </div>

    <script src="<?=WEB_URL?>assets/js/Outlet.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?=GOOGLE_MAP_KEY?>&libraries=places&callback=initMap"></script>
    <script defer>
        var from = getREquestParameter('from');
        var to = getREquestParameter('to');
        var lat = getREquestParameter('lat');
        var long = getREquestParameter('long');
        var loc1 = getREquestParameter('location');
        initializeAutoSearch('routeFrom', 'routeStartVal');
        initializeAutoSearch('routeTo', 'routeEndVal');
        if(from != undefined && to != undefined) {
            $(".form-filter").find('#lblRoute').trigger('click');
            var fromArray = from.split('\|');
            var toArray = to.split('\|');
            $('#routeFrom').val(fromArray[3]);
            $('#routeStartVal').val(fromArray[4]);
            $('#routeTo').val(toArray[3]);
            $('#routeEndVal').val(toArray[4]);
            draw_polyline($('#routeStartVal').val(), $('#routeEndVal').val(), undefined);
        }
        if (lat != undefined && long != undefined) {
            if(loc1 != undefined) {
                var loc1Array = loc1.split('\|');
                $('#txtSearch1').val(loc1Array[1])
                filter_map(lat, long, loc1Array[0]);
            } else {
                filter_map(lat, long, undefined);
            }
        }
    </script>
    <script> const webUrl = '<?=WEB_URL?>'; </script>
</body>

</html>