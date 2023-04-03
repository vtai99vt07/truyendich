@extends('shop.layouts.app')
@section('title')
    {{ $story->name }} @if(!empty(setting('store_name')))
        -
    @endif
    {{ setting('store_name') }}
    @if(!empty(setting('store_slogan')))
        -
    @endif
    {{ setting('store_slogan') }}
@endsection
@section('seo')
    <link rel="canonical" href="{{ request()->fullUrl() }}">
    <meta name="title" content="{{ $story->name }}">
    <meta name="description" content="{{ $story->meta_description }}">
    <meta name="keywords" content="{{ $story->meta_keywords }}">
    <meta property="og:url" content="{{ request()->fullUrl() }}">
    <meta property="og:title" content="{{ $story->meta_title }}">
    <meta property="og:description" content="{{ $story->meta_description }}">
    <meta property="og:type" content="website">
    <meta property="og:image" content="{{ asset('frontend/img/logo/logo.png') }}">
    <meta property="og:site_name" content="giangthe.com">
@stop
@push('styles')
    <style>
        .input-group {
            padding: 0px;
        }
        .input-group .form-control {
            padding: 5px;
            height: 39px;
        }
        .input-group .form-control:focus {
            border-color: unset;
            box-shadow: none;
            border: 1px solid #ced4da;
        }
        .tt-box-chapter {
            max-height: 216px;
            overflow: hidden;
            padding: 8px 0px;
        }
        .more-list-chapter {
            text-align: center;
            font-size: 14px;
            padding: 10px 0px;
            position: relative;
            cursor: pointer;
            margin-top: 10px;
        }
        .tt-box-list-chapter .more:before {
            /*background-color: rgba(255, 255, 255, .8);*/
            display: block;
            content: "";
            height: 35px;
            position: absolute;
            top: -35px;
            width: 100%;
            left: 0;
        }
        .tt-box-list-chapter .tt-box-chapter.expand {
            height: initial;
            max-height: initial;
        }
    </style>
@endpush
@section('content')
    @include('shop.layouts.partials.ads')
    <section class=" fs-6 bg-story pt-4 pb-5">
        <div class="container px-md-4 px-sm-0 px-0 bg-main-story">
            <div style="position: relative">
                <div
                    style="background: url({{ $story->avatar ?? $story->getFirstMediaUrl('default') }});background-size: cover;height: 450px;filter: blur(8px);position: absolute;width: 100%">
                </div>
            </div>
            <div class="container" style="padding-top: 70px">
                <div class="row">
                    <div class="col" style="z-index:100">
                        <center><img class="img-story"
                                     src="{{ $story->avatar ?? $story->getFirstMediaUrl('default') }}"></center>
                    </div>
                    <div class="col-xl-12 pt-5">
                        <center>
                            <span id="book_name2" class="cap story-name" style="color:#004c1f"> {{ ucfirst($story->name) }} </span>
                            <br>
                            <span class="cap pt-5"><i class="fa fa-user"></i>  {{ $story->author }}</span>
                        </center>
                    </div>
                </div>
            </div>
            <div class="mt-4 mb-2 border-top-radius">
                <div class="row justify-content-md-center bg-white" style="margin: 0">
                    <div class="col-4 p-2 text-center col-lg-2">
                        <span><i class="fa fa-eye"></i><br>{{ number_format($story->view) }} lượt xem</span>
                    </div>
                    <div class="col-4 p-2 text-center col-lg-2">
                            <span><i class="fa fa-lg fa-thumbs-up"></i><br><span
                                    id="whishlist">{{ number_format($story->whishlist_count) }}</span> lượt like</span>
                    </div>
                    <div class="col-4 p-2 text-center col-lg-2">
                        <span id="bookstatus"><i class="fa fa-star-half"></i><br>Còn tiếp</span>
                    </div>
                    <div class="col-4 p-2 text-center col-lg-2">
                        <span><i class="fa fa-rss"></i><br><span id="follow_story"> {{ number_format($story->follow_count) }}</span> Theo dõi</span>
                    </div>
                    <div class="col-4 p-2 text-center col-lg-2">
                        <span><i class="fas fa-gift"></i><br><span id="follow_story"> {{ number_format((int)$story->donate) }}</span> vàng</span>
                    </div>
                </div>
            </div>
            <div class="bg-white" style="font-weight:500">
                <div class="p-1"><i class="fa fa-info-circle"></i> Tóm tắt truyện</div>
                <div class="p-2 bt">
                    {!! $story->description !!}
                </div>
            </div>
            <div class="bg-white mt-2" style="font-size: 14px;">
                <div class="p-1 bt"><i class="fa fa-info-circle"></i> Thông tin</div>
                <div class="p-1 bt">Tên gốc: <span id="oriname">{{ $story->name_chines }}</span></div>
                <div class="p-1 bt">Hán việt: {{ $story->name }} </div>
                <div class="p-1 bt">Tác giả: {{ $story->author_vi }}</div>
                <div class="p-1 bt">Thể
                    loại: @if(!empty($story->categories)) @foreach($story->categories as $category) {{ $category->name }} @endforeach @endif</div>
                @if(strpos(url()->current(), 'truyenvipfaloo'))
                <div class="p-1 bt">Nguồn truyện: <a class="text-success"
                                                     href="{{ $story->origin ?? '#'}}">{{ $story->origin ?? 'Sáng tác'}}</a>
                </div>
                @endif
                <div class="p-1 bt">Loại
                    truyện: @if(!empty($story->types)) @foreach($story->types as $type) {{ $type->name }} @endforeach @endif</div>
                <?php
                $tags = json_decode($story->tags, 1);
                $last_tag = null;
                if (!empty($tags)) {
                    $last_tag = end($tags);
                }
                ?>
                <div class="p-1 bt">
                    Tags: @if(!empty($tags)) @foreach($tags as $tag) {!! $tag !!} @if($tag!=$last_tag)
                        ,  @endif @endforeach @else Không có @endif</div>
                <div class="p-1 bt">Nhập thời: {{ $story->created_at }}</div>
            </div>
        @if(!empty(currentUser()->id))
            <div class="bg-white mt-2">
                <div class="p-1"><i class="fas fa-circle"></i> Thao tác</div>
                <div class="row text-center bt pt-2">
                    <div class="col-3 col-lg-3">
                    <span id="readnowbtn"><i class="fa fa-eye"></i><br>Đọc ngay</span>
                    </div>
                    <div class="col-3 col-lg-3" id="like">
                        <span><i class="fa fa-thumbs-up"></i><br>Thích</span>
                    </div>
                    <div class="col-3 col-lg-3" id="follow">
                        <span><i class="fa fa-plus"></i><br>Theo dõi</span>
                    </div>
                    <div class="col-3 col-lg-3" data-bs-toggle="modal" data-bs-target="#donate">
                        <span><i class="fas fa-gift"></i><br><span id="follow_story">Thưởng truyện</span> </span>
                    </div>
                    <div class="modal fade" id="donate" tabindex="-1" aria-labelledby="exampleModalLabel"
                         aria-hidden="true" style="font-size: 12px;">
                            @if($donate || $story->mod_id))
                                <div class="modal-dialog modal-dialog-centered modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="modal-title">Thưởng truyện</h6>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="" style="text-align:left">
                                                @csrf
                                                <div class="error text-danger"></div>
                                                <p>Số vàng bạn hiện có</p>
                                                <div class="position-relative">
                                                    <input type="text" value="{{ number_format((int)$wallet->gold) }}" readonly
                                                           class="wallet form-control" data-wallet="{{ (int)$wallet->gold}} ">
                                                </div>
                                                <p class="mt-3">Số vàng muốn thưởng</p>
                                                <p><input class="form-control gold" value="0" name="gold" type="text" placeholder="Nhập số vàng muốn tặng"></p>

                                                <p class="text-danger">*Thưởng ít nhất 1000 vàng để ủng hộ người làm truyện</p>
                                                <p>Kiểm tra lại số vàng sẽ thưởng:</p>
                                                <div class="position-relative">
                                                    <input type="text" value="0" readonly class="form-control request">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" disabled class="btn btn-gt gift">Tặng ngay
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                    </div>
                    @else
                        <div class="modal-dialog modal-dialog-centered modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title">Thưởng truyện</h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="" style="text-align:left">
                                        @csrf
                                        <div class="error text-danger"></div>
                                        <p>Hôm nay bạn có 1 điểm thưởng miễn phí</p>
                                        <p>Số vàng bạn hiện có</p>
                                        <div class="position-relative">
                                            <input type="text" value="{{ number_format((int)$wallet->gold) }}" readonly
                                                   class="wallet form-control">
                                        </div>
                                        <p>Số điểm thưởng muốn tặng?</p>
                                        <div class="position-relative">
                                            <input type="text" value="1" readonly class="form-control">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-gt gifts">Tặng ngay</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                </div>
                @endif
            </div>
        </div>
        @endif
        <div class="p-1 bg-white mt-2">
            <div>
                Người Nhúng
            </div>
            <div class="bt">
                <a href="{{ $story->user_id ? route('user.index',$story->user_id) : ''}}" class="d-flex">
                    <div class="position-relative">
                        @if($story->user && @$story->user->avatar)
                            <img src="{{ pare_url_file($story->user->avatar,'user') }}" class="img-user">
                        @else
                            <img src="frontend/images/no-user.png" class="img-user">
                        @endif
                    </div>
                    <span style="padding: 10px 0px;">{{ $story->user->name ?? 'Chưa có' }}</span>
                    @if($story->user->is_vip)
                        <span style="padding: 10px 0px">- Mod làm truyện</span>
                    @endif
                </a>
            </div>
        </div>
        <div class="p-1 bg-white mt-2">
            <div>
                <i class="fa fa-list"></i> Mục lục
                {{--                    <span style="float: right;color: gray">--}}
                {{--                        <i class="fa fa-retweet"></i> Cập nhật</span>--}}
                {{--                    <span style="float: right;color: gray;margin-right: 8px">--}}
                {{--                        <a href="#clicktoexp" style="color: gray;"><i class="fa fa-chevron-down"></i> Xuống</a></span>--}}
            </div>
            @if(strpos(url()->current(), 'truyenvipfaloo'))
            <div class="bt p-1" style="font-size: 14px;">
                Nguồn:
                <span style="border-bottom: 2px solid green">{{ $story->origin ?? 'Sáng tác'}}: {{ $story->chapters_count }} chương</span>
                {{--<a href="#">aikanshuba(96) </a>--}}
            </div>
            @endif
            <div>
                <div class="pt-2 pb-2 tt-box-list-chapter">
                    <div class="row tt-box-chapter">
                        <?php $readed = true ?>
                        @php
                            $check = 0;
                            $time = 0;
                            if(currentUser()){
                            foreach(\App\Enums\UserState::Admin as $list){
                                if(currentUser() && $list === currentUser()->username)
                                    $check = 1;
                            }
                            if( $story->mod_id == currentUser()->id )
                            $check = 1;
                            }
                        @endphp
                        @if($story->chapters)
                            @foreach($story->chapters as $chapter)
                                @if((@$chapter->timer && @$chapter->timer <= date('Y-m-d H:i:s')) || !@$chapter->timer)
                                    @php
                                        if (currentUser()) {
                                            if ($story->type == 1) {
                                                if (!$chapLastReaded) {
                                                    $readed = false;
                                                }
                                                if($chapterLastReaded != '' && ($chapterLastReaded == $chapter['order'])) {
                                                 $link = 'chaplastreaded';
                                                 $readed = false;
                                                }
                                                else if($readed) $link = 'chapreaded';
                                                else $link = '';
                                            } else {
                                                if($chapterLastReaded == @$chapter['order']) $link = 'chaplastreaded';
                                                else if($chapterLastReaded < @$chapter['order']) $link = '';
                                                else $link = 'chapreaded';
                                            }
                                        }
                                        $linkStory = @$chapter['embed_link'] ?  @$chapter['link_other'] ?? route('chapters.show', [$story->id, 'link' => @$chapter['embed_link']]) : @$chapter['link_other'] ?? route('chapters.show', [$story->id, 'id' => $chapter['id']]);
                                    @endphp
                                    @if(!empty(currentUser()->id))
                                        @if(@$chapter['is_vip'] == 1)
                                            @if(\App\Domain\Admin\Models\Order::where(['chapter_id'=>@$chapter['id'],
                                                'user_id' => currentUser()->id
                                                ])->first() || $check || currentUser()->user_vip == 1)
                                                <div class="col-md-4">
                                                    <div class="tt-chapter {{ @$link }}"
                                                         @if(@$link == 'chaplastreaded') id="last_readed" @endif>
                                                        <a href="{{  $linkStory }}"
                                                           class="text-success"
                                                           title="{{ $chapter['name'] }}">
                                                            <i class="fal fa-check"></i> {{ Str::limit(@$chapter['name'], 47) }}
                                                        </a>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-md-4">
                                                    <div class="tt-chapter {{ @$link }}"
                                                         @if(@$link == 'chaplastreaded') id="last_readed" @endif>
                                                        <a href="javascript:;"
                                                           data-url="{{  $linkStory }}"
                                                           data-story="{{ $story->id }}"
                                                           data-chapter="{{ @$chapter['id'] }}"
                                                           data-chapter-name="{{ @$chapter['name'] }}"
                                                           data-price="{{ number_format(@$chapter['price']) }}"
                                                           class="text-success order"
                                                           title="{{ $chapter['name'] }}">
                                                            <i class="fa fa-lock"></i> {{ Str::limit($chapter['name'], 47) }}
                                                        </a>
                                                    </div>
                                                </div>
                                            @endif
                                        @else
                                            <div class="col-md-4">
                                                <div class="tt-chapter {{ @$link }}"
                                                     @if(@$link == 'chaplastreaded') id="last_readed" @endif>
                                                    <a href="{{ $linkStory }}" class="text-success"
                                                        title="{{ $chapter['name'] }}"> {{ Str::limit(@$chapter['name'], 47) }} </a>
                                                </div>
                                            </div>
                                        @endif
                                    @else
                                        @if(@$chapter['is_vip'] != 1)
                                            <div class="col-md-4">
                                                <div class="tt-chapter {{ @$link }}"
                                                    @if(@$link == 'chaplastreaded') id="last_readed" @endif>
                                                    <a href="{{ $linkStory }}"
                                                        class="text-success "
                                                        title="{{ $chapter['name'] }}">
                                                        {{ Str::limit($chapter['name'], 47) }}
                                                    </a>
                                                </div>
                                            </div>
                                        @else
                                            <div class="col-md-4">
                                                <div class="tt-chapter">
                                                    <a href="{{ @$linkStory }}"
                                                       class="text-success"
                                                       title="{{ $chapter['name'] }}">
                                                        <i class="fa fa-lock"></i> {{ Str::limit($chapter['name'], 47) }}
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                @endif
                            @endforeach
                        @endif
                    </div>
                    <div class="text-center text-dark">
                        <div id="clicktoexp" style="background-color:#f2f2f2;" class="pt-2 pb-2 more-list-chapter more">
                            Mở rộng
                        </div>
                        <span>Chương mới :{{ \Carbon\Carbon::parse($story->chapter_updated)->diffForHumans(\Carbon\Carbon::now()) }}</span>
                        @if(currentUser() && $story->type == 1 && $story->complete_free == \App\Domain\Story\Models\Story::COMPLETE_FREE_INACTIVE )
                            <div style="background-color:#f2f2f2; cursor: pointer;" class="pt-2 pb-2 mt-1 updateEmbedStory">Cập nhật chương mới <i class="fa fa-sync-alt"></i></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            @include('shop.layouts.comment',['type' => "App/Domain/Chapter/Models/Story",'id' => $story->id ,'author' => $story->mod_id])
        </div>
        </div>
    </section>
@endsection

@section('scripts')
     <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            $("#readnowbtn").click(function () {
                $('html, body').animate({
                    scrollTop: $('.tt-box-list-chapter').offset().top
                }, 200);
            });
            $(".tt-box-list-chapter .more-list-chapter").click(function () {
                if ($('.more-list-chapter').hasClass('more')) {
                    $(this).removeClass('more').addClass('less');
                    $(this).html('Thu gọn');
                } else {
                    $(this).removeClass('less').addClass('more');
                    $(this).html('Xem thêm');
                    $('html, body').animate({
                        scrollTop: $('.tt-box-list-chapter').offset().top
                    }, 200);
                }
                jQuery(".tt-box-list-chapter .tt-box-chapter").toggleClass("expand");
            });
        });
        $(function () {
            $('.order').on('click', function () {
                var story = $(this).attr('data-story');
                var chapter = $(this).attr('data-chapter-name');
                var price = $(this).attr('data-price');
                Swal.fire({
                    title: 'Bạn muốn mua chương này ?',
                    text: `Chương ${chapter} giá 99 vàng`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Tất nhiên rồi!',
                    cancelButtonText: 'Chưa phải lúc này!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        if (!$(this).data("loading")) {
                            var href = $(this).attr('data-url');
                            var chapters = $(this).attr('data-chapter');
                            var url = "{{ route('user.order.chapter') }}";
                            $.post({
                                url: url,
                                data: {chapter: chapters, story: story},
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function (res) {
                                    if (res.status == 300) {
                                        toastr.error(res.message, 'Cảnh Báo');
                                    } else {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Thành công',
                                            text: res.message,
                                            confirmButtonText: 'Đọc ngay',
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                window.location.href = href;
                                            }
                                        })
                                    }
                                }
                            })
                        }
                    }
                })
            })
            $('.gold').on('keyup', function () {
                $('button.gift').prop('disabled', false);
                var gold = $(this).val();
                if (!gold.length) {
                    $('.error').text('Vàng không được bỏ trống');
                    $('button.gift').prop('disabled', true);
                    return;
                }
                if (gold == 0) {
                    $('.error').text('Số vàng phải lớn hơn 0');
                    $('button.gift').prop('disabled', true);
                    return;
                }
                if (gold % 10 > 0) {
                    $('.error').text('Số vàng phải chia hết cho 10');
                    $('button.gift').prop('disabled', true);
                    return;
                }
                if (/^[0-9.]+$/.test($(this).val())) {
                    $('.error').text('');
                    if (parseFloat(gold) > parseFloat($('.wallet').attr('data-wallet'))) {
                        $('.request').val('Bạn không đủ vàng để tặng')
                    } else {
                        var number = gold / 1;
                        $('.request').val(number);
                    }
                    $('button.gift').prop('disabled', false);
                } else {
                    $('.error').text('');
                    $('.request').val('Số vàng phải là số')
                    $('button.gift').prop('disabled', true);
                }
            })
            $('.gift').on('click', function () {
                // $(this).attr("disabled", true);
                var gold = $('.gold').val();
                var request = gold;
                var received = '{{ $story->mod_id ?? 0 }}';
                var story = '{{ $story->id }}';
                var url = "{{ route('user.donate.store') }}";
                $.post({
                    url: url,
                    data: {num: request, gold: gold, received: received, story: story},
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (res) {
                        if (res.status == 300) {
                            $('.error').text(res.message);
                            $('.gift').attr("disabled", false);
                        } else {
                            toastr.success(res.message, 'Thành Công');
                            // setTimeout(window.location.reload(), 2000);
                        }
                    }
                })
            })
            $('.gifts').on('click', function () {
                // $(this).attr("disabled", true);
                var request = 1;
                var gold = 1;
                var received = 0;
                var story = '{{ $story->id }}';
                var url = "{{ route('user.donate.store') }}";
                $.post({
                    url: url,
                    data: {num: request, gold: gold, received: received, story: story},
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (res) {
                        if (res.status == 300) {
                            $('.error').text(res.message);
                            $('.gifts').attr("disabled", false);
                        } else {
                            toastr.success(res.message, 'Thành Công');
                            // setTimeout(window.location.reload(), 2000);
                        }
                    }
                })
            })
            $(document).on('click', function () {
                $('.lists').addClass('d-none');
            })
            $('#like').on('click', function () {
                var id = '{{ $story->id}}';
                var url = '/truyen/' + id + '/whishlist';
                $.post({
                    url: url,
                    data: {id: id},
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (res) {
                        if (res.status == 300) {
                            $('.error').text(res.message);
                        } else {
                            toastr.success(res.message, 'Thành Công');
                            $('#whishlist').text(res.all_whishlist);
                        }
                    }
                })
            });
            $('#follow').on('click', function () {
                var id = '{{ $story->id}}';
                var url = '/truyen/' + id + '/follow';
                $.post({
                    url: url,
                    data: {id: id},
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (res) {
                        if (res.status == 300) {
                            $('.error').text(res.message);
                        } else {
                            toastr.success(res.message, 'Thành Công');
                            $('#follow_story').text(res.all_follow);
                        }
                    }
                })
            });
            @if($story->type == 1)
            $('.updateEmbedStory').click(function (el) {
                $.ajax({
                    url: '{{ route('updateEmbedStory') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        story_id: '{{ $story->id }}',
                    },
                    success: function (res) {
                        toastr.success(res.message, 'Thành Công');
                    },
                })
            })
            @endif
        })
    </script>
@endsection
