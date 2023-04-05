@extends('MainAdmin.index')

@section('style')
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
                    <h1 class="d-flex align-items-center fw-bolder fs-3 my-1" style="color: #5482d5">
                        إضافة كورس للمدينة
                    </h1>
                    <!--end::Title-->
                    <!--begin::Separator-->
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <!--end::Separator-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin.home')}}" class="text-muted text-hover-primary">الرئيسية</a>
                        </li>
                        <!--end::Item-->
                        <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin.cities-courses')}}" class="text-muted text-hover-primary">
                                كورس المدينة</a>
                        </li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
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
                <!--begin::Form-->
                <form action="{{route('admin.cities-courses.store')}}" method="post" enctype="multipart/form-data"
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
                                    <div class="card card-flush py-4">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>بيانات كورس المدينة</h2>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <!--begin::Input group-->
{{--                                            <div class="mb-10 fv-row">--}}
{{--                                                <!--begin::Label-->--}}
{{--                                                <label class="required form-label">إسم المدينة (عربي)</label>--}}
{{--                                                <!--end::Label-->--}}
{{--                                                <!--begin::Input-->--}}
{{--                                                <input type="text" required name="title_ar" class="form-control mb-2"--}}
{{--                                                       placeholder="إسم المدينة (عربي)" value=""/>--}}
{{--                                                <!--end::Input-->--}}
{{--                                                <!--begin::Description-->--}}
{{--                                            </div>--}}
                                            <!--end::Input group-->

                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label"> الدولة</label>
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
                                                    <label class="required form-label">إختر المدينة</label>
                                                    <!--end::Label-->
                                                    <!--begin::Select2-->
                                                    <!--begin::Input-->
                                                    <select name="city_id" required class="city_id form-select mb-2" data-control="select2" data-hide-search="false" data-placeholder="إختر المدينة" >
                                                        <option></option>
                                                    </select>
                                                    <!--end::Select2-->
                                                </div>
                                            </div>

                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label"> الكورس</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <select name="course_id" required class=" form-select form-select-solid" data-kt-select2="true" >
                                                    @foreach($courses as $course)
                                                        <option value="{{$course->id}}" >{{$course->name_en}}</option>
                                                    @endforeach
                                                </select>

                                                <!--begin::Description-->
                                            </div>
                                            <!--end::Input group-->

                                            <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">عدد اسابيع الكورس</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="number" required name="no_of_weeks" class="form-control mb-2"
                                                       placeholder="عدد الاسابيع" value=""/>
                                                <!--end::Input-->
                                                <!--begin::Description-->
                                            </div>
                                            <!--end::Input group-->

                                            <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">سعر الاسبوع</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="number" required name="price_per_week" class="form-control mb-2"
                                                       placeholder="سعر الاسبوع" value=""/>
                                                <!--end::Input-->
                                                <!--begin::Description-->
                                            </div>
                                            <!--end::Input group-->


                                        </div>
                                        <!--end::Card header-->
                                    </div>
                                    <!--end::General options-->

                                </div>
                            </div>
                            <!--end::Tab pane-->
                        </div>
                        <!--end::Tab content-->
                        <div class="d-flex justify-content-end">
                            <!--begin::Button-->
                            <a href="{{route('admin.cities')}}" id="kt_ecommerce_add_product_cancel"
                               class="btn btn-light me-5">عودة</a>
                            <!--end::Button-->
                            <!--begin::Button-->
                            <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
                                <span class="indicator-label">حفظ</span>
                                <span class="indicator-progress">إنتظر قليلا . . .
												<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
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
    <script>
        $(document).on('change', '.country_id', function () {
            var country_id = $(this).val();
            if (country_id) {
                $.ajax({
                    type: "GET",
                    url: "{{asset('admin/cities-courses/get/cities')}}?country_id=" + country_id,
                    success: function (res) {
                        if (res) {
                            console.log(res);
                            $(".city_id").empty();
                            $.each(res, function (key, value) {
                                $(".city_id").append('<option value="' + value.id + '" >' + value.name_en + '</option>');
                            });
                        }

                    }
                });
            }
        });

    </script>
@endsection
