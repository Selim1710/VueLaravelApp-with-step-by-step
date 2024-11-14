<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>
    <style>
        label {
            text-transform: capitalize;
        }
    </style>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-end">
                    <!-- Large modal -->
                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#addNewModalId">
                        Add New
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table id="basic-datatable" class="table table-bordered table-striped dt-responsive w-100">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Remarks</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($categories))
                            @foreach ($categories as $key => $data)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $data->name ?? '' }}</td>
                                    <td class="{{ $data->status == 1 ? '' : 'text-danger' }}">
                                        {{ $data->status == 1 ? 'Active' : 'Inactive' }}
                                    </td>
                                    <td>{!! Str::limit($data->description, 50) !!}</td>
                                    <td style="width: 100px;">
                                        <div class="d-flex justify-content-end gap-1">
                                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#editNewModalId{{ $data->id }}">Edit</button>
                                            <a class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#danger-header-modal{{ $data->id }}">Delete</a>

                                        </div>
                                    </td>


                                    <!--Edit Modal -->
                                    <div class="modal fade" id="editNewModalId{{ $data->id }}"
                                        data-bs-backdrop="static" tabindex="-1" role="dialog"
                                        aria-labelledby="editNewModalLabel{{ $data->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="addNewModalLabel{{ $data->id }}">
                                                        Edit
                                                        {{ $page_tile }}
                                                    </h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post"
                                                        action="{{ route('category.update', $data->id) }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="mb-3">
                                                                    <label for="title" class="form-label">Title<span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" id="title" name="name"
                                                                        value="{{ $data->name }}"
                                                                        class="form-control" placeholder="Enter Title"
                                                                        required>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="mb-3">
                                                                    <label> Remarks</label>
                                                                    <textarea class="form-control  ck_editor" name="description" placeholder="Enter Remarks">{{ $data->description }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="mb-3">
                                                                    <label for="example-select"
                                                                        class="form-label">Status<span
                                                                            class="text-danger">*</span></label>
                                                                    <select name="status" class="form-select">
                                                                        <option value="1"
                                                                            {{ $data->status === 1 ? 'selected' : '' }}>
                                                                            Active</option>
                                                                        <option value="0"
                                                                            {{ $data->status === 0 ? 'selected' : '' }}>
                                                                            Inactive</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex justify-content-end">
                                                            <button class="btn btn-primary"
                                                                type="submit">Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Delete Modal -->
                                    <div id="danger-header-modal{{ $data->id }}" class="modal fade" tabindex="-1"
                                        role="dialog" aria-labelledby="danger-header-modalLabel{{ $data->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header modal-colored-header bg-danger">
                                                    <h4 class="modal-title"
                                                        id="danger-header-modalLabe{{ $data->id }}l">Delete</h4>
                                                    <button type="button" class="btn-close btn-close-white"
                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <h5 class="mt-0">Are You Went to Delete this ? </h5>
                                                </div>
                                                <div class="modal-footer">

                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <a href="{{ route('category.show', $data->id) }}"
                                                        class="btn btn-danger">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--Add Modal -->
    <div class="modal fade" id="addNewModalId" data-bs-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="addNewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="addNewModalLabel">Add {{ $page_tile }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('category.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title<span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="title" name="name" class="form-control"
                                        placeholder="Enter Title" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label>Remarks</label>
                                    <textarea class="form-control ck_editor" id="" name="description" placeholder="Enter Remarks" rows="4"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="example-select" class="form-label">Status<span
                                            class="text-danger">*</span></label>
                                    <select name="status" class="form-select" required>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>


</body>

</html>
