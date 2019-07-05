<div class="tab-pane" id="nego">
  <h3>
    Negosiasi
  <span class="pcr-date">{{ $schedule->a_negotiation }}</span>
  </h3>
  <hr>
  <p>
    @if($negotiating_name != '')
      Peserta yang saat ini dinegosiasi: {{ $negotiating_name }}
    @else
      Belum ada negosiasi
    @endif
  </p>
  <hr>
</div>
