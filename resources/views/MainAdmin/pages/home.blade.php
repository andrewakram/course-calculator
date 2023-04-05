@extends('MainAdmin.index')
@section('style')
    <link href="{{ asset('admin/dist/assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet"
          type="text/css"/>
@endsection
@section('content')

    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Toolbar-->
        <div class="toolbar" id="kt_toolbar">
            <!--begin::Container-->
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                     data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                     class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <!--begin::Title-->
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">
                        <h1 class=" fs-3 fw-bold my-1 ms-1 app-f-color">الرئيسية</h1>
                        <!--begin::Separator-->
                        <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                        <!--end::Separator-->
                    </h1>
                    <!--end::Title-->
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">

                <!--begin::Toolbar-->
                <div class="d-flex flex-wrap flex-stack my-5">
                    <!--begin::Heading-->
                    <!--end::Heading-->
                </div>
                <!--end::Toolbar-->
                <div class="row g-5 g-xl-8">
                    <div class="col-xl-6">
                        <!--begin::Statistics Widget 5-->
                        <a href="{{route('admin.countries')}}" class="card app-bg-color hoverable card-xl-stretch mb-xl-8">
                            <!--begin::Body-->
                            <div class="card-body">

                                <i class="fa fa-map-pin fa-2x text-white"></i>
                                <!--end::Svg Icon-->
                                <div class="text-gray-100 fw-bolder fs-2 mb-2 mt-5">{{$data['countries']}}</div>
                                <div class="fw-bold text-gray-100">الدول</div>
                            </div>
                            <!--end::Body-->
                        </a>
                        <!--end::Statistics Widget 5-->
                    </div>
                    <div class="col-xl-6">
                        <!--begin::Statistics Widget 5-->
                        <a href="{{route('admin.cities')}}" class="card app-bg-color hoverable card-xl-stretch mb-xl-8 ">
                            <!--begin::Body-->
                            <div class="card-body">
                                <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm008.svg-->
                                <i class="fa fa-map-pin fa-2x text-white"></i>
                                <div class="text-white fw-bolder fs-2 mb-2 mt-5">{{$data['cities']}}</div>
                                <div class="fw-bold text-white">المدن</div>
                            </div>
                            <!--end::Body-->
                        </a>
                        <!--end::Statistics Widget 5-->
                    </div>
                    <div class="col-xl-6">
                        <!--begin::Statistics Widget 5-->
                        <a href="{{route('admin.courses')}}" class="card app-bg-color hoverable card-xl-stretch mb-xl-8">
                            <!--begin::Body-->
                            <div class="card-body">
                                <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                                <i class="fa fa-circle fa-2x text-white"></i>
                                <!--end::Svg Icon-->
                                <div class="text-white fw-bolder fs-2 mb-2 mt-5">{{$data['courses']}}</div>
                                <div class="fw-bold text-white">الكورسات</div>
                            </div>
                            <!--end::Body-->
                        </a>
                        <!--end::Statistics Widget 5-->
                    </div>
                    <div class="col-xl-6">
                        <!--begin::Statistics Widget 5-->
                        <a href="{{route('admin.centers')}}" class="card app-bg-color hoverable card-xl-stretch mb-xl-8">
                            <!--begin::Body-->
                            <div class="card-body">
                                <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                                <i class="fa fa-circle fa-2x text-white"></i>
                                <!--end::Svg Icon-->
                                <div class="text-white fw-bolder fs-2 mb-2 mt-5">{{$data['centers']}}</div>
                                <div class="fw-bold text-white">سنتر الكورسات</div>
                            </div>
                            <!--end::Body-->
                        </a>
                        <!--end::Statistics Widget 5-->
                    </div>

                </div>


{{--                ////--}}
{{--                ////--}}
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
