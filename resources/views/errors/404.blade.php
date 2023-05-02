@extends('errors::illustrated-layout')
@section('title', __('PÁGINA NO ENCONTRADA'))
@section('code', '404')
@section('message', __($exception->getMessage() ?:'PÁGINA NO ENCONTRADA'))