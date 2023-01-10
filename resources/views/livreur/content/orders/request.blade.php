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
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <div class="d-flex">
                                request count : {{ $bons->count() }}
                            </div>
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>bon ID</th>
                                        <th>view</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bons as $bon)
                                        <tr>
                                            <td>{{ $bon->id }}</td>
                                            <td>
                                                <form action="{{route('livreur.bon.view.colis')}}" >
                                                    @csrf
                                                    <input type="hidden" name="bon_id" value="{{ $bon->id }}">
                                                    <button type="submit" class="btn btn-warning">
                                                        <i class="fa-sharp fa-solid fa-eye"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <form action="{{route('livreur.bon.accepte',$bon->id)}}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success mt-3" style="margin-left: 320px"> accepte</button>
                                                    </form>
                                                    <form action="{{route('livreur.bon.refuse',$bon->id)}}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger mt-3 ml-4"> refuse</button>
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
