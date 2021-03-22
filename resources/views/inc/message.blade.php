@if (session('success'))
    <div class="alert alert-success">
        <strong>{{ session('success') }}</strong>
    </div>
@elseif (session('message'))
    <div class="alert alert-info">
        <strong>{{ session('message') }}</strong>
    </div>
@endif