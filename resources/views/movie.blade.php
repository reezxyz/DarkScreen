<!DOCTYPE html>
<html>
<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        {{ $movie['title'] }}
    </title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            background:#0f0f0f;
            color:white;
            font-family:Arial;
            overflow-x:hidden;
        }

        a{
            text-decoration:none;
        }

        /* HERO */

        .hero{
            position:relative;
            height:100vh;
            overflow:hidden;
        }

        .hero-video,
        .hero-backdrop{
            position:absolute;
            top:50%;
            left:50%;

            width:120vw;
            height:120vh;

            transform:
                translate(-50%, -50%);

            object-fit:cover;

            border:none;

            z-index:1;

            filter:
                brightness(.55);
        }

        .hero-overlay{
            position:absolute;
            inset:0;

            z-index:2;

            background:
                linear-gradient(
                    to top,
                    #0f0f0f 8%,
                    rgba(0,0,0,.25) 35%,
                    rgba(0,0,0,.55) 100%
                );
        }

        .hero-content{
            position:absolute;
            left:70px;
            bottom:100px;

            max-width:650px;

            z-index:3;
        }

        .movie-logo{
            max-width:420px;
            margin-bottom:25px;
        }

        .movie-title{
            font-size:64px;
            margin-bottom:20px;
            font-weight:bold;
        }

        .tagline{
            color:#ddd;
            font-size:20px;
            font-style:italic;
            margin-bottom:25px;
        }

        .meta-row{
            display:flex;
            align-items:center;
            gap:12px;
            flex-wrap:wrap;

            margin-bottom:25px;
        }

        .chip{
            background:
                rgba(255,255,255,.12);

            padding:8px 16px;

            border-radius:999px;

            font-size:14px;
        }

        .genre{
            background:
                rgba(229,9,20,.2);

            border:1px solid
                rgba(229,9,20,.35);
        }

        .overview{
            color:#ddd;
            line-height:1.8;
            font-size:16px;

            margin-bottom:35px;

            max-width:620px;
        }

        .watch-btn{
            display:inline-flex;
            align-items:center;
            gap:10px;

            background:white;
            color:black;

            padding:16px 34px;

            border-radius:10px;

            font-weight:bold;
            font-size:17px;

            transition:.3s;
        }

        .watch-btn:hover{
            transform:translateY(-2px);
            background:#e8e8e8;
        }

        /* DETAILS */

        .details{
            padding:70px;
            max-width:1400px;
            margin:auto;
        }

        .section-title{
            font-size:34px;
            margin-bottom:35px;

            display:flex;
            align-items:center;
            gap:12px;
        }

        .section-title::before{
            content:'';
            width:4px;
            height:30px;
            border-radius:999px;
            background:#e50914;
        }

        .details-layout{
            display:grid;
            grid-template-columns:
                1.1fr 2fr;

            gap:28px;
        }

        .detail-panel{
            background:
                rgba(255,255,255,.04);

            border:1px solid
                rgba(255,255,255,.08);

            border-radius:24px;

            padding:28px;
        }

        .detail-panel h3{
            font-size:20px;
            margin-bottom:24px;
        }

        .mini-grid{
            display:grid;
            grid-template-columns:
                repeat(2,1fr);

            gap:18px;
        }

        .info-box{
            background:
                rgba(255,255,255,.03);

            border:1px solid
                rgba(255,255,255,.06);

            border-radius:18px;

            padding:18px;

            min-height:90px;
        }

        .info-title{
            font-size:13px;
            color:#8f8f8f;
            margin-bottom:10px;
        }

        .info-value{
            font-size:16px;
            line-height:1.7;
            color:#fff;

            word-break:break-word;
        }

        .movie-summary{
            display:flex;
            flex-direction:column;
            gap:22px;
        }

        .summary-card{
            background:
                rgba(255,255,255,.03);

            border:1px solid
                rgba(255,255,255,.08);

            border-radius:20px;

            padding:22px;
        }

        .summary-card-title{
            font-size:13px;
            color:#888;
            margin-bottom:10px;
        }

        .summary-card-value{
            font-size:17px;
            line-height:1.8;
        }

        /* ACTORS */

        .actors-grid{
            display:grid;
            grid-template-columns:
                repeat(auto-fit,minmax(320px,1fr));

            gap:18px;
        }

        .actor-card{
            display:flex;
            align-items:center;
            gap:18px;

            background:
                rgba(255,255,255,.03);

            border:1px solid
                rgba(255,255,255,.08);

            border-radius:22px;

            padding:18px;

            transition:.25s;
        }

        .actor-card:hover{
            transform:translateY(-3px);
            border-color:
                rgba(229,9,20,.3);
        }

        .actor-photo{
            width:68px;
            height:68px;

            border-radius:50%;
            object-fit:cover;

            flex-shrink:0;
        }

        .actor-name{
            font-size:20px;
            font-weight:600;
            margin-bottom:5px;
        }

        .actor-character{
            color:#a1a1a1;
            font-size:15px;
        }

        @media(max-width:992px){

            .details-layout{
                grid-template-columns:1fr;
            }

            .mini-grid{
                grid-template-columns:1fr;
            }
        }

        @media(max-width:768px){

            .hero-content{
                left:30px;
                right:30px;
                bottom:60px;
            }

            .movie-logo{
                max-width:280px;
            }

            .movie-title{
                font-size:42px;
            }

            .details{
                padding:35px 25px;
            }
        }

        .actors-grid{
            display:grid;
            grid-template-columns:
                repeat(auto-fit,minmax(320px,1fr));
            gap:18px;
        }

        .actor-card{
            display:flex;
            align-items:center;
            gap:18px;
            background: rgba(255,255,255,.03);
            border:1px solid rgba(255,255,255,.08);
            border-radius:22px;
            padding:18px;
            transition:.25s;
        }

        .actor-card:hover{
            transform:translateY(-3px);
            border-color: rgba(229,9,20,.3);
        }

        .actor-photo{
            width:68px;
            height:68px;
            border-radius:50%;
            object-fit:cover;
            flex-shrink:0;
        }

        .actor-name{
            font-size:20px;
            font-weight:600;
            margin-bottom:5px;
        }

        .actor-character{
            color:#a1a1a1;
            font-size:15px;
        }
        .section-block{
            margin-top:70px;
        }

        .collection-card{
            display:flex;
            align-items:center;
            gap:30px;
        }

        .collection-poster{
            width:120px;
            border-radius:18px;
        }

        .collection-title{
            font-size:28px;
            font-weight:700;
            margin-bottom:10px;
        }

        .collection-subtitle{
            color:#a1a1a1;
            line-height:1.8;
        }
    </style>

</head>
<body>

<div class="hero">

    @if($trailer)

        <iframe
            class="hero-video"
            src="https://www.youtube-nocookie.com/embed/{{ $trailer['key'] }}?autoplay=1&mute=1&controls=0&loop=1&playlist={{ $trailer['key'] }}&playsinline=1&modestbranding=1&rel=0&iv_load_policy=3&disablekb=1&fs=0"
            allow="autoplay"
            tabindex="-1"
        ></iframe>

    @else

        <img
            class="hero-backdrop"
            src="https://image.tmdb.org/t/p/original{{ $movie['backdrop_path'] }}"
        >

    @endif

    <div class="hero-overlay"></div>

    <div class="hero-content">

        @if($logo)

            <img
                class="movie-logo"
                src="https://image.tmdb.org/t/p/original{{ $logo['file_path'] }}"
            >

        @else

            <h1 class="movie-title">
                {{ $movie['title'] }}
            </h1>

        @endif

        @if(!empty($movie['tagline']))

            <div class="tagline">
                “{{ $movie['tagline'] }}”
            </div>

        @endif

        <div class="meta-row">

            <div class="chip">
                ⭐ {{ number_format($movie['vote_average'],1) }}/10
            </div>

            <div class="chip">
                ⏱ {{ $formattedRuntime }}
            </div>

            <div class="chip">
                📅 {{ date('Y', strtotime($movie['release_date'])) }}
            </div>

            @foreach($movie['genres'] as $genre)

                <div class="chip genre">
                    {{ $genre['name'] }}
                </div>

            @endforeach

        </div>

        <p class="overview">
            {{ $movie['overview'] }}
        </p>

        <a
            href="/watch/{{ $movie['id'] }}"
            class="watch-btn"
        >
            ▶ Watch Movie
        </a>

    </div>

</div>

<div class="details">

    <!-- MOVIE DETAILS -->

    <h2 class="section-title">
        Movie Details
    </h2>

    <div class="details-layout">

        <!-- LEFT -->

        <div class="detail-panel">

            <h3>
                Information
            </h3>

            <div class="mini-grid">

                <div class="info-box">
                    <div class="info-title">
                        Original Language
                    </div>

                    <div class="info-value">
                        {{ strtoupper($movie['original_language']) }}
                    </div>
                </div>

                <div class="info-box">
                    <div class="info-title">
                        Runtime
                    </div>

                    <div class="info-value">
                        {{ $formattedRuntime }}
                    </div>
                </div>

                <div class="info-box">
                    <div class="info-title">
                        Release Year
                    </div>

                    <div class="info-value">
                        {{ date('Y', strtotime($movie['release_date'])) }}
                    </div>
                </div>

                <div class="info-box">
                    <div class="info-title">
                        Country
                    </div>

                    <div class="info-value">
                        {{ implode(', ', $movie['origin_country']) }}
                    </div>
                </div>

            </div>

        </div>

        <!-- RIGHT -->

        <div class="movie-summary">

            <div class="summary-card">

                <div class="summary-card-title">
                    Studios
                </div>

                <div class="summary-card-value">
                    {{ collect($movie['production_companies'])
                        ->pluck('name')
                        ->join(', ') }}
                </div>

            </div>

            <div class="summary-card">

                <div class="summary-card-title">
                    Spoken Languages
                </div>

                <div class="summary-card-value">
                    {{ collect($movie['spoken_languages'])
                        ->pluck('english_name')
                        ->join(', ') }}
                </div>

            </div>

        </div>

    </div>

    <!-- CAST -->
    <div class="section-block">

    <h2 class="section-title">
        Actors
    </h2>

    <div class="actors-grid">

        @foreach($actors as $actor)

            <div class="actor-card">

                <img
                    class="actor-photo"
                    src="{{
                        $actor['profile_path']
                        ? 'https://image.tmdb.org/t/p/w300'.$actor['profile_path']
                        : 'https://placehold.co/300x300?text=No+Photo'
                    }}"
                >

                <div class="actor-info">

                    <div class="actor-name">
                        {{ $actor['name'] }}
                    </div>

                    <div class="actor-character">
                        {{ $actor['character'] }}
                    </div>

                </div>

            </div>

        @endforeach

    </div>

    <!-- ABOUT MOVIE -->

<div class="section-block">

    <h2 class="section-title">
        About This Movie
    </h2>

    <div class="detail-panel">

        <div class="about-grid">

            <div class="info-box">

                <div class="info-title">
                    Tagline
                </div>

                <div class="info-value">
                    {{ $movie['tagline']
                        ?: 'No tagline available'
                    }}
                </div>

            </div>

            <div class="info-box">

                <div class="info-title">
                    Status
                </div>

                <div class="info-value">
                    {{ $movie['status'] }}
                </div>

            </div>

            <div class="info-box">

                <div class="info-title">
                    Budget
                </div>

                <div class="info-value">
                    $
                    {{ number_format(
                        $movie['budget']
                    ) }}
                </div>

            </div>

            <div class="info-box">

                <div class="info-title">
                    Revenue
                </div>

                <div class="info-value">
                    $
                    {{ number_format(
                        $movie['revenue']
                    ) }}
                </div>

            </div>

        </div>

    </div>

</div>

<!-- COLLECTION -->

@if(isset($movie['belongs_to_collection']))

<div class="section-block">

    <h2 class="section-title">
        Collection
    </h2>

    <div class="detail-panel">

        <div class="collection-card">

            <img
                class="collection-poster"
                src="
https://image.tmdb.org/t/p/w300{{ $movie['belongs_to_collection']['poster_path'] }}
            ">

            <div>

                <div class="collection-title">
                    {{ $movie['belongs_to_collection']['name'] }}
                </div>

                <div class="collection-subtitle">
                    This movie belongs to
                    a franchise collection.
                </div>

            </div>

        </div>

    </div>

</div>

@endif