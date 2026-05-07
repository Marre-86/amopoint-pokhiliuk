@extends('layouts.two-column')

@section('title', 'Пункт 2 - Описание и решение')

@section('left_column')
    @include('points.point2-left')
@endsection

@section('right_column')
    @include('points.point2-right')
@endsection