@if (session('success'))
    <div class="alert alert-info">
        <strong>{{ session('success') }}</strong>
    </div>
@endif