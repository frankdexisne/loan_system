<div class="row">
    <div class="col-xs-12">
        <div class="clearfix">
            <div class="pull-right tableTools-container {{$pshowtools}}">
                <div class="dt-buttons btn-overlap btn-group">
                    @can($module.'.create')
                    <a
                        id="add"
                        class="dt-button btn btn-white btn-primary btn-bold"
                        title="Add"
                        >
                        <span>
                            <i class="fa fa-plus bigger-110 blue"></i>
                        </span>
                    </a>
                    @endcan
                    <a
                        id="reload"
                        class="dt-button btn btn-white btn-success btn-bold"
                        title="Reload"
                        >
                        <span>
                            <i class="fa fa-refresh bigger-110 green"></i>
                        </span>
                    </a>
                </div>
            </div>
        </div>

        <div class="table-header">
            List of {{ucfirst($module)}}
        </div>
        <div>
            <table id="datatable" class="table table-striped table-bordered table-hover" style="width:100%">
            </table>
        </div>
    </div>
</div>
