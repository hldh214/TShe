@extends('layouts.app')

@section('style')
    <link href="https://cdn.bootcss.com/Swiper/3.4.2/css/swiper.min.css" rel="stylesheet">
    <style>
        .navbar {
            margin-bottom: 0;
        }

        .swiper-container {
            margin-bottom: 10px;
        }

        p {
            font-size: 12px;
        }

        .yellow {
            background-color: #ffd423;
            color: black;
            margin-top: 5px;
        }
    </style>
@endsection

@section('content')
    <div class="swiper-container">
        <div class="swiper-wrapper">
            @foreach($carousels as $carousel)
                <div class="swiper-slide">
                    <a href="{{ $carousel->link }}">
                        <img class="img-responsive" src="{{ $carousel->full_uri }}" lt="slide">
                    </a>
                </div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
    </div>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-body">
                <img class="img-responsive" src="https://o86bsrpha.qnssl.com/assets/qixi_mt__big-fb1257b8daa4427d18767e12d8d7db3c.gif"
                     alt="morons">
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                <img class="img-responsive" src="https://o86bsrpha.qnssl.com/assets/font_editor__big-6d041aab2e523051526146b06c2ff0da.png"
                     alt="morons">
            </div>
        </div>

        <h4 class="text-center">总有一些东西值得你定制</h4>

        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-6">
                        <img src="https://o86bsrpha.qnssl.com/assets/cam_case__small01-d126a0d7d955bb43f779d051679bbe42.png" alt="" class="img-responsive">
                        <h5>《王者荣耀》主题</h5>
                        <p>王者有时候很简单，可以握在手里，也可以穿在身上。</p>
                    </div>
                    <div class="col-xs-6">
                        <img src="https://o86bsrpha.qnssl.com/assets/cam_case__big01-2844220cb406b9c57043aefba2d68e80.png" alt="" class="img-responsive">
                        <button class="btn btn-block btn-sm yellow">立即定制
                            <span class="glyphicon glyphicon-play"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-6">
                        <img src="https://o86bsrpha.qnssl.com/assets/cam_case__big02-51d392fac7dde27475659080c0c6928f.png" alt="" class="img-responsive">
                        <button class="btn btn-block btn-sm yellow">立即定制
                            <span class="glyphicon glyphicon-play"></span>
                        </button>
                    </div>
                    <div class="col-xs-6">
                        <img src="https://o86bsrpha.qnssl.com/assets/cam_case__small02-7410433d73462087d1a5b43bead7416a.png" alt="" class="img-responsive">
                        <h5>《权力的游戏》主题</h5>
                        <p>把喜欢穿在身上是权游迷应有的姿态。</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-6">
                        <img src="https://o86bsrpha.qnssl.com/assets/cam_case__small03-845fb9e86e2f31d644e1f5f02f8008cd.png" alt="" class="img-responsive">
                        <h5>《关爱单身汪》主题</h5>
                        <p>T社关爱单身汪在行动，不说废话，直接6折。</p>
                    </div>
                    <div class="col-xs-6">
                        <img src="https://o86bsrpha.qnssl.com/assets/cam_case__big03-5666d63db83ed7e0cba4271db6bb81ff.png" alt="" class="img-responsive">
                        <button class="btn btn-block btn-sm yellow">立即定制
                            <span class="glyphicon glyphicon-play"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.bootcss.com/Swiper/3.4.2/js/swiper.jquery.min.js"></script>

    <script>
        // slider
        new Swiper('.swiper-container', {
            loop: true,
            pagination: '.swiper-pagination',
            paginationClickable: true,
            autoplay: 5000
        });
    </script>
@endsection
