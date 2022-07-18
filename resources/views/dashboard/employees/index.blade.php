@extends('layouts.dashboard.app')

@section('content')

    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.employees')</h1>

            <ol class="breadcrumb">
                <li><a href=""><i class="fa fa-dashboard"></i></a></li>
                <li class="active"></li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">
                        @lang('site.employees')
                    </h3>

                </div><!-- end of box header -->

                <div class="box-body">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><strong>Status :</strong></label>
                                <select id="company_filter" class="form-control">
                                    <option value="">--Select Company--</option>
                                    <?php foreach($all_companies as $key=>$item): ?>
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th width="100px">Comapany</th>
                                <th width="100px">actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


    <script type="text/javascript">
        $(function () {

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('en/employee') }}",
                    data: function (d) {
                        d.company_id = $('#company_filter').val(),
                        d.search     = $('input[type="search"]').val()
                    }
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'company', name: 'company'},
                    {data: 'actions', name: 'actions'},
                ]
            });

            $('#company_filter').change(function () {
                table.draw();
            });

        });
    </script>

@endsection
