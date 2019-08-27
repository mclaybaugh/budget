{{-- table_template.blade.php 

  params:
  - title
  - [records]
--}}
<div class="overflow-auto pa3">
  <table class="f6 w-100 bg-near-black silver collapse">
    <thead>
      <tr>
        <th class="fw6 tc pa3 light-silver bb b--dark-gray">Description</th>
        <th class="fw6 tc pa3 light-silver bb b--dark-gray">Date</th>
        <th class="fw6 tc pa3 light-silver bb b--dark-gray">Amount</th>
      </tr>
    </thead>
      @foreach($records as $i => $item)
        @php
        $rowClass = ($i % 2 == 0) ? 'stripe-dark' : '';
        @endphp
        <tr @if ($i % 2 == 0) class="{{ $rowClass }}" @endif>
          <td class="pa3">{{ $item->description }}</td>
          <td class="pa3">{{ $item->datetime }}</td>
          <td class="pa3 tr">${{ number_format($item->amount) }}</td>
        </tr>
      @endforeach
  </table>
</div>