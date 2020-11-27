@extends('home.layouts.main')
@section('style')
<style type="text/css">
  table.dataTable thead .sorting:after,
  table.dataTable thead .sorting:before,
  table.dataTable thead .sorting_asc:after,
  table.dataTable thead .sorting_asc:before,
  table.dataTable thead .sorting_asc_disabled:after,
  table.dataTable thead .sorting_asc_disabled:before,
  table.dataTable thead .sorting_desc:after,
  table.dataTable thead .sorting_desc:before,
  table.dataTable thead .sorting_desc_disabled:after,
  table.dataTable thead .sorting_desc_disabled:before {
    bottom: .5em;
  }
</style>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
@endsection

@section('content')
<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Stt
      </th>
      <th class="th-sm">Họ và tên
      </th>
      <th class="th-sm">Pháp Danh
      </th>
      <th class="th-sm">Thể loại
      </th>
      <th class="th-sm">Chức vụ
      </th>
    </tr>
  </thead>
  <tbody>
    @foreach($official as $detail_official)
    <tr>
      <td>{{$loop->index + 1}}</td>
      <td><a href="{{route('official.detail',$detail_official->slug)}}">{{$detail_official->name}}</a></td>
      <td>{{$detail_official->alias}}</td>
      <td>@if($detail_official->Category){{$detail_official->Category->name}}@endif</td>
      <td>@if($detail_official->Position){{$detail_official->Position->name}}@endif</td>
    </tr>
    @endforeach
  </tbody>
  <tfoot>
    <tr>
      <th class="th-sm">Stt
      </th>
      <th class="th-sm">Họ và tên
      </th>
      <th class="th-sm">Pháp Danh
      </th>
      <th class="th-sm">Thể loại
      </th>
      <th class="th-sm">Chức vụ
      </th>
    </tr>
  </tfoot>
</table>
@endsection

@section('script')
<script type="text/javascript" src="/assets/js/jquery/jquery.min8ce6.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $('#dtBasicExample').DataTable({
      "paging": false 
    });
    $('.dataTables_length').addClass('bs-select');
  });
</script>
@endsection
