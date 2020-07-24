<form action="{{ route('event.store') }}" method="POST"
    v-on:submit.prevent="store"
    ref="eventForm">
    @csrf

    <div class="form-group">
        <label for="event">{{ __('fields.event') }}</label>
        <input type="text" class="form-control" name="name" id="event" 
            aria-describedby="evantName">
    </div>

    <div class="form-group d-flex">

        <div class="col-6 px-0">
            <label for="fromDate">{{ __('fields.date.from') }}</label>
            <input type="date" class="form-control" id="fromDate" 
                name="from"
                aria-describedby="fromDate">
        </div>

        <div class="col-6 px-0">
            <label for="fromDate">{{ __('fields.date.to') }}</label>
            <input type="date" class="form-control"
                id="fromDate" 
                name="to"
                aria-describedby="fromDate">
        </div>
    </div>

    <div class="form-group">
        {{-- @todo: Move Sunday to last --}}
        @foreach(\Carbon\Carbon::getDays() as $ndx => $value)
            <input type="checkbox" value="{{ $ndx }}" name="days[]"> 
            {{ Str::substr($value, 0, 3) }}
        @endforeach
    </div>

    <button class="btn btn-primary" role="button" :disabled="processing">
        <span v-show="processing">
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Loading...
        </span>

        <span v-show="! processing">{{ __('actions.save') }}</span>
    </button>

</form>
