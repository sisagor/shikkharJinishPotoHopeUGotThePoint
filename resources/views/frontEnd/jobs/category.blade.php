

<div class="col-md-4 col-sm-4 col-12">
    <div class="x_content">
        <div class="bs-example" data-example-id="simple-jumbotron">
            <div class="jumbotron">
                @foreach(get_job_categories() as $cat)
                    <h2>{{$cat->name}}</h2>
                    <ul>
                        @foreach($cat->jobs as $job)
                             <li> <a href="{{route('job.show', $job->id)}}"> {{$job->position}} </a></li>
                        @endforeach
                   </ul>
                @endforeach
            </div>
        </div>
    </div>

</div>
