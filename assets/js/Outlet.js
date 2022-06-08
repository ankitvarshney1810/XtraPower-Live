$(".form-filter").find('#lblOutlet').click(function() {
    $(".outletForm").show();
    $(".routeForm").hide();
    console.log("Outlet");
});
$(".form-filter").find('#lblRoute').click(function() {
    $(".outletForm").hide();
    $(".routeForm").show();
    console.log("Route");
});

var getREquestParameter = function(name) {
    if (name = (new RegExp('[?&]' + encodeURIComponent(name) + '=([^&]*)')).exec(location.search))
        return decodeURIComponent(name[1]);
};

//Toggle Hide SideBar

$(".btnToggle").click(function() {
    $(".side-menu").toggleClass('hide');
    $("#map").toggleClass('expendMap');
    $(".btnToggle").find('.lni').toggleClass('lni-close lni-list');
});

//Initialize Map
var map;
var locations = [
    ['SWAGAT COCO Barauni', '31', 'Begusarai, Bihar', '25.425222', '86.102944', 1, 1, 1, 1, 1, 1, 1, 'COCO'],
    ['SWAGAT Sutara Petroleum', '31', 'Katihar, Bihar', '25.471754', '87.266535', 1, 1, 1, 1, 1, 1, 1, 'COCO'],
    ['SWAGAT COCO Piprakothi', '28', 'East Champaran, Bihar', '26.526488', '84.953405', 1, 1, 1, 1, 1, 1, 1, 'COCO'],
    ['SWAGAT Sanjeev Jubilee Petroleum', '57', 'Muzaffarpur, Bihar', '26.115264807834', '85.5517064140015', 1, 1, 1, 1, 1, 1, 1, 'COCO'],
    ['SWAGAT COCO Bawal', '8', 'Rewari, Haryana', '28.067904', '76.550147', 1, 1, 1, 1, 1, 1, 1, 'COCO'],
    ['SWAGAT COCO Manesar', '8', 'Gurgaon, Haryana', '28.342606', '76.937775', 1, 1, 1, 1, 1, 1, 1, 'COCO'],
    ['SWAGAT COCO Moraiya', '8A', 'Ahmedabad, Gujarat', '22.90997', '72.43072', 1, 1, 1, 1, 1, 1, 1, 'COCO'],
    ['SWAGAT Shree Ganesh Petroleum', '8A', 'Kutch, Gujarat', '23.197639', '70.228261', 1, 1, 1, 1, 1, 1, 1, 'COCO'],
    ['SWAGAT Shri Nidhi Petroleum', '8Ae', 'Kutch, Gujarat', '22.921', '69.78', 1, 1, 1, 1, 1, 1, 1, 'COCO'],
    ['SWAGAT COCO Maliya', '8A', 'Morbi, Gujarat', '23.081001', '70.791966', 1, 1, 1, 1, 1, 1, 1, 'COCO'],
    ['SWAGAT COCO Narsapura', '4', 'Kolar, Karnataka', '13.133631', '77.975233', 1, 1, 1, 1, 1, 1, 1, 'COCO'],
    ['SWAGAT COCO Mummigatti', '4', 'Dharwad, Karnataka', '15.5015672', '74.9556848', 1, 1, 1, 1, 1, 1, 1, 'COCO'],
    ['SWAGAT Sri Vinayaka Petroleums', '13', 'Bijapur, Karnataka', '17.2261369444444', '75.8050061111111', 0, 1, 0, 1, 1, 1, 0, 'COCO'],
    ['SWAGAT COCO Pongam', '47', 'Thrissur, Kerala', '10.2458541', '76.3704152', 1, 1, 1, 1, 1, 1, 1, 'COCO'],
    ['SWAGAT COCO Vallarpadam', '47', 'Ernakulam, Kerala', '9.985013', '76.248273', 0, 1, 1, 1, 1, 1, 1, 'COCO'],
    ['SWAGAT COCO Siltara', '30', 'Raipur, Chhattisgarh', '21.366582', '81.664752', 1, 1, 1, 1, 1, 1, 1, 'COCO'],
    ['SWAGAT COCO Madirhasoud', '6', 'Raipur, Chhattisgarh', '21.2277', '81.794408', 1, 1, 1, 1, 1, 1, 1, 'COCO'],
    ['SWAGAT COCO Bilavali', '3', 'Dewas, Madhya Pradesh', '22.994244', '76.088176', 1, 1, 1, 1, 1, 1, 1, 'COCO'],
    ['SWAGAT Gaurav Auto Care', '3', 'Thane, Maharashtra', '19.337559', '73.112436', 1, 1, 1, 1, 1, 1, 1, 'COCO'],
    ['SWAGAT Novel Fuel Station', 'Mumbai-Pune Eway', 'Raigarh, Maharashtra', '18.793527', '73.296022', 1, 1, 1, 1, 1, 1, 1, 'COCO'],
    ['SWAGAT Shri Swami Samarth Auto', '548D', 'Pune, Maharashtra', '18.759117', '73.836274', 1, 0, 0, 1, 1, 1, 0, 'COCO'],
    ['SWAGAT COCO Kuksa', '161', 'Washim, Maharashtra', '20.1907358', '76.7804144', 0, 1, 1, 1, 1, 1, 1, 'COCO'],
    ['SWAGAT COCO Chhatia', '5', 'Jajpur, Odisha', '20.597263', '86.051285', 0, 1, 1, 1, 1, 1, 1, 'COCO'],
    ['SWAGAT COCO Sabulay', '5', 'Ganjam, Odisha', '19.471328', '85.084689', 0, 1, 1, 1, 1, 1, 1, 'COCO'],
    ['SWAGAT COCO Hasnabad', '5', 'Jajpur, Odisha', '20.67', '86.12873', 1, 1, 1, 1, 1, 1, 1, 'COCO'],
    ['SWAGAT Sambit Jyoti Highway Service', '5', 'Baleshwar, Odisha', '25.0211', '73.85705', 1, 1, 1, 1, 1, 1, 1, 'COCO'],
    ['SWAGAT COCO Gumjal', '62', 'Fazilka, Punjab', '29.9768719', '73.9010891', 1, 1, 1, 1, 1, 1, 1, 'COCO'],
    ['SWAGAT Maan Service Station', '148 B', 'Bathinda, Punjab', '30.123901', '74.999748', 0, 1, 0, 1, 1, 1, 0, 'COCO'],
    ['SWAGAT COCO Jalampura', '79', 'Chittaurgarh, Rajasthan', '24.81763', '74.63064', 1, 1, 1, 1, 1, 1, 1, 'COCO'],
    ['SWAGAT Ratanpur Indianoil Filling Station', '8', 'Dungarpur, Rajasthan', '23.7531', '73.466', 1, 1, 1, 1, 1, 1, 1, 'COCO'],
    ['SWAGAT Vijayvargia Indianoil', '79', 'Ajmer, Rajasthan', '26.3118', '74.7491', 1, 1, 1, 1, 1, 1, 1, 'COCO'],
    ['SWAGAT COCO Mm Nagar', '45', 'Chengalpattu, Tamil Nadu', '12.767177', '79.996959', 1, 1, 1, 1, 1, 1, 1, 'COCO'],
    ['SWAGAT COCO Nammakkal', '7', 'Namakkal, Tamil Nadu', '11.1922515', '78.0961787', 0, 1, 1, 1, 1, 1, 1, 'COCO'],
    ['SWAGAT COCO Chengapalli', '47', 'Tirupur, Tamil Nadu', '11.203144', '77.427355', 1, 1, 1, 1, 1, 1, 1, 'COCO'],
    ['SWAGAT COCO Mela Arasaradi', '45B', 'Tuticorin, Tamil Nadu', '8.886412', '78.109125', 0, 1, 1, 1, 1, 1, 1, 'COCO'],
    ['SWAGAT COCO Anakapalli', '5', 'Vishakhapatnam, Andhra Pradesh', '17.676488', '83.01538', 1, 1, 1, 1, 1, 1, 1, 'COCO'],
    ['SWAGAT Sri Surya Filling Stn', '5', 'East Godavari, Andhra Pradesh', '17.050843', '81.855853', 1, 1, 1, 1, 1, 1, 1, 'COCO'],
    ['SWAGAT COCO Ongole', '5', 'Prakasam, Andhra Pradesh', '15.399744', '80.039653', 0, 1, 1, 1, 1, 1, 1, 'COCO'],
    ['SWAGAT COCO Krishnapatnam', '57', 'Nellore, Andhra Pradesh', '14.260328', '80.013362', 1, 1, 1, 1, 1, 1, 1, 'COCO'],
    ['SWAGAT RKBK Ghulamipur', '2', 'Kaushambi, Uttar Pradesh', '25.640842', '81.377327', 1, 1, 1, 1, 1, 1, 1, 'COCO'],
    ['SWAGAT COCO Unnao', '25', 'Unnao, Uttar Pradesh', '26.602395', '80.605489', 1, 1, 1, 1, 1, 1, 1, 'COCO'],
    ['SWAGAT Sonbarsa Automobiles', '28', 'Gorakhpur, Uttar Pradesh', '26.740978', '83.568936', 0, 1, 1, 1, 1, 1, 1, 'COCO'],
    ['SWAGAT Mohini F Stn', '2', 'Mathura, Uttar Pradesh', '27.373761', '77.698605', 1, 1, 1, 1, 1, 1, 1, 'COCO'],
    ['SWAGAT RKBK Limited', '24', 'Shahjahanpur, Uttar Pradesh', '27.874463', '79.85417', 1, 1, 1, 1, 1, 1, 1, 'COCO'],
    ['SWAGAT COCO Agra Lucknow Eway 101', 'Agra-Lucknow Eway', 'Mainpuri, Uttar Pradesh', '26.968347', '79.01919', 0, 1, 0, 0, 1, 1, 1, 'COCO'],
    ['SWAGAT COCO Agra Lucknow Eway 104', 'Agra-Lucknow Eway', 'Etawah, Uttar Pradesh', '26.958218', '79.046761', 0, 1, 0, 0, 1, 1, 1, 'COCO'],
    ['SWAGAT COCO Haldia', '41', 'Purba Medinipur, West Bengal', '22.0664', '88.0724', 1, 1, 1, 1, 1, 1, 1, 'COCO'],
    ['SWAGAT COCO Hoogalberia', '41', 'Purba Medinipur, West Bengal', '22.3694', '87.8595', 1, 1, 1, 1, 1, 1, 1, 'SWAGAT'],
    ['SWAGAT Mahamaya Filling Station', '2', 'Purba Bardhaman, West Bengal', '23.363262', '87.64102', 0, 1, 1, 1, 1, 1, 1, 'COCO'],
    ['SWAGAT COCO Narayanpur', '34', 'Malda, West Bengal', '25.069709', '88.145772', 1, 1, 1, 1, 1, 1, 1, 'SWAGAT']
];

var markers = [];

function initMap() {
    // PUT COUNT ON FILTERS
    $('.filters').find('label[for=all]').html('All (' + locations.length + ')');
    $('.filters').find('label[for=coco]').html('COCO Outlets (' + (locations.filter(l => l[12] === 'COCO')).length + ')');
    $('.filters').find('label[for=swagat]').html('Swagat Outlets (' + (locations.filter(l => l[12] === 'SWAGAT')).length + ')');

    /** AUTO COMPLETE BLOCK */
    var input = document.getElementById('txtSearch1');
    var options = {
        componentRestrictions: {country: 'in'}
    };
    var autocomplete = new google.maps.places.Autocomplete(input, options);
    autocomplete.setFields(['geometry', 'name', 'address_components']);
    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        var place = autocomplete.getPlace();
        console.log(place.name + ' ' + place.geometry.location.lat() + ' ' + place.geometry.location.lng());
        console.log(JSON.stringify(place.address_components));
        var redirect = webUrl + 'search-outlet.php?lat=' + place.geometry.location.lat() +
            '&long=' + place.geometry.location.lng() + '&location=' + encodeURIComponent(place.name.toLowerCase() + '|'+$('#txtSearch1').val());
        window.location.href = redirect;
    });



    /** MAP VIEW */
    var center = { lat: Number(locations[0][3]), lng: Number(locations[0][4]) };
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 9,
        center: center
    });
    var infowindow = new google.maps.InfoWindow({});
    var marker, count;
    document.getElementById('list').innerHTML = '';

    for (count = 0; count < locations.length; count++) {
        // create list map list for search
        document.getElementById('list').innerHTML += list_item(locations[count], count);

        marker = new google.maps.Marker({
            position: new google.maps.LatLng(Number(locations[count][3]), Number(locations[count][4])),
            map: map,
            animation: google.maps.Animation.DROP,
            title: locations[count][0]
        });
        google.maps.event.addListener(marker, 'click', (function(marker, count) {
            return function() {
                infowindow.setContent(marker_window(count, locations[count]));
                infowindow.open(map, marker);
            }
        })(marker, count));

        markers.push(marker);
        if (count == 0)
            google.maps.event.trigger(marker, 'click')

    }
}

var marker_window = function(count, data) {
    return '<div class="info_content">' +
        '<h5>' + data[0].toLowerCase().replace(/\b(\w)/g, x => x.toUpperCase()) + '</h5>' +
        '<p>NH. ' + data[1] + ', ' + data[2] + '</p>' +
        '<p><a href="https://maps.google.com/?q=' + data[3] + ',' + data[4] + '" target="_blank">Get Direction</a></p></div>';
};

var list_item = function(data, count) {
    return `<a class="item detail anchor" id="list_`+count+`" href="javascript:void(0)" onclick="markLocation(` + count + `, this)">
                <span class="title">`+data[0]+`</span>
                <span class="address">`+data[1]+`, `+data[2]+`</span>
            </a>`;
}

var markLocation = function(count, object) {
    map.setCenter(new google.maps.LatLng(Number(locations[count][3]), Number(locations[count][4])));
    google.maps.event.trigger(markers[count], 'click');

    var ele = document.getElementsByClassName('anchor');
    for (var i = 0; i < ele.length; i++)
        ele[i].classList.remove('active');
    object.classList.add("active");
}

$('input[name=filter]').on('click', function() {
    // console.log($(this).attr('id'));
    var id = $(this).attr('id');
    var temp = 0;
    for (var count = 0; count < locations.length; count++) {
        if(id == 'all') {
            markers[count].setVisible(true);
            $('#list_'+count).css('display', 'block');
            if(temp === 0) {
                map.setCenter(new google.maps.LatLng(Number(locations[0][3]), Number(locations[0][4])));
                google.maps.event.trigger(markers[count], 'click');
                temp++;
            }
        } else if(id == 'coco') {
            if(locations[count][12] === 'COCO' && temp === 0) {
                map.setCenter(new google.maps.LatLng(Number(locations[0][3]), Number(locations[0][4])));
                google.maps.event.trigger(markers[count], 'click');
                temp++;
            }
            markers[count].setVisible(locations[count][12] === 'COCO');
            $('#list_'+count).css('display', locations[count][12] === 'COCO' ? 'block' : 'none');
        } else if(id == 'swagat') {
            if(locations[count][12] === 'SWAGAT' && temp === 0) {
                map.setCenter(new google.maps.LatLng(Number(locations[0][3]), Number(locations[0][4])));
                google.maps.event.trigger(markers[count], 'click');
                temp++;
            }
            markers[count].setVisible(locations[count][12] === 'SWAGAT');
            $('#list_'+count).css('display', locations[count][12] === 'SWAGAT' ? 'block' : 'none');
        }
    }
});

var polyline;
var draw_polyline = function(start, end, waypoints) {
    var tempLocations = [];
    if(polyline)
        polyline.setMap(null);

    var directionsService = new google.maps.DirectionsService();
    var directionsRequest = {
        origin: start.trim(),
        destination: end.trim(),
        //waypoints: waypoints,
        optimizeWaypoints: true,
        travelMode: google.maps.DirectionsTravelMode.DRIVING,
        unitSystem: google.maps.UnitSystem.METRIC
    };
    if(waypoints != undefined && waypoints.length > 0) {
        directionsRequest['waypoints'] = waypoints;
    }
    
    directionsService.route(directionsRequest, function (response, status) {
        if (status == google.maps.DirectionsStatus.OK) {                    
            //console.log(response);
            const symbolOne = {
                path: "M -2,0 0,-2 2,0 0,2 z",
                strokeColor: "#ec691f",
                strokeWeight: 2
            };
            
            polyline = new google.maps.Polyline({
                path: [],
                strokeColor: '#5499d8',
                strokeWeight: 5,
                icons: [
                    {
                        icon: symbolOne,
                        offset: "0%",
                    },
                    {
                        icon: symbolOne,
                        offset: "100%",
                    }
                ]
            });
            var bounds = new google.maps.LatLngBounds();
        
            var legs = response.routes[0].legs;
            for (i=0; i<legs.length; i++) {
                var steps = legs[i].steps;
                for (j=0; j<steps.length; j++) {
                    var nextSegment = steps[j].path;
                    for (k=0; k<nextSegment.length; k++) {
                        polyline.getPath().push(nextSegment[k]);
                        bounds.extend(nextSegment[k]);
                    }
                }
            }
            polyline.setMap(map);
            map.fitBounds(bounds);

            // check if lat longs are near to polyline
            var temp = 0;
            for (var count = 0; count < locations.length; count++) {
                var myPosition = new google.maps.LatLng(Number(locations[count][3]), Number(locations[count][4]));
                // console.log(google.maps.geometry.poly.isLocationOnEdge(myPosition, polyline, 10e-1));
                if (google.maps.geometry.poly.isLocationOnEdge(myPosition, polyline, 0.05)) {
                    // console.log(count + " = Relocate!");
                    markers[count].setVisible(true);
                    // document.getElementById('list').innerHTML += list_item(locations[count], count);
                    $('#list_'+count).css('display', 'block');
                    if(temp == 0){
                        google.maps.event.trigger(markers[count], 'click');
                    }
                    temp++;
                } else {
                    markers[count].setVisible(false); // maps API hide call
                    $('#list_'+count).css('display', 'none');
                }
            }
        }
        else{
            console.log("failed to fetch data....");
        }
    });
};

const options = {
    componentRestrictions: {country: 'in'}
};

var initializeAutoSearch = function(idText, idHidden) {
    var input = document.getElementById(idText);
    var autocomplete = new google.maps.places.Autocomplete(input, options);
    autocomplete.setFields(['address_components']);
    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        var place = autocomplete.getPlace();
        // console.log(idHidden + ' = ' + setAddressComponentValue(place.address_components));
        $('#'+idHidden).val(setAddressComponentValue(place.address_components));
        $('#'+idHidden).trigger('change');
    });
};

//Append Via Destination
var parentDiv = $("#viaLocation");
$("#btnAddDestination").click(function() {
    for(var i = 1; i <= 100; i++) {
        console.log($('#routeEndVal'+i).val());
        if($('#routeEndVal'+i).val() == undefined) {
            var listItem = "<div class='location to'><div class='icon'><i class='lni lni-pin'></i></div><input class='input' type='text' name='to' id='routeTo"+i+"' placeholder='Enter destination'><input type='hidden' value='' id='routeEndVal"+i+"' /><button class='btnclear' onclick='closeLocationDiv(this)'><i class='lni lni-close'></i></button></div>";
            parentDiv.append(listItem);
            initializeAutoSearch('routeTo'+i, 'routeEndVal'+i);
            break;
        }
    }
});

var closeLocationDiv = function(object) {
    var div = $(object).closest('.location');
    console.log(div);
    div.remove();
    $('#routeStartVal').trigger('change');
}

var setAddressComponentValue = function(address_components) {
    var val = '';
    $.each(address_components, function(key, value) {
        val += value.short_name + ',';
    });
    if(val.endsWith(',')) {
        val = val.substring(0, val.length-1);
    }
    return val;
};

$('.routeForm').on('change', '#routeStartVal, [id^=routeEndVal]', function() {
    var start = $('#routeStartVal').val();
    var routes = $('[id^=routeEndVal]');
    var end;
    
    var finalRoutes = [];
    for(var i = 0; i < routes.length; i++) {
        // console.log(routes[i]);
        var via = $(routes[i]).val();
        if(via != undefined && via.trim() != '')
            finalRoutes.push(routes[i]);
    }

    var waypoints = [];
    for(var i = 0; i < finalRoutes.length; i++) {
        var via = $(finalRoutes[i]).val();
        if(i == finalRoutes.length - 1) {
            end = via;
            continue;
        } else {
            waypoints.push({
                location: via.trim(),
                stopover: true,
            });
        }
    }

    if(start.trim() == '') {
        $('#routeStart').trigger('focus');
        return false;
    } else if(end == undefined || end.trim() == '') {
        $('#routeEnd').trigger('focus');
        return false;
    }
    console.log(start + ' ||  ' + end + ' ||  ' + routes.length);
    draw_polyline(start, end, waypoints);
});

var filter_map = function(lat, long, loc) {
    var temp = -1;
    var arrays = [];
    let map1 = new Map();
    console.log(lat + ', ' + long + ', ' + loc);
    if (loc) {
        for (var count = 0; count < locations.length; count++) {
            if (locations[count][2].toUpperCase().indexOf(loc.toUpperCase()) >= 0) {
                arrays.push(count);
            }
        }
    }
    // arrays.includes(count)
    for (var count = 0; count < locations.length; count++) {
        var distance = distanceInLatLong(lat, long, locations[count][3], locations[count][4], 'K');
        // console.log(lat +', '+ long +', '+ locations[count][3] +', '+ locations[count][4] +' == ' + distance);
        if (distance <= 100 && !arrays.includes(count)) {
            arrays.push(count);
            map1.set(distance, count);
        }
    }
    console.log(arrays);
    $('[id^=list_]').css('display', 'none');
    for (var tmp = 0; tmp < arrays.length; tmp++) {
        $('#list_'+arrays[tmp]).css('display', 'block');
        if (tmp == 0) {
            map.setCenter(new google.maps.LatLng(Number(locations[arrays[tmp]][3]), Number(locations[arrays[tmp]][4])));
            google.maps.event.trigger(markers[arrays[tmp]], 'click');
        }
    }
};

function distanceInLatLong(lat1, lon1, lat2, lon2, unit) {
    if ((lat1 == lat2) && (lon1 == lon2)) {
        return 0;
    } else {
        var radlat1 = Math.PI * lat1 / 180;
        var radlat2 = Math.PI * lat2 / 180;
        var theta = lon1 - lon2;
        var radtheta = Math.PI * theta / 180;
        var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
        if (dist > 1) {
            dist = 1;
        }
        dist = Math.acos(dist);
        dist = dist * 180 / Math.PI;
        dist = dist * 60 * 1.1515;
        if (unit == "K") { dist = dist * 1.609344 }
        if (unit == "N") { dist = dist * 0.8684 }
        return dist;
    }
}