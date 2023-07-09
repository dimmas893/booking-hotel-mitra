@extends('layouts.admin.template')
@section('content')
    <div class="main-content">
        <div class="modal fade" id="add_TU_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    </div>
                    <form action="#" method="POST" id="add_TU_form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ $id }}" name="idmitra">
                        <div class="modal-body">
                            <div class="my-2">
                                <label for="name">Tanggal Awal Berlaku</label>
                                <input type="date" name="tglawalberlaku" class="form-control" required>
                            </div>
                            <div class="my-2">
                                <label for="name">Tanggal Akhir Berlaku</label>
                                <input type="date" name="tglakhirberlaku" class="form-control" required>
                            </div>
                            <div class="my-2">
                                <label for="name">Tanggal Ditandatangani</label>
                                <input type="date" name="tglditandatangani" class="form-control" required>
                            </div>
                            <div class="my-2">
                                <label for="name">Nama Pihak Owner 1</label>
                                <input type="text" name="namapihakowner1" class="form-control"
                                    placeholder="Masukan Nama Pihak Owner 1" required>
                            </div>

                            <div class="my-2">
                                <label for="name">Nama Pihak Owner 2</label>
                                <input type="text" name="namapihakowner2" class="form-control"
                                    placeholder="Masukan Nama Pihak Owner 2" required>
                            </div>
                            <div class="my-2">
                                <label for="name">Nama Pihak Mitra 1</label>
                                <input type="text" name="namapihakmitra1" class="form-control"
                                    placeholder="Masukan Nama Pihak Mitra 1" required>
                            </div>
                            <div class="my-2">
                                <label for="name">Nama Pihak Mitra 2</label>
                                <input type="text" name="namapihakmitra2" class="form-control"
                                    placeholder="Masukan Nama Pihak Mitra 2" required>
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
        <div class="modal fade" id="editTUModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-backdrop="static"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                    </div>
                    <form action="#" method="POST" id="edit_TU_form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <input type="hidden" name="idmitra" {{ $id }}>
                        <div class="modal-body">
                            <div class="my-2">
                                <label for="name">Tanggal Awal Berlaku</label>
                                <input type="date" name="tglawalberlaku" id="tglawalberlaku" class="form-control"
                                    required>
                            </div>
                            <div class="my-2">
                                <label for="name">Tanggal Akhir Berlaku</label>
                                <input type="date" name="tglakhirberlaku" id="tglakhirberlaku" class="form-control"
                                    required>
                            </div>
                            <div class="my-2">
                                <label for="name">Tanggal Ditandatangani</label>
                                <input type="date" name="tglditandatangani" id="tglditandatangani"
                                    class="form-control" required>
                            </div>
                            <div class="my-2">
                                <label for="name">Nama Pihak Owner 1</label>
                                <input type="text" name="namapihakowner1" id="namapihakowner1" class="form-control"
                                    placeholder="Masukan Nama Pihak Owner 1" required>
                            </div>

                            <div class="my-2">
                                <label for="name">Nama Pihak Owner 2</label>
                                <input type="text" name="namapihakowner2" id="namapihakowner2" class="form-control"
                                    placeholder="Masukan Nama Pihak Owner 2" required>
                            </div>
                            <div class="my-2">
                                <label for="name">Nama Pihak Mitra 1</label>
                                <input type="text" name="namapihakmitra1" id="namapihakmitra1" class="form-control"
                                    placeholder="Masukan Nama Pihak Mitra 1" required>
                            </div>
                            <div class="my-2">
                                <label for="name">Nama Pihak Mitra 2</label>
                                <input type="text" name="namapihakmitra2" id="namapihakmitra2" class="form-control"
                                    placeholder="Masukan Nama Pihak Mitra 2" required>
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


        <div class="modal fade" id="add_TU_modal_harga" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Harga Perjanjian Mitra</h5>
                    </div>
                    <form action="{{ route('hargasepakatmitra-store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="idkesepakatan" name="idperjanjianmitra">
                        <div class="modal-body">
                            <div class="my-2">
                                <label for="name">Fasilitas</label>
                                <select name="idfasilitas" class="form-control select2">
                                    <option value="" selected disabled>---Pilih Fasilitas---</option>
                                    @foreach ($fasilitas as $item)
                                        <option value="{{ $item->id }}">{{ $item->namafasilitas }} -
                                            {{ $item->jenisfasilitas->namajenisfasilitas }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="my-2">
                                <label for="name">Unit</label>
                                <select name="idunit" class="form-control">
                                    <option value="" selected disabled>---Pilih Unit---</option>
                                    @foreach ($unit as $item)
                                        <option value="{{ $item->id }}">{{ $item->namaunit }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="my-2">
                                <label for="name">Harga Per Orang</label>
                                <input type="number" name="hargaperorang" placeholder="Masukan Harga Kesepakatan Mitra"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="add_TU_btn_harga" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="edithargaperjanjianmitramodal" tabindex="-1" aria-labelledby="exampleModalLabel"
            data-backdrop="static" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Harga Sepakat Mitra</h5>
                    </div>
                    <form action="#" method="POST" id="edit_TU_form_harga" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="idhargakesepakatanmitra" id="idhargakesepakatanmitra">
                        <div class="modal-body">
                            <div class="my-2">
                                <label for="name">Unit</label>
                                <select name="idunit" id="idunit" class="form-control">
                                    <option value="">---Pilih Unit---</option>
                                    @foreach ($unit as $item)
                                        <option value="{{ $item->id }}">{{ $item->namaunit }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="my-2">
                                <label for="name">Harga Per Orang</label>
                                <input type="number" name="hargaperorang" id="hargaperorang"
                                    placeholder="Masukan Harga Kesepakatan Mitra" class="form-control" required>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="edit_TU_btn_harga" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="section-header">
                <h1>Halaman Perjanjian Mitra</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-lg-8 col-sm-12 col-md-12">
                        <div class="card shadow">
                            <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                                <h3 class="text-light">Tabel Perjanjian Mitra</h3>
                                <button class="btn btn-light" data-toggle="modal" data-target="#add_TU_modal"><i
                                        class="bi-plus-circle me-2"></i>Tambah Perjanjian Mitra</button>
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
                    @php
                        $mitra = \App\Models\Mitra::where('id', $id)->first();
                    @endphp
                    <div class="col-lg-4 col-sm-12 col-md-12">
                        <div class="card shadow card-primary">
                            <img src="{{ asset('mitrafoto/' . $mitra->foto) }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{ $mitra->namamitra }}</h5>
                                <p class="card-text">{{ $mitra->alamatmitralengkap }}</p>
                                {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')
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
                    url: '{{ route('perjanjianmitra-store') }}',
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

            $(document).on('click', '.editIcon_harga', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                console.log(id)
                $("#idkesepakatan").val(id);
            });

            // edit employee ajax request
            $(document).on('click', '.editIcon', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                $.ajax({
                    url: '{{ route('mitra-perjanjianmitra') }}',
                    method: 'get',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response.id)
                        $("#tglawalberlaku").val(response.tglawalberlaku);
                        $("#tglakhirberlaku").val(response.tglakhirberlaku);
                        $("#tglditandatangani").val(response.tglditandatangani);
                        $("#namapihakowner1").val(response.namapihakowner1);
                        $("#namapihakowner2").val(response.namapihakowner2);
                        $("#namapihakmitra1").val(response.namapihakmitra1);
                        $("#namapihakmitra2").val(response.namapihakmitra2);
                        // $("#namajenisfasilitas").val(response.namajenisfasilitas);
                        $("#id").val(response.id);
                    }
                });
            });

            $(document).on('click', '.edithargaperjanjianmitra', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                $.ajax({
                    url: '{{ route('hargasepakatmitra-edit') }}',
                    method: 'get',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response.id)
                        $("#hargaperorang").val(response.hargaperorang);
                        $("#idunit").val(response.idunit);
                        $("#idhargakesepakatanmitra").val(response.id);
                    }
                });
            });

            $("#edit_TU_form_harga").submit(function(e) {
                e.preventDefault();
                const fd = new FormData(this);
                $("#edit_TU_btn_harga").text('Loading...');
                $.ajax({
                    url: '{{ route('hargasepakatmitra-update') }}',
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
                            $("#edit_TU_btn_harga").text('Update');
                            $("#edit_TU_form_harga")[0].reset();
                            $("#edithargaperjanjianmitramodal").modal('hide');
                        }

                    }
                });
            });
            // update employee ajax request
            $("#edit_TU_form").submit(function(e) {
                e.preventDefault();
                const fd = new FormData(this);
                $("#edit_TU_btn").text('Loading...');
                $.ajax({
                    url: '{{ route('perjanjianmitra-update') }}',
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
                            url: '{{ route('perjanjianmitra-delete') }}',
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
                    url: '{{ route('perjanjianmitra-all', $id) }}',
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
