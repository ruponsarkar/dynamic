@extends('adminpanel/layout')

@section('title', 'Dashboard')
@section('breadcrumb', 'Dashboard')



@section('content')



<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-xl-4">
                <div class="card daily-sales">
                    <div class="card-block">
                        <h6 class="mb-4">Total Journal</h6>
                        <div class="row d-flex align-items-center">
                            <div class="col-9">
                                <h3 class="f-w-300 d-flex align-items-center m-b-0"><i
                                        class="feather icon-arrow-up text-c-green f-30 m-r-10"></i>{{$countJournal}}</h3>
                            </div>

                            <div class="col-3 text-right">
                                <!-- <p class="m-b-0">67%</p> -->
                            </div>
                        </div>
                        <div class="progress m-t-30" style="height: 7px;">
                            <div class="progress-bar progress-c-theme" role="progressbar" style="width: 100%;"
                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card Monthly-sales">
                    <div class="card-block">
                        <h6 class="mb-4">Article Count</h6>
                        <div class="row d-flex align-items-center">
                            <div class="col-9">
                                <h3 class="f-w-300 d-flex align-items-center  m-b-0"><i
                                        class="feather icon-arrow-up text-c-green f-30 m-r-10"></i>{{$countArticle}}</h3>
                            </div>
                            <div class="col-3 text-right">
                                <!-- <p class="m-b-0">100%</p> -->
                            </div>
                        </div>
                        <div class="progress m-t-30" style="height: 7px;">
                            <div class="progress-bar progress-c-theme2" role="progressbar" style="width: 100%;"
                                aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-xl-4">
                <div class="card yearly-sales">
                    <div class="card-block">
                        <h6 class="mb-4">Total Download</h6>
                        <div class="row d-flex align-items-center">
                            <div class="col-9">
                                <h3 class="f-w-300 d-flex align-items-center  m-b-0"><i
                                        class="feather icon-arrow-up text-c-green f-30 m-r-10"></i>{{$countDownload}}</h3>
                            </div>
                            <div class="col-3 text-right">
                                <!-- <p class="m-b-0">80%</p> -->
                            </div>
                        </div>
                        <div class="progress m-t-30" style="height: 7px;">
                            <div class="progress-bar progress-c-theme" role="progressbar" style="width: 100%;"
                                aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>



<!-- for Home Page edit  -->

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="card daily-sales">
                    <div class="card-block">
                        <h6 class="mb-4">Change Logo</h6>
                        <div class="row d-flex align-items-center">
                            <div class="col-12">
                                <img class="col-4" src="{{url('assets/homeAssets/'.$HomeAssets->logo)}}" alt="logo">
                            </div>
                            <form action="changeHomeAsset" method="post" enctype="multipart/form-data">
                                @csrf
                            <div class="col-12">
                                <input class="form-control" type="file"  name="logo" accept=".jpg,.jpeg,.png" id="formFile" required>
                            </div>
                            <div class="col-12 pt-2">
                                <input class="form-control btn btn-primary btn-sm" type="submit"  name="" value="Change Logo">
                            </div>
                        </form>
                            

                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-6 col-xl-6">
                <div class="card daily-sales">
                    <div class="card-block">
                        <h6 class="mb-4">Change Banner</h6>
                        <div class="row d-flex align-items-center">
                            <form action="changeHomeAsset" method="post" enctype="multipart/form-data">
                                @csrf
                            <div class="col-12">
                                <img class="col-12" src="{{url('assets/homeAssets/'.$HomeAssets->banner)}}" alt="Banner">
                            </div>
                            <div class="col-12">
                                <input class="form-control" type="file"  name="banner" accept=".jpg,.jpeg,.png" id="formFile" required>
                            </div>
                            <div class="col-12 pt-2">
                                <input class="form-control btn btn-primary btn-sm" type="submit"  name="" value="Change Banner">
                            </div>

                        </form>
                            

                        </div>
                    </div>
                </div>
            </div> --}}


            <!-- <div class="col-md-6 col-xl-4">
                <div class="card daily-sales">
                    <div class="card-block">
                        <h6 class="mb-4">Change Logo</h6>
                        <div class="row d-flex align-items-center">
                            <div class="col-12">
                                <img class="col-12" src="{{url('assets/img/logo.png')}}" alt="">
                            </div>
                            <div class="col-12">
                                <input class="form-control" type="file"  name="photo" accept=".jpg,.jpeg,.png" id="formFile">
                            </div>
                            <div class="col-12 pt-2">
                                <input class="form-control btn btn-primary btn-sm" type="submit"  name="" value="Change Logo">
                            </div>
                            

                        </div>
                    </div>
                </div>
            </div> -->
        </div>

    </div>
</section>


@endsection