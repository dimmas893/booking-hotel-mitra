@extends('layouts.admin.template')
@section('content')
    <div class="main-content">

        <div class="">
            <div class="modal fade" id="add_TU_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                        </div>
                        <form action="#" method="POST" id="add_TU_form" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="my-2">
                                    <label for="name">Jenis Mitra</label>
                                    <select name="idjenismitra" class="form-control select2">
                                        <option value="" selected disabled>---Pilih Jenis Mitra---</option>
                                        @foreach ($jenismitra as $item)
                                            <option value="{{ $item->id }}">{{ $item->namajenismitra }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="my-2">
                                    <label for="name">Nama Mitra</label>
                                    <input type="text" name="namamitra" class="form-control"
                                        placeholder="Masukan Nama Mitra" required>
                                </div>
                                <div class="my-2">
                                    <label for="name">Email</label>
                                    <input type="text" name="email" class="form-control"
                                        placeholder="Masukan Nama Mitra" required>
                                </div>
                                <div class="my-2">
                                    <label for="name">Longitude</label>
                                    <textarea name="longitude" class="form-control" placeholder="Masukan Longitude" required></textarea>
                                </div>
                                <div class="my-2">
                                    <label for="name">Latitude</label>
                                    <textarea name="latitude" class="form-control" placeholder="Masukan Latitude" required></textarea>
                                </div>
                                <div class="my-2">
                                    <label for="name">Alamat</label>
                                    <textarea name="alamatmitralengkap" class="form-control" placeholder="Masukan Alamat Lengkap" required></textarea>
                                </div>
                                <div class="my-2">
                                    <label for="foto">Foto</label>
                                    <input type="file" name="foto" class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" id="add_TU_btn" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="editTUModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                data-backdrop="static" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                        </div>
                        <form action="#" method="POST" id="edit_TU_form" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="emp_image" id="emp_image">
                            <div class="modal-body">
                                <div class="my-2">
                                    <label for="name">Jenis Mitra</label>
                                    <select name="idjenismitra" class="form-control" id="idjenismitra">
                                        <option value="" selected disabled>---Pilih Jenis Mitra---</option>
                                        @foreach ($jenismitra as $item)
                                            <option value="{{ $item->id }}">{{ $item->namajenismitra }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="my-2">
                                    <label for="name">Nama Mitra</label>
                                    <input type="text" name="namamitra" id="namamitra" class="form-control"
                                        placeholder="Masukan Nama Mitra" required>
                                </div>
                                <div class="my-2">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        placeholder="Masukan email">
                                </div>
                                <div class="my-2">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="Masukan Password">
                                    <p style="color:red">*Kosongkan jika tidak ingin mengganti</p>
                                </div>
                                <div class="my-2">
                                    <label for="name">longitude</label>
                                    <textarea name="longitude" id="longitude" class="form-control" placeholder="Masukan longitude" required></textarea>
                                </div>
                                <div class="my-2">
                                    <label for="name">Latitude</label>
                                    <textarea name="latitude" id="latitude" class="form-control" placeholder="Masukan latitude" required></textarea>
                                </div>
                                <div class="my-2">
                                    <label for="name">Alamat</label>
                                    <textarea name="alamatmitralengkap" id="alamatmitralengkap" class="form-control"
                                        placeholder="Masukan Alamat Lengkap" required></textarea>
                                </div>

                                <div class="my-2">
                                    <label for="image">Select Foto</label>
                                    <input type="file" id="emp_image" name="foto" class="form-control">
                                </div>
                                <div class="mt-2" id="image">

                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" id="edit_TU_btn" class="btn btn-success">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="section-header">
                <h1>Halaman Data Mitra</h1>
            </div>
            <div class="section-body">
                <div class="row my-5">
                    <div class="col-lg-12">
                        <div class="card shadow">
                            <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                                <h3 class="text-light">Tabel Mitra</h3>
                                <button class="btn btn-light" data-toggle="modal" data-target="#add_TU_modal"><i
                                        class="bi-plus-circle me-2"></i>Tambah Mitra</button>
                            </div>
                            <div>
                                <div class="card-body" id="TU_all">
                                    <h1 class="text-secondary my-5 text-center">
                                        <div class="load-3">
                                            <div class="line"></div>
                                            <div class="line"></div>
                                            <div class="line"></div>
                                        </div>
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
    <script>
        $(document).ready(function() {
            // $(".select2").select2();
            if (jQuery().select2) {
                $(".select2").select2({
                    width: '100%'
                });
            }
        })
        $(function() {
            // add new employee ajax request
            $("#add_TU_form").submit(function(e) {
                e.preventDefault();
                const fd = new FormData(this);
                $("#add_TU_btn").text('Loading...');
                $.ajax({
                    url: '{{ route('mitra-store') }}',
                    method: 'post',
                    data: fd,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 200) {
                            Swal.fire(
                                'Berhasil!',
                                'Berhasil menambah data!',
                                'success'
                            )
                            TU_all();
                            $("#add_TU_btn").text('Save');
                            $("#add_TU_form")[0].reset();
                            $("#add_TU_modal").modal('hide');
                        } else {
                            Swal.fire(
                                'Opss!',
                                'Email udah ada harap ubah alamat email!',
                                'info'
                            )
                            $("#add_TU_btn").text('Simpan');
                        }
                    }
                });
            });
            // edit employee ajax request
            $(document).on('click', '.editIcon', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                $.ajax({
                    url: '{{ route('mitra-edit') }}',
                    method: 'get',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response.foto)
                        $("#idjenismitra").val(response.idjenismitra);
                        $("#namamitra").val(response.namamitra);
                        $("#email").val(response.user.email);
                        $("#longitude").val(response.longitude);
                        $("#latitude").val(response.latitude);
                        $("#alamatmitralengkap").val(response.alamatmitralengkap);
                        $("#image").html(
                            `<img src="/mitrafoto/${response.foto}" width="100" class="img-fluid img-thumbnail">`
                        );
                        $("#emp_image").val(response.foto);
                        $("#id").val(response.id);
                    }
                });
            });
            // update employee ajax request
            $("#edit_TU_form").submit(function(e) {
                e.preventDefault();
                const fd = new FormData(this);
                $("#edit_TU_btn").text('Loading...');
                $.ajax({
                    url: '{{ route('mitra-update') }}',
                    method: 'post',
                    data: fd,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 200) {
                            Swal.fire(
                                'Berhasil!',
                                'Berhasil mengubah data!',
                                'success'
                            )
                            TU_all();
                            $("#edit_TU_btn").text('Update');
                            $("#edit_TU_form")[0].reset();
                            $("#editTUModal").modal('hide');
                        }
                        if (response.status === 400) {
                            Swal.fire(
                                'Opss!',
                                'Email udah ada harap ubah alamat email!',
                                'info'
                            )
                            $("#edit_TU_btn").text('Updating');
                        }

                    }
                });
            });
            // delete employee ajax request
            $(document).on('click', '.deleteIcon', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                let csrf = '{{ csrf_token() }}';
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('mitra-delete') }}',
                            method: 'post',
                            data: {
                                id: id,
                                _token: csrf
                            },
                            success: function(response) {
                                console.log(response);
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )
                                TU_all();
                            }
                        });
                    }
                })
            });
            // fetch all employees ajax request
            TU_all();

            function TU_all() {
                $.ajax({
                    url: '{{ route('mitra-all') }}',
                    method: 'get',
                    success: function(response) {
                        $("#TU_all").html(response);
                        $("table").DataTable({
                            destroy: true,
                            responsive: true
                        });
                    }
                });
            }
        });
    </script>
@endsection
