@php 
    $alertClass = 'alert-success';

    /**
     * @todo: Enhance this!
     */

    if(session('success')) {
        $message = session('success');
    } else if(session('error')) {
        $message = session('error') ?? session('errors')->all();
        $alertClass = 'alert-danger';
    } else if (session('errors')) {
        $message = session('errors')->all();
        $alertClass = 'alert-danger';
    }

@endphp

@isset ($message)
    <div class="form-group row justify-content-center">
        <div class="col-md-8 alert {{ $alertClass }} row justify-content-center" role="alert">
            @if (is_array($message))
                <ul>
                    @foreach ($message as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @else
                {{ $message }}
            @endif
        </div>
    </div>
@endisset