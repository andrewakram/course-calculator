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
                <form action="{{route('web.calculatePrice')}}" method="post" enctype="multipart/form-data"
                      class="form d-flex flex-column flex-lg-row gap-7 gap-lg-10">
                @csrf

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
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>Fees Calculator</h2>
                                            </div>
                                        </div>
                                        <hr>
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">

                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label"> Choose Country</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <select name="country_id" required class="country_id form-select form-select-solid" data-kt-select2="true" >
                                                    @foreach($countries as $country)
                                                        <option value="{{$country->id}}" >{{$country->name_en}}</option>
                                                    @endforeach
                                                </select>

                                                <!--begin::Description-->
                                            </div>
                                            <!--end::Input group-->


                                            <div class="row">
                                                <div class="mb-10 fv-row">
                                                    <label class="required form-label">Choose City</label>
                                                    <!--end::Label-->
                                                    <!--begin::Select2-->
                                                    <!--begin::Input-->
                                                    <select name="city_id" required class="city_id form-select mb-2" data-control="select2" data-hide-search="false" data-placeholder="Choose City" >
                                                        <option></option>
                                                    </select>
                                                    <!--end::Select2-->
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="mb-10 fv-row">
                                                    <label class="required form-label">Choose Center</label>
                                                    <!--end::Label-->
                                                    <!--begin::Select2-->
                                                    <!--begin::Input-->
                                                    <select name="center_id" required class="center_id form-select mb-2" data-control="select2" data-hide-search="false" data-placeholder="Choose Center" >
                                                        <option></option>
                                                    </select>
                                                    <!--end::Select2-->
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="mb-10 fv-row">
                                                    <label class="required form-label">Choose Course</label>
                                                    <!--end::Label-->
                                                    <!--begin::Select2-->
                                                    <!--begin::Input-->
                                                    <select name="course_id" required class="course_id form-select mb-2" data-control="select2" data-hide-search="false" data-placeholder="Choose Course" >
                                                        <option></option>
                                                    </select>
                                                    <!--end::Select2-->
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="mb-10 fv-row">
                                                    <label class="required form-label">Number Of Weeks</label>
                                                    <!--end::Label-->
                                                    <!--begin::Select2-->
                                                    <!--begin::Input-->
                                                    <select name="no_of_weeks" required class="no_of_weeks form-select mb-2" data-control="select2" data-hide-search="false" data-placeholder="Choose Center" >
                                                        <option></option>
                                                    </select>
                                                    <!--end::Select2-->
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="mb-10 fv-row">
                                                    <label class="required form-label">Start date</label>
                                                    <!--end::Label-->
                                                    <!--begin::Select2-->
                                                    <!--begin::Input-->
                                                    <input name="start_date" type="date" required class="form-control mb-2" />
                                                    <!--end::input-->
                                                </div>
                                            </div>



                                        </div>
                                        <!--end::Card header-->
                                    </div>
                                    <!--end::General options-->

                                    {{--                                            //////////////--}}
                                    <!--begin::General options-->
                                    <div class="card card-flush py-4" >
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>Accomodation Options</h2>
                                            </div>
                                        </div>
                                        <hr>
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">

                                            <div class="row">
                                                <div class="mb-10 fv-row">
                                                    <label class="required form-label">Choose Accomodation</label>
                                                    <!--end::Label-->
                                                    <!--begin::Select2-->
                                                    <!--begin::Input-->
                                                    <select name="accomodation_id" required class="accomodation_id form-select mb-2" data-control="select2" data-hide-search="false" data-placeholder="Choose Accomodation" >
                                                        <option></option>
                                                    </select>
                                                    <!--end::Select2-->
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="mb-10 fv-row">
                                                    <label class="required form-label">Accomodation Number Of Weeks</label>
                                                    <!--end::Label-->
                                                    <!--begin::Select2-->
                                                    <!--begin::Input-->
                                                    <select name="accomodation_no_of_weeks" required class="no_of_weeks form-select mb-2"
                                                            data-control="select2" data-hide-search="false"
                                                            data-placeholder="Accomodation Number Of Weeks" >
                                                        <option></option>
                                                    </select>
                                                    <!--end::Select2-->
                                                </div>
                                            </div>


                                        </div>
                                        <!--end::Card header-->
                                    </div>
                                    <!--end::General options-->
                                    {{--                                            //////////////--}}

                                </div>
                            </div>
                            <!--end::Tab pane-->
                        </div>
                        <!--end::Tab content-->
                        <div class="d-flex justify-content-center">
                            <!--begin::Button-->
                            <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-success">
                                <span class="indicator-label">Get Price Now !</span>
                                <span class="indicator-progress">wait few seconds . . .
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                            <!--end::Button-->
                        </div>
                    </div>
                    <!--end::Main column-->
                </form>
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

    <script>
        $(document).on('change', '.country_id', function () {
            var country_id = $(this).val();
            if (country_id) {
                $.ajax({
                    type: "GET",
                    url: "{{asset('get/cities')}}?country_id=" + country_id,
                    success: function (res) {
                        if (res) {
                            $(".city_id").empty();
                            $(".center_id").empty();
                            $(".course_id").empty();
                            $(".city_id").append('<option value="0" disabled selected>' + 'city: ' + '</option>');
                            $.each(res, function (key, value) {
                                $(".city_id").append('<option value="' + value.id + '" >' + value.name_en + '</option>');
                            });
                        }

                    }
                });
                $.ajax({
                    type: "GET",
                    url: "{{asset('get/accomodations')}}?country_id=" + country_id,
                    success: function (res) {
                        if (res) {
                            $(".accomodation_id").empty();
                            $(".accomodation_id").append('<option value="0" disabled selected>' + 'Accomodations: ' + '</option>');
                            $.each(res, function (key, value) {
                                $(".accomodation_id").append('<option value="' + value.id + '" >' + value.name_en + '</option>');
                            });
                        }

                    }
                });
            }
        });

        $(document).on('change', '.city_id', function () {
            var city_id = $(this).val();
            if (city_id) {
                $.ajax({
                    type: "GET",
                    url: "{{asset('get/centers')}}?city_id=" + city_id,
                    success: function (res) {
                        if (res) {
                            $(".center_id").empty();
                            $.each(res, function (key, value) {
                                $(".center_id").append('<option value="' + value.id + '" >' + value.name_en + '</option>');
                            });
                        }

                    }
                });

                $.ajax({
                    type: "GET",
                    url: "{{asset('get/courses')}}?city_id=" + city_id,
                    success: function (res) {
                        if (res) {
                            $(".course_id").empty();
                            $(".course_id").append('<option value="0" disabled selected>' + 'Course: ' + '</option>');
                            $.each(res, function (key, value) {
                                $(".course_id").append('<option value="' + value.id + '"  no-of-weeks="' + value.no_of_weeks + '" >' + value.name_en + '</option>');
                            });
                        }

                    }
                });
            }
        });

        $(document).on('change', '.course_id', function () {
            var no_of_weeks = $('option:selected', this).attr('no-of-weeks');
            $(".no_of_weeks").empty();
            for (let i = 1; i <= no_of_weeks; i++) {
                $(".no_of_weeks").append('<option value="' + i + '" >' + i + ' Weeks </option>');
            }
        });

    </script>
@endsection

