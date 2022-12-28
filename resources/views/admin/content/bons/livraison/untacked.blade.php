@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
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
                    <div class="card-header py-3 d-flex">
                        <h6 class="m-0 font-weight-bold text-primary">bons list {{ $bons->count() }}</h6><input class="ml-5" type="search" name="" placeholder="search for bon by id" id="">
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>livreur</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bons as $bon)
                                        <tr>
                                            <td>{{ $bon->id }}</td>
                                            <td>
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
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{route('admin.bon.livraison.view',$bon->id)}}" class="btn btn-success"><i class="fa-solid fa-eye"></i></a>
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
