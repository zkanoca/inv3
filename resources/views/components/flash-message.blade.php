{{-- {{ dd(session('message')) }} --}}
@if (session()->has('message'))
    <div class="toast align-items-center text-bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true"
        x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show">
        <div class="d-flex">
            <div class="toast-body">
                {{ session('message') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                aria-label="Close"></button>
        </div>
    </div>
@endif
