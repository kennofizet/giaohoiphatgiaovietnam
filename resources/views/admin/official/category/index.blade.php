@extends('admin.layouts.main')
@section('style')
<link href="{{url('/')}}/admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Bảng dữ liệu</h1>
<p class="mb-4">Bảng dữ liệu này sử dụng js, sẽ gây ra tình trạng lag nếu danh sách quá nhiều (khoảng vài nghìn thể loại), nếu gặp tình trạng lag khi tải danh sách này vui lòng liên hệ <a target="_blank"
        href="https://www.facebook.com/houtarounokata/">lập trình viên</a> để được hỗ trợ.</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách thể loại</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTableAdminOfficialListCategory" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Tên/ Số nhân sự</th>
                        <th>Nội dung tóm tắt</th>
                        <th>Nội dung chi tiết</th>
                        <th>Cập nhật</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Tên/ Số nhân sự</th>
                        <th>Nội dung tóm tắt</th>
                        <th>Nội dung chi tiết</th>
                        <th>Cập nhật</th>
                        <th>Hành động</th>
                    </tr>
                </tfoot>
                <tbody>
                	@foreach($list_official_category as $detail_category)
                    <tr>
                        <td>{{$detail_category->name}} ({{$detail_category->Official->count()}})</td>
                        <td>{{$detail_category->description}}</td>
                        <td>{{$detail_category->content}}</td>
                        <td>{{Carbon\Carbon::createFromTimestamp(strtotime($detail_category->updated_at))->diffForHumans()}}</td>
                        <td>
                        	<button class="btn btn-primary" type="button" data-id="{{$detail_category->id}}" class="button_admin_official_category_edit"><a href="{{route('admin.official.category.edit',$detail_category->id)}}" style="color: white">Sửa</a></button>
                        	<button class="btn btn-danger" type="button" data-toggle="modal" data-target="#adminOfficialListCategoryModalDelete{{$detail_category->id}}">Xóa</button>
                        	<!-- Modal -->
							<div class="modal fade" id="adminOfficialListCategoryModalDelete{{$detail_category->id}}" tabindex="-1" role="dialog" aria-labelledby="adminOfficialListCategoryModalDelete{{$detail_category->id}}Label" aria-hidden="true">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
								    <form id="form_admin_official_category_delete_{{$detail_category->id}}" data-id="{{$detail_category->id}}" class="form_admin_official_category_delete" action="{{route('api.admin.official.category.delete')}}" method="POST">
								    	{{csrf_field()}}
								      <div class="modal-header">
								        <h5 class="modal-title" id="adminOfficialListCategoryModalDelete{{$detail_category->id}}Label">Xác nhận xóa</h5>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								      <div class="modal-body">
								        Thao tác này sẽ không thể khôi phục, việc này cũng đồng nghĩa sẽ xóa {{$detail_category->Official->count()}} nhân sự thuộc thể loại này!
								      </div>
								      <input type="number" name="id" style="display: none;" value="{{$detail_category->id}}">
								      <div class="modal-footer">
								        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
								        <button type="submit" class="btn btn-primary" data-id="{{$detail_category->id}}" class="button_admin_official_category_delete" id="button_admin_official_category_delete_{{$detail_category->id}}">Xác nhận xóa</button>
								      </div>
								    </form>
							    </div>
							  </div>
							</div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
 <!-- Page level plugins -->
    <script src="{{url('/')}}/admin/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{url('/')}}/admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


    <!-- Page level custom scripts -->
    <script type="text/javascript">
    	$(document).ready(function() {
		  $('#dataTableAdminOfficialListCategory').DataTable();
		});
    </script>
    <script type="text/javascript">
	$( document ).ready(function() {
		$('.form_admin_official_category_delete').on('submit',function (e) {
			e.preventDefault();
		      $.ajaxSetup({
		          headers: {
		              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		          }
		      });
		      $.ajax({
		        url:"{{route('api.admin.official.category.delete')}}",
		        method:"POST",
		        data:new FormData(this),
		        contentType: false,
		        cache: false,
		        processData: false,
		        success:function(data){
		          if (data.message === "success") {
		              Swal.fire({
		                position: 'top-end',
		                icon: 'success',
		                title: 'Đã Xóa thể loại ! ',
		                showConfirmButton: false,
		                timer: 1500
		              });
		              reLoad();
		          }else{
		            Swal.fire({
		              icon: 'error',
		              title: 'Anou...',
		              text: 'Có lỗi gì đó đã xảy ra!',
		              footer: '<a href>Bạn muốn đóng góp ý kiến vui lòng liên hệ lập trình viên !</a>'
		            })
		          };
		        },
		        error: function(jqXhr, json, errorThrown){// this are default for ajax errors 
		          Swal.fire({
		            icon: 'error',
		            title: 'Anou...',
		            text: 'Có lỗi gì đó đã xảy ra!',
		            footer: '<a href>Bạn muốn đóng góp ý kiến vui lòng liên hệ lập trình viên !</a>'
		          })
		        }
		      });
		});
	});
    </script>
@endsection
