<validation-observer v-slot="{ handleSubmit }" slim>
    <form action="{{ route('event.store') }}" method="POST"
        v-on:submit.prevent="handleSubmit(store)"
        ref="eventForm"
    >
        @csrf
        
        <validation-provider name="{{ __('fields.event') }}" 
            rules="required"
            v-slot="{ errors }"
        >
            <div class="form-group">
                <label for="event">{{ __('fields.event') }}</label>
                <input type="text" class="form-control" name="name" id="event"
                    v-model="model.name"
                    :class="{ 'is-invalid': errors.length }" 
                    aria-describedby="evantName">

                <span v-show="errors" class="text-danger align-right">
                    @{{ errors[0] }}
                </span>
            </div>
        </validation-provider>

        <validation-observer v-slot="{ errors }" slim>
            <div class="form-group d-flex mb-2">
                
                <validation-provider rules="required"
                    name="fromDate" 
                    v-slot="{ errors }"
                    slim
                >
                    <div class="col-6 px-0">
                        <label for="fromDate">{{ __('fields.date.from') }}</label>
                        {{-- <input type="date" class="form-control" id="fromDate" 
                            v-model="model.from"
                            name="from"
                            :class="{ 'is-invalid': errors.length }" 
                            aria-describedby="fromDate"> --}}

                        <b-form-datepicker
                            name="from"
                            class="form-control mb-2"
                            :class="{ 'is-invalid': errors.length }" 
                            v-model="model.from"
                            button-variant="primary"
                            :date-format-options="{ year: 'numeric', month: 'numeric', day: 'numeric' }"
                            :state="errors.length == 0 ? null : false"
                        />
                    </div>
                </validation-provider>

                <validation-provider :rules="{ date_equal_or_after: '@fromDate' }" name="To" v-slot="{ errors }" slim>
                    <div class="col-6 px-0">
                        <label for="toDate">{{ __('fields.date.to') }}</label>

                         <b-form-datepicker
                            name="to"
                            class="form-control mb-2"
                            :class="{ 'is-invalid': errors.length }" 
                            v-model="model.to"
                            button-variant="primary"
                            :date-format-options="{ year: 'numeric', month: 'numeric', day: 'numeric' }"
                            :state="errors.length == 0 ? null : false"
                        />
                    </div>
                </validation-provider>
            </div>

            <div class="col-12 mb-2 pt-0" v-if="errors['To']">
                <span class="text-danger">@{{ errors['To'][0] }}</span>
            </div>
        </validation-observer>

        <div class="form-group">
            {{-- @todo: Find a better way for this, carbon mixin ?? --}}
            @foreach(\Carbon\Carbon::getDays() as $ndx => $value)
                @if ($ndx !== 0)
                    <input type="checkbox" value="{{ $ndx }}" name="days[]"> 
                    <span class="mr-1">{{ Str::substr($value, 0, 3) }}</span>
                @else
                    @push('lastDay')
                        <input type="checkbox" value="{{ $ndx }}" name="days[]"> 
                        <span class="mr-1">{{ Str::substr($value, 0, 3) }}</span>
                    @endpush
                @endif
            @endforeach

            @stack('lastDay')
        </div>

        <button class="btn btn-primary" role="button" :disabled="processing">
            <span v-show="processing">
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Loading...
            </span>

            <span v-show="! processing">{{ __('actions.save') }}</span>
        </button>

    </form>
</validation-observer>