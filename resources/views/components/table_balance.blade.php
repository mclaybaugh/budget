{{-- table_balance.blade.php 

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
      </tr>
    </thead>
    <tbody>
      @foreach($rows as $row)
        <tr>
          <td class="pa3">{{ $row['date'] }}</td>
          <td class="pa3">
            <a class="link text-1 dim" href="{{ $row['edit_link'] }}">{{ $row['amount'] }}</a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>