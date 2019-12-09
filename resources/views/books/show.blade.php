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
                            <th>تقييم المستخدمين</th>
                            <td>
                                <span class="score">
                                    <div class="score-wrap">
                                        <span class="stars-active" style="width:{{ $book->rate()*20 }}%">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </span>

                                        <span class="stars-inactive">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </span>

                                <span>عدد المقيّمين {{ $book->ratings()->count() }} مستخدم</span>

                            </td>
                        </tr>

                        <tr>
                            <th>صورة الغلاف</th>
                            <td><img class="img-thumbnail" src="{{ url('uploads/' . $book->cover_image) }}" alt="{{ $book->title }}"></td>
                        </tr>

                        @if($book->category != NULL)
                            <tr>
                                <th>التصنيف</th>
                                <td><a style="color:inherit" href="{{ route('categories.show', $book->category) }}">{{ $book->category->name }}</a></td>
                            </tr>
                        @endif

                        @if($book->authors->isNotEmpty())
                            <tr>
                                <th>المؤلفون</th>
                                <td>
                                    @foreach($book->authors as $author)
                                        {{ $loop->first ? '' : 'و' }}
                                        <a style="color:inherit" href="{{ route('authors.show', $author) }}">{{ $author->name }} </a>
                                    @endforeach
                                </td>
                            </tr>
                        @endif

                        @if($book->publisher != NULL)
                            <tr>
                                <th>الناشر</th>
                                <td><a style="color:inherit" href="{{ route('publishers.show', $book->publisher) }}">{{ $book->publisher->name }}</a></td>
                            </tr>
                        @endif

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

                    @auth
                        <h4>قيّم هذا الكتاب<h4>

                        @if(auth()->user()->rated($book))
                            <div class="rating">
                                <span class="rating-star {{ auth()->user()->bookRating($book)->value == 5 ? 'checked' : '' }}" data-value="5"></span>
                                <span class="rating-star {{ auth()->user()->bookRating($book)->value == 4 ? 'checked' : '' }}" data-value="4"></span>
                                <span class="rating-star {{ auth()->user()->bookRating($book)->value == 3 ? 'checked' : '' }}" data-value="3"></span>
                                <span class="rating-star {{ auth()->user()->bookRating($book)->value == 2 ? 'checked' : '' }}" data-value="2"></span>
                                <span class="rating-star {{ auth()->user()->bookRating($book)->value == 1 ? 'checked' : '' }}" data-value="1"></span>
                            </div>
                        @else
                            <div class="rating">
                                <span class="rating-star" data-value="5"></span>
                                <span class="rating-star" data-value="4"></span>
                                <span class="rating-star" data-value="3"></span>
                                <span class="rating-star" data-value="2"></span>
                                <span class="rating-star" data-value="1"></span>
                            </div>
                        @endif

                        <br><br>


                    @endauth



                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')


    <script>
        $('.rating-star').click(function() {
            $(this).parents('.rating').find('.rating-star').removeClass('checked');
            $(this).addClass('checked');

            var submitStars = $(this).attr('data-value');

            $.ajax({
                type: 'post',
                url: {{ $book->id }} + '/rate',
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'value' : submitStars
                },
                success: function() {
                    alert('تمت عملية التقييم بنجاح');
                    location.reload();
                },
                error: function() {
                    alert('حدث خطأ ما');
                },
            });
        });
    </script>
@endsection
