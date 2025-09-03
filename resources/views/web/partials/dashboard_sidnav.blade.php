
@php
    $lang = Session::get('lang');
@endphp

<div class="float-left d-mobile-close d-mobile-toggle">
    <i class="bi bi-x-circle"></i>
</div>
<ul class="sm-ul">
    <li>
        <a href="{{ route('user.home') }}" class="{{ menuActive('user.home') }}">
            <i class="bi bi-speedometer2 me-1"></i>
            @lang('Dashboard')
        </a>
    </li>
    <li>
        <a href="{{ route('user.favorite.index') }}" class="{{ menuActive('user.favorite.index') }}">
            <i class="bi bi-heart me-1"></i>
            @lang('Favorite')
        </a>
    </li>
    <li>
        <a href="{{ route('user.profile.setting') }}" class="{{ menuActive('user.profile.setting') }}">
            <i class="fa-regular fa-user me-1"></i>
            @lang('Profile Settings')
        </a>
    </li>
    <li>
        <a href="{{ route('support.index') }}" class="{{ menuActive('support.index') }}">
            <i class="bi bi-envelope me-1"></i>
            @lang('Support')
        </a>
    </li>
    <li>
        <a href="{{ route('user.change.password') }}" class="{{ menuActive('user.change.password') }}">
            <i class="bi bi-lock me-1"></i>
            @lang('Change Password')
        </a>
    </li>
    <li>
        <a href="{{ route('user.logout') }}">
            <i class="bi bi-box-arrow-right me-1"></i>
            @lang('Logout')
        </a>
    </li>
</ul>
