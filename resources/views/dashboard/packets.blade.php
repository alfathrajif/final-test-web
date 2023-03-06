@extends('dashboard.layouts.main')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#create">
        Create
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
                <th scope="col">Paket Kuota</th>
                <th scope="col">Berat</th>
                <th scope="col">Harga</th>
                <th scope="col">Cabang</th>
                <th scope="col">Created At</th>
                <th scope="col">Aktif</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($packets as $packet)
            <tr>
                <td>{{ $packet->name }}</td>
                <td>{{ $packet->weight }} {{ $packet->unit->name }}</td>
                <td>{{ "Rp " . number_format($packet->price,2,',','.') }}</td>
                <td>{{ $packet->branch }}</td>
                <td>{{ $packet->created_at }}</td>
                <td>
                    @if ($packet->aktif == true)
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
                                    data-bs-target="#{{ $packet->id }}">Edit</a>
                            </li>
                            @if ($packet->aktif == true)
                            <li>
                                <form action="/packet/aktif/{{ $packet->id }}" method="POST">
                                    @csrf
                                    <input type="hidden" value="0" name="aktif">
                                    <button type="submit" class="dropdown-item">Nonaktif</button>
                                </form>
                            </li>
                            @else
                            <li>
                                <form action="/packet/aktif/{{ $packet->id }}" method="POST">
                                    @csrf
                                    <input type="hidden" value="1" name="aktif">
                                    <button type="submit" class="dropdown-item" href="">Aktif</button>
                                </form>
                            </li>
                            @endif
                        </ul>
                    </div>
                </td>
            </tr>
            {{-- pakcet unit --}}
            <div class="modal fade" id="{{ $packet->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Paket Kuota</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="/dashboard/packets/update/{{ $packet->id }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <input type="hidden" name="aktif" value="1">
                                    <label for="name" class="form-label">Paket Kuota<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Satuan Unit" value="{{ $packet->name }}">
                                </div>
                                <div class="flex gap-2">
                                    <div class="row">
                                        <div class="col">
                                            <label for="weight" class="form-label">Berat
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="weight" placeholder="weight"
                                                name="weight" value="{{ $packet->weight }}">
                                        </div>
                                        <div class=" col">
                                            <label for="description" class="form-label">Satuan Unit
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select class="form-select" aria-label="Default select example"
                                                name="satuan_id">
                                                @foreach ($units as $unit)
                                                <option value="{{ $unit->id }}" @if ($packet->unit->id == $unit->id)
                                                    selected
                                                    @endif>{{ $unit->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="price" class="form-label">Harga<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="price" name="price" placeholder="Harga"
                                        value="{{ $packet->price }}">
                                </div>
                                <div class="mb-3">
                                    <label for="branch" class="form-label">Cabang<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="branch" name="branch"
                                        placeholder="Cabang" value="{{ $packet->branch }}">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-warning">Update</button>
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Paket Kuota</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <input type="hidden" name="aktif" value="1">
                            <label for="name" class="form-label">Paket Kuota<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Satuan Unit">
                        </div>
                        <div class="flex gap-2">
                            <div class="row">
                                <div class="col">
                                    <label for="weight" class="form-label">Berat
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="weight" placeholder="weight"
                                        name="weight">
                                </div>
                                <div class="col">
                                    <label for="description" class="form-label">Satuan Unit
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select" aria-label="Default select example" name="satuan_id">
                                        @foreach ($units as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Harga<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="price" name="price" placeholder="Harga">
                        </div>
                        <div class="mb-3">
                            <label for="branch" class="form-label">Cabang<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="branch" name="branch" placeholder="Cabang">
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
