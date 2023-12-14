<div class="modal-header">
    <h6 class="modal-title" id="staticBackdropLabel2">
        Create New SOS
    </h6>
    <button type="button" class="btn-close" data-bs-dismiss="modal"
            aria-label="Close"></button>
</div>
<div class="modal-body">

    <form method="POST" action="{{ route('sos-list.store') }}">
        @csrf
        <div class="col-xl-12 mb-3">
            <label for="name" class="form-label text-default">{{ __('User') }}</label>
            <select class="form-control select_2_picker" name="user_id" required>
                <option></option>
                @foreach(\App\Models\User::all() as $user)
                    <option value="{{$user->id}}">{{$user->name}} ({{$user->email}})</option>
                @endforeach
            </select>
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="col-xl-12 mb-3">
            <label for="phone_no" class="form-label text-default d-block">{{ __('Phone No') }}</label>
            <input id="phone_no" type="tel" class="form-control" required />
            <input type="hidden" name="phone_no" id="phone_no_full" required />
            @error('phone_no')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>


        <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" name="message" value="1" id="message" checked="">
            <label class="form-check-label" for="message">
                Message
            </label>
            @error('message')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" value="1" name="call" id="call" checked="">
            <label class="form-check-label" for="call">
                Call
            </label>
            @error('call')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>


        <div class="row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Add SOS No') }}
                </button>
            </div>
        </div>
    </form>

</div>


<script>
    $(document).ready(function() {
        const phoneInputField = document.querySelector("#phone_no");
        const phoneInput = intlTelInput(phoneInputField);

        $("#phone_no").on('change',function (){
            $("#phone_no_full").val(phoneInput.getNumber());
        });

        $(".select_2_picker").select2({
            placeholder: "Select a User",
            dropdownParent: $('#editModalGetAjax')
        });
    });
</script>
