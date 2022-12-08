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
                    data-whatever="@mdo"><b><b>+</b></b> Employee</button><br><br>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">New employee</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="POST" action="{{ route('employees.store') }}">
                                @csrf
                                @method('post')
                                <div class="modal-body">
                                    <div class="form-row">
                                        <div class="col form-group">
                                            <label>Nom et Prenom :</label>
                                            <input type="text" name="name" class="form-control"
                                                placeholder="full name">
                                        </div> <!-- form-group end.// -->
                                        <div class="col form-group">
                                            <label>telephone :</label>
                                            <input type="text" name="phone" class="form-control" placeholder="phone">
                                        </div> <!-- form-group end.// -->
                                    </div> <!-- form-row end.// -->
                                    <div class="form-row">
                                        <div class="col form-group">
                                            <label>email : </label>
                                            <input type="text" name="email" class="form-control" placeholder="email">
                                        </div> <!-- form-group end.// -->
                                        <div class="col form-group">
                                            <label>Mot de Passe :</label>
                                            <input type="password" name="password" class="form-control"
                                                placeholder="mots de passe">
                                        </div> <!-- form-group end.// -->
                                    </div> <!-- form-row end.// -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Send message</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Employee list {{ $employees->count() }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>email</th>
                                        <th>adresse</th>
                                        <th>phone</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employees as $employee)
                                        <tr>
                                            <td>{{ $employee->name }}</td>
                                            <td>{{ $employee->email }}</td>
                                            <td>{{ $employee->adresse }}</td>
                                            <td>{{ $employee->phone }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <button class="btn btn-warning" style="margin-right: 6px">update</button>
                                                    <form action="{{ route('employees.destroy', $employee->id) }}"
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
