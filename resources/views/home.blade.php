@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="row">
                    <div class="col-md-4"></div>

                    <form class="form-inline col-md-6" action="{{ route('search') }}" method="GET">
                        @csrf
                        <input type="text" class="form-control mx-sm-3 mb-2" name="term">
                        <button type="submit" class="btn btn-secondary mb-2">ابحث</button>
                    </form>

                    <div class="col-md-2"></div>
                </div>


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
                                <a href="{{ route('books.show', $book->id) }}" style="color:#555555">
                                    <img class="img-fluid img-thumbnail" src="{{ url('uploads/' . $book->cover_image) }}" alt="">
                                    
                                    <b>{{ $book->title }}</b>
                                </a>
                                            
                                @if($book->category != NULL)
                                <br><a style="color:#525252" href="{{ route('categories.show', $book->category) }}">{{ $book->category->name }}</a>
                            @endif

                            @if($book->authors->isNotEmpty())
                                <br><b>تأليف: </b>
                                @foreach($book->authors as $author)
                                    {{ $loop->first ? '' : 'و' }}
                                    <a style="color:#525252" href="{{ route('authors.show', $author) }}">{{ $author->name }} </a>
                                @endforeach
                            @endif

                            <br><b>الناشر: </b>
                            @if($book->publisher != NULL)
                               <a style="color:#525252" href="{{ route('publishers.show', $book->publisher) }}">{{ $book->publisher->name }}</a>
                            @endif

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
