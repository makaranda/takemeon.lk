@if ($jobs->count() > 0)
    @foreach($jobs as $job)
        <div class="single-job-items mb-30">
            <div class="job-items">
                <div class="company-img">
                    <a href="{{ route('frontend.job.view', $job->slug) }}">
                        <img 
                            src="{{ asset('public/assets/frontend/candidates/' . ($job->detail?->profile_img ?? 'user_profile.png')) }}" 
                            alt="{{ $job->name }}"
                        >
                    </a>
                </div>
                <div class="job-tittle job-tittle2">
                    <a href="{{ route('frontend.job.view', $job->slug) }}">
                        <h4>{{ $job->name }}</h4>
                    </a>
                    <ul>
                        <li>
                            {{ $job->latestPastEmployment?->company_name ?? 'Company Not Available' }}
                        </li>
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            {{ $job->detail?->city?->name ?? 'Sri Lanka' }}
                        </li>
                        <li>
                            @php
                                $salary = $job->expectingArea?->expected_salary;
                            @endphp
                            @if ($salary && $salary > 0)
                                Rs {{ number_format($salary) }}
                            @else
                                Salary Negotiable
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
            <div class="items-link items-link2 f-right">
                <a href="{{ route('frontend.job.view', $job->slug) }}">
                    {{ $job->expectingArea?->job_type ?? 'Full Time' }}
                </a>
                <span>
                    {{ $job->created_at->diffForHumans() }}
                </span>
            </div>
        </div>
    @endforeach
@else
    <div class="w-100 alert alert-warning text-center">
        <strong>No candidates found!</strong>
    </div>
@endif