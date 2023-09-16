@extends('layouts.app')

@section('message')
@include('partials.messages')
@endsection

@section('content')
<div class="content-main">
  <!-- start content-login -->
  <div class="content-login">
    <div class="box-forgot-password">
      <h3>Quên mật khẩu</h3></h3>
      <form action="{{route('forgot-password')}}" method="post" class="d-flex align-items-center justify-content-center form-login">
        {{ csrf_field() }}
        <div class="container mt-3 ">
          <div class="mb-3 mt-3">
            <div class="input-group form-rounded-1">
              <span class="input-group-text">
                <i class="fa fa-user "></i>
              </span>
              <input type="text" required id="Email" name="Email" style="text-align: left;" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1">
            </div>
          </div>
          <div class="mb-3 mt-3">
            <div class="input-group form-rounded-1">
              <span class="input-group-text">
                <i class="fa fa-lock "></i>
              </span>
              <input type="password" required id="Email" name="old-password" style="text-align: left;" class="form-control" placeholder="Mật khẩu cũ" aria-label="Mật khẩu cũ" aria-describedby="basic-addon1">
            </div>
          </div>
          <div class="mb-3 mt-3">
            <div class="input-group form-rounded-1">
              <span class="input-group-text">
                <i class="fa fa-lock "></i>
              </span>
              <input type="password" required id="Email" name="new-password" style="text-align: left;" class="form-control" placeholder="Mật khẩu mới" aria-label="Mật khẩu mới" aria-describedby="basic-addon1">
            </div>
          </div>
          <div class="d-grid gap-2 col-12 mx-auto">
            <button type="submit" class="btn btn-primary-login mb-3  form-rounded-1">Lấy lại mật khẩu</button>
          </div>
          <div class="d-grid align-items-center justify-content-center ">
            <a href="{{route('login')}}" style="color: #000!important" class="text-danger text-decoration-none">Đăng nhập</a>
          </div>
        </div>
      </form>
    </div>
  </div>
  </div>
  <!-- end content-login -->
</div>
@endsection