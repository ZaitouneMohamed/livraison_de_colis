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
                        <h6 class="m-0 font-weight-bold text-primary">tout votre colis livree {{ $colis->count() }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID Colis</th>
                                        <th>Telephone</th>
                                        <th>destinataire</th>
                                        <th>Ville</th>
                                        <th>prix</th>
                                        <th>date d'ajout</th>
                                        <th>livree at</th>
                                        <th>statue</th>
                                        <th>products</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($colis as $coli)
                                        <tr>
                                            <td>{{ $coli->id }}</td>
                                            <td>{{ $coli->telephone }}</td>
                                            <td>{{ $coli->destinataire }}</td>
                                            <td>{{ $coli->ville }}</td>
                                            <td>{{ $coli->prix }}</td>
                                            <td>{{ $coli->created_at }}</td>
                                            <td>{{ $coli->livrée_at }}</td>
                                            <td>
                                                <p class="btn btn-success">{{ $coli->statue }}</p>
                                            </td>
                                            <td>{{ $coli->products }}</td>
                                            <td>
                                                
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
