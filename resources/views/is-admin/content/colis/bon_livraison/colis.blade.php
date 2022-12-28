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
                    <div class="card-header py-3">
                        <h6 class="m-2 font-weight-bold text-primary">vous avez nouveau colis , bon id (
                            {{ $colis->count() }} )( {{ $untacked_colis->count() }} )</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
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
                            <button class="btn btn-primary">add to bon</button>
                        </div>
                    </div>
                </div>
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
