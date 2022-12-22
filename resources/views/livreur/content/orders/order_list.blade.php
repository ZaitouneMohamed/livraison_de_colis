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
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <div class="d-flex">
                                orders:{{ $orders->count() }}
                                <form action="{{ route('livreur.order.nouveau') }}" method="post">
                                    @csrf
                                    @method("post")
                                    <input type="submit" value="Add New Order" class="btn btn-primary" style="margin-left: 750px">
                                </form>
                            </div>
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>order id</th>
                                        <th>place now</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->place_now }}</td>
                                            <td>
                                                <form action="{{ route('livreur.order.colis_list',$order->id) }}" method="post">
                                                    @csrf
                                                    @method("GET")
                                                    <input type="submit" value="view colis" class="btn btn-primary">
                                                </form>
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
