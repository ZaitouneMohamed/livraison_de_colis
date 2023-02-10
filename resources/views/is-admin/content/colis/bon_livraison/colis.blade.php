@extends('is-admin.layout.master')

@section('content')
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
    <div class="container-fluid">
        <div class="row">
            <div class="container-fluid">

                    <div class="card shadow mb-4">
                        @if ($bon_info->admin_statue == 0)
                        <div class="card-header py-3">
                                <h6 class="m-2 font-weight-bold text-primary">vous avez {{ $untacked_colis->count() }} nouveau colis</h6>
                            </div>
                        @endif
                            @if ($untacked_colis->count() > 0)
                                <div class="card-body">
                                        <div class="table-responsive">
                                            <form action="{{route('user.add.coli.to.bon',$bon_info->id)}}">
                                            <table class="table table-bordered" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>ID Colis</th>
                                                        <th>Telephone</th>
                                                        <th>destinataire</th>
                                                        <th>Ville</th>
                                                        <th>prix</th>
                                                        <th>date d'ajout</th>
                                                        <th>Etat</th>
                                                        <th>produit</th>
                                                        <th>action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($untacked_colis as $coli)
                                                        <tr>
                                                            <td>
                                                                <input type="checkbox" name="coli[]" value="{{ $coli->id }}"
                                                                    id="">
                                                            </td>
                                                            <td>{{ $coli->id }}</td>
                                                            <td>{{ $coli->destinataire }}</td>
                                                            <td>{{ $coli->telephone }}</td>
                                                            <td>{{ $coli->ville }}</td>
                                                            <td>{{ $coli->prix }}</td>
                                                            <td>{{ $coli->created_at }}</td>
                                                            <td>{{ $coli->statue }}</td>
                                                            <td>{{ $coli->products }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <button class="btn btn-primary" type="submit">add to bon</button>
                                        </form>
                                        </div>
                                </div>
                            @endif
                    </div>
            </div>
        </div>
        <div class="text-center">
            <h1>colis in this bon</h1>
            <div class="row row-cols-1 row-cols-lg-3 g-2 g-lg-3">
                @foreach ($colis as $coli)
                    <div class="col">
                        <div class="p-3 border bg-light">
                            <h5 class="card-title">destinataire : {{ $coli->destinataire }}</h5>
                            <p class="card-text">phone : {{ $coli->telephone }}</p>
                            <p class="card-text">ville : {{ $coli->ville }}</p>
                            <p class="card-text">total a payée : {{ $coli->total }}DH</p>
                            <p class="card-text">adresse : {{ $coli->adresse }}</p>
                            <a href="{{ route('user.coli.view', $coli->id ) }}" class="btn btn-primary">view this coli</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="container">
                <form action="{{route('user.bon.livraison.pdf',$id)}}" method="post">
                    @csrf
                    <input type="submit" value="watch tickets" class="btn btn-primary">
                </form>
                <form action="{{route('user.bon.livraison.pdf',$id)}}" method="post">
                    @csrf
                    <input type="submit" value="dowload bon" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
@endsection
