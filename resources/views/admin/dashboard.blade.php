@extends('layouts.admin')

@section('title', 'الرئيسية')

@section('content_header', 'الرئيسية')

@section('content_header_link')
<a href="{{route('admin.dashboard')}}">الرئيسية</a>
@endsection

@section('content_header_active', 'عرض')

@section('content')

@endsection