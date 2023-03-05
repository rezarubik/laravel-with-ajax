@extends('dashboard.layouts.master') @section('title', 'Welcome')
@section('page_heading', 'Welcome')
@section('content')
<link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet" type="text/css" />
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">

                        <div class="col-auto mx-auto">
                            Welcome <b> {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</b>!
                            <br>
                            You role {{ count(Auth::user()->roles) > 1 ? 'are:' : 'is:' }}
                            <ul>
                                @foreach(Auth::user()->roles as $role)
                                <li> {{ $role->name }} </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection