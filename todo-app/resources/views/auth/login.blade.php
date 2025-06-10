@section('content') <!-- ana icerik govdesinde html/blade kodunu enjekte eder . Login formu , buttonlar vs bu blokta yer alir  -->
 <!-- eger basarili bir sekilde regoster yapilip donduryse kayit basarili mesajini alir -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul> 
            @foreach ($errors->all() as $msg)
            <li> {{$msg}} </li> <!--  li methodu ile hatalari $msg degiskeni icerisinde hatalari liste halinde gosterir-->
            @endforeach
         </ul>
    </div>
    @endif

    <form method="POST" action="{{route('login.submit')}}">
     <!-- Post ile  gonderilen degerler login.submit kismina gonderilir -->
      @csrf 
     <!-- email - password - full_name girisleri yapilip submit edilir -->
      <div class="form-group">
            <label for="email">Email</label>
            <input
                type="email"
                id="email"
                name="email"
                class="form-control"
                value="{{ old('email') }}"
                required
            > 
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                class="form-control"
                required
            >
        </div>

        <button type="submit" class="btn btn-primary">Login</button>
    </form>
    <p class="form-group">
        Don’t have an account?
        <a href="{{ route('register.form') }}">Register here</a>
    </p> 
@endsection
