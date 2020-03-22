@extends('layouts.backend')

@section('content')
<div class="content">



    <h1 class="page-header"><svg class="svg-inline--fa fa-home fa-w-18" aria-hidden="true" focusable="false"
            data-prefix="fas" data-icon="home" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
            data-fa-i2svg="">
            <path fill="currentColor"
                d="M280.37 148.26L96 300.11V464a16 16 0 0 0 16 16l112.06-.29a16 16 0 0 0 15.92-16V368a16 16 0 0 1 16-16h64a16 16 0 0 1 16 16v95.64a16 16 0 0 0 16 16.05L464 480a16 16 0 0 0 16-16V300L295.67 148.26a12.19 12.19 0 0 0-15.3 0zM571.6 251.47L488 182.56V44.05a12 12 0 0 0-12-12h-56a12 12 0 0 0-12 12v72.61L318.47 43a48 48 0 0 0-61 0L4.34 251.47a12 12 0 0 0-1.6 16.9l25.5 31A12 12 0 0 0 45.15 301l235.22-193.74a12.19 12.19 0 0 1 15.3 0L530.9 301a12 12 0 0 0 16.9-1.6l25.5-31a12 12 0 0 0-1.7-16.93z">
            </path>
        </svg><!-- <i class="fas fa-home"></i> --> Homepage Setup</h1>

    <form action="/backend/homepage" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <table class="form_table">
            <tbody>
                <tr class="form-group">
                    <td>
                        <h3 class="sub-header"><svg class="svg-inline--fa fa-font fa-w-14" aria-hidden="true"
                                focusable="false" data-prefix="fas" data-icon="font" role="img"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                <path fill="currentColor"
                                    d="M432 416h-23.41L277.88 53.69A32 32 0 0 0 247.58 32h-47.16a32 32 0 0 0-30.3 21.69L39.41 416H16a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h128a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16h-19.58l23.3-64h152.56l23.3 64H304a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h128a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zM176.85 272L224 142.51 271.15 272z">
                                </path>
                            </svg><!-- <i class="fas fa-font"></i> --> Landing Page Title</h3>
                        <p>The big text on the landing page. Put a short message here, maybe a greeting or simply just
                            your name, whatever you feel like.</p>
                    </td>
                    <td></td>
                    <td><input class="form-control" type="text" name="landing_page_title" minlength="3" maxlength="35"
                            value="{{ $pref->landing_page_title ?? "Pref not initialised" }}"></td>
                </tr>

                <tr>
                    <td> <br> </td>
                </tr>

                <tr class="form-group">
                    <td>
                        <h3 class="sub-header"><svg class="svg-inline--fa fa-quote-left fa-w-16" aria-hidden="true"
                                focusable="false" data-prefix="fas" data-icon="quote-left" role="img"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                <path fill="currentColor"
                                    d="M464 256h-80v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8c-88.4 0-160 71.6-160 160v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48zm-288 0H96v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8C71.6 32 0 103.6 0 192v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48z">
                                </path>
                            </svg><!-- <i class="fas fa-quote-left"></i> --> Landing Page Text</h3>
                        <p>Some text to go underneath the landing page title. Explain in a sentence or two what your
                            blog is about.</p>
                    </td>
                    <td></td>
                    <td><textarea class="form-control" type="text" maxlength="350"
                            name="landing_page_text">{{ $pref->landing_page_text ?? "Pref not initialised" }}</textarea>
                    </td>
                </tr>

                <tr class="form-group">
                    <td>
                        <h3 class="sub-header"><svg class="svg-inline--fa fa-paragraph fa-w-14" aria-hidden="true"
                                focusable="false" data-prefix="fas" data-icon="paragraph" role="img"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                <path fill="currentColor"
                                    d="M448 48v32a16 16 0 0 1-16 16h-48v368a16 16 0 0 1-16 16h-32a16 16 0 0 1-16-16V96h-32v368a16 16 0 0 1-16 16h-32a16 16 0 0 1-16-16V352h-32a160 160 0 0 1 0-320h240a16 16 0 0 1 16 16z">
                                </path>
                            </svg><!-- <i class="fas fa-paragraph"></i> --> About Me Text</h3>
                        <p>Enter in a longer description about you or your blog. Should be about a paragraph or two long
                            ideally, with a maximum of 2000 characters.</p>
                    </td>
                    <td></td>
                    <td><textarea class="form-control" type="text" minlength="50" maxlength="2000"
                            name="about_section">{{ $pref->about_section ?? "Pref not initialised" }}</textarea>
                    </td>
                </tr>


                <tr>
                    <td>
                        <div class="form-group">
                            <button class="btn" name="submit" type="submit">Update</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <br>
    </form>
    <br><br>
</div>

@endsection
