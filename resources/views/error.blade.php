@if (session('message'))
    <div class="container-fluid py-1">
        <div class="alert alert-warning alert-dismissible fade show mt-5" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
@endif

@if ($errors->any())
    <div class="container-fluid py-1">
        @error ('email')
        <div class="alert alert-warning alert-dismissible fade show mt-5" role="alert">
            {{$message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @enderror
        @error ('password' )
        <div class="alert alert-warning alert-dismissible fade show mt-5" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @enderror
        @error ('error')
        <div class="alert alert-warning alert-dismissible fade show mt-5" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @enderror
        @error ('success')
        <div class="alert alert-warning alert-dismissible fade show mt-5" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @enderror
    </div>
@endif
