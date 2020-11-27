@extends('admin.layouts.main')
@section('style')
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
@endsection

@section('content')
<form class="w3-container w3-card-4" id="form_admin_official_category_create" action="{{route('api.admin.official.category.create')}}" method="POST">
	{{csrf_field()}}
	<br>
	<p>      
		<label class="w3-text-grey">Tên thể loại *</label><span class="mess-name" style="margin-left: 5px;color: red;display: none;">Vui lòng nhập tên</span>
		<input class="w3-input w3-border" type="text" name="name" required>
	</p>
	<p>      
		<label class="w3-text-grey">Nội dung tóm tắt</label>
		<textarea class="w3-input w3-border" name="description" style="resize:none"></textarea>
	</p>
	<p>      
		<label class="w3-text-grey">Nội dung chi tiết</label>
		<textarea class="w3-input w3-border" rows="10" name="content" style="resize:none"></textarea>
	</p>
	<br>
	<p><button type="submit" class="w3-btn w3-padding w3-teal" style="width:120px;float: right;">Thêm &nbsp; ❯</button></p>
</form>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript">
	$('#form_admin_official_category_create').on('submit',function (e) {
    e.preventDefault();
    $('.mess-name').css('display','none');
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
        url:"{{route('api.admin.official.category.create')}}",
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
                title: 'Đã Thêm thể loại ! ',
                showConfirmButton: false,
                timer: 1500
              });
              $('#form_admin_official_category_create').trigger("reset");
          }else if (data.message === "validator") {
          	$('.mess-name').css('display','block');
              Swal.fire({
  					  icon: 'error',
  					  title: 'Lỗi...',
  					  text: 'Vui lòng nhập đầy đủ thông tin!',
  					  footer: '<a href>Vui lòng nhập đầy đủ thông tin có dấu *</a>'
  					})
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
</script>
@endsection
