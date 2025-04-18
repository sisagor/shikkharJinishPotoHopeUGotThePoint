@extends('frontEnd.layouts.app')

@section('contents')

    <section class="p-0">
        @include('frontEnd.partials.header')
    </section>

    <div class="container">
        <section class="p-0">
            <div class="breadcrumb_design">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb_item"><a href="/">Home</a></li>
                        <li class="breadcrumb_item active" aria-current="page">Contact US</li>
                    </ol>
                </nav>
            </div>
        </section>
    </div>

    <div class="container">
        <div class="contact-container">
            <div class="contact-card my-2">
                <div class="icon-container">
                    <img src="{{asset('frontEnd/img/Icon-call.png')}}" alt="Phone Icon">
                </div>
                <h3>Call us At</h3>
                <p>{{$contact['system_phone']}}</p>
            </div>
            <div class="contact-card my-2">
                <div class="icon-container">
                    <img src="{{asset('frontEnd/img/Icon-mail.png')}}" alt="Mail Icon">
                </div>
                <h3>Email us At</h3>
                <p>{{$contact['system_email']}}</p>
            </div>
            <div class="contact-card my-2">
                <div class="icon-container">
                    <img src="{{asset('frontEnd/img/location-03.png')}}" alt="Location Icon" style="width: 24px; height:24px">
                </div>
                <h3>Our Location</h3>
                <p>{{$contact['system_address']}}</p>
            </div>
        </div>
        <div class="map-container">
            <iframe 
{{--                src="{{$contact['system_google_map']}}"--}}
                src="https://www.google.com/maps/embed?pb=!1m18!1m12... (long string)"
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
        <div class="contact-section">
            <div class="contact-form">
                <div class="form-header">
                    <span class="question-tag">HAVE ANY QUESTIONS</span>
                    <h2>Feel Free To Contact!</h2>
                </div>

                <form action="/contact-store" method="post" class="comment-form">
                    @csrf
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" placeholder="Your name" required>

                    <div class="email-phone">
                        <div class="input-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="Your email" required>
                        </div>
                        <div class="input-group">
                            <label for="phone">Phone</label>
                            <div class="phone-input">
                                <div class="country-code">
                                    <img src="{{asset('frontEnd/img/BD-Flag-icon.png')}}" alt="Bangladesh Flag">
                                    <select name="country_code">
                                        <option value="+880">+880</option>
                                        <!-- Add more country codes -->
                                    </select>
                                </div>
                                <input type="text" id="phone" name="phone" value="1756888319">
                            </div>
                        </div>
                    </div>
                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="4" placeholder="Write your message" required></textarea>

                    <button type="submit">Send Message</button>
                </form>
            </div>

            <div class="contact-illustration">
                <img src="{{asset('frontEnd/img/Contact 1.png')}}" alt="Contact Illustration">
            </div>
        </div>
    </div>

    <style>
        /* General Reset & Container */
        .container {
            max-width: 1200px;
            margin: auto;
            padding: 15px;
        }

        /* Contact Info Cards */
        .contact-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            padding: 50px 0;
        }
        .contact-card {
            background-color: #F7F5FF;
            border-radius: 20px;
            padding: 20px;
            text-align: center;
            flex: 1 1 300px;
            max-width: 350px;
            position: relative;
        }
        .icon-container {
            width: 50px;
            height: 50px;
            background-color: #5b4af2;
            border-radius: 50%;
            padding: 15px;
            margin: 0 auto;
            position: absolute;
            top: -30px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .icon-container img {
            width: 40px;
            height: 40px;
        }
        .contact-card h3 {
            font-size: 1.3em;
            color: #333;
            margin-top: 50px;
        }
        .contact-card p {
            font-size: 1.1em;
            color: #666;
            margin-top: 10px;
        }

        /* Map */
        .map-container {
            margin: 20px 0;
            height: 450px;
            border: 2px solid #d8e1f0;
            border-radius: 10px;
            overflow: hidden;
        }
        .map-container iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        /* Contact Section */
        .contact-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
            padding: 30px;
            border-radius: 20px;
            flex-wrap: wrap;
            gap: 20px;
        }
        .contact-form,
        .contact-illustration {
            flex: 1 1 45%;
            min-width: 300px;
        }
        .contact-form {
            background-color: #F7F5FF;
            padding: 20px;
            border-radius: 20px;
        }
        .form-header {
            margin-bottom: 20px;
        }
        .question-tag {
            background-color: #eef2ff;
            color: #5b4af2;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.9em;
            font-weight: bold;
        }
        h2 {
            margin-top: 10px;
            color: #2d2d2d;
            font-size: 1.5em;
        }
        label {
            display: block;
            margin-top: 10px;
            color: #2d2d2d;
            font-weight: bold;
        }
        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #d8e1f0;
            border-radius: 20px;
            font-size: 1em;
            color: #333;
            background-color: #fff;
        }
        textarea {
            resize: none;
        }
        .email-phone {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .input-group {
            flex: 1;
        }
        .phone-input {
            display: flex;
            align-items: center;
            border: 1px solid #d8e1f0;
            border-radius: 20px;
            background-color: #fff;
        }
        .country-code {
            display: flex;
            align-items: center;
            padding: 10px;
            background-color: #f7f6fe;
            border-right: 1px solid #d8e1f0;
            border-radius: 20px 0 0 20px;
        }
        .country-code img {
            width: 22px;
            height: auto;
            margin-right: 10px;
        }
        .country-code select {
            border: none;
            background-color: transparent;
            font-size: 1em;
            outline: none;
            color: #333;
            appearance: none;
            cursor: pointer;
        }
        .phone-input input[type="text"] {
            border: none;
            border-radius: 0 20px 20px 0;
            padding: 10px;
            width: 100%;
            outline: none;
        }
        .contact-form button {
            width: 100%;
            padding: 15px;
            background-color: #ff0077;
            color: #fff;
            border: none;
            border-radius: 20px;
            margin-top: 20px;
            font-size: 1.2em;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .contact-form button:hover {
            background-color: #ec0470;
        }

        /* Illustration */
        .contact-illustration {
            text-align: center;
        }
        .contact-illustration img {
            width: 100%;
            max-width: 400px;
            border-radius: 20px;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .contact-section {
                flex-direction: column;
            }
        }
        @media (max-width: 576px) {
            .email-phone {
                flex-direction: column;
            }

            .icon-container {
                width: 45px;
                height: 45px;
            }

            .icon-container img {
                width: 30px;
                height: 30px;
            }

            .contact-card h3 {
                font-size: 1.1em;
                margin-top: 40px;
            }

            .contact-card p {
                font-size: 1em;
            }
        }
    </style>

@endsection
