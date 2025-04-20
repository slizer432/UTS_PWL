<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Employee Details</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <table class="table table-bordered table-striped">
                <tr>
                    <th>Name</th>
                    <td>{{ $employee->name }}</td>
                </tr>
                <tr>
                    <th>Salary</th>
                    <td>Rp{{ number_format($employee->salary, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Registered Since</th>
                    <td>{{ $employee->registered_since }}</td>
                </tr>
                <tr>
                    <th>Job Position</th>
                    <td>{{ $employee->job_position }}</td>
                </tr>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
