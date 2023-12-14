<div class="modal-header">
    <h6 class="modal-title" id="staticBackdropLabel2">
        Edit User
    </h6>
    <button type="button" class="btn-close" data-bs-dismiss="modal"
            aria-label="Close"></button>
</div>
<div class="modal-body">

    <form method="POST" action="{{ route('admins.update',$user) }}">
        @csrf
        @method('PUT')
        <div class="col-xl-12 mb-3">
            <label for="name" class="form-label text-default">{{ __('Name') }}</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name??old('name') }}" required >
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="col-xl-12 mb-3">
            <label for="email" class="form-label text-default">{{ __('Email Address') }}</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email??old('email') }}" required >

            @error('email')
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
            @enderror
        </div>

        <div class="col-xl-12 mb-2">
            <label for="password" class="form-label text-default">{{ __('New Password') }}</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
            @enderror
        </div>

        <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" name="super_admin" id="super_admin" @if($user->super_admin) checked @endif >
            <label class="form-check-label" for="super_admin">
                Super Admin
            </label>
            @error('super_admin')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>


        <div class="row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Update') }}
                </button>
            </div>
        </div>
    </form>

</div>

