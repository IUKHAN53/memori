<div>
    <div class="my-3">
        <label for="search"
               class="inline-block mb-2 text-base font-medium">
            {{ __('all.cemetery_plot_location') }}
        </label>
        <div class="flex rounded-lg shadow-sm">
            <input type="text" id="search"
                   class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
        </div>
    </div>
    <div
        wire:ignore id="map" style="width: 100%; height: 400px">
    </div>
    <div class="flex flex-col">
        <button  id="submit" class="bg-custom-400 rounded p-2 m-2 text-white" wire:click="setCoordinates" @click="show =false">
            {{ __('all.confirm_and_close')}}
        </button>
    </div>
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{config('app.google_api_key')}}&libraries=places">
    </script>
    <script>

        let map;
        let marker;
        let lat = 6.5244;
        let lng = 3.3792;

        initializeMap(lat, lng);
        placeMarker(new google.maps.LatLng(lat, lng));
        initializeAutocomplete();

        document.getElementById("submit").addEventListener("click", function () {
            if (marker) {
                let lat = marker.getPosition().lat();
                let lng = marker.getPosition().lng();

                @this.set('latitude', lat);
                @this.set('longitude', lng);
            }
        });

        function initializeMap(lat, lng) {
            var mapOptions = {
                center: new google.maps.LatLng(lat, lng),
                zoom: 12
            };
            map = new google.maps.Map(document.getElementById("map"), mapOptions);

            // Add click event listener to map
            google.maps.event.addListener(map, 'click', function (event) {
                placeMarker(event.latLng);
            });
        }

        function initializeAutocomplete() {
            var input = document.getElementById('search');
            var autocomplete = new google.maps.places.Autocomplete(input);

            autocomplete.addListener('place_changed', function () {
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    return;
                }
                var lat = place.geometry.location.lat();
                var lng = place.geometry.location.lng();

                if (marker) {
                    marker.setMap(null);
                }

                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(lat, lng),
                    map: map,
                    draggable: true
                });

                map.setCenter(new google.maps.LatLng(lat, lng));
                placeMarker(new google.maps.LatLng(lat, lng));
            });
        }

        function placeMarker(location) {
            if (marker) {
                marker.setMap(null);
            }

            marker = new google.maps.Marker({
                position: location,
                map: map,
                draggable: true
            });
        }
    </script>
</div>
