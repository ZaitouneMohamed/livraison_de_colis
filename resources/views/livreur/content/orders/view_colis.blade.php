@extends('livreur.layout.master')

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
                <div class="container text-center">
                    <div class="row row-cols-1 row-cols-lg-3 g-2 g-lg-3">
                        @foreach ($colis as $coli)
                            <div class="col">
                                <div class="p-3 border bg-light">
                                    <h5 class="card-title">destinataire : {{ $coli->destinataire }}</h5>
                                    <p class="card-text">phone : {{ $coli->telephone }}</p>
                                    <p class="card-text">ville : {{ $coli->ville }}</p>
                                    <p class="card-text">total a payée : {{ $coli->prix }}DH</p>
                                    <p class="card-text">adresse : {{ $coli->adresse }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="d-flex">
                        @if ($bon->livreur_statue == "have request")
                            <form action="{{route('livreur.bon.accepte',$bon_id)}}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success mt-3" style="margin-left: 320px"> accepte</button>
                            </form>
                            <form action="{{route('livreur.bon.refuse',$bon_id)}}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger mt-3 ml-4"> refuse</button>
                            </form>
                        @endif
                        @if ($bon->livreur_statue=="tacked")
                            <form action="{{ route('livreur.demarer',$bon_id) }}" method="POST">
                                @csrf
                                @method("POST")
                                <button style="margin-left: 420px" type="submit" class="btn btn-success">Demarer</button>
                            </form>
                        @endif
                        @if ($bon->livreur_statue=="on road")
                            <h1>this colis on road , <h2>Google Maps</h2> </h1>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
