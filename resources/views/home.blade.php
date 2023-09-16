@extends('layouts.app')


@section('page-title', $title)

@section('message')
@include('partials.messages')
@endsection

@section('content')
<div class="content-main">


  <!--  start slide bar  -->
  <div class="wrapper">
    <!-- Sidebar  -->
    @include('partials.common.slide-bar')

    <!-- Page Content  -->
    <div id="content">
      @include('partials.common.tieude')
      @php
      $quyen=null;
      if(auth()->user()){
      if(auth()->user()->quyennguoidungs()){
      if(auth()->user()->quyennguoidungs()->first()){
      $quyen = auth()->user()->quyennguoidungs()->first()->Q_MaQ;
      }
      }
      }
      @endphp
      <div class="container text-center p-2">
        <div class="row align-items-center gx-2">
          <h1>Xin chào, tôi tên Trần Thanh Hòa</h1>
        </div>
      </div>
    </div>
  </div>
  @endsection