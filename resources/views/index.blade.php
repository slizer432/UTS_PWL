@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <button onclick="modalAction('{{ url('employee/create_ajax') }}')" class="btn btn-sm btn-success mt-1">
                    Add
                </button>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <table class="table table-bordered table-striped table-hover table-sm" id="table_employee">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Salary</th>
                        <th>Registered Since</th>
                        <th>Job Position</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static"
        data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection

@push('js')
    <script>
        function modalAction(url = '') {
            $('#myModal').load(url, function () {
                $('#myModal').modal('show');
            });
        }

        let dataEmployee;
        $(document).ready(function () {
            dataEmployee = $('#table_employee').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('employee') }}",
                columns: [
                    {
                        data: 'DT_RowIndex',
                        className: 'text-center',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        className: 'text-center'
                    },
                    {
                        data: 'salary',
                        className: 'text-center',
                        render: function (data, type, row) {
                            return 'Rp ' + parseFloat(data).toLocaleString('id-ID');
                        }
                    },
                    {
                        data: 'registered_since',
                        className: 'text-center'
                    },
                    {
                        data: 'job_position',
                        className: 'text-center'
                    },
                    {
                        data: 'actions',
                        className: 'text-center',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@endpush

