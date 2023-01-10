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
                        <h6 class="m-0 font-weight-bold text-primary">you have {{ $orders->count() }} order</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>statue</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>
                                                @if ($order->livreur_statue == "tacked")
                                                    {{ $order->livreur_statue }}
                                                @elseif ($order->livreur_statue == "tacked")
                                                    <form action="{{route('livreur.bon.accepte',$bon->id)}}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success mt-3" style="margin-left: 320px"> accepte</button>
                                                    </form>
                                                    <form action="{{route('livreur.bon.refuse',$bon->id)}}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger mt-3 ml-4"> refuse</button>
                                                    </form>
                                                    @endif
                                            </td>
                                            <td>
                                                <form action="{{route('livreur.bon.view.colis')}}">
                                                    @csrf
                                                    <input type="hidden" name="bon_id" value="{{ $order->id }}">
                                                    <button type="submit" class="btn btn-success">view</button>
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
