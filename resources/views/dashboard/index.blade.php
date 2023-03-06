@extends('dashboard.layouts.main')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
    <button type="button" class="btn btn-secondary d-flex gap-1 align-items-center" data-bs-toggle="modal"
        data-bs-target="#create">
        <i data-feather="plus"></i> Create
    </button>
</div>
<div class="navbar">
    <div class="d-flex gap-2 align-items-center">
        <div>sadsa</div>
        <select class="form-select form-select-sm" aria-label="Default select example">
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
        </select>
        <div>sads</div>
    </div>
    <form action="">
        <div class="input-group input-group-sm flex-nowrap">
            <button type="submit" class="input-group-text" id="addon-wrapping">Search</button>
            <input type="text" class="form-control" placeholder="Username" aria-label="Username"
                aria-describedby="addon-wrapping">
        </div>
    </form>
</div>
<div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Satuan Unit</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">Aktif</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($units as $unit)
            <tr>
                <td>{{ $unit->name }}</td>
                <td>{{ $unit->description }}</td>
                <td>
                    @if ($unit->aktif == true)
                    <button class="btn btn-success btn-sm">Aktif</button>
                    @else
                    <button class="btn btn-danger btn-sm">Nonaktif</button>
                    @endif
                </td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Action
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" data-bs-toggle="modal"
                                    data-bs-target="#{{ $unit->id }}">Edit</a>
                            </li>
                            @if ($unit->aktif == true)
                            <li>
                                <form action="/unit/aktif/{{ $unit->id }}" method="POST">
                                    @csrf
                                    <input type="hidden" value="0" name="aktif">
                                    <button type="submit" class="dropdown-item"><i data-feather="power"
                                            class="text-danger"></i>
                                        Nonaktif</button>
                                </form>
                            </li>
                            @else
                            <li>
                                <form action="/unit/aktif/{{ $unit->id }}" method="POST">
                                    @csrf
                                    <input type="hidden" value="1" name="aktif">
                                    <button type="submit" class="dropdown-item" href="">
                                        <i data-feather="power" class="text-success"></i>
                                        Aktif
                                    </button>
                                </form>
                            </li>
                            @endif
                        </ul>
                    </div>
                </td>
            </tr>
            {{-- Satuan Unit --}}
            <div class="modal fade" id="{{ $unit->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Satuan Unit</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="/dashboard/edit/{{ $unit->id }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Satuan Unit<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="name@example.com" value="{{ $unit->name }}">
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="description"
                                        placeholder="name@example.com" name="description"
                                        value="{{ $unit->description }}">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>

    {{-- Create --}}
    <div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Satuan Unit</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <input type="hidden" name="aktif" value="1">
                            <label for="name" class="form-label">Satuan Unit<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Satuan Unit">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="description" placeholder="description"
                                name="description">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
