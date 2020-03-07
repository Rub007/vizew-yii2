@extends('layouts.layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div>
                    @if(session()->has('message'))
                        <div>{{session('message')}}</div>
                    @endif
                </div>
                <!-- Archive Catagory & View Options -->
                <div class="archive-catagory-view mb-50 d-flex align-items-center justify-content-between">
                    <!-- Catagory -->
                    <div class="archive-catagory">
                        <h4>Your Searched News</h4>
                    </div>
                </div>
                <!-- Single Post Area -->
                @if(!$topics->toArray()['data'])
                    <div>Your Search Had No Results</div>
                @else
                @foreach($topics as $topic)
                    <div class="single-post-area style-2">
                        <div class="row align-items-center">
                            <div class="col-12 col-md-6">
                                <!-- Post Thumbnail -->

                                @if($topic['type'] == 'image')
                                    <a href="{{route('news.show',$topic)}}">
                                        <img src="{{asset('/images')}}/{{$topic['src']}}" alt="">
                                    </a>
                                @endif
                                @if($topic['type'] == 'video')
                                    <a href="{{route('single.post',$topic)}}">
                                        <img src="/storage/previews/{{$topic['src'].'.jpg'}}" alt="">
                                        <a href="{{route('single.post',$topic)}}" class="btn play-btn"><i class="fa fa-play" aria-hidden="true"></i></a>
                                    </a>
                                @endif
                            </div>
                            <div class="col-12 col-md-6">
                                <!-- Post Content -->
                                <div class="post-content mt-0">
                                    @foreach($topic['category'] as $category)
                                        <a href="#" class="post-cata cata-sm cata-success" style="background-color: {{$category['color']}}">{{$category['name']}}</a>
                                    @endforeach
                                    <a href="{{route('single.post',$topic)}}" class="post-title mb-2">{{$topic['name']}}</a>
                                    <div class="post-meta d-flex align-items-center mb-2">
                                        <a href="#" class="post-date">{{$topic['created_at']}}</a>
                                    </div>
                                    <div class="mb-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            <!-- Pagination -->
                <nav class="mt-50">
                    <ul class="pagination justify-content-center">
                        {{$topics->links()}}
                    </ul>
                </nav>
            </div>
        </div>
    </div>

@endsection
