@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <br>

                    <h3>{{ $title }}</h3>

                    <br>
                    <div class="row">
                        @if($books->count())
                            @foreach($books as $book)
                                @if($book->number_of_copies > 0)
                                    <div class="col-lg-3 col-md-4 col-6" style="margin-bottom:10px">
                                        <div class="d-block mb-4 h-100 border rounded" style="padding:10px">
                                            
                                                <img class="img-fluid img-thumbnail" src="{{ url('uploads/' . $book->cover_image) }}" alt="">
                                                
                                                <b>{{ $book->title }}</b>
                                            
                                          

                                           

                                            

                                          

                                            <br><b>السعر: </b>{{ $book->price }} $
                                            

                                            <br>
                                           
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            
                            <div class="col-12">{{ $books->links() }}</div>
                            
                        @else
                            <h3 style="margin:0 auto">لا نتائج</h3>
                        @endif
                    </div>        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
