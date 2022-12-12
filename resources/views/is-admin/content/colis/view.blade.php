@extends('is-admin.layout.master')

@section('content')
    <div class="container-fluid">
        @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <div class="row">
            <div class="container-fluid">
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-center">user name : {{ $coli->user->name }}</h6>
                        <p class="card-text text-center">call : {{$coli->user->phone}}</p>
                    </div>
                    <div class="card-body">
                        <center>
                            <ul class="list-group list-group-flush" style="font-weight: bold">
                                <li class="list-group-item">destinataire : {{$coli->destinataire}}</li>
                                <li class="list-group-item">prix :{{$coli->prix}}</li>
                                <li class="list-group-item">ville :{{$coli->ville}}</li>
                                <li class="list-group-item">adresse :{{$coli->adresse}}</li>
                                <li class="list-group-item">produit :{{$coli->products}}</li>
                                <li class="list-group-item">note :{{$coli->note}}</li>
                                <li class="list-group-item">place now :{{$coli->place_now}}</li>
                            </ul>
                        </center>
                    </div>
                </div>

            </div>
        </div>



    </div>
@endsection
