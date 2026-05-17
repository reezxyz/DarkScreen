<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DarkScreen</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            background:#0f0f0f;
            font-family:Arial, Helvetica, sans-serif;
            color:white;
        }

        a{
            text-decoration:none;
            color:white;
        }

        /* NAVBAR */

        .navbar{
            position:fixed;
            top:0;
            left:0;
            width:100%;
            padding:20px 50px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            z-index:100;
            background:linear-gradient(to bottom, rgba(0,0,0,0.8), transparent);
        }

        .logo{
            font-size:28px;
            font-weight:bold;
            color:#e50914;
        }

        .nav-links{
            display:flex;
            gap:25px;
        }

        .nav-links a{
            font-size:15px;
            transition:0.3s;
        }

        .nav-links a:hover{
            color:#e50914;
        }

        /* HERO */

        .hero{
            position:relative;
            width:100%;
            height:90vh;
            overflow:hidden;
        }

        .hero img{
            width:100%;
            height:100%;
            object-fit:cover;

            animation:zoom 20s infinite alternate;
        }

        @keyframes zoom{
            from{
                transform:scale(1);
            }

            to{
                transform:scale(1.08);
            }
        }

        .hero-overlay{
            position:absolute;
            inset:0;

            background:
                linear-gradient(
                    to top,
                    #0f0f0f 5%,
                    rgba(0,0,0,0.2) 40%,
                    rgba(0,0,0,0.5) 100%
                );
        }

        .hero-content{
            position:absolute;
            bottom:120px;
            left:60px;
            max-width:600px;
            z-index:10;
        }

        .hero-title{
            font-size:60px;
            margin-bottom:20px;
        }

        .hero-overview{
            line-height:1.7;
            color:#ddd;
            margin-bottom:30px;
        }

        .hero-buttons{
            display:flex;
            gap:15px;
        }

        .btn{
            padding:12px 28px;
            border-radius:5px;
            font-weight:bold;
            transition:0.3s;
        }

        .btn-play{
            background:white;
            color:black;
        }

        .btn-play:hover{
            background:#ddd;
        }

        .btn-info{
            background:rgba(255,255,255,0.2);
        }

        .btn-info:hover{
            background:rgba(255,255,255,0.3);
        }

        /* MOVIE SECTION */

        .section{
            padding:40px 50px;
        }

        .section-title{
            font-size:28px;
            margin-bottom:25px;
        }

        .movie-wrapper{
            position:relative;
        }

        .movies{
            display:flex;
            gap:20px;

            overflow-x:auto;
            overflow-y:hidden;

            scroll-behavior:smooth;

            padding:10px 0;

            scrollbar-width:none;
        }

        .movies::-webkit-scrollbar{
            display:none;
        }

        .movie-card{
            min-width:160px;
            max-width:160px;

            flex-shrink:0;

            position:relative;
            overflow:hidden;

            border-radius:10px;

            transition:0.3s;
        }

        .movie-card:hover{
            transform:scale(1.05);
        }

        .movie-card img{
            width:100%;
            height:240px;

            object-fit:cover;

            display:block;
        }

        .movie-info{
            padding:12px;
        }

        .movie-title{
            font-size:14px;
            margin-bottom:5px;
        }

        .movie-rating{
            font-size:12px;
        }

        .scroll-btn{
            position:absolute;
            top:50%;
            transform:translateY(-50%);

            width:50px;
            height:50px;

            border:none;
            border-radius:50%;

            background:rgba(0,0,0,0.7);
            color:white;

            font-size:24px;

            cursor:pointer;

            z-index:20;

            transition:0.3s;
        }

        .scroll-btn:hover{
            background:#e50914;
        }

        .left{
            left:-20px;
        }

        .right{
            right:-20px;
        }

        .navbar-right form{
            display:flex;
            align-items:center;
            gap:15px;
        }

        .search-bar{
            padding:10px 15px;

            border:none;
            outline:none;

            border-radius:5px;

            background:rgba(255,255,255,0.1);

            color:white;

            width:220px;
        }

        .language-select{
            padding:10px;

            border:none;
            outline:none;

            border-radius:5px;

            background:rgba(255,255,255,0.1);

            color:white;

            cursor:pointer;
        }

    </style>
</head>
<body>

    <!-- NAVBAR -->

    <div class="navbar">

        <div class="logo">
            DarkScreen
        </div>

        <div class="nav-links">
            <a href="#">Home</a>
            <a href="#">Trending</a>
            <a href="#">Movies</a>
            <a href="#">TV Shows</a>
        </div>

    

        <form method="GET" action="/">

            <input
                type="text"
                name="search"
                placeholder="Search movie..."
                class="search-bar"
            >

            <select
                name="lang"
                class="language-select"
                onchange="this.form.submit()"
            >
                <option value="en-US"
                    {{ $lang == 'en-US' ? 'selected' : '' }}>
                    English
                </option>

                <option value="id-ID"
                    {{ $lang == 'id-ID' ? 'selected' : '' }}>
                    Indonesia
                </option>

                <option value="ja-JP"
                    {{ $lang == 'ja-JP' ? 'selected' : '' }}>
                    Japanese
                </option>

                <option value="ko-KR"
                    {{ $lang == 'ko-KR' ? 'selected' : '' }}>
                    Korean
                </option>

            </select>

        </form>

    </div>

    <!-- HERO -->

    <div class="hero">

        <img src="https://image.tmdb.org/t/p/original{{ $hero['backdrop_path'] }}">

        <div class="hero-overlay"></div>

        <div class="hero-content">

            <h1 class="hero-title">
                {{ $hero['title'] }}
            </h1>

            <p class="hero-overview">
                {{ $hero['overview'] }}
            </p>

            <div class="hero-buttons">

                <a
                    href="/movie/{{ $hero['id'] }}"
                    class="btn btn-play"
                >
                    ▶ Watch Now
                </a>

                <a
                    href="#"
                    class="btn btn-info"
                >
                    More Info
                </a>

            </div>

        </div>

    </div>

    <!-- TRENDING MOVIES -->

    <div class="section">

        <h2 class="section-title">
            🔥 Trending Movies
        </h2>

        <div class="movie-wrapper">

    <button class="scroll-btn left">
        ❮
    </button>

    <div class="movies" id="movieSlider">

            @foreach($movies as $movie)

                <a
                    href="/movie/{{ $movie['id'] }}"
                    class="movie-card"
                >

                    <img
                        src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}"
                    >

                    <div class="movie-info">

                        <div class="movie-title">
                            {{ $movie['title'] }}
                        </div>

                        <div class="movie-rating">
                            ⭐ {{ $movie['vote_average'] }}
                        </div>

                    </div>

                </a>

            @endforeach

        </div>

        <button class="scroll-btn right">
            ❯
        </button>

    </div>

    </div>

    <!-- THRILLER PICKS -->

<div class="section">

    <h2 class="section-title">
        🩸 Thriller Picks
    </h2>

    <div class="movie-wrapper">

        <button class="scroll-btn left thriller-left">
            ❮
        </button>

        <div
            class="movies thriller-slider"
        >

            @foreach($thrillerMovies as $movie)

                <a
                    href="/movie/{{ $movie['id'] }}"
                    class="movie-card"
                >

                    <img
                        src="https://image.tmdb.org/t/p/w780{{ $movie['backdrop_path'] }}"
                    >

                    <div class="movie-info">

                        <div class="movie-title">
                            {{ $movie['original_title'] }}
                        </div>

                        <div class="movie-rating">
                            ⭐ {{ $movie['vote_average'] }}
                        </div>

                    </div>

                </a>

            @endforeach

        </div>

        <button class="scroll-btn right thriller-right">
            ❯
        </button>

    </div>

</div>

    <script>

function setupSlider(
    sliderClass,
    leftClass,
    rightClass
){

    const slider =
        document.querySelector(sliderClass);

    const leftBtn =
        document.querySelector(leftClass);

    const rightBtn =
        document.querySelector(rightClass);

    rightBtn.addEventListener(
        'click',
        () => {

            slider.scrollBy({
                left:800,
                behavior:'smooth'
            });

        }
    );

    leftBtn.addEventListener(
        'click',
        () => {

            slider.scrollBy({
                left:-800,
                behavior:'smooth'
            });

        }
    );

    slider.addEventListener(
        'wheel',
        (e) => {

            if(e.shiftKey){

                e.preventDefault();

                slider.scrollLeft +=
                    e.deltaY;

            }

        }
    );
}

// Trending
setupSlider(
    '#movieSlider',
    '.left',
    '.right'
);

// Thriller
setupSlider(
    '.thriller-slider',
    '.thriller-left',
    '.thriller-right'
);

</script>
</body>
</html>