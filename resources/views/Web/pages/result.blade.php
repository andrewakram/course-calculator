@extends('Web.index')
@section('style')
    <link href="{{ asset('admin/dist/assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet"
          type="text/css"/>
@endsection
@section('content')

    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Toolbar-->
    {{--        <div class="toolbar" id="kt_toolbar">--}}
    {{--            <!--begin::Container-->--}}
    {{--            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">--}}
    {{--                <!--begin::Page title-->--}}
    {{--                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"--}}
    {{--                     data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"--}}
    {{--                     class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">--}}
    {{--                    <!--begin::Title-->--}}
    {{--                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">--}}
    {{--                        <h1 class=" fs-3 fw-bold my-1 ms-1 app-f-color">Home</h1>--}}
    {{--                        <!--begin::Separator-->--}}
    {{--                        <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>--}}
    {{--                        <!--end::Separator-->--}}
    {{--                    </h1>--}}
    {{--                    <!--end::Title-->--}}
    {{--                </div>--}}
    {{--                <!--end::Page title-->--}}
    {{--            </div>--}}
    {{--            <!--end::Container-->--}}
    {{--        </div>--}}
    <!--end::Toolbar-->
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Form-->

                <!--begin::Main column-->
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <!--begin:::Tabs-->

                    <!--begin::Tab content-->
                    <div class="tab-content">
                        <!--begin::Tab pane-->
                        <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general"
                             role="tab-panel">
                            <div class="d-flex flex-column gap-7 gap-lg-10">
                                <!--begin::General options-->
                                <div class="card card-flush py-4" style="margin-top: -70px">
                                    <div class="card-header bg-success">
                                        <div class="card-title">
                                            <h1>Course Fees Calculator Result</h1>
                                        </div>
                                    </div>
                                    <hr>
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">

                                        <div class="row">
                                            <div class="col-md-11">
                                                <h2>Course Options</h2>
                                            </div>
                                            <div class="col-md-1">
                                                <h2>{{$data['course_cost']}} {{$data['country']->currency_en}} </h2>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h4>Country:</h4>
                                            </div>
                                            <div class="col-md-8">
                                                <h4>{{$data['country']->name_en}}</h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h4>City:</h4>
                                            </div>
                                            <div class="col-md-8">
                                                <h4>{{$data['city']->name_en}}</h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h4>Center:</h4>
                                            </div>
                                            <div class="col-md-8">
                                                <h4>{{$data['center']->name_en}}</h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h4>Course:</h4>
                                            </div>
                                            <div class="col-md-8">
                                                <h4>{{$data['course']->name_en}} - {{$data['course_weeks']}} Weeks</h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h4>Start date:</h4>
                                            </div>
                                            <div class="col-md-8">
                                                <h4>{{$data['start_date']}}</h4>
                                            </div>
                                        </div>

                                        <hr>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-11">
                                                <h2>Accomodation Options</h2>
                                            </div>
                                            <div class="col-md-1">
                                                <h2>{{$data['accomodation_cost']}} {{$data['country']->currency_en}} </h2>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h4>Accomodation:</h4>
                                            </div>
                                            <div class="col-md-8">
                                                <h4>{{$data['accomodation']->name_en}} - {{$data['accomodation_weeks']}}
                                                    Weeks</h4>
                                            </div>
                                        </div>


                                        <hr>
                                        <hr>

                                        <div class="row">
                                            <div class="col-md-11">
                                                <h2>Total</h2>
                                            </div>
                                            <div class="col-md-1">
                                                <h2>{{$data['course_cost']+$data['accomodation_cost']}} {{$data['country']->currency_en}} </h2>
                                            </div>
                                        </div>

                                    </div>
                                    <!--end::Card header-->
                                </div>
                                <!--end::General options-->

                            </div>
                        </div>
                        <!--end::Tab pane-->
                    </div>
                    <!--end::Tab content-->
                    <div class="d-flex justify-content-center">
                        <form action="{{route('web.printCalculatePrice')}}" method="post" enctype="multipart/form-data"
                              target="_blank" class="form d-flex flex-column flex-lg-row gap-7 gap-lg-10">
                            @csrf
                            <input type="hidden" name="country_id" value="{{$data['country']->id}}">
                            <input type="hidden" name="city_id" value="{{$data['city']->id}}">
                            <input type="hidden" name="center_id" value="{{$data['center']->id}}">
                            <input type="hidden" name="course_id" value="{{$data['course']->id}}">
                            <input type="hidden" name="no_of_weeks" value="{{$data['course_weeks']}}">
                            <input type="hidden" name="start_date" value="{{$data['start_date']}}">
                            <input type="hidden" name="accomodation_id" value="{{$data['accomodation']->id}}">
                            <input type="hidden" name="accomodation_no_of_weeks" value="{{$data['accomodation_weeks']}}">
                            <!--begin::Button-->
                            <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-success">
                                <span class="indicator-label">Print</span>
                                <span class="indicator-progress">wait few seconds . . .
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                            </button>
                            <!--end::Button-->
                        </form>
                    </div>
                </div>
                <!--end::Main column-->
                <!--end::Form-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Content-->


@endsection

@section('script')
    <!--begin::Page Vendors Javascript(used by this page)-->
    <script src="{{ asset('admin/dist/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    {{--    <script src="{{ asset('admin/dist/assets/js/custom/apps/projects/list/list.js')}}"></script>--}}

    <!-- BEGIN PAGE LEVEL PLUGINS -->

    <script src="{{ asset('admin/dist/assets/js/custom/widgets.js')}}"></script>
    <script src="{{ asset('admin/dist/assets/js/custom/apps/chat/chat.js')}}"></script>
    <script src="{{ asset('admin/dist/assets/js/custom/modals/upgrade-plan.js')}}"></script>
    <script src="{{ asset('admin/dist/assets/js/custom/modals/create-app.js')}}"></script>
    <script src="{{ asset('admin/dist/assets/js/custom/modals/users-search.js')}}"></script>
    <!--end::Page Vendors Javascript-->

@endsection

