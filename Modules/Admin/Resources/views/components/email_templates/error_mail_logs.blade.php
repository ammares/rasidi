<div class="row">
    <div class="col-12 table-responsive">
        <div class="d-flex align-items-center justify-content-between my-1">
            <div class="col-9 d-flex p-0">
                <h4 class="template-name mr-1"></h4>
                <h4 class="text-danger sent-count"></h4>
            </div>
            <div>
                <button class="btn btn-outline-secondary clear-logs hide">
                    {{__('global.clear_logs')}}
                </button>
            </div>
        </div>
        <table class="table table-nowrap">
            <thead>
                <tr>
                    <th>{{__('global.sent_at')}}</th>
                    <th>{{__('global.to')}}</th>
                    <th class="errors-column">{{__('global.error_message')}}</th>
                </tr>
            </thead>
            <tbody class="tbody">
                <tr>
                    <td colspan="3">
                        <div class="text-center">
                            <i class="fa fa-spin fa-spinner"></i> {{__('global.loading')}}
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>