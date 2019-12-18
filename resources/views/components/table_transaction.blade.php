{{-- table_transaction.blade.php 

  params:
  - title
  - [rows]
--}}
<div class="overflow-auto pa3">
  <table class="f6 w-100 depth-1 collapse text-1">
  <caption class="f4 lh-copy">{{ $title }}</caption>
    <thead class="dn">
      <tr>
        <th class="text-0 fw6 tc pa3 bb b--dark-gray">Date</th>
        <th class="text-0 fw6 tc pa3 bb b--dark-gray">Amount</th>
        <th class="text-0 fw6 tc pa3 bb b--dark-gray">Balance</th>
        <th class="text-0 fw6 tc pa3 bb b--dark-gray">Description</th>
      </tr>
    </thead>
    <tbody>
      @foreach($rows as $row)
        <tr @if ($loop->even) class="depth-2" @endif>
          <td class="ph3 pv1">{{ $row['date'] }}</td>
          <td class="text-1 ph3 pv1 tr">{{ $row['amount'] }}</td>
          <td class="text-1 ph3 pv1 tr">{{ $row['balance'] }}</td>
          <td class="ph3 pv1">
            <a class="link text-1 dim" href="{{ $row['edit_link'] }}">{{ $row['description'] }}</a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>