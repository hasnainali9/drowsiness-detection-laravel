@extends('layout.guest')
@section('title')
    Tracking Ride
@endsection

@section('content')


    <!-- Start::app-content -->
    <div class="">
        <div class="container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title my-auto">Ride Detail</h1>
            </div>
            <!-- PAGE-HEADER END -->
            <div class="row my-3">
                <div class="col-12 col-md-6">
                    <div class="card custom-card card-bg-secondary">
                        <div class="card-body">
                            <div class="d-flex align-items-center w-100">
                                <div class="">
                                    <div class="fs-15 fw-semibold">Source</div>
                                    <p class="mb-0 text-fixed-white op-7 fs-12">{{$rideRequest->source}}</p>
                                    <small><b>Lat</b> {{$rideRequest->source_lat}} <b>Lon</b> {{$rideRequest->source_long}}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card custom-card card-bg-primary">
                        <div class="card-body">
                            <div class="d-flex align-items-center w-100">
                                <div class="">
                                    <div class="fs-15 fw-semibold">Destination</div>
                                    <p class="mb-0 text-fixed-white op-7 fs-12">{{$rideRequest->destination}}</p>
                                    <small><b>Lat</b> {{$rideRequest->destination_lat}} <b>Lon</b> {{$rideRequest->destination_long}}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <div class="row my-3">
                <div class="col-12 col-md-6">
                    <div class="card custom-card card-bg-info">
                        <div class="card-body">
                            <div class="d-flex align-items-center w-100">
                                <div class="">
                                    <div class="fs-15 fw-semibold">Ride Duration</div>
                                    <p class="mb-0 text-fixed-white op-7 fs-12" id="rideDuration">0 mins</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card custom-card card-bg-success">
                        <div class="card-body">
                            <div class="d-flex align-items-center w-100">
                                <div class="">
                                    <div class="fs-15 fw-semibold">Ride Distance</div>
                                    <p class="mb-0 text-fixed-white op-7 fs-12" id="rideDistance">0 km</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>







            <!-- Map Container -->
            <div id="map" style="height: 400px;"></div>

            <div id="route-info"></div> <!-- To display distance and time -->

        </div>
    </div>
    <!-- End::app-content -->

    @push('scripts')
        <script>
            function initMap() {
                // Create a map centered at a specific location
                var map = new google.maps.Map(document.getElementById('map'), {
                    center: { lat: {{$rideRequest->source_lat}}, lng: {{$rideRequest->source_long}}},
                    zoom: 12
                });

                // Add source marker
                var sourceMarker = new google.maps.Marker({
                    position: { lat: {{$rideRequest->source_lat}}, lng: {{$rideRequest->source_long}} },
                    map: map,
                    title: 'Source'
                });





                // Add destination marker
                var destinationMarker = new google.maps.Marker({
                    position: { lat: {{$rideRequest->destination_lat}}, lng: {{$rideRequest->destination_long}} },
                    map: map,
                    title: 'Destination'
                });



                @foreach($rideRequest->rideDrownies as $key=>$drowny)

                var drownyMarker_{{$key}} = new google.maps.Marker({
                    position: { lat: {{$drowny->place_lat}}, lng: {{$drowny->place_long}} },
                    map: map,
                    icon: {
                        url: "{{$drowny->image}}",
                        scaledSize: new google.maps.Size(40, 40)
                    }
                });

                // Create InfoWindow for each drownyMarker
                var infoWindow_{{$key}} = new google.maps.InfoWindow({
                    content: '<div>' +
                        '<strong>Drowsiness Detected</strong><br>' +
                        'Location: {{$drowny->place}}<br>' +
                        '<a href="{{ $drowny->video }}" target="_blank">Check Video</a>' +
                        '</div>'
                });

                // Add click event listener to open the InfoWindow
                drownyMarker_{{$key}}.addListener('click', function() {
                    infoWindow_{{$key}}.open(map, drownyMarker_{{$key}});
                });

                @endforeach

                // Draw route
                var directionsService = new google.maps.DirectionsService();
                var directionsRenderer = new google.maps.DirectionsRenderer();
                directionsRenderer.setMap(map);

                var request = {
                    origin: sourceMarker.getPosition(),
                    destination: destinationMarker.getPosition(),
                    travelMode: 'DRIVING'
                };

                directionsService.route(request, function(result, status) {
                    if (status == 'OK') {
                        directionsRenderer.setDirections(result);

                        // Display distance and duration
                        var rideDistance = document.getElementById('rideDistance');
                        var rideDuration = document.getElementById('rideDuration');
                        rideDistance.innerHTML =  result.routes[0].legs[0].distance.text;
                        rideDuration.innerHTML = result.routes[0].legs[0].duration.text ;
                    }
                });
            }
        </script>

        <script async defer src="https://maps.googleapis.com/maps/api/js?key={{config('map.key')}}&libraries=places&callback=initMap"></script>
    @endpush
@endsection
