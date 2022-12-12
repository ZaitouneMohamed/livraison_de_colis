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
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
                    data-whatever="@mdo"><b><b>+</b></b> admin</button><br><br>
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
                            <form method="POST" action="{{ route('manage_admin.store') }}">
                                @csrf
                                @method('post')
                                <div class="modal-body">
                                    <div class="form-row">
                                        <div class="col form-group">
                                            <label>name : *</label>
                                            <input type="text" name="name" class="form-control"
                                                placeholder="name">
                                        </div>
                                        <div class="col form-group">
                                            <label>email : *</label>
                                            <input type="email" name="email" class="form-control" placeholder="phone">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col form-group">
                                            <label>password : *</label>
                                            <input type="password" name="password" class="form-control"
                                                placeholder="name">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col form-group">
                                            <label>phone :</label>
                                            <input type="text" name="phone" class="form-control"
                                                placeholder="phone">
                                        </div>
                                        <div class="col form-group">
                                            <label>adresse :</label>
                                            <input type="text" name="adresse" class="form-control" placeholder="adresse">
                                        </div>
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
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Admin List</h6>
                    </div>
                    
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>email</th>
                                        <th>phone</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admins as $admin)
                                        <tr>
                                            <td>{{ $admin->name }}</td>
                                            <td>{{ $admin->email }}</td>
                                            <td>{{ $admin->phone }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    @if (auth()->user()->id != $admin->id )     
                                                        <a href="{{route('manage_admin.edit',$admin->id)}}" class="btn btn-primary"><i class="fa-solid fa-eye"></i></a>
                                                        <form action="{{ route('manage_admin.destroy',$admin->id) }}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                                        </form>
                                                    @endif
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
