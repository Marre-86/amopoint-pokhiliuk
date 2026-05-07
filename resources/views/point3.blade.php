@extends('layouts.two-column')

@section('title', 'Пункт 3 - Описание и решение')

@section('left_column')
    @include('points.point3-left')
@endsection

@section('right_column')
    @include('points.point3-right')
@endsection