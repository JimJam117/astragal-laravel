@extends('layouts.base')

@section('title')
Portfolio
@endsection

@section('content')
<h1 class="portfolio-title" style="font-size: 3rem;">Portfolio</h1>

<h1 class="portfolio-title">Websites and Webapps
    <hr>
</h1>

<!-- Instajam -->
<a class="portfolio-link unfinished" href="#/hanzibase">
    <div class="portfolio-link-image">
        <img src="/img/hanzibase.png" alt="hanzibase">
    </div>
    
    <div class="portfolio-link-text">
        <h3>Hanzibase</h3>
        <br>
        <p>Webapp database for learning Chinese Characters, built in Laravel and Vue using public APIs</p>
    </div>

</a>
<!-- expand -->
<div class="expandable" id="hanzibase">
    <div class="expandable-top">
        <img src="/img/hanzibase.png" alt="">
        <div class="expandable-text">
            <h3>Hanzibase</h3>
            <p>Work in Progress</p>
        </div>
    </div>
    <div class="expandable-bottom">
        <a href="#">Live Demo</a> <a href="#">Source</a> <a href="#">Blog Page</a>
    </div>
</div>

<!-- Astralondon.me -->
<a class="portfolio-link unfinished" href="#/astralondon">
    <div class="portfolio-link-image">
        <img src="/img/astralondon.png" alt="">
    </div>
    
    <div class="portfolio-link-text">
        <h3>Astralondon.me</h3>
        <br>
        <p>Portfolio gallery webapp in pure PHP, complete with backend user interface</p>
    </div>

</a>
<!-- expand -->
<div class="expandable" id="astralondon">
    <div class="expandable-top">
        <img src="/img/screenshots/astragal-screenshot.png" alt="">
        <div class="expandable-text">
            <h3>Astralondon.me</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur blanditiis quis obcaecati iste. Ea aut
                aliquid
                doloribus veniam fuga cupiditate.</p>
        </div>
    </div>
    <div class="expandable-bottom">
        <a href="#">Live Demo</a> <a href="#">Source</a> <a href="#">Blog Page</a>
    </div>
</div>

<!-- Chiltern School of Motoring -->
<a class="portfolio-link" href="#csom">
    <div class="portfolio-link-image">
        <img src="/img/csom.png" alt="">
    </div>
    <div class="portfolio-link-text">
        <h3>Chiltern School Of Motoring</h3>
        <br>
        <p>Wordpress website made for my driving instructor, with a custom Wordpress theme to the client's specification
        </p>
    </div>

</a>
<!-- expand -->
<div class="expandable" id="csom">
    <div class="expandable-top">
        <div class="expandable-image">
            <img src="/img/screenshots/chiltern-screenshot.png" alt="">
        </div>
        <div class="expandable-text">
            <h3>Chiltern School of Motoring</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur blanditiis quis obcaecati iste. Ea aut
                aliquid
                doloribus veniam fuga cupiditate.</p>
        </div>
    </div>

    <div class="expandable-middle">
        <div><i class="fab fa-wordpress"></i> <small>Wordpress</small></div>
        <div><i class="fab fa-html5"></i> <small>HTML5</small></div>
        <div><i class="fab fa-css3-alt"></i></i> <small>CSS3</small></div>
        <div><i class="fab fa-php"></i> <small>PHP</small></div>
        <div><i class="fas fa-mobile-alt"></i></i> <small>Responsive Design</small></div>
    </div>

    <div class="expandable-bottom">
        <a class="btn" href="https://www.chilternsom.co.uk/" target="_blank">
            <i class="far fa-window-maximize"></i> Live Site
        </a>  
        <p style="color:#a1a1a1; margin: auto 0;">
            <i class="fas fa-lock"></i> Source Private
        </p> 
        <a class="btn" href="#">
            <i class="fas fa-pen"></i> Blog Page
        </a>
    </div>
</div>

<!-- Instajam -->
<a class="portfolio-link unfinished" href="#/instajam">
    <div class="portfolio-link-image">
        <img src="/img/jimjam4.png" alt="">
    </div>
    
    <div class="portfolio-link-text">
        <h3>Instajam</h3>
        <br>
        <p>An Instagram clone made in Laravel with Vue components</p>
    </div>

</a>
<!-- expand -->
<div class="expandable" id="instajam">
    <div class="expandable-top">
        <img src="https://s3.amazonaws.com/ladder-blog/2017/11/Step1---GIPHY-GIF-MAKER.gif" alt="">
        <div class="expandable-text">
            <h3>Instajam</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur blanditiis quis obcaecati iste. Ea aut
                aliquid
                doloribus veniam fuga cupiditate.</p>
        </div>
    </div>
    <div class="expandable-bottom">
        <a href="#">Live Demo</a> <a href="#">Source</a> <a href="#">Blog Page</a>
    </div>
</div>

<!-- London24Racing -->
<a class="portfolio-link" href="#london24racing">
    <div class="portfolio-link-image">
        <img src="/img/london24racing.png" alt="london24racing">
    </div>
    
    <div class="portfolio-link-text">
        <h3>London24Racing</h3>
        <br>
        <p>Website for an international powerboat racing team with a parralax design and a basic PHP blog</p>
    </div>

</a>
<!-- expand -->
<div class="expandable" id="london24racing">
    <div class="expandable-top">
        <div class="expandable-image">
            <img src="/img/screenshots/l24r-screenshot.png" alt="screenshot">
        </div>
        <div class="expandable-text">
            <h3>London24Racing.com</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur blanditiis quis obcaecati iste. Ea aut
                aliquid
                doloribus veniam fuga cupiditate.</p>
        </div>
    </div>
    <div class="expandable-middle">
        <div><i class="fab fa-html5"></i> <small>HTML5</small></div>
        <div><i class="fab fa-css3-alt"></i></i> <small>CSS3</small></div>
        <div><i class="fab fa-js"></i> <small>Javascript</small></div>
        <div><i class="fab fa-php"></i> <small>PHP</small></div>
        <div><i class="fas fa-mobile-alt"></i></i> <small>Responsive Design</small></div>
    </div>
    <div class="expandable-bottom">
        <a class="btn" href="https://london24racing.com" target="_blank">
            <i class="far fa-window-maximize"></i> Live Site
        </a>  
        <a class="btn" href="#" target="_blank">
            <i class="fas fa-code"></i> Source
        </a> 
        <a class="btn" href="#">
            <i class="fas fa-pen"></i> Blog Page
        </a>
    </div>
</div>

<br><br><br>
<!--<h1 class="portfolio-title">Game Development
    <hr>
</h1> -->

<!-- Hong Kong 47 -->
<a class="portfolio-link unfinished" href="#/hk47">
    <div class="portfolio-link-image">
        <img src="/img/hk47.png" alt="Hong Kong 47">
    </div>

    <div class="portfolio-link-text">
        <h3>Hong Kong 47</h3>
        <br>
        <p>Doom-style 2.5d FPS set in Hong Kong, with 4 weapons and 3 types of enemies, made in Unity</p>
    </div>

</a>
<!-- expand -->
<div class="expandable" id="hk47">
    <div class="expandable-top">
        <img src="/img/screenshots/hk47-screenshot.png" alt="">
        <div class="expandable-text">
            <h3>Hong Kong 47</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur blanditiis quis obcaecati iste. Ea aut
                aliquid
                doloribus veniam fuga cupiditate.</p>
        </div>
    </div>
    <div class="expandable-bottom">
        <a href="#">Live Demo</a> <a href="#">Source</a> <a href="#">Blog Page</a>
    </div>
</div>

<!-- Bloki -->
<a class="portfolio-link unfinished" href="#/bloki">
    <div class="portfolio-link-image">
        <img src="/img/bloki.png" alt="bloki">
    </div>
    
    <div class="portfolio-link-text">
        <h3>Bloki</h3>
        <br>
        <p>My first attempt at Unity Game Development, Arkanoid clone (in Russian)</p>
    </div>

</a>
<!-- expand -->
<div class="expandable" id="bloki">
    <div class="expandable-top">
        <img src="https://s3.amazonaws.com/ladder-blog/2017/11/Step1---GIPHY-GIF-MAKER.gif" alt="">
        <div class="expandable-text">
            <h3>Bloki</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur blanditiis quis obcaecati iste. Ea aut
                aliquid
                doloribus veniam fuga cupiditate.</p>
        </div>
    </div>
    <div class="expandable-bottom">
        <a href="#">Live Demo</a> <a href="#">Source</a> <a href="#">Blog Page</a>
    </div>
</div>

<!-- Connect 4 -->
<a class="portfolio-link unfinished" href="#/c4">
    <div class="portfolio-link-image">
        <img src="/img/c4.png" alt="connect 4">
    </div>
    <div class="portfolio-link-text">
        <h3>Connect 4</h3>
        <br>
        <p>Very simple connect 4 made in Unity</p>
    </div>

</a>
<!-- expand -->
<div class="expandable" id="c4">
    <div class="expandable-top">
        <img src="https://s3.amazonaws.com/ladder-blog/2017/11/Step1---GIPHY-GIF-MAKER.gif" alt="">
        <div class="expandable-text">
            <h3>Connect 4</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur blanditiis quis obcaecati iste. Ea aut
                aliquid
                doloribus veniam fuga cupiditate.</p>
        </div>
    </div>
    <div class="expandable-bottom">
        <a href="#">Live Demo</a> <a href="#">Source</a> <a href="#">Blog Page</a>
    </div>
</div>

@endsection


@section('extra-scripts')

<style>
    html {
        scroll-behavior: smooth;
    }

    .expandable {
        background: #595959;
        overflow: hidden;
        transition: all .5s ease-in-out;
        height: 0;
        padding: 0 1em;
        color: #fff;
    }

    .expandable:target {
        line-height: 1.5;
        padding-top: 1em;
        padding-bottom: 1em;
        margin-bottom: 1em;
        color: #fff;
        height: initial;
    }

    .expandable:target .expandable-image {
        display: block;
    }

    .expandable-image {
        display: none;
    }
    .expandable-image img{
        width: 100%;
    }

    .expandable-top {
        display: flex;
        margin-top: 1em;
    }
    .expandable-top div{
        width: 50%;
    }

    .expandable-middle{
        text-align: center;
    display: flex;
    justify-content: space-evenly;
    padding: 1em;
    flex-wrap: wrap;
    }
    .expandable-middle div{
        padding: 1em;
        color: #dfdfdf;
    }
    

    .expandable-bottom {
        text-align: center;
        padding: 2em 1em 1em 1em;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-evenly;

    }

    .expandable-bottom a {
        text-decoration: none;
        border: none;
        font-weight: 500;
        margin: 1em;
    }

    .expandable-text {
        padding: 0 1em 1em 1em;
    }

    .portfolio-title {
        text-align: center;
        margin-bottom: 1em;
    }

    .portfolio-link {
        width: 100%;
        display: flex;
        margin-top: 1em;
        color: #595959;
        text-decoration: none;
        transition: 0.2s;
    }

    .portfolio-link:hover {
        background-color: rgb(69, 77, 90);
        color: #fff;
    }

    .portfolio-link-image {
        width: 20%;
        display: flex;
        justify-content: center;
        align-items: center;

    }

    .portfolio-link img {
        border-radius: 100%;
        padding: 1em;
        width: 100%;
    }

    .portfolio-link-text {
        padding: 1em;
        font-weight: 400;
        width: 80%;
    }

    .portfolio-link-text p {
        font-size: 1.25rem;
    }

    .portfolio-link-text h3 {
        font-size: 2rem;
    }

    @media only screen and (max-width: 985px) {
        .portfolio-link-text {
            font-size: 0.8rem;
            width: 65%;
        }

        .portfolio-link-image {
            width: 35%;
        }
        .expandable-top{
            flex-direction: column;
        }
        .expandable-top div{
            width: 100%;
        }
        .expandable-image{
            margin-bottom: 1em;
        }
    }

    @media only screen and (max-width: 650px) {
        .portfolio-link-text {
            width: 60%;
        }

        .portfolio-link-image {
            width: 40%;
        }
        .main{
            padding: 1em 0;
        }
    }

    @media only screen and (max-width: 488px) {
        .portfolio-link-text {
            font-size: 0.6rem;
        }
    }

</style>

@auth
<style>
    .unfinished,
    .unfinished:hover {
        background-color: #595959;
        color: grey;
    }

</style>
@endauth

@guest
<style>
    .unfinished,
    .unfinished:hover {
        display: none;
    }

</style>
@endguest

@endsection
