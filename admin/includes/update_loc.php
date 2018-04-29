
<form action="" method="post" enctype="multipart/form-data">
    <!-- Update location -->
    <?php update_truck_loc(); ?>
    <div class="form-group">
        <label for="truck_time">Date *</label>
        <input class="form-control" type="text" name="truck_time" placeholder="YYYY-MM-DD hh:mm" required>
    </div>
    <div class="form-group">
        <label for="truck_loc">Location</label>
        <input class="form-control" id="autocomplete" type="text" placeholder="Zip code" onFocus="geolocate()"></input>
        <input class="form-control" id="locality" type="text" name="truck_city" placeholder="City" disabled="true">
        <input class="form-control" id="administrative_area_level_1" type="text" name="truck_state" placeholder="State" disabled="true">
        <input class="form-control" id="postal_code" type="text" name="truck_zip" placeholder="Zip code" disabled="true">
    </div>
    <div class="form-group">
        <input class="btn btn-success" type="submit" name="update" value="Update Location">
    </div>                          
</form>

<script>
    var placeSearch, autocomplete;
    var componentForm = {
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        postal_code: 'short_name'
    };

    function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical location types.
        autocomplete = new google.maps.places.Autocomplete(
            (document.getElementById('autocomplete')),
            {types: ['geocode']}
        );
        // When the user selects an address from the dropdown, populate the address fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
    }

    function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
            document.getElementById(component).value = '';
            document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
            }
        }
    }

      // Bias the autocomplete object to the user's geographical location, as supplied by the browser's 'navigator.geolocation' object.
    function geolocate() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                var circle = new google.maps.Circle({
                    center: geolocation,
                    radius: position.coords.accuracy
                });
                autocomplete.setBounds(circle.getBounds());
            });
        }
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDoVe8-O3eYkHkyc-f9VzQXh57Rp0QDNeg&libraries=places&callback=initAutocomplete" async defer>
</script>

