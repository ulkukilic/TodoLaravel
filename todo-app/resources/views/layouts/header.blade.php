@auth 
<!--kullanici oturum acilmisa devam eder -->
<li class="nav-item"><a class="nav-ling" href="{{route('dash.customer')}}"> Customer </a> </li>   <!-- customer paneline yonlendiren link -->
<li class="nav-item"><a class="nav-ling" href="{{route('dash.admin')}}"> Admin </a> </li>   <!-- customer paneline yonlendiren link -->
<li class="nav-item">
<form method="POST" action="{{ route('logout') }}">
 @csrf <!-- formun gerçekten sizin uygulamanızdan gönderildiğini doğrular -->
<button class="btn btn-link nav-link">Logout</button>
</form>
</li>
      @else  <!-- Eğer kullanıcı oturum açmamışsa bu kısmı göster -->
        <li class="nav-item"><a class="nav-link" href="{{ route('login.form') }}">Login</a></li><!-- kayit veya giris kismina  yonlendirme yapan baslik kisimlari -->
        <li class="nav-item"><a class="nav-link" href="{{ route('register.form') }}">Register</a></li>
      @endauth
