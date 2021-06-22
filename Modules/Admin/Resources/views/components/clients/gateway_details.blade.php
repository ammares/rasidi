<div class="row">
    <div class="col-12 d-flex mt-2">
        <div class="col-6">
            <div class="media">
                <div class="avatar bg-light-primary rounded mr-1">
                    <div class="avatar-content">
                        <i data-feather="user" class="avatar-icon font-medium-3"></i>
                    </div>
                </div>
                <div class="media-body">
                    <h6 class="mb-0 client-name"></h6>
                    <small class="client-email"></small>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="media">
                <div class="avatar bg-light-success rounded mr-1">
                    <div class="avatar-content">
                        <i data-feather="dollar-sign" class="avatar-icon font-medium-3"></i>
                    </div>
                </div>
                <div class="media-body">
                    <h6 class="mb-0 subscription-date"></h6>
                    <small class="subscribed"></small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 d-flex mt-2">
        <div class="col-6">
            <div class="media">
                <div class="avatar bg-light-warning rounded mr-1">
                    <div class="avatar-content">
                        <i data-feather="sun" class="avatar-icon font-medium-3"></i>
                    </div>
                </div>
                <div class="media-body">
                    <h6 class="mb-0 solar-pv"></h6>
                    <small>{{__('global.solar_pv')}}</small>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="media">
                <div class="avatar bg-light-warning rounded mr-1">
                    <div class="avatar-content">
                        <i data-feather="battery-charging" class="avatar-icon font-medium-3"></i>
                    </div>
                </div>
                <div class="media-body">
                    <h6 class="mb-0 battery-storage"></h6>
                    <small>{{__('global.battery_storage')}}</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 mt-3">
        <h6 class="mb-1">{{__('global.power_modules')}}</h6>
        <table class="table power-modules">
            <thead>
                <tr>
                    <th>{{__('global.appliance')}}</th>
                    <th>{{__('global.device_id')}}</th>
                    <th>{{__('global.client_assigned_label')}}</th>
                    <th>{{__('global.status')}}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="4" class="no-data-to-display">
                        <i class="fa fa-exclamation-triangle mb-2"></i>
                        <br>
                        {{__('global.no_data_to_display')}}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>