<div class="row">
    <div class="col-12">
        <div class="card user-card mt-2 mb-4">
            <div class="row">
                <div class="col-8 d-flex flex-column justify-content-between border-container-lg">
                    <div class="user-avatar-section">
                        <div class="d-flex justify-content-start">
                            {{--  @Todo implement client avatar   --}}
                            <img class="img-fluid rounded" src="{{ asset('images/custom/user_silhouette.png') }}"
                                height="104" width="104" alt="User avatar" />
                            <div class="d-flex flex-column ml-1">
                                <div class="user-info my-1">
                                    <h4 class="mb-0 client-name"></h4>
                                    <div class="user-info-wrapper">
                                        <div class="d-flex flex-wrap my-50">
                                            <div class="user-info-title">
                                                <i class="far fa-envelope mr-1"></i>
                                            </div>
                                            <p class="card-text mb-0 client-email"></p>
                                        </div>
                                        <div class="d-flex flex-wrap my-50">
                                            <div class="user-info-title">
                                                <i class="fas fa-phone mr-1"></i>
                                            </div>
                                            <p class="card-text mb-0 client-mobile"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 my-2">
                    <div class="user-info-wrapper">
                        <div class="d-flex flex-wrap my-50">
                            <div class="user-info-title mr-1">
                                <i class="fas fa-envelope-open-text"></i>
                            </div>
                            <p class="card-text mb-0 contacted-at"></p>
                        </div>
                        <div class="d-flex flex-wrap my-50">
                            <div class="user-info-title mr-1">
                                <i class="replied-icon"></i>
                            </div>
                            <p class="card-text mb-0 replied-at"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title subject"></h4>
                    </div>
                    <div class="card-body pb-1">
                        <p class="card-text message"></p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>