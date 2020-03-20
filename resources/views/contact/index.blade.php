@extends('layouts.base')

@section('title')
Contact
@endsection

@section('content')
<h1>Contact</h1>
<br>
<form action="/contact" method="post" enctype="multipart/form-data">
    @csrf
    <div class=" form-group row">

        <input id="name" placeholder="Name" type="name" class="form-control @error('name') is-invalid @enderror"
            name="name" value="{{ old('name') }}" required>

        @error('title')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class=" form-group row">

        <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror"
            name="email" value="{{ old('email') }}" required>

        @error('title')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>


    <div class=" form-group row">
        <textarea placeholder="Message" class="form-control @error('body') is-invalid @enderror" type="text"
            name="body" rows="8">{{old('body')}}</textarea>
        @error('body')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    
    <div class="form-group row captchaStyle {{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
            {!! app('captcha')->display() !!}
            @if ($errors->has('g-recaptcha-response'))
                <span class="help-block">
                    <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                </span>
            @endif
    </div>


    <div class="form-group row mb-0">
        <button aria-label="Send" class="submit-button" type="submit" name="button">Send</button>
    </div>
</form>

{!! NoCaptcha::renderJs() !!}

@endsection

@section('extra-scripts')
<style>
    .captchaStyle{
        width: 100%;
        display: flex;
        justify-content: center;
    }
    textarea {
        width: 100%;
        padding: 1em;
        margin: 1em 0;
        resize: vertical;
        font-family: "Open Sans";
    }

    h1 {
        text-align: center;
    }

    form {
        text-align: center;
        width: 50%;
        margin: auto;

    }

    .submit-button {
        background-color: #4771b1;
        color: #fff;
        padding: 1em 2em;
        font-size: 1rem;
        border: 2px solid #4771b1;
        transition: 0.2s;
        margin: 3rem 0;
    }

    .submit-button:hover {
        background-color: #fff;
        color: #4771b1;
        border: 2px solid #4771b1;
    }

    .row {
        padding: 0;
    }


    @media only screen and (max-width: 650px) {
        form {
            width: 90%;
            margin: auto;

        }

        .submit-button {
            padding: 1em 2em;
            font-size: initial;
        }
    }

</style>
@endsection
