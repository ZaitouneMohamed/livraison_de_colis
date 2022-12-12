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
                        <h6 class="m-0 font-weight-bold text-primary">tout votre returned colis {{ $colis->count() }}</h6>
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
                                            <td>{{ $coli->telephone }}</td>
                                            <td>{{ $coli->destination }}</td>
                                            <td>{{ $coli->ville }}</td>
                                            <td>{{ $coli->prix }}</td>
                                            <td>{{ $coli->created_at }}</td>
                                            <td>{{ $coli->updated_at }}</td>
                                            <td>
                                                <p class="btn btn-danger">Returned</p>
                                            </td>
                                            <td>{{ $coli->produit }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{route('colis.show',$coli->id)}}" class="btn btn-primary" style="margin-right: 6px"><i class="fa-solid fa-eye"></i></a>
                                                    <a href="{{route('colis.edit',$coli->id)}}" class="btn btn-warning" style="margin-right: 6px"><i class="fa-sharp fa-solid fa-pen-to-square"></i></a>
                                                    <form action="{{ route('colis.destroy', $coli->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger" type="submit"><i class="fa-solid fa-trash"></i></button>
                                                        </form>
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
