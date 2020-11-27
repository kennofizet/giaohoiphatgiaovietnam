@extends('admin.layouts.main')
@section('style')
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style type="text/css">


.preview {
    /* max-height: 200px; */
    /* height: 200px; */
    /* width: auto; */
    max-width: auto;
    /* max-width: 200px; */
    text-align: center;
    display: block;
    /* width: 200px; */
    /* height: 200px; */
    margin: 20px auto;
    /* box-shadow: 0px 0px 0px 2px rgba(33, 122, 105, 1); */
    overflow: hidden;
}
.prev-restyle img{
  max-height: 200px!important;
  max-width: 200px!important;
}
.preview img{
  max-height: 200px;
  max-width: 200px;
}

.file-upload-wrapper {
    position: relative;
    z-index: 5;
    display: block;
    width: 250px;
    height: 30px;
    margin: 25px auto;
    border-radius: 0px;
    border-bottom: 1px dashed rgba(33, 122, 105, 1);
}

.file-upload-native,
.file-upload-text {
    position: absolute;
    top: 0;
    left: 0;
    display: block;
    width: 100%;
    height: 100%;
    cursor: pointer;
    color: rgba(255,255,255,0.8);
}

input[type="file"]::-webkit-file-upload-button {
    cursor: pointer;
}

.file-upload-native:focus,
.file-upload-text:focus {
    outline: none;
}

.file-upload-text {
    z-index: 10;
    padding: 5px 15px 8px;
    overflow: hidden;
    font-size: 14px;
    line-height: 1.4;
    cursor: pointer;
    text-align: center;
    letter-spacing: 1px;
    text-overflow: ellipsis;
    border: 0;
    background-color: transparent;
}

.file-upload-native {
    z-index: 15;
    opacity: 0;
}
</style>
@endsection

@section('content')
<div class="panel panel-default">
  	<table class="table table-striped table-bordered table-hover">
  		<tbody>
  			<tr>
  				<th>Mã số thẻ</th>
  				<td colspan="2">
  					<input class="w3-input w3-border-0" type="text" name="card_number" value="{{$detail_official_view->card_number}}" disabled>
  				</td>
  			</tr>
  			<tr>
  				<th>Họ tên *</th>
  				<td>
  					<input class="w3-input w3-border-0" type="text" name="name" value="{{$detail_official_view->name}}" disabled>
  				</td>
  				<td colspan="2" rowspan="3" align="center">
            <div class="text-left">
              <div class="preview prev-restyle img-wrapper">
                <img src="{{url('/')}}/upload/source/api/blog/images/{{$detail_official_view->photo_profile}}.jpg">
              </div>
              <hr>
              <div class="file-upload-wrapper">
                  
              </div>
            </div>
  				</td>
  			</tr>
  			<tr>
  				<th>Pháp Danh</th>
  				<td>
  					<span>{{$detail_official_view->alias}}</span>
  				</td>			
  			</tr>
  			<tr>
  				<th>Thể loại </th>
  				<td>
  					<span>{{$detail_official_view->category}}</span>
  				</td>
  			</tr>
  			<tr>
  				<th>Ngày sinh</th>
  				<td colspan="2">
  					<span>{{$detail_official_view->date_of_birth}}</span>
  				</td>
  			</tr>
  			<tr>
  				<th>Số CMND</th>
  				<td colspan="2">
  					<span>{{$detail_official_view->cmnd}}</span>
  				</td>
  			</tr>
  			<tr>
  				<th>Chức vụ</th>
  				<td colspan="2">
  					<span>{{$detail_official_view->position}}</span>
  				</td>
  			</tr>
  			<tr>
  				<th>Đc thường trú</th>
  				<td colspan="2">
  					<span>{{$detail_official_view->address}}</span>
  				</td>
  			</tr>
  			<tr>
  				<th>QR code ( Ảnh vuông )</th>
  				<td colspan="2">
  					<div class="text-left">
              <div class="preview img-wrapper">
                <img src="{{url('/')}}/upload/source/api/blog/images/{{$detail_official_view->qr_code}}.jpg">
              </div>
  					</div>

  				</td>
  			</tr>	
  		</tbody>
  	</table>
</div>
@endsection

@section('script')

@endsection
