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
                        <h6 class="m-0 font-weight-bold text-primary"></h6>
                    </div>
                    <div class="card-body">
                        <center>
                            <div class="card-body" style="font-weight: bold">
                                <h5 class="card-title">user name :{{ $order->user->name }}</h5>
                                <p class="card-text">call : {{ $order->user->phone }}</p>
                            </div>
                            <ul class="list-group list-group-flush" style="font-weight: bold">
                                <li class="list-group-item">destinataire : {{ $order->destinataire }}</li>
                                <li class="list-group-item">prix :{{ $order->prix }}</li>
                                <li class="list-group-item">ville :{{ $order->ville }}</li>
                                <li class="list-group-item">adresse :{{ $order->adresse }}</li>
                                <li class="list-group-item">produit :{{ $order->product }}</li>
                                <li class="list-group-item">note :{{ $order->note }}</li>
                                @if (auth()->user()->id == $order->livreur_id)
                                    <li class="list-group-item">place now :{{ $order->place_now }}</li>
                            </ul>
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
                        @else
                            <form action="{{ route('livreur.take.order', $order->id) }}" method="post">
                                @csrf
                                @method('post')
                                <button class="btn btn-primary" type="submit"><i
                                        class="fa-sharp fa-solid fa-check"></i></button>
                            </form>
                            @endif

                        </center>
                    </div>
                </div>

            </div>
        </div>



    </div>
@endsection
