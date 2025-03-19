@extends('frontEnd.layouts.app')

@section('contents')

    <div class="container">
        <section class="p-0">
            {{--menu section--}}
            @include('frontEnd.partials.header')
        </section>
        <!--  feature free downloadable -->
        <section class="header_bg mt-4">
            @include('frontEnd.sections.section_one')
        </section>

        {{--About us section--}}
        <section>
            @include('frontEnd.sections.section_two')
        </section>
    </div>
    <!-- Explore Our Most Read Blog Posts section Start -->
    <section style="background-color: #F7F5FF; padding-bottom: 50px; padding-top: 0px">
        <div class="container">
            @include('frontEnd.sections.section_three')
        </div>
    </section>
    <!-- OUR AUTHOR -->
    @include('frontEnd.sections.section_four')
    {{--Blogs--}}
    <section>
        @include('frontEnd.sections.section_five')
    </section>

    <!-- new Book  -->
    <div class="container-full bg_color_new_book">
        @include('frontEnd.sections.section_six')
    </div>

    <!-- Get Organized & Inspired: Your Guide to Planners & Calendars -->
    <section style="padding-bottom: 0; padding-top: 50px">
        @include('frontEnd.sections.section_seven')
    </section>

    <!-- Generate Fun with Our Interactive Puzzle Tools! -->
    <section>
        @include('frontEnd.sections.section_eight')
    </section>

@endsection




