@extends('master.layout')

@section('title')
    Produk Habis
@endsection

@section('subtitle')
    Produk Habis
@endsection

@section('content')
    <div class="col-md-12 table-responsive">
        {!! $html->table(['class'=>'bordered-table display']) !!}
    </div>
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Stok</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ustok" class="bmd-label-floating">Update Stok</label>
                                <input type="text" name="ustok" id="ustok" class="form-control"
                                       style="text-align: center" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="update-stok">Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/material-design-lite/1.3.0/material.min.js"></script>
    <script>
        $(document).ready(function () {
            var id = 0;
            var dt = $('#dataTableBuilder').DataTable({
                processing: true,
                serverSide: true,
                ajax: '/admin/emProduk/',
                columns: [
                    {data: 'id_produk', name: 'id_produk'},
                    {data: 'nama_produk', name: 'nama_produk'},
                    {data: 'nama_kategori', name: 'nama_kategori'},
                    {data: 'harga', name: 'harga'},
                    {data: 'deskripsi', name: 'deskripsi'},
                    {data: 'stok', name: 'stok'},
                    {data: 'size', name: 'size'},
                    {data: 'warna', name: 'warna'},
                    {data: 'action', name: 'action', orderable: false, searchable: false, align: 'center'},
                ]
            });
            $('body').on("click", '.editmodal', function () {
                $('#myModal').modal("show");
                id = $(this).attr('data-id');
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $('#update-stok').click(function () {
                $.ajax({
                    url: "/admin/editStok/" + id,
                    method: "PUT",
                    data: {
                        'stok': $('#ustok').val()
                    },
                }).done(function (msg) {
                    dt.ajax.reload();
                    alert("Produk sudah dipindahkan ke list produk.");
                    $('#myModal').modal("hide");
                }).fail(function (textStatus) {
                    alert("inputan harus berupa angka");
                    $('#myModal').modal("hide");
                });
            });
        });
    </script>
@endsection

