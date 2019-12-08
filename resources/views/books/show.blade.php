@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">تفاصيل الكتاب</div>

                <div class="card-body">
                    <table id="section-to-print" class="table table-striped">
                        <tr>
                            <th>عنوان الكتاب</th>
                            <td><h1>{{ $book->title }}</h1></td>
                        </tr>

                        @if($book->isbn != NULL)
                            <tr>
                                <th>الرقم التسلسلي</th>
                                <td>{{ $book->isbn }}</td>
                            </tr>
                        @endif

                       

                        <tr>
                            <th>صورة الغلاف</th>
                            <td><img class="img-thumbnail" src="{{ url('uploads/' . $book->cover_image) }}" alt="{{ $book->title }}"></td>
                        </tr>

                       
                      

                        @if($book->description != NULL)
                            <tr>
                                <th>الوصف</th>
                                <td>{{ $book->description }}</td>
                            </tr>
                        @endif
                        
                        @if($book->publish_year != NULL)
                            <tr>
                                <th>سنة النشر</th>
                                <td>{{ $book->publish_year }}</td>
                            </tr>
                        @endif
                        
                        <tr>
                            <th>عدد الصفحات</th>
                            <td>{{ $book->number_of_pages }}</td>
                        </tr>
                        
                        @auth
                            <tr>
                                <th>عدد النسخ</th>
                                <td>{{ $book->number_of_copies }}</td>
                            </tr>
                        @endauth
                        
                        <tr>
                            <th>السعر</th>
                            <td>{{ $book->price }} $</td>
                        </tr>
                    </table>

                    <br><hr><br>

                  

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

