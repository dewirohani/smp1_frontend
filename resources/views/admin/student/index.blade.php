@extends('app')
@section('content')
    <div class="content">
            <!-- Datatables -->
      <div class="col-lg-12">
        <div class="card mb-4 ">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-dark">Data Siswa</h6>
            <a href="{{ route('students.create') }}">
              <button class="btn btn-success mr-2" style="float: right"><i class="fa fa-plus"></i></button>
            </a>
          </div>
          <div class="table-responsive p-3 align-items-center">
            <table class="table align-items-center table-flush" id="dataTable" >
              <thead class="thead-light">
                <tr>
                  <th>#</th>
                  <th>NISN</th>
                  <th>Nama</th>
                  <th>Jenis Kelamin</th>
                  <th>Diterima Di Kelas</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>#</th>
                  <th>NISN</th>
                  <th>Nama</th>
                  <th>Jenis Kelamin</th>
                  <th>Diterima Di Kelas</th>
                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>    
    <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <script>
    $(document).ready(function(){
        $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('students.index') }}",
                type: 'GET',
            },
            "responsive": true,
            "language": {
                "oPaginate": {
                    "sNext": "<i class='fas fa-angle-right'>",
                    "sPrevious": "<i class='fas fa-angle-left'>",
                },
               
            },
            columns: [{
                    data: 'DT_RowIndex',
                },
                {
                    data: 'nisn',
                },
                {
                    data: 'nama_lengkap',
                },
                {
                    data: 'jenis_kelamin',
                },
                {
                    data: 'diterima_dikelas',
                },
                {
                    data: 'action',
                },
            ],
        });
    });
</script>     
{{-- @include('admin.studen.jurusan.scriptdeletedata') --}}
@endsection