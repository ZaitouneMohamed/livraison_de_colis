@extends('admin.layout.master')

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
                            <h5 class="card-title">user name :{{$coli->user->name}}</h5>
                            <p class="card-text">call : {{$coli->user->phone}}</p>
                          </div>
                          <ul class="list-group list-group-flush" style="font-weight: bold">
                            <li class="list-group-item">destination To : {{$coli->destination}}</li>
                            <li class="list-group-item">prix :{{$coli->prix}}</li>
                            <li class="list-group-item">ville :{{$coli->ville}}</li>
                            <li class="list-group-item">adresse :{{$coli->adresse}}</li>
                            <li class="list-group-item">produit :{{$coli->produit}}</li>
                            <li class="list-group-item">note :{{$coli->note}}</li>
                          </ul>
                          <div class="card-body">
                            @if ($coli->statue == 0)
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal"
                                data-whatever="@mdo">valider coli</button>
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">New employee</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="GET" action="{{ route('admin.valider.coli') }}">
                                            @csrf
                                            @method('GET')
                                            <div class="modal-body">
                                                <div class="form-row">
                                                    <div class="col form-group">
                                                        <input type="hidden" name="coli_id" value="{{$coli->id}}">
                                                        <label>time :</label>
                                                        <input type="text" name="time" class="form-control"
                                                            placeholder="full name" value="48">
                                                    </div> 
                                                    <div class="col form-group">
                                                        <label>total :</label>
                                                        <input type="text" name="total" class="form-control" placeholder="phone">
                                                    </div> 
                                                </div>
                                                <div class="form-row">
                                                    <label>total :</label>
                                                    <select class="form-select" name="livreur_id" aria-label="Default select example">
                                                        @foreach ($livreur as $lv)
                                                            <option value="{{$lv->id}}">{{$lv->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success">Valider coli</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                                        <a href="{{route('admin.refuse.coli',$coli->id)}}" class="btn btn-danger">refuse coli</a>
                                        </div>
                            @endif
                        </center>
                    </div>
                </div>

            </div>
        </div>



    </div>
@endsection
