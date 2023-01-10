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
                <div class="container text-center">
                    <div class="row row-cols-1 row-cols-lg-3 g-2 g-lg-3">
                        @foreach ($colis as $coli)
                            <div class="col">
                                <div class="p-3 border bg-light">
                                    <h5 class="card-title">destinataire : {{ $coli->destinataire }}</h5>
                                    <p class="card-text">phone : {{ $coli->telephone }}</p>
                                    <p class="card-text">ville : {{ $coli->ville }}</p>
                                    <p class="card-text">total a payée : {{ $coli->total }}DH</p>
                                    <p class="card-text">adresse : {{ $coli->adresse }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if ( $bon->admin_statue == 0 )
                        <form action="{{ route('admin.valide.bon.livraison',$bon->id) }}" method="POST">
                            @csrf
                            @method("POST")
                            <button type="submit" class="btn btn-success mt-3"> received</button>
                        </form>
                    @elseif ($bon->livreur_id == null )
                    <br>
                        <form action="{{route('admin.bon.send_request_to_admin')}}" method="POST">
                            @csrf
                            <input type="hidden" name="bon_id" value="{{$bon->id}}">
                            <select class="form-select" name="livreur_id"  onchange="this.form.submit()" aria-label="Default select example">
                                <option selected>shose a livreur</option>
                                @foreach ($livreurs as $livreur)
                                    <option value="{{ $livreur->id }}">{{ $livreur->name }}</option>  
                                @endforeach
                            </select>
                        </form>
                    @elseif ( $bon->livreur_statue == "have request" )
                        waiting for answer
                        <form action="{{route('admin.annuler.request',$bon->id)}}">
                            @csrf
                            <button type="submit" class="btn btn-danger">annuler </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
