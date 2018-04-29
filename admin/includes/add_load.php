
<form action="" method="post" enctype="multipart/form-data">
    <!-- Insert post -->
    <?php insert_load(); ?>
    <!-- <div class="form-group">
        <label for="post_by_ID">Company Name</label>
        <input type="text" class="form-control" name="post_by_ID" required>
    </div> -->

    <div class="form-group">
        <label for="date_exp">Date Expired</label>
        <input type="text" class="form-control" name="date_exp" placeholder="YYYY-MM-DD hh:mm">
    </div>

    <div class="form-group">
        <label for="date_pickup">Pick Up</label>
        <input type="text" class="form-control" name="date_pickup" placeholder="YYYY-MM-DD hh:mm" required>
        <label for="date_delivery">Delivery</label>
        <input type="text" class="form-control" name="date_delivery" placeholder="YYYY-MM-DD hh:mm" required>
    </div>

    <div class="form-group">
        <label for="location_pickup">Pickup Location</label>
        <input type="text" class="form-control" id="autocomplete" placeholder="Enter address here" onFocus="geolocate()"></input>
        <input type="text" class="form-control" id="street_number" name="addrNum_pickup" placeholder="Street Number" disabled="true">
        <input type="text" class="form-control" id="route" name="addr_pickup" placeholder="Street Name" disabled="true">
        <input type="text" class="form-control" id="locality" name="city_pickup" placeholder="City" disabled="true">
        <input type="text" class="form-control" id="administrative_area_level_1" name="state_pickup" placeholder="State" disabled="true">
        <input type="text" class="form-control" id="postal_code" name="zip_pickup" placeholder="Zip Code" disabled="true">
    </div>

    <div class="form-group">
        <label for="location_pickup">Delivery Location</label>
        <input type="text" class="form-control" id="autocomplete" placeholder="Enter address here" onFocus="geolocate()"></input>
        <input type="text" class="form-control" id="street_number" name="addrNum_delivery" placeholder="Street Number" disabled="true">
        <input type="text" class="form-control" id="route" name="addr_delivery" placeholder="Street Name" disabled="true">
        <input type="text" class="form-control" id="locality" name="city_delivery" placeholder="City" disabled="true">
        <input type="text" class="form-control" id="administrative_area_level_1" name="state_delivery" placeholder="State" disabled="true">
        <input type="text" class="form-control" id="postal_code" name="zip_delivery" placeholder="Zip Code" disabled="true">
    </div>

    <div class="form-group">
        <label for="load_info">Load Information</label>
        <input type="text" name="load_type" class="form-control" placeholder="Load Type" required>
        <input type="text" name="vehicle_size" class="form-control" placeholder="Vehicle Size" required>
        <input type="text" name="pieces" class="form-control" placeholder="Number of Pieces" required>
        <input type="text" name="load_weight" class="form-control" placeholder="Load Weight" required>
    </div>

    <div class="form-group">
        <label for="miles">Miles</label>
        <input type="text" class="form-control" name="miles" required>
    </div>

    <div class="form-group">
        <label for="budget">Price</label>
        <input type="text" class="form-control" name="budget" required>
    </div>

    <div class="form-group">
        <label for="note">Note</label>
        <textarea class="form-control" name="note" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-success" name="create_load" value="Post">
    </div>
</form>
<script>
    var placeSearch, autocomplete;
    var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
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
