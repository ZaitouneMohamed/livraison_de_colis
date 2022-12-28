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
                                        <th>action</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bons as $bon)
                                        <tr>
                                            <td>{{ $bon->id }}</td>
                                            <td>
                                                <form action="">
                                                    <select name="" id="">
                                                        <option value="v1">received</option>
                                                        <option value="v2">another actions</option>
                                                        <option value="v2">another actions</option>
                                                        <option value="v2">another actions</option>
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
                            {{ $bons->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>



    </div>
@endsection
