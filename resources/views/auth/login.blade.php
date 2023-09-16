@extends('layouts.app')

@section('message')
@include('partials.messages')
@endsection

@section('content')
<div class="content-main">
  <!-- start content-login -->
  <div class="content-login">
    <div class="box-login">
      <h3>Đăng nhập</h3>
      <form action="{{route('post-login')}}" method="post" class="d-flex align-items-center justify-content-center form-login">
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
            <div class="input-group form-rounded-1" id="show_hide_password">
              <span class="input-group-text">
                <i class="fa fa-lock "></i>
              </span>
              <input type="password" required id="Password" name="Password" style="text-align: left;" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1">
              <span class="input-group-text">
                <a href=""><i class="fa fa-eye-slash" id="show_hide_eye"></i></a>
              </span>
            </div>
          </div>
          <div class="form-check mb-3 d-grid align-items-center justify-content-center">
            <label class="form-check-label">
              <input class="form-check-input" type="checkbox" name="remember" id="remember" value="1">Nhớ tài khoản</label>
          </div>
          <div class="d-grid gap-2 col-12 mx-auto">
            <button type="submit" class="btn btn-primary-login mb-3  form-rounded-1">Đăng nhập</button>
          </div>
          <div class="d-grid align-items-center justify-content-center ">
            <a href="{{route('forgot-password')}}" style="color: #000!important" class="text-danger text-decoration-none">Quên mật khẩu</a>
          </div>
        </div>
      </form>
    </div>
  </div>
  <!-- end content-login -->
</div>
@endsection