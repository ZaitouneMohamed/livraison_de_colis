@extends('admin.layout.master')

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
                                    <p class="card-text">total a payée : {{ $coli->total }}DH</p>
                                    <p class="card-text">adresse : {{ $coli->adresse }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <form action="{{ route('admin.valide.bon.livraison',$id) }}" method="POST">
                        @csrf
                        @method("POST")
                        <button type="submit" class="btn btn-success mt-3"> received</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
