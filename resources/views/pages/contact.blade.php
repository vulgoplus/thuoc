@extends('layouts.app')

@section('title','Liên hệ')

@section('content')
    <div class="minimum">
        <div id="map"></div>
        <script>
          function initMap() {
            // Create a map object and specify the DOM element for display.
            var map = new google.maps.Map(document.getElementById('map'), {
              center: {lat: 20.792526, lng: 106.427429},
              scrollwheel: true,
              zoom: 15
            });
            var marker = new google.maps.Marker({
              position: {lat: 20.792526, lng: 106.427429},
              map: map
            });
          }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADmL-Ps9wO2y5jYY-WzSRLoAXzINlyQDo&callback=initMap"
        async defer></script>
    </div>
@endsection


