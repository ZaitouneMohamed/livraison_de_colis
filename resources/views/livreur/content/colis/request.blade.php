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
                    @if ($orders->count() == 0)
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">colis request {{ $orders->count() }} - No Request Yet</h6>
                        </div>
                    @else
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">colis rrequest {{ $orders->count() }}</h6>
                        </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>phone</th>
                                        <th>Destination</th>
                                        <th>adresse</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->livreur->name }}</td>
                                            <td>{{ $order->colis->user->phone }}</td>
                                            <td>{{ $order->colis->destination }}</td>
                                            <td>{{ $order->colis->adresse }}</td>
                                            <td>
                                                <a href="" class="btn btn-danger">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <form action="{{ route('livreur.accepte.order') }}"
                                                        method="post">
                                                        @csrf
                                                        @method('POST')
                                                        <input type="hidden" name="order_id" value="{{$order->id}}">
                                                        <button class="btn btn-primary" type="submit"><i class="fa-sharp fa-solid fa-check"></i></button>
                                                    </form>
                                                    <form action="{{ route('livreur.refuse.order') }}" method="POST">
                                                        @csrf
                                                        @method('POST')
                                                        <input type="hidden" name="order_id" value="{{$order->id}}">
                                                        <button class="btn btn-danger" type="submit"><i class="fa-solid fa-xmark"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                </div>

            </div>
        </div>



    </div>
@endsection
