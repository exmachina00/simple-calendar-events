<script type="application/json" ref="events">{!!
    json_encode($data['rs'], JSON_UNESCAPED_SLASHES);
!!}</script>

<full-calendar :events="events"/>
