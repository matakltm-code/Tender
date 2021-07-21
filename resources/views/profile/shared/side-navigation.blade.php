<div class="list-group ">
    <a href="/profile"
        class="list-group-item list-group-item-action <?=(Route::current()->uri() == '/profile' ? 'active':'')?>">
        Profile
    </a>

    <a href="/profile/edit" class="list-group-item list-group-item-action">
        Edit Profile
    </a>

    @if (Auth::user()->is_counselor)
    <a href="/profile/edit/specialty" class="list-group-item list-group-item-action">
        Edit your counselling specialty
    </a>
    @endif

    <a href="/profile/change-password" class="list-group-item list-group-item-action">
        Change password
    </a>


</div>
