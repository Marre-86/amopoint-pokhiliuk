@extends('layouts.two-column')

@section('title', 'Пункт 1 - Описание и решение')

@section('left_column')
    @include('points.point1-left')
@endsection

@section('right_column')
    @include('points.point1-right')
@endsection