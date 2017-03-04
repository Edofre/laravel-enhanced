@if(isset($errors) && $errors->any())
    <div class="alert alert-danger" role="alert">
        @foreach($errors->all() as $key => $error)
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">{{ trans('common._error') }}</span>
            {{ $error }}
            <br/>
        @endforeach
    </div>
@endif