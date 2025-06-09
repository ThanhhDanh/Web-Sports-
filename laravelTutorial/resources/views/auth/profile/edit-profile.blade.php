<div class="card">
    <div class="card-body card-edit">
        <form method="POST" action="{{ route('profile.update', $user->id) }}">

            @csrf
            @method('PUT')

            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="d-flex align-items-center justify-content-start mb-5">
                        <a href="{{ route('profile.index', $user->id) }}" class="btn-back me-5">
                            <svg height="40px" width="40px" version="1.1" id="Layer_1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                viewBox="0 0 512 512" xml:space="preserve" fill="#000000">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                </g>
                                <g id="SVGRepo_iconCarrier">
                                    <circle style="fill:#61ACD2;" cx="256" cy="256" r="243.81">
                                    </circle>
                                    <path style="fill:#EFEFEF;"
                                        d="M256,60.952c107.549,0,195.048,87.498,195.048,195.048S363.549,451.048,256,451.048 S60.952,363.549,60.952,256S148.451,60.952,256,60.952z">
                                    </path>
                                    <polygon style="fill:#F4A026;"
                                        points="138.299,256 248.686,349.87 241.371,291.352 374.248,291.352 374.248,218.21 241.371,218.21 248.686,162.13 ">
                                    </polygon>
                                    <path
                                        d="M256,0C114.842,0,0,114.842,0,256s114.842,256,256,256s256-114.842,256-256S397.158,0,256,0z M256,487.619 C128.284,487.619,24.381,383.716,24.381,256S128.284,24.381,256,24.381S487.619,128.284,487.619,256S383.716,487.619,256,487.619z">
                                    </path>
                                    <path
                                        d="M256,48.762C141.729,48.762,48.762,141.729,48.762,256S141.729,463.238,256,463.238S463.238,370.271,463.238,256 S370.271,48.762,256,48.762z M256,438.857c-100.827,0-182.857-82.03-182.857-182.857S155.173,73.143,256,73.143 S438.857,155.173,438.857,256S356.827,438.857,256,438.857z">
                                    </path>
                                    <path
                                        d="M374.248,206.019H255.255l5.519-42.313c0.652-4.998-1.838-9.88-6.266-12.288c-4.426-2.405-9.879-1.841-13.719,1.424 l-110.387,93.87c-2.723,2.316-4.293,5.711-4.293,9.287c0,3.575,1.57,6.971,4.293,9.287l110.387,93.87 c2.255,1.918,5.065,2.904,7.899,2.904c1.98,0,3.972-0.482,5.79-1.464c4.423-2.389,6.927-7.25,6.302-12.238l-5.6-44.815h119.067 c6.733,0,12.19-5.458,12.19-12.19V218.21C386.438,211.477,380.98,206.019,374.248,206.019z M362.057,279.162H241.371 c-3.496,0-6.825,1.501-9.139,4.123c-2.314,2.621-3.391,6.11-2.957,9.579l3.427,27.412L157.116,256l75.394-64.115l-3.227,24.747 c-0.453,3.479,0.613,6.984,2.927,9.621c2.315,2.636,5.654,4.147,9.161,4.147h120.686V279.162z">
                                    </path>
                                </g>
                            </svg>
                        </a>
                        <span class="welcome">Hi. <strong>{{ Auth::user()->name }}</strong></span>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group mb-4">
                        <label class="mb-2" for="lastName">Last Name</label>
                        <input name="last_name" value="{{ $user['last_name'] }}" type="text" class="form-control"
                            id="lastName" placeholder="Enter last name">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group mb-4">
                        <label class="mb-2" for="firstName">First Name</label>
                        <input name="name" value="{{ $user['name'] }}" type="text" class="form-control"
                            id="firstName" placeholder="Enter first name">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group mb-4">
                        <label class="mb-2" for="eMail">Email</label>
                        <input name="email" value="{{ $user['email'] }}" type="email" class="form-control"
                            id="eMail" placeholder="Enter email">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group mb-4">
                        <label class="mb-2" for="Street">Street</label>
                        <input value="{{ $user['address'] }}" type="name" class="form-control" id="Street"
                            placeholder="Enter Street">
                    </div>
                </div>
            </div>
            <div class="row gutters">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group mb-4">
                        <label class="mb-2" for="sTate">State</label>
                        <input type="text" class="form-control" id="sTate" placeholder="Enter State">
                    </div>
                </div>
            </div>
            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="text-end">
                        <button type="submit" class="btn btn-update">Update</button>
                        <button name="submit" class="btn btn-cancel">Cancel</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
