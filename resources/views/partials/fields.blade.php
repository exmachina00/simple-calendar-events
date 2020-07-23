<form action="">
    <div class="form-group">
        <label for="event">{{ __('fields.event') }}</label>
        <input type="text" class="form-control" name="name" id="event" 
            aria-describedby="evantName">
    </div>

    <div class="form-group d-flex">

        <div class="col-6 px-0">
            <label for="fromDate">{{ __('fields.date.from') }}</label>
            <input type="date" class="form-control form-inline" id="fromDate" 
                name="from"
                aria-describedby="fromDate">
        </div>

        <div class="col-6 px-0">
            <label for="fromDate">{{ __('fields.date.to') }}</label>
            <input type="date" class="form-control form-inline" id="fromDate" 
                name="from"
                aria-describedby="fromDate">
        </div>
    </div>

    {{--  --}}

    {{-- @todo: Find a better way for this. Avoid hard-coded options --}}
    <div class="form-group">
        <input type="checkbox" value="0"> test
        <input type="checkbox" value="0"> test
    </div>

</form>