{{-- table_template.blade.php 

  params:
  - title
  - [records]
--}}
<table class="silver">
  <caption>{{ $title }}</caption>
  <thead>
    <tr>
      <th>Description</th>
      <th>Date</th>
      <th>Amount</th>
    </tr>
  </thead>
    @foreach($records as $item)
    <tr>
      <td>{{ $item->description }}</td>
      <td>{{ $item->datetime }}</td>
      <td>{{ $item->amount }}</td>
    </tr>
    @endforeach
</table>