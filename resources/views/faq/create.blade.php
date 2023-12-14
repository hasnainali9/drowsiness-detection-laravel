<div class="modal-header">
    <h6 class="modal-title" id="staticBackdropLabel2">
        Create New FAQ
    </h6>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">

    <form method="POST" action="{{ route('faqs.store') }}">
        @csrf

        <div class="col-xl-12 mb-3">
            <label for="question" class="form-label text-default d-block">{{ __('Question') }}</label>
            <input id="question" type="text" class="form-control" required name="question" />
            @error('question')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="col-xl-12 mb-3">
            <label for="answer" class="form-label text-default d-block">{{ __('Answer') }}</label>
            <textarea class="form-control" id="answer" name="answer" rows="5"></textarea>
            @error('answer')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>



        <div class="row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Add FAQ') }}
                </button>
            </div>
        </div>
    </form>

</div>


