@extends('errors::minimal')
@section('title', __('SERVICIO NO DISPONIBLE'))
@section('code', '503')
@section('message', __($exception->getMessage() ?: 'SERVICIO NO DISPONIBLE'))