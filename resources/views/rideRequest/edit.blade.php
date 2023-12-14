<script src="https://maps.googleapis.com/maps/api/js?key={{config('map.key')}}&libraries=places&callback=initAutocomplete" async></script>
<style>
    .pac-container {
        z-index: 10000 !important;
    }
</style>

<div class="modal-header">
    <h6 class="modal-title" id="staticBackdropLabel2">
        Edit Ride Request
    </h6>
    <button type="button" class="btn-close" data-bs-dismiss="modal"
            aria-label="Close"></button>
</div>
<div class="modal-body">

    <form method="POST" action="{{ route('ride-requests.update',$rideRequest) }}">
        @csrf
        @method('PUT')
        <div class="col-xl-12 mb-3">
            <label for="name" class="form-label text-default">{{ __('User') }}</label>
            <select class="form-control select_2_picker" name="user_id" required>
                <option></option>
                @foreach(\App\Models\User::all() as $user)
                    <option value="{{$user->id}}" @if($user->id==$rideRequest->user_id) selected @endif>{{$user->name}} ({{$user->email}})</option>
                @endforeach
            </select>
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>


        <div class="col-xl-12 mb-2">
            <label for="sourceInput" class="form-label text-default">{{ __('Source') }}</label>
            <input id="sourceInput" value="{{$rideRequest->source}}" type="text" class="form-control @error('source') is-invalid @enderror" name="source" required >

            @error('source')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="row mb-2">
            <div class="col-xl-6">
                <label for="source_lat" class="form-label text-default">{{ __('Source Lat') }}</label>
                <input type="text" class="form-control" value="{{$rideRequest->source_lat}}" name="source_lat" id="source_lat" required readonly />
            </div>
            <div class="col-xl-6">
                <label for="source_long" class="form-label text-default">{{ __('Source Lon') }}</label>
                <input type="text" class="form-control" value="{{$rideRequest->source_long}}" name="source_long" id="source_long" required readonly />
            </div>
        </div>





        <div class="col-xl-12 mb-2">
            <label for="destinationInput" class="form-label text-default">{{ __('Destination') }}</label>
            <input id="destinationInput" type="text" value="{{$rideRequest->destination}}" class="form-control @error('destination') is-invalid @enderror" name="destination" required >

            @error('destination')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="row mb-2">
            <div class="col-xl-6">
                <label for="destination_lat" class="form-label text-default">{{ __('Source Lat') }}</label>
                <input type="text" class="form-control" value="{{$rideRequest->destination_lat}}" name="destination_lat" id="destination_lat" required readonly />
            </div>
            <div class="col-xl-6">
                <label for="destination_long" class="form-label text-default">{{ __('Source Lon') }}</label>
                <input type="text" class="form-control" value="{{$rideRequest->destination_long}}" name="destination_long" id="destination_long" required readonly />
            </div>
        </div>

        <div class="col-xl-12 mb-3">
            <label for="status" class="form-label text-default">{{ __('Ride Status') }}</label>
            <select class="form-control" name="status" required>
                <option value="pending" @if($rideRequest->status=="pending") selected @endif>Pending</option>
                <option value="started" @if($rideRequest->status=="started") selected @endif>Started</option>
                <option value="ended" @if($rideRequest->status=="ended") selected @endif>Complete</option>
            </select>
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>


        <div class="row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Update Ride') }}
                </button>
            </div>
        </div>
    </form>

</div>


<script>
    let sourceAutocomplete;
    let destinationAutocomplete;

    /* ------------------------- Initialize Autocomplete ------------------------ */
    function initAutocomplete() {
        const sourceInput = document.getElementById("sourceInput");
        const destinationInput = document.getElementById("destinationInput");

        sourceAutocomplete = new google.maps.places.Autocomplete(sourceInput);
        destinationAutocomplete = new google.maps.places.Autocomplete(destinationInput);

        sourceAutocomplete.addListener("place_changed", onSourcePlaceChange);
        destinationAutocomplete.addListener("place_changed", onDestinationPlaceChange);
    }

    /* --------------------------- Handle Source Place Change ------------------- */
    function onSourcePlaceChange() {
        const sourcePlace = sourceAutocomplete.getPlace();
        $("#sourceInput").val( sourcePlace.formatted_address);
        $("#source_lat").val( sourcePlace.geometry.location.lat());
        $("#source_long").val( sourcePlace.geometry.location.lng());
    }

    /* --------------------------- Handle Destination Place Change --------------- */
    function onDestinationPlaceChange() {
        const destinationPlace = destinationAutocomplete.getPlace();
        $("#destinationInput").val( destinationPlace.formatted_address);
        $("#destination_lat").val( destinationPlace.geometry.location.lat());
        $("#destination_long").val( destinationPlace.geometry.location.lng());
    }

    $(document).ready(function() {
        $(".select_2_picker").select2({
            placeholder: "Select a User",
            dropdownParent: $('#editModalGetAjax'),
        });
    });
</script>

