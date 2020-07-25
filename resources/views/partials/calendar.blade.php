<script type="application/json" ref="events">{!!
    json_encode($data['rs'], JSON_UNESCAPED_SLASHES);
!!}</script>

{{-- calendar view --}}
{{-- <full-calendar :events="events"></full-calendar> --}}

<calendar-list :events="events"></calendar-list>
