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
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
                    data-whatever="@mdo"><b><b>+</b></b> colis</button><br><br>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">New colis</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="POST" action="{{ route('colis.store') }}">
                                @csrf
                                @method('post')
                                <div class="modal-body">
                                    <div class="form-row">
                                        <div class="col form-group">
                                            <label>Destinaire : <span style="color: red">*</span></label>
                                            <input type="text" name="destinataire" class="form-control"
                                                placeholder="destinataire">
                                        </div>
                                        <div class="col form-group">
                                            <label>telephone : <span style="color: red">*</span></label>
                                            <input type="text" name="phone" class="form-control" placeholder="phone">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col form-group">
                                            <label>ville : <span style="color: red">*</span></label>
                                            <input type="text" name="ville" class="form-control" placeholder="ville">
                                        </div>
                                        <div class="col form-group">
                                            <label>prix : <span style="color: red">*</span></label>
                                            <input type="number" name="prix" class="form-control" placeholder="prix">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <label>adresse : <span style="color: red">*</span></label>
                                        <input type="text" name="adresse" class="form-control"
                                            placeholder="adresse exact">
                                    </div>
                                    <div class="form-row">
                                        <label>produit : <span style="color: red">*</span></label>
                                        <input type="test" name="products" class="form-control" placeholder="produit">
                                    </div>
                                    <div class="form-row">
                                        <label>note :</label>
                                        <input type="text" name="note" class="form-control" placeholder="note">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Send Colie</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">tout votre colis {{ $colis->count() }}</h6>
                    </div>
                    <div class="card-body">
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
                                        <th>Etat</th>
                                        <th>produit</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach ($colis as $coli)
                                            <tr>
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
                                                                <form action="{{ route('colis.destroy', $coli->id) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <button class="btn btn-danger" type="submit"><i
                                                                                class="fa-solid fa-trash"></i></button>
                                                                    </form>
                                                            @endif 
                                                        </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                            </table>
                            {{ $colis->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>



    </div>
@endsection
@section("js")

<script>

// $(document).ready(function() {
//     $('#myTable').DataTable( {
//         dom: 'Bfrtip',
//         // buttons: [
//         //     'pdfHtml5',
//         //     'copyHtml5',
//         //     'excelHtml5',
//         //     'csvHtml5',
//         //     ]
//     } );
// } );
// button = document.getElementById('btn_sbmt');

// button.onclick = function f1() {
//     document.getElementById('my_form').submit();
// }
</script>
@endsection
