{{-- table_template.blade.php 

  params:
  - title
  - [rows]
--}}
<section>
  <h3 class="clip">{{ $title }}</h3>
  <ol>
    @foreach ($rows as $row)
    <li class="list w-100">
      <div class="dib w4"><a href="{{ $row->edit_link }}">{{ $row->description }}</a></div>
      <div class="dib w3">{{ $row->date }}</div>
      <div class="dib w3">{{ $row->amount }}</div>
    </li>
    @endforeach
  </ol>
</section>