@extends('app')

@section('titre', 'Securite')

@section('content')

<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block">
                    <div class="row g-gs">
                        <div class="col-lg-12">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <div class="team">
                                        <div class="user-card user-card-s2">
                                            <div class="user-avatar md bg-primary">
                                                <span><em class="ni ni-user-alt"></em></span>
                                                <div class="status dot dot-lg dot-success"></div>
                                            </div>
                                            <div class="user-info">
                                                <h6>Abu Bin Ishtiyak</h6>
                                                <span class="sub-text">@ishtiyak</span>
                                            </div>
                                        </div>
                                        <ul class="team-statistics">
                                            <li>
                                                <span>213</span>
                                                <span>Projects</span>
                                            </li>
                                            <li>
                                                <span>87.5%</span>
                                                <span>Performed</span>
                                            </li>
                                            <li>
                                                <span>587</span>
                                                <span>Tasks</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card card-bordered">
                                <div class="card-aside-wrap">
                                    <div class=" card card-inner card-inner-lg">
                                        <ul class="nav nav-tabs nav-tabs-s2">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#tabItem1">
                                                    <em class="icon ni ni-user"></em>
                                                    <span>Informations Personnelles</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#tabItem2">
                                                    <em class="icon ni ni-lock-alt"></em>
                                                    <span>Paramette de Sécurité</span>
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tabItem1">
                                                <div class="card-aside-wrap">
                                                    <div class="card-inner card-inner-lg">
                                                        <div class="nk-block-head nk-block-head-lg">
                                                            <div class="nk-block-between">
                                                                <div class="nk-block-head-content">
                                                                    <h4 class="nk-block-title">
                                                                        Informations Personnelles
                                                                    </h4>
                                                                </div>
                                                                <div class="nk-block-head-content align-self-start d-lg-none">
                                                                    <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside">
                                                                        <em class="icon ni ni-menu-alt-r"></em>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="nk-block">
                                                            <div class="nk-data data-list">
                                                                <div class="data-head">
                                                                    <h6 class="overline-title">Basics</h6>
                                                                </div>
                                                                <div class="data-item">
                                                                    <div class="data-col">
                                                                        <span class="data-label">Nom</span>
                                                                        <span class="data-value">
                                                                            Abu Bin Ishtiyak
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="data-item">
                                                                    <div class="data-col">
                                                                        <span class="data-label">Prénoms</span>
                                                                        <span class="data-value">
                                                                            Ishtiyak
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--<div class="nk-data data-list">
                                                                <div class="data-head">
                                                                    <h6 class="overline-title">Preferences</h6>
                                                                </div>
                                                                <div class="data-item">
                                                                    <div class="data-col"><span class="data-label">Language</span><span class="data-value">English (United State)</span></div>
                                                                    <div class="data-col data-col-end"><a href="#" class="link link-primary">Change Language</a></div>
                                                                </div>
                                                                <div class="data-item">
                                                                    <div class="data-col"><span class="data-label">Date Format</span><span class="data-value">M d, YYYY</span></div>
                                                                    <div class="data-col data-col-end"><a href="#" class="link link-primary">Change</a></div>
                                                                </div>
                                                                <div class="data-item">
                                                                    <div class="data-col"><span class="data-label">Timezone</span><span class="data-value">Bangladesh (GMT +6)</span></div>
                                                                    <div class="data-col data-col-end"><a href="#" class="link link-primary">Change</a></div>
                                                                </div>
                                                            </div>-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tabItem2">
                                                <div class="card-aside-wrap">
                                                    <div class="card-inner card-inner-lg">
                                                        <div class="nk-block-head nk-block-head-lg">
                                                            <div class="nk-block-between">
                                                                <div class="nk-block-head-content">
                                                                    <h4 class="nk-block-title">Securité</h4>
                                                                </div>
                                                                <div class="nk-block-head-content align-self-start d-lg-none"><a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a></div>
                                                            </div>
                                                        </div>
                                                        <div class="nk-block">
                                                            <div class="card card-bordered">
                                                                <div class="card-inner-group">
                                                                    <div class="card-inner">
                                                                        <div class="between-center flex-wrap flex-md-nowrap g-3">
                                                                            <div class="nk-block-text">
                                                                                <h6>Save my Activity Logs</h6>
                                                                                <p>You can save your all activity logs including unusual activity detected.</p>
                                                                            </div>
                                                                            <div class="nk-block-actions">
                                                                                <ul class="align-center gx-3">
                                                                                    <li class="order-md-last">
                                                                                        <div class="custom-control custom-switch me-n2"><input type="checkbox" class="custom-control-input" checked="" id="activity-log"><label class="custom-control-label" for="activity-log"></label></div>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card-inner">
                                                                        <div class="between-center flex-wrap g-3">
                                                                            <div class="nk-block-text">
                                                                                <h6>Change Password</h6>
                                                                                <p>Set a unique password to protect your account.</p>
                                                                            </div>
                                                                            <div class="nk-block-actions flex-shrink-sm-0">
                                                                                <ul class="align-center flex-wrap flex-sm-nowrap gx-3 gy-2">
                                                                                    <li class="order-md-last"><a href="#" class="btn btn-primary">Change Password</a></li>
                                                                                    <li><em class="text-soft text-date fs-12px">Last changed: <span>Oct 2, 2019</span></em></li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card-inner">
                                                                        <div class="between-center flex-wrap flex-md-nowrap g-3">
                                                                            <div class="nk-block-text">
                                                                                <h6>2 Factor Auth &nbsp; <span class="badge badge-success ms-0">Enabled</span></h6>
                                                                                <p>Secure your account with 2FA security. When it is activated you will need to enter not only your password, but also a special code using app. You can receive this code by in mobile app. </p>
                                                                            </div>
                                                                            <div class="nk-block-actions"><a href="#" class="btn btn-primary">Disable</a></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" role="dialog" id="profile-edit">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content"><a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
            <div class="modal-body modal-body-lg">
                <h5 class="title">Update Profile</h5>
                <ul class="nk-nav nav nav-tabs">
                    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#personal">Personal</a></li>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#address">Address</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="personal">
                        <div class="row gy-4">
                            <div class="col-md-6">
                                <div class="form-group"><label class="form-label" for="full-name">Full Name</label><input type="text" class="form-control form-control-lg" id="full-name" value="Abu Bin Ishtiyak" placeholder="Enter Full name"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"><label class="form-label" for="display-name">Display Name</label><input type="text" class="form-control form-control-lg" id="display-name" value="Ishtiyak" placeholder="Enter display name"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"><label class="form-label" for="phone-no">Phone Number</label><input type="text" class="form-control form-control-lg" id="phone-no" value="+880" placeholder="Phone Number"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"><label class="form-label" for="birth-day">Date of Birth</label><input type="text" class="form-control form-control-lg date-picker" id="birth-day" placeholder="Enter your birth-date"></div>
                            </div>
                            <div class="col-12">
                                <div class="custom-control custom-switch"><input type="checkbox" class="custom-control-input" id="latest-sale"><label class="custom-control-label" for="latest-sale">Use full name to display </label></div>
                            </div>
                            <div class="col-12">
                                <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                    <li><a href="#" data-bs-dismiss="modal" class="btn btn-lg btn-primary">Update Profile</a></li>
                                    <li><a href="#" data-bs-dismiss="modal" class="link link-light">Cancel</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="address">
                        <div class="row gy-4">
                            <div class="col-md-6">
                                <div class="form-group"><label class="form-label" for="address-l1">Address Line 1</label><input type="text" class="form-control form-control-lg" id="address-l1" value="2337 Kildeer Drive"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"><label class="form-label" for="address-l2">Address Line 2</label><input type="text" class="form-control form-control-lg" id="address-l2" value=""></div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"><label class="form-label" for="address-st">State</label><input type="text" class="form-control form-control-lg" id="address-st" value="Kentucky"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"><label class="form-label" for="address-county">Country</label><select class="form-select js-select2" id="address-county" data-ui="lg">
                                        <option>Canada</option>
                                        <option>United State</option>
                                        <option>United Kindom</option>
                                        <option>Australia</option>
                                        <option>India</option>
                                        <option>Bangladesh</option>
                                    </select></div>
                            </div>
                            <div class="col-12">
                                <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                    <li><a href="#" class="btn btn-lg btn-primary">Update Address</a></li>
                                    <li><a href="#" data-bs-dismiss="modal" class="link link-light">Cancel</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
