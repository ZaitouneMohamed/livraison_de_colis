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
                        <h6 class="m-0 font-weight-bold text-primary">my colis {{ $orders->count() }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>phone</th>
                                        <th>total</th>
                                        <th>destinataire</th>
                                        <th>adresse</th>
                                        <th>place now</th>
                                        <th>statue</th>
                                        <th>statue</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ auth()->user()->name }}</td>
                                            <td>{{ $order->telephone }}</td>
                                            <td>{{ $order->total }}</td>
                                            <td>{{ $order->ville }}</td>
                                            <td>{{ $order->adresse }}</td>
                                            <td>{{ $order->place_now }}</td>
                                            @if ($order->statue != "livreé" && $order->statue!= "retournee" && $order->statue == "en cours de livraison")
                                                <td>
                                                    <form action="{{ route('livreur.place.now') }}" method="post">
                                                        @csrf
                                                        @method('POST')
                                                        <input type="hidden" name="coli_id" value="{{ $order->id }}">
                                                        <ul class="list-group list-group-flush" style="font-weight: bold">
                                                            <li class="list-group-item">where is it now : <input type="text"
                                                                    class="form-controler" name="place_now" id="" placeholder="place now">
                                                            </li>
                                                        </ul>
                                                        <button type="submit" class="btn btn-primary">submit</button>
                                                    </form>
                                                </td>
                                            @else
                                                <td>{{$order->statue}}</td>
                                            @endif
                                            <td>{{ $order->statue }}</td>
                                            @if ($order->statue !="livreé" && $order->statue != "retournee")
                                                <td>
                                                    <form action="{{ route('livreur.change.action') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="coli_id" value="{{$order->id}}">
                                                        <select name="statue" id="" onchange="this.form.submit()">
                                                            <option value="">shose a plane</option>
                                                            <option value="ramasser">Ramasser</option>
                                                            <option value="emballer">Emballe</option>
                                                            <option value="en cours de livraison">en cours de livraison</option>
                                                            <option value="livreé">livreé</option>
                                                            <option value="retournee">retournee</option>
                                                        </select>
                                                    </form>
                                                </td>
                                            @endif

                                            <td>
                                                <a href="{{route('livreur.view.coli',$order->id)}}" class="btn btn-success"><i class="fa-solid fa-eye"></i></a>
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
