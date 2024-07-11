@extends('frontEnd.layouts.app')

@section('contents')

    <div class="container">
        <section>
            {{--menu section--}}
            @include('frontEnd.partials.header')
        </section>
        <!--  feature free downloadable -->
        <section class="header_bg">
            @include('frontEnd.sections.section_one')
        </section>

        {{--About us section--}}
        <section>
            @include('frontEnd.sections.section_two')
        </section>

        <!-- Explore Our Most Read Blog Posts section Start -->
        <section>
            @include('frontEnd.sections.section_three')
        </section>

        <!-- OUR AUTHOR -->
        @include('frontEnd.sections.section_four')

    </div>

    {{--Blogs--}}
    <section>
        @include('frontEnd.sections.section_five')
    </section>

    <!-- new Book  -->
    <div class="container-full bg_color_new_book">
        @include('frontEnd.sections.section_six')
    </div>

    <!-- Get Organized & Inspired: Your Guide to Planners & Calendars -->
    <section>
        @include('frontEnd.sections.section_seven')
    </section>

    <!-- Generate Fun with Our Interactive Puzzle Tools! -->
    <section>
        @include('frontEnd.sections.section_eight')
    </section>

@endsection




