@if ($errors->any())
    <div class="form-errors" role="alert" tabindex="-1">
        <strong>Please review the following:</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
