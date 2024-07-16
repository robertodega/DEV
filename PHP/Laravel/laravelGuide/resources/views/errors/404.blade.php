@extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '404')
<?php /* * ?>
@section('message', __('Not Found'))
<?php /* */ ?>
@section('message')
{{$exception->getMessage()}}
@endsection
<?php /* */ ?>