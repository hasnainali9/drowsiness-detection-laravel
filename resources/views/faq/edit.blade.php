<div class="modal-header">
    <h6 class="modal-title" id="staticBackdropLabel2">
        Edit SOS
    </h6>
    <button type="button" class="btn-close" data-bs-dismiss="modal"
            aria-label="Close"></button>
</div>
<div class="modal-body">

    <form method="POST" action="{{ route('faqs.update',$faq) }}">
        @csrf
        @method('PUT')
        <div class="col-xl-12 mb-3">
            <label for="question" class="form-label text-default d-block">{{ __('Question') }}</label>
            <input id="question" type="text" class="form-control" value="{{$faq->question}}" required name="question" />
            @error('question')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="col-xl-12 mb-3">
            <label for="answer" class="form-label text-default d-block">{{ __('Answer') }}</label>
            <textarea class="form-control" id="answer" name="answer" rows="5">{{$faq->answer}}</textarea>
            @error('answer')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>


        <div class="row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('update FAQ') }}
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
