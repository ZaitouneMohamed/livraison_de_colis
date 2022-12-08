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
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">tout votre colis {{ $colis->count() }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID Colis</th>
                                        <th>Telephone</th>
                                        <th>destination</th>
                                        <th>Ville</th>
                                        <th>prix</th>
                                        <th>date d'ajout</th>
                                        <th>Date mise a joure</th>
                                        <th>Etat</th>
                                        <th>produit</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($colis as $coli)
                                        <tr>
                                            <td>{{ $coli->id }}</td>
                                            <td>{{ $coli->colis->telephone }}</td>
                                            <td>{{ $coli->colis->destination }}</td>
                                            <td>{{ $coli->colis->ville }}</td>
                                            <td>{{ $coli->colis->prix }}</td>
                                            <td>{{ $coli->created_at }}</td>
                                            <td>{{ $coli->updated_at }}</td>
                                            <td>
                                                @if ($coli->place_now == "")
                                                    <p class="btn btn-warning"><i class="fa-solid fa-spinner"></i></p>
                                                
                                                @else
                                                    {{ $coli->place_now }}
                                                @endif
                                            </td>
                                            <td>{{ $coli->colis->produit }}</td>
                                            <td>
                                                <a href="{{route('user.coli.view',$coli->colis->id)}}" class="btn btn-primary">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>



    </div>
@endsection
