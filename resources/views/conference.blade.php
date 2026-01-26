@extends('layouts.app')

@section('title', 'Conference')



@section('content')

<div>
    <!-- MAIN CONTENT GRID -->
    <div class="container mt-4">

       <div class="row">

           <!-- LEFT SECTION -->
           <div class="col-md-9">
            <div class="container-fluid">

                <div class="row manuscript-bg pb-3">
                    <div class=" manuscript-form pb-3 card cus-padding">
                        
                  
                            <div class="card-body">
                                <h1 class="title">Conference Proceedings</h1>
                    
                                @foreach ( $confrence as $item )
                                
                                <div class="card p-2">
                                <a href="{{ asset('assets/conference/' . $item->file) }}" target="_blank">
                                        <!-- 1st International Conference on ” New Horizons in Pharmaceutical Sciences and Biomedical Sciences” NHPBMS-2013, Dehradun (UK), Indi -->
                                        {{ $loop->index + 1 }}  {{$item->title}}
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        

                    </div>
                </div>
        
            </div>


           </div>

           <!-- RIGHT SIDEBAR -->
           <div class="col-md-3">



              @include('partials.right')


           </div>



       </div>
   </div>
</div>

  

@endsection
