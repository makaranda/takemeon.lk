@if ($jobs->count() > 0)
    @foreach($jobs as $job)
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
            <div class="properties pb-30">
                <div class="properties-card">
                    <div class="properties-img">

                        <a href="{{ route('frontend.job.view', $job->slug) }}">
                            <img 
                                src="{{ asset('public/assets/frontend/candidates/' . ($job->detail?->profile_img ?? 'user_profile.png')) }}" 
                                alt="{{ $job->name }}"
                            />
                        </a>

                        <div class="socal_icon">
                            <a href="#" data-id="{{ $job->id }}" class="add_cart">
                                <i class="ti-shopping-cart"></i>
                            </a>

                            <a href="#" data-id="{{ $job->id }}" class="view_product">
                                <i class="ti-zoom-in"></i>
                            </a>
                        </div>

                    </div>

                    <div class="properties-caption properties-caption2">

                        <h3>
                            <a href="{{ route('frontend.job.view', $job->slug) }}">
                                {{ $job->name }}
                            </a>
                        </h3>

                        <div class="properties-footer">
                            <div class="price">

                                @php
                                    $salary = $job->expectingArea?->expected_salary;
                                @endphp

                                @if ($salary && $salary > 0)
                                    <span class="discounted-price">
                                        Rs {{ number_format($salary) }}
                                    </span>
                                @else
                                    <span class="text-muted">
                                        Salary Negotiable
                                    </span>
                                @endif

                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="col-12">
        <div class="alert alert-warning text-center">
            <strong>No candidates found!</strong>
        </div>
    </div>
@endif