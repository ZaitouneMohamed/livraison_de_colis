@extends('livreur.layout.master')

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
            @if ($order->statue == "en cours de livraison")
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Warning </strong>if you change the status or the place , it will change in all of your colis , Take Care.
                </div>
            @endif
            <div class="container-fluid">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">tout les colis qui sont dant l'order id ( {{ $order->id }} ) </h6>
                    </div>
                </div>
                @if ($order->statue == "")
                    <div class="d-flex">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
                            data-whatever="@mdo"><b><b>+</b></b> ajouter nouveau coli au votre order</button>
                        <form action="{{route('livreur.order.demarer',$order->id)}}" method="GET">
                            @csrf
                            @method("GET")
                            <input type="submit" value="Demarer" style="margin-left: 20px" class="btn btn-danger">
                        </form>
                    </div><br><br>
                @else
                    <form action="{{route('livreur.order.place_now',$order->id)}}">
                        @csrf
                        <select name="city" class="form-select" aria-label="Default select example" class="selectpicker" data-live-search="true" onchange="this.form.submit()">
                            <option selected>Place Now</option>
                            <option data-tokens="Agadir">Agadir</option>
                            <option data-tokens="Al Hoceima">Al Hoceima</option>
                            <option data-tokens="Azilal">Azilal</option>
                            <option data-tokens="Beni Mellal">Beni Mellal</option>
                            <option data-tokens="Ben Slimane">Ben Slimane</option>
                            <option data-tokens="Boulemane">Boulemane</option>
                            <option data-tokens="Casablanca">Casablanca</option>
                            <option data-tokens="Chaouen">Chaouen</option>
                            <option data-tokens="El Jadida">El Jadida</option>
                            <option data-tokens="El Kelaa des Sraghna">El Kelaa des Sraghna</option>
                            <option data-tokens="Er Rachidia">Er Rachidia</option>
                            <option data-tokens="Essaouira">Essaouira</option>
                            <option data-tokens="Fes">Fes</option>
                            <option data-tokens="Figuig">Figuig</option>
                            <option data-tokens="Guelmim">Guelmim</option>
                            <option data-tokens="Ifrane">Ifrane</option>
                            <option data-tokens="Kenitra">Kenitra</option>
                            <option data-tokens="Khemisset">Khemisset</option>
                            <option data-tokens="Khenifra">Khenifra</option>
                            <option data-tokens="Khouribga">Khouribga</option>
                            <option data-tokens="Laayoune">Laayoune</option>
                            <option data-tokens="Larache">Larache</option>
                            <option data-tokens="Marrakech">Marrakech</option>
                            <option data-tokens="Meknes">Meknes</option>
                            <option data-tokens="Nador">Nador</option>
                            <option data-tokens="Ouarzazate">Ouarzazate</option>
                            <option data-tokens="Oujda">Oujda</option>
                            <option data-tokens="Rabat-Sale">Rabat-Sale</option>
                            <option data-tokens="Safi">Safi</option>
                            <option data-tokens="Settat">Settat</option>
                            <option data-tokens="Sidi Kacem">Sidi Kacem</option>
                            <option data-tokens="Tangier">Tangier</option>
                            <option data-tokens="Tan-Tan">Tan-Tan</option>
                            <option data-tokens="Taounate">Taounate</option>
                            <option data-tokens="Taroudannt">Taroudannt</option>
                            <option data-tokens="Tata">Tata</option>
                            <option data-tokens="Taza">Taza</option>
                            <option data-tokens="Tetouan">Tetouan</option>
                            <option data-tokens="Tiznit">Tiznit</option>
                        </select>
                    </form><br>
                    <form action="{{ route('livreur.order.statue',$order->id) }}">
                        @csrf
                        <select name="statue" class="form-select" aria-label="Default select example" onchange="this.form.submit()">
                            <option selected>Statue</option>
                            <option value="ramasser">ramasser</option>
                            <option value="emballer">emballer</option>
                            <option value="en cours de livraison">en cours de livraison</option>
                        </select>
                    </form><br>
                @endif
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Colis List</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
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
                                            <th>produit</th>
                                            <th>action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($colis_list as $coli)
                                            <tr>
                                                <td>{{ $coli->id }}</td>
                                                <td>{{ $coli->destinataire }}</td>
                                                <td>{{ $coli->telephone }}</td>
                                                <td>{{ $coli->ville }}</td>
                                                <td>{{ $coli->prix }}</td>
                                                <td>{{ $coli->created_at }}</td>
                                                <td>{{ $coli->products }}</td>
                                                <td>
                                                    <form action="{{ route('livreur.take.order',$coli->id) }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                                                        <input type="submit" value="take coli" class="btn btn-primary">
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
        <div class="container text-center">
            <div class="row row-cols-1 row-cols-lg-3 g-2 g-lg-3">
                @foreach ($colis_taked as $coli)
                    <div class="col">
                        <div class="p-3 border bg-light">
                            <h5 class="card-title">destinataire : {{ $coli->destinataire }}</h5>
                            <p class="card-text">phone : {{ $coli->telephone }}</p>
                            <p class="card-text">ville : {{ $coli->ville }}</p>
                            <p class="card-text">total a payée : {{ $coli->total }}DH</p>
                            <p class="card-text">adresse : {{ $coli->adresse }}</p>
                            <a href="{{ route('livreur.view.coli', $coli->id ) }}" class="btn btn-primary">view this coli</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    
@endsection
