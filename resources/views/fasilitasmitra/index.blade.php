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
                            <input type="hidden" name="idmitra" value="{{ $perjanjianmitra->idmitra }}">
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
                                    <label for="name">Deskripsi</label>
                                    <textarea type="text" name="deskrispsifasilitas" class="form-control" placeholder="Masukan Deskripsi" required></textarea>
                                </div>
                                <div class="my-2">
                                    <label for="name">Spesifikasi</label>
                                    <textarea type="text" name="specfasilitasi" class="form-control" placeholder="Masukan Specfasilitasi" required></textarea>
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
                            <div class="modal-body">
                                <div class="my-2">
                                    <label for="name">Fasilitas</label>
                                    <select name="idfasilitas" id="idfasilitas" class="form-control">
                                        <option value="" selected disabled>---Pilih Fasilitas---</option>
                                        @foreach ($fasilitas as $item)
                                            <option value="{{ $item->id }}">{{ $item->namafasilitas }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="my-2">
                                    <label for="name">Deskripsi</label>
                                    <textarea type="text" name="deskrispsifasilitas" id="deskrispsifasilitas" class="form-control"
                                        placeholder="Masukan Deskripsi" required></textarea>
                                </div>
                                <div class="my-2">
                                    <label for="name">Spesifikasi</label>
                                    <textarea type="text" name="specfasilitasi" id="specfasilitasi" class="form-control"
                                        placeholder="Masukan Specfasilitasi" required></textarea>
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
                <h1>Halaman Data Fasilitas Mitra</h1>
            </div>
            <div class="section-body">
                @if (isset($perjanjianmitra))
                    {{-- {{ $perjanjianmitra }} --}}
                    <div class="row">
                        <div class="col-lg-4 col-sm-12 col-md-12">
                            <div class="card shadow card-primary">
                                {{-- <img src="{{ asset('mitrafoto/' . $mitra->foto) }}" class="card-img-top" alt="..."> --}}
                                <div class="card-body">
                                    <h5 class="card-title">Perjanjian Yang Berlaku</h5>
                                    <p class="card-text">{{ $perjanjianmitra->tglawalberlaku }} sampai
                                        {{ $perjanjianmitra->tglakhirberlaku }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-12 col-md-12">
                            <div class="card shadow card-primary">
                                {{-- <img src="{{ asset('mitrafoto/' . $mitra->foto) }}" class="card-img-top" alt="..."> --}}
                                <div class="card-body">
                                    <h5 class="card-title">Penanda Tangan Owner</h5>
                                    <p class="card-text">{{ $perjanjianmitra->namapihakowner1 }} dan
                                        {{ $perjanjianmitra->namapihakowner2 }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-12 col-md-12">
                            <div class="card shadow card-primary">
                                {{-- <img src="{{ asset('mitrafoto/' . $mitra->foto) }}" class="card-img-top" alt="..."> --}}
                                <div class="card-body">
                                    <h5 class="card-title">Penanda Tangan Mitra</h5>
                                    <p class="card-text">{{ $perjanjianmitra->namapihakmitra1 }} dan
                                        {{ $perjanjianmitra->namapihakmitra2 }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if (empty($perjanjianmitra))
                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow card-primary">
                                {{-- <img src="{{ asset('mitrafoto/' . $mitra->foto) }}" class="card-img-top" alt="..."> --}}
                                <div class="card-body">
                                    <h5 class="card-title">Masa Perjanjian Sudah Berakhir</h5>
                                    <p class="card-text">Silahkan Hubungi Pihak Terkait Untuk Memperpanjang</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="row my-2">
                    <div class="col-lg-8 col-sm-12 col-md-12">
                        <div class="card shadow">
                            <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                                <h3 class="text-light">Tabel Fasilitas Mitra</h3>
                                @if (isset($perjanjianmitra))
                                    <button class="btn btn-light" data-toggle="modal" data-target="#add_TU_modal"><i
                                            class="bi-plus-circle me-2"></i>Tambah Fasilitas Mitra</button>
                                @endif
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
                    <div class="col-lg-4 col-sm-12 col-md-12">
                        <div class="card shadow card-primary">
                            <img src="{{ asset('mitrafoto/' . $mitra->foto) }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{ $mitra->namamitra }}</h5>
                                <p class="card-text">{{ $mitra->alamatmitralengkap }}</p>
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
                $("#add_TU_btn").text('Adding...');
                $.ajax({
                    url: '{{ route('fasilitas-mitra-store') }}',
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
                        }
                        $("#add_TU_btn").text('Save');
                        $("#add_TU_form")[0].reset();
                        $("#add_TU_modal").modal('hide');
                    }
                });
            });
            // edit employee ajax request
            $(document).on('click', '.editIcon', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                $.ajax({
                    url: '{{ route('fasilitas-mitra-edit') }}',
                    method: 'get',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response.id)
                        $("#idfasilitas").val(response.idfasilitas);
                        $("#specfasilitasi").val(response.specfasilitasi);
                        $("#deskrispsifasilitas").val(response.deskrispsifasilitas);
                        $("#id").val(response.id);
                    }
                });
            });
            // update employee ajax request
            $("#edit_TU_form").submit(function(e) {
                e.preventDefault();
                const fd = new FormData(this);
                $("#edit_TU_btn").text('Updating...');
                $.ajax({
                    url: '{{ route('fasilitas-mitra-update') }}',
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
                        }
                        $("#edit_TU_btn").text('Update');
                        $("#edit_TU_form")[0].reset();
                        $("#editTUModal").modal('hide');
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
                            url: '{{ route('fasilitas-mitra-delete') }}',
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
                    url: '{{ route('fasilitas-mitra-all', $idperjanjian) }}',
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
