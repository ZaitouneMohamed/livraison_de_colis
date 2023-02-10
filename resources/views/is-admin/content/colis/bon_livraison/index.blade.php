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
    <div class="container-fluid">
        <div class="row">
            <div class="container-fluid">
                @if ($colis->count() != 0)
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
                        data-whatever="@mdo"><b><b>+</b></b> bone de livraison</button><br><br>
                @endif

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">bon de livraison</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action=" {{ route('user.coli.add.coli.to.bon.livraison') }} " method="get">
                                @csrf
                                <div class="modal-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th><input type="checkbox" name="" id=""></th>
                                                    <th>ID Colis</th>
                                                    <th>Telephone</th>
                                                    <th>destinataire</th>
                                                    <th>Ville</th>
                                                    <th>prix</th>
                                                    <th>date d'ajout</th>
                                                    <th>Etat</th>
                                                    <th>produit</th>
                                                    <th>action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($colis as $coli)
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="coli[]"
                                                                value="{{ $coli->id }}" id="">
                                                        </td>
                                                        <td>{{ $coli->id }}</td>
                                                        <td>{{ $coli->destinataire }}</td>
                                                        <td>{{ $coli->telephone }}</td>
                                                        <td>{{ $coli->ville }}</td>
                                                        <td>{{ $coli->prix }}</td>
                                                        <td>{{ $coli->created_at }}</td>
                                                        <td>{{ $coli->statue }}</td>
                                                        <td>{{ $coli->products }}</td>
                                                        <td>
                                                            <div class="d-flex">
                                                                <a href="{{ route('colis.show', $coli->id) }}"
                                                                    class="btn btn-primary" style="margin-right: 6px"><i
                                                                        class="fa-solid fa-eye"></i></a>
                                                                @if ($coli->statue == 'nouveau')
                                                                    <a href="{{ route('colis.edit', $coli->id) }}"
                                                                        class="btn btn-warning" style="margin-right: 6px"><i
                                                                            class="fa-sharp fa-solid fa-pen-to-square"></i></a>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Add To Bon</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">bons livraison list {{ $bons->count() }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>bon ID</th>
                                        <th>statue</th>
                                        <th>created at</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bons as $coli)
                                        <tr>
                                            <td>{{ $coli->id }}</td>
                                            <td>
                                                @if ($coli->admin_statue == 0)
                                                    <span class="badge bg-warning text-white">en attent</span>
                                                @elseif ($coli->admin_statue == 1)
                                                    <span class="badge bg-success text-white">received</span>
                                                @endif
                                            </td>
                                            <td> {{ $coli->created_at->diffForHumans()}}</td>
                                            <td>
                                                <a href="{{ route('user.coli.view_and_add',$coli->id) }}" class="btn btn-primary"><i class="fa-solid fa-eye"></i></a>
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

