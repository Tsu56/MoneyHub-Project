@extends('layouts.moneyhub')

@section('main')
<div class="card">
    <a href="{{ route('moneyhub.indexhome') }}"><img src="{{ asset('img/Banner-3.png') }}" class="card-img-top" alt="โฆษณามันนี่ฮับ"></a>
</div><br><br>

<div class="container mt-3">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <img src="{{ asset('img/ads-5.png') }}" class="rounded-circle img-pointer" alt="โฆษณาวงกลม" width="304" height="236">
        </div>
        <div class="col-md-4 mx-auto">
            <img src="{{ asset('img/ads.png') }}" class="rounded-circle img-pointer" alt="โฆษณาวงกลม-2" width="304" height="236">
        </div>
        <div class="col-md-4 mx-auto">
            <img src="{{ asset('img/ads-4.png') }}" class="rounded-circle img-pointer" alt="โฆษณาวงกลม-3" width="304" height="236">
        </div>
    </div>
</div>



@endsection