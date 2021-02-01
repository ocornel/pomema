<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            <b>{{$report_title}}</b>
                            <span class="pull-right">
                                    <a href="{{Request::url()}}/PDF"
                                       target="_blank" class="btn btn-primary">PRINT PDF</a>
                                        <a href="{{Request::url()}}/XLS"
                                           target="_blank" class="btn btn-primary">DOWNLOAD EXCEL</a>
                                </span>
                        </h2>
                    </div>
                    <div class="body" style="min-height: 80vh">
                        <table class="summary-table">
                            @foreach($report_summary as $k => $v)
                                <tr>
                                    <td class="key">{{$k}}</td>
                                    <td class="value">{{$v}}</td>
                                </tr>
                            @endforeach
                        </table>
                        @yield('table')
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
