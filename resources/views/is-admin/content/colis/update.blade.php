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

                        </div>
                        <form action="{{route('colis.update',$coli->id)}}" method="post">
                            @csrf
                            @method("put")
                            <ul class="list-group list-group-flush" style="font-weight: bold">
                                <li class="list-group-item">destination To : <input type="text" name="destination" value="{{$coli->destination}}"></li>
                                <li class="list-group-item">prix : <input type="text" name="prix" value="{{$coli->prix}}"></li>
                                <li class="list-group-item">phone : <input type="text" name="phone" value="{{$coli->telephone}}"></li>
                                <li class="list-group-item">ville : <input type="text" name="ville" value="{{$coli->ville}}"></li>
                                <li class="list-group-item">adresse : <input type="text" name="adresse" value="{{$coli->adresse}}"></li>
                                <li class="list-group-item">produit : <input type="text" name="produit" value="{{$coli->produit}}"></li>
                                <li class="list-group-item">note : <input type="text" name="note" value="{{$coli->note}}"></li>
                            </ul>
                            <a href="{{route('colis.index')}}" class="btn btn-danger">cancel</a>
                            <button type="submit" class="btn btn-warning">update</button>
                        </form>
                        
                    </center>
                </div>
            </div>

        </div>
    </div>


@endsection