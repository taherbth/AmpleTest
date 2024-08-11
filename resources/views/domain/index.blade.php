@extends('layouts.app')

@section('content')
<div class="container mt-5" >    
    <div>
        <h1>Link Harvester Domain & Urls</h1>       
        <table id="dataTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Base Domain</th>
                    <th>URL</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('domains.getDomainUrls') }}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'domain_name', name: 'domain_name'},  
                    {data: 'urls', name: 'urls', orderable: false, searchable: false}             
                ],
                order: [[0, 'desc']],
                pageLength: 10,
            });
        });
    </script>
</div>
@endsection
 