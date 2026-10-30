@extends('layouts.app')

@section('title', 'Conference')



@section('content')

<div>
    <!-- MAIN CONTENT GRID -->
    <div class="container mt-4">

       <div class="row">

           <!-- LEFT SECTION -->
           <div class="col-md-9 order-1">
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
           <div class="col-md-3 order-2">
              @include('partials.quicklinks1', ['extraQuickLinks' => [
                  ['label' => 'Indexing & abstracting', 'url' => url('indexing')],
                  ['label' => 'Publication fees', 'url' => url('publication-fees')],
                  ['label' => 'Open access policy', 'url' => url('open-access-policy-licensing-and-copyright')],
                  ['label' => 'Plagiarism policy', 'url' => url('plagiarism-policy')],
                  ['label' => 'Fast track review', 'url' => url('fast-track-review-and-publication')],
                  ['label' => 'Peer review process', 'url' => url('peer-review-process')],
                  ['label' => 'Waiver and discounts', 'url' => url('waiver-and-discounts')],
                  ['label' => 'Conflicts of interest', 'url' => url('conflicts-of-interest')],
                  ['label' => 'Terms and conditions', 'url' => url('terms-and-conditions')],
                  ['label' => 'Corrections and retraction', 'url' => url('corrections-and-retraction')],
                  ['label' => 'Digital preservation', 'url' => url('digital-preservation')],
                  ['label' => 'Misconduct and sanctions', 'url' => url('misconduct-and-sanctions')],
                  ['label' => 'Privacy statement', 'url' => url('privacy-statement')],
                  ['label' => 'Complaints and appeals', 'url' => url('complaints-and-appeals')],
              ]])


           </div>



       </div>
   </div>
</div>

  

@endsection
