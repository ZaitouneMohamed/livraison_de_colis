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
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">colis : {{ $orders->count() }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>phone</th>
                                        <th>Destinataire</th>
                                        <th>adresse</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->user->name }}</td>
                                            <td>{{ $order->user->phone }}</td>
                                            <td>{{ $order->destinataire }}</td>
                                            <td>{{ $order->adresse }}</td>
                                            <td>
                                                <a href="{{route('livreur.view.coli',$order->id)}}" class="btn btn-success"><i class="fa-solid fa-eye"></i></a>
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <form method="POST" action="{{ route('livreur.take.order',$order->id) }}" >
                                                        @csrf
                                                        @method("POST")
                                                        <button class="btn btn-primary" type="submit"><i class="fa-sharp fa-solid fa-check"></i></button>
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
