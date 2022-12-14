@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
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
                        <h6 class="m-0 font-weight-bold text-primary">Coulis retournee {{ $colis->count() }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>phone</th>
                                        <th>Destinataire</th>
                                        <th>prix</th>
                                        <th>ville</th>
                                        <th>statue</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($colis as $coli)
                                        <tr>
                                            <td>{{ $coli->user->name }}</td>
                                            <td>{{ $coli->telephone }}</td>
                                            <td>{{ $coli->destinataire }}</td>
                                            <td>{{ $coli->prix }}</td>
                                            <td>{{ $coli->ville }}</td>
                                            <td>{{ $coli->statue }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{route('admin.view.coli',$coli->id)}}" class="btn btn-primary"><i class="fa-solid fa-eye"></i></a>
                                                </div>
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
