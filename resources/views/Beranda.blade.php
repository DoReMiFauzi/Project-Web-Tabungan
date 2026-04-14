<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/beranda.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/hand-holding-usd.png') }}" type="image/x-icon">
    <title>Beranda</title>
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
        <li class="active"><a href="{{ route('Tabungan.index') }}">Dashboard</a></li>
        <li><a href="{{ route('Tabungan.create') }}">Tabung Uang</a></li>
        <li><a href="{{ route('Tabungan.viewTarik') }}">Tarik Uang</a></li>
        <li><a href="{{ route('Tabungan.viewRiwayat') }}">Data Riwayat</a></li>
      </ul>
    </div>

    <div class="main-content">
      <div class="hero">
        <div class="hero-content">
          <div class="hero-text">
            <h1>Dashboard Overview</h1>
            <p>
              Selamat datang kembali. Berikut ringkasan data terbaru hari ini.
            </p>

            <div class="hero-buttons">
              <a href="{{ route('Tabungan.create') }}">
                <button class="btn-primary">Tambah Data</button>
              </a>
              <a href="{{ route('Tabungan.viewRiwayat') }}">
              <button class="btn-secondary">Lihat Laporan</button>
              </a>
            </div>
          </div>

          <div class="hero-stats">
            <div class="stats-card">
              <span>Total Uang Tabungan</span>
              <h2>Rp {{ number_format($totalTabungan, 0, ',', '.') }}</h2>
            </div>
          </div>
        </div>
      </div>

            <!-- Card -->
      <div class="card-container">
        <div class="card">
          <div class="card-icon">
            <svg
              width="30"
              height="30"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              viewBox="0 0 24 24"
            >
              <circle cx="12" cy="12" r="9"></circle>
              <path d="M15 9a3 3 0 0 0-6 0c0 3 6 3 6 6a3 3 0 0 1-6 0"></path>
            </svg>
          </div>
          <div class="card-info">
            <h3>Uang Ditabung Hari Ini</h3>
            <h5>Total : Rp {{ number_format($totalTabung, 0, ',', '.') }}</h5>
          </div>
        </div>
        <div class="card card-pinjam">
          <div class="card-icon" style="color: #ef4444">
            <svg
              width="30"
              height="30"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              viewBox="0 0 24 24"
            >
              <circle cx="12" cy="12" r="9"></circle>
              <path d="M15 9a3 3 0 0 0-6 0c0 3 6 3 6 6a3 3 0 0 1-6 0"></path>
            </svg>
          </div>
          <div class="card-info">
            <h3>Uang Ditarik Hari Ini</h3>
            <h5>Total : Rp {{ number_format($totalTarik, 0, ',', '.') }}</h5>
          </div>
        </div>
      </div>

        <div class="table-container">
        <h2>Histori 7 Hari Terakhir</h2>

        <div class="table-wrapper">
          <table class="history-table">
            <thead>
              <tr>
                <th>No</th>
                <th>Nominal</th>
                <th>Tanggal</th>
                <th>Jenis</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @if ($historyTabungan7Hari->isEmpty())
                <td colspan="7" style="color: grey">Maaf Data 7 Hari Terakhir Belum Ada</td>
              @endif
              @foreach ($historyTabungan7Hari as $item)
              <tr>
                @if ($item->tipe == 'Tarik')
                <td>{{ $loop->iteration }}</td>
                <td style="color: red">Rp {{number_format($item->nominal, 0 , ',', '.') }}</td>
                <td style="color: red">{{ $item->tanggal }}</td>
                <td style="color: red">{{ $item->tipe }}</td>
                @else
                <td>{{ $loop->iteration }}</td>
                <td style="color: #3B82F6">Rp {{number_format($item->nominal, 0 , ',', '.') }}</td>
                <td style="color: #3B82F6">{{ $item->tanggal }}</td>
                <td style="color: #3B82F6">{{ $item->tipe }}</td>           
                @endif
                <td>
                  <form action="{{ route('Tabungan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus data ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 6h18"></path>
                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                    <line x1="10" y1="11" x2="10" y2="17"></line>
                    <line x1="14" y1="11" x2="14" y2="17"></line>
                    </svg>
                  </button>
                  </form>
                </td>
              </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
</body>
</html>