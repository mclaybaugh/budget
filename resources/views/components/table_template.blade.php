{{-- table_template.blade.php 

  params:
  - title
  - [rows]
--}}
<div class="overflow-auto pa3">
  <table class="f6 w-100 depth-1 collapse text-1">
  <caption class="f4 lh-copy">{{ $title }}</caption>
    <colgroup>
      <col span="1" style="width: 50%">
      <col span="1" style="width: 25%">
      <col span="1" style="width: 25%">
    </colgroup>
    <thead class="dn">
      <tr>
        <th class="text-0 fw6 tc pa3 bb b--dark-gray">Description</th>
        <th class="text-0 fw6 tc pa3 bb b--dark-gray">Date</th>
        <th class="text-0 fw6 tc pa3 bb b--dark-gray">Amount</th>
      </tr>
    </thead>
    <tbody>
      @foreach($rows as $row)
        <tr>
          <td class="pa3">
            <a class="link text-1 dim" href="{{ $row['edit_link'] }}">{{ $row['description'] }}</a>
          </td>
          <td class="pa3">{{ $row['date'] }}</td>
          <td class="text-1 pa3 tr">{{ $row['amount'] }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>