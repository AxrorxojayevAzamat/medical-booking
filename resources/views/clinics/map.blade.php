 <!-- <h1>Test MAP</h1> -->
<ul class="contacts">
    <li>{{$clinic->name}}</li>
    <li>{{$clinic->address}}</li>
    <li>{{$clinic->location}}</li>
</ul> 
<div id="map_listing" class="normal_list">
                <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"/>
                <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
                       
                       <style>
                           #map {    width: 100%;
                                     height: 100%;
                                     position: absolute;
                                     top: 0;
                                     left: 0; }
                       </style>
                        <body>
                       <div id="map"></div>
                       
                       
                       <script>
                            var map = L.map('map').setView([41.311081, 69.240562],11);
                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png?{foo}', {foo: 'bar', attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>'})
                            .addTo(map);

                            var greenIcon = L.icon({
                                iconUrl: '/img/icons/clinic.png',
                                iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
                                iconSize:     [50, 50], // size of the icon
                                popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
                                    });

                                    var clinics_data = @json($clinic);
                                    console.log(clinics_data);
                                   
                                    let newArray = clinics_data.location.split(',');
                                            for(let a = 0; a < newArray.length; a++){
                                                newArray[a] = parseFloat(newArray[a]);
                                            }
                                            console.log(newArray.length)
                                            clinics_data.location = newArray;
                                            
                                            console.log(clinics_data.location)
                                            L.marker(clinics_data.location,{icon:greenIcon}).addTo(map).bindPopup(clinics_data.name_ru);
                                   
                                            
                            </script>
                        </div>