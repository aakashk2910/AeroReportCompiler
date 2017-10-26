@extends('master')
@section('content')

<main class="site-content" role="main">


<section id="contact">
    <div class="container">
        <div class="sec-title text-center wow animated fadeInDown">
            <h2>Upload Image</h2>
            <p>Images for Packages</p>
        </div>
        <div class="sec-title text-center contact-form wow animated fadeInLeft">
             <form action="{{route('addentry', [])}}" method="post" enctype="multipart/form-data">

                 <div class="input-field">
                     <input type="text" name="title" class="form-control" placeholder="Title..." required>
                 </div>
                 <div class="input-field">
                     <input type="text" name="displayText" class="form-control" placeholder="Description..." required>
                 </div>
                 <div class="input-field">
                     <input type="file" class=" form-control" name="filefield" required>
                     <button type="submit" class="btn btn-blue btn-effect">
                         <i class="fa fa-paper-plane fa-lg"></i>
                     </button>
                 </div>
             </form>
        </div>
    </div>
</section>
</main>
@endsection