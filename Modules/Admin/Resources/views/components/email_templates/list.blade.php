@props(['category'])

<section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <table class="datatables-{{$category}} table">
                        <thead>
                            <tr>
                                <th></th>
                                <th class="hide">{{__('global.activate')}}</th>
                                <th class="hide">{{__('global.sent')}}</th>
                                <th>{{__('global.sent')}}</th>
                                <th>{{__('global.template')}}</th>
                                <th>{{__('global.sent_rule')}}</th>
                                <th>{{__('global.last_modified')}}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>