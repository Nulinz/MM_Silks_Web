<img src="{{ asset('assets/images/avatar.png') }}" height="40px" class="userimg rounded-5" alt="">
<h6 class="px-3 py-1 m-0 rounded-1 userdiv">
    <span class="username">{{ Auth::guard('web')->user()->name }}</span><br>
    <span class="userrole">Admin</span>
</h6>