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
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-2 font-weight-bold text-primary">vous avez {{ $colis->count() }} nouveau colis</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" name="" id="">
                                        </th>
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
                                <form action="{{ route('user.coli.add.coli.to.bon.livraison') }}" method="post"
                                    id="my_form">
                                    @csrf
                                    @method('post')
                                    <input type="hidden" name="bon_id" value="">
                                    <tbody>
                                        <input type="submit" value="bon de ramassage" class="btn btn-primary"><br><br>
                                        @foreach ($colis as $coli)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="colis[]" value="{{ $coli->id }}"
                                                        id="">
                                                </td>
                                                <td>{{ $coli->id }}</td>
                                                <td>{{ $coli->destinataire }}</td>
                                                <td>{{ $coli->telephone }}</td>
                                                <td>{{ $coli->ville }}</td>
                                                <td>{{ $coli->prix }}</td>
                                                <td>{{ $coli->created_at }}</td>
                                                <td>
                                                    {{ $coli->statue }}
                                                </td>
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
                                </form>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
