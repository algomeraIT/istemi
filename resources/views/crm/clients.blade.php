@extends('layout.main')

@section('content')
        @livewire('crm.client', [], key(time()))
@endsection