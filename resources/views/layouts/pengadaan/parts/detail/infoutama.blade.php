<div class="tab-pane active" id="first1">
<dl class="mt25 uhui dl-horizontal">

  <dt>Unit Kerja</dt>
    <dd>{{ $user->unit->name }}</dd>
    <dt>Nama Pengaju</dt>
    <dd>{{ $procurement_array['user']['name'] }}</dd>
    <dt>Metode Lelang</dt>
    <dd>{{ $procurement->method }}</dd>
    <dt>Metode Kualifikasi</dt>
    <dd>{{ $procurement->qualification }}</dd>
    <dt>Metode Penyampaian</dt>
    <dd>{{ $procurement->deliverable }}</dd>
    <dt>Nama Pekerjaan</dt>
    <dd>{{ ucwords($procurement_array['title'])}} </dd>
    <dt>Nilai HPS</dt>
    <dd>Rp. {{ number_format($procurement_array['amount'], 0, ',', '.') }}</dd>
    <dt>Usulan Tanggal Mulai</dt>
    <dd>{{ date('d F Y', strtotime($procurement_array['start_date'])) }}</dd>
    <dt>Usulan Penyedia</dt>
    <dd>
      @php
      if($procurement_array['procurement_method'] > 3){
        foreach($procurement_array['enrollments'] as $no=>$val){
          echo $val['company']['name'];
          if($no != count($procurement_array['enrollments'])-1){
            echo ',';
          }
        }
      }else{
        echo '-';
      }
      @endphp
    </dd>
    <hr>
    <dt>Nota Dinas</dt>
    <dd>{{ $procurement_array['memo_number']}}</dd>
    @if(!empty($memo))
    <dd><a href="{{ URL::asset($memo['filepath']) }}" target="_blank">{{$memo['filename']}}</a></dd>
    @endif
    <dt>SPPP/B</dt>
    <dd>{{ $procurement_array['issuance_number'] }}</dd>
    @if(!empty($issuance))
    <dd><a href="{{ URL::asset($issuance['filepath']) }}" target="_blank">{{$issuance['filename']}}</a></dd>
    @endif
    <dt>RKS Teknis</dt>
    <dd>RKS-eprocurement</dd>
    @if(!empty($rks))
    <dd><a href="{{ URL::asset($issuance['filepath']) }}" target="_blank">{{$rks['filename']}}</a></dd>
    @endif
    <hr>
    <dt>Justifikasi </dt>
    <dd>{{ $procurement_array['justification'] }}</dd>
    <dt>Catatan Lain</dt>
    <dd>{{ $procurement_array['notes'] }}</dd>
  </dl>
  <hr>
<hr>
</div>
