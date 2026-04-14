<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/tabung.css">
    <link rel="shortcut icon" href="{{ asset('images/hand-holding-usd.png') }}" type="image/x-icon">
    <title>Tabung</title>
</head>
<body>
<!-- SideBar -->
    <div class="sidebar">
      <div class="logo">
        <div class="logo-icon">
          <svg
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
          >
            <circle cx="12" cy="12" r="9"></circle>
            <path d="M15 9a3 3 0 0 0-6 0c0 3 6 3 6 6a3 3 0 0 1-6 0"></path>
          </svg>
        </div>
        <span>MyDana</span>
      </div>
      <ul class="menu">
        <li><a href="{{ route('Tabungan.index') }}">Dashboard</a></li>
        <li class="active"><a href="{{ route('Tabungan.create') }}">Tabung Uang</a></li>
        <li><a href="{{ route('Tabungan.viewTarik') }}">Tarik Uang</a></li>
        <li><a href="{{ route('Tabungan.viewRiwayat') }}">Data Riwayat</a></li>
      </ul>
    </div>

    <div class="main-content">
        <div class="hero">
            <div class="hero-content">
              <div class="hero-text">
                <div class="stats-card">
                  <span>Total Uang Tabungan</span>
                  <h2>Rp {{ number_format($totalTabungan, 0, ',', '.') }}</h2>
                </div>
          </div>
        
        <div class="form-card">
            <h2>Tambah Data</h2>
            @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                        <li style="color: red">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            @if(session('succsess'))
              <div class="alert alert-succsess" style="color: green; margin-bottom: 20px;">
                 {{ session('succsess') }}
              </div>
            @endif

        <form action="{{ route('Tabungan.store') }}" method="post" autocomplete="off">
            @csrf
        <div class="form-group">
            <label>Nominal</label>
            <input type="number" name="nominal" placeholder="Masukkan nominal">
        </div>

        <div class="form-group">
            <label>Tanggal</label>
            <input type="date" name="tanggal" required>
        </div>

        <button type="submit" class="btn-primary">Tabung</button>
        </form>
    </div>
</div>

</body>
</html>