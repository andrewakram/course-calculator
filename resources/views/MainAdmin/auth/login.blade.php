<!DOCTYPE html>

<html lang="ar" dir="rtl">
<!--begin::Head-->
<head>
    <base href="../../../">
    <title>Course-Calculator</title>
    <meta charset="utf-8"/>
    <meta name="description" content="Course-Calculator"/>
    <meta name="keywords" content="Course-Calculator"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="Course-Calculator"/>
    <meta property="og:url" content="http://tesolutionspro.com/metronic"/>
    <meta property="og:site_name" content="Keenthemes | Metronic"/>
    <link rel="canonical" href="https://preview.keenthemes.com/metronic8"/>
    <link rel="shortcut icon" href="{{asset('/')}}/default.png"/>
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{ url('admin/dist/') }}/assets/plugins/global/plugins.bundle.rtl.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{ url('admin/dist/') }}/assets/css/style.bundle.rtl.css" rel="stylesheet" type="text/css"/>
    <!--end::Global Stylesheets Bundle-->

    @include('MainAdmin.includes.css')

</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="bg-body">
<!--begin::Main-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root">
    <!--begin::Authentication - Sign-in -->
    <div
        class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed"
        style="background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            background-image: url({{asset('/')}}background.png)">
        <!--begin::Content-->
        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
            <!--begin::Logo-->
{{--            <a href="{{asset('/')}}" class="mb-12">--}}
{{--                <img alt="Logo" src="{{asset('/')}}default.png" class=" "--}}
{{--                     style="background-color: white; border-radius: 5px;padding: 10px;height:160px;width: 300px"/>--}}
{{--            </a>--}}
            <!--end::Logo-->
            <!--begin::Wrapper-->
            <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-10 mx-auto">


                <!--begin::Form-->
                <form action="{{route('admin.login')}}" method="post" class="form w-100" id="kt_sign_in_form1">
                @csrf
                <!--begin::Heading-->
                    <div class="text-center mb-10">
                        <!--begin::Link-->
                    {{--                        <div class="text-gray-400 fw-bold fs-4">--}}
                    {{--                            <a href="" class=" fw-bolder" style="color: #5482d5">Course-Calculator</a>--}}
                    {{--                        </div>--}}
                    {{--                        <br>--}}
                    <!--end::Link-->
                        <!--begin::Title-->
                        <h1 class="text-dark mb-3">تسجيل الدخول بلوحة التحكم الرئيسية</h1>
                        <!--end::Title-->
                        @include('MainAdmin.includes.messages')
                    </div>
                    <!--begin::Heading-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <!--begin::Label-->
                        <label class="form-label fs-6 fw-bolder text-dark">البريد الالكتروني</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input class="form-control form-control-lg form-control-solid" type="text" name="email"
                               autocomplete="off"/>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-stack mb-2">
                            <!--begin::Label-->
                            <label class="form-label fw-bolder text-dark fs-6 mb-0">كلمة المرور</label>
                            <!--end::Label-->
                            <!--begin::Link-->
                        {{--                            <a href="../../demo1/dist/authentication/layouts/basic/password-reset.html" class="link-primary fs-6 fw-bolder">Forgot Password ?</a>--}}
                        <!--end::Link-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Input-->
                        <input class="form-control form-control-lg form-control-solid" type="password" name="password"
                               autocomplete="off"/>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Actions-->
                    <div class="text-center">
                        <!--begin::Submit button-->
                        <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                            <span class="indicator-label">تسجيل</span>
                            <span class="indicator-progress">جاري التحميل . . .
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                        <!--end::Submit button-->
                        <!--begin::Separator-->
                    {{--                        <div class="text-center text-muted text-uppercase fw-bolder mb-5">or</div>--}}
                    <!--end::Separator-->
                        <!--begin::Google link-->
                    {{--                        <a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5">--}}
                    {{--                            <img alt="Logo" src="assets/media/svg/brand-logos/google-icon.svg" class="h-20px me-3" />Continue with Google</a>--}}
                    <!--end::Google link-->
                        <!--begin::Google link-->
                    {{--                        <a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5">--}}
                    {{--                            <img alt="Logo" src="assets/media/svg/brand-logos/facebook-4.svg" class="h-20px me-3" />Continue with Facebook</a>--}}
                    <!--end::Google link-->
                        <!--begin::Google link-->
                    {{--                        <a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100">--}}
                    {{--                            <img alt="Logo" src="assets/media/svg/brand-logos/apple-black.svg" class="h-20px me-3" />Continue with Apple</a>--}}
                    <!--end::Google link-->
                    </div>

                    <!--end::Actions-->
                </form>
                <!--end::Form-->

            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Content-->
        <!--begin::Footer-->

    <!--end::Footer-->
    </div>
    <!--end::Authentication - Sign-in-->
</div>
<!--end::Root-->
<!--end::Main-->
<!--begin::Javascript-->
<script>var hostUrl = "assets/";</script>
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{ url('admin/dist/') }}/assets/plugins/global/plugins.bundle.js"></script>
<script src="{{ url('admin/dist/') }}/assets/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="{{ url('admin/dist/') }}/assets/js/custom/authentication/sign-in/general.js"></script>
<!--end::Page Custom Javascript-->

<?php
$errors = session()->get("errors");
?>
@if( session()->has("errors"))
    <?php
    $e = implode(' - ', $errors->all());
    ?>

    <script>
        Swal.fire({
            icon: 'warning',
            title: "برجاء التأكد من البيانات.",
            text: "{{$e}} ",
            type: "error",
            timer: 5000,
            showConfirmButton: false
        });
    </script>

@endif

@if( session()->has("error"))
    <?php
    $e = session()->get("error");
    ?>

    <script>
        Swal.fire({
            icon: 'warning',
            title: "تنبية",
            text: "{{$e}} ",
            type: "error",
            timer: 5000,
            showConfirmButton: false
        });
    </script>

@endif

@if( session()->has("success"))
    <?php
    $e = session()->get("success");
    ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: "تمت العملية بنجاح.",
            text: "{{$e}} ",
            type: "success",
            timer: 5000,
            showConfirmButton: false,
            dir:"row"
        });
    </script>

@endif
<!--end::Javascript-->
</body>
<!--end::Body-->
</html>
