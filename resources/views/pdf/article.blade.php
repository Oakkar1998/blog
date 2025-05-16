<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $article['title'] }}</title>
    <style>
        @page {
            margin: 100px 50px 80px 50px;
        }

           

        body {
            font-family: 'notosansmyanmar', sans-serif;
            line-height: 1.6;
            color: #222;
        }

        header {
            position: fixed;
            top: -80px;
            left: 0;
            right: 0;
            height: 70px;
            text-align: center;
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
        }

        header img {
            height: 50px;
        }

        footer {
            position: fixed;
            bottom: -50px;
            left: 0;
            right: 0;
            height: 40px;
            text-align: center;
            font-size: 12px;
            color: #666;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }

        .pagenum:before {
            content: counter(page);
        }

        .container {
            margin: 0 auto;
            padding: 20px 0;
            width: 100%;
        }

        .header-image {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .category {
            display: inline-block;
            background-color: #0d0e0d;
            color: rgb(245, 237, 237);
            font-size: 12px;
            padding: 4px 10px;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .meta {
            font-size: 18px;
            color: #0e0d0d;
            margin-bottom: 20px;
        }

        .body {
            font-size: 16px;
            text-align: justify;
        }
    </style>
</head>

<body>

    <header>
        <img src="{{ asset('BlogTem/html-magazine-template.jpg') }}" alt="Logo">
    </header>

    <footer>
        © {{ date('Y') }} Future Light — Page <span class="pagenum"></span>
    </footer>

    
    
    <div class="container">

        @if ($article['image'])
            <div style="text-align: center; margin-bottom: 20px;">
                <img src="{{ $article['image'] }}" alt="Article Image"
                    style="width: 300px; height: 300px; object-fit: cover; border-radius: 6px;">
            </div>
        @endif


        

        <div class="title">{{ $article['title'] }}</div>
        
        <div class="category">{{ $article['category'] }}</div>

        <div class="meta">
             {{ $article['author'] }} | {{ $article['date'] }}
        </div>

        

        <div class="body">
            {!! nl2br(e($article['body'])) !!}
            
        </div>

    </div>

</body>

</html>
