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
                        <h6 class="m-0 font-weight-bold text-primary">Employee list {{ $colis->count() }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($colis as $coli)
                                        <tr>

                                            <td>{{ $coli->destination }}</td>
                                            <td>{{ $coli->telephone }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <button class="btn btn-warning" style="margin-right: 6px">update</button>
                                                    <form action="{{ route('colis.destroy', $coli->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger" type="submit">delete</button>
                                                    </form>
                                                </div>
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
