@extends('layouts.dashboard.app')

@section('content')

    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.company')</h1>

            <ol class="breadcrumb">
                <li><a href=""><i class="fa fa-dashboard"></i></a></li>
                <li class="active"></li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">
                        @lang('site.company')
                    </h3>

                </div><!-- end of box header -->

                <div class="box-body">

                    <table class="table table-bordered data-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>address</th>
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
                    url: "{{ route('company.index') }}",
                    data: function (d) {
                        d.search = $('input[type="search"]').val()
                    }
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'address', name: 'email'},
                    {data: 'actions', name: 'actions'},
                ]
            });


        });
    </script>

@endsection
