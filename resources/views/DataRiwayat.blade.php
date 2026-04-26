<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dataRiwayat.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/hand-holding-usd.png') }}" type="image/x-icon">
    <title>Data Riwayat</title>
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
        <li><a href="{{ route('Tabungan.create') }}">Tabung Uang</a></li>
        <li><a href="{{ route('Tabungan.viewTarik') }}">Tarik Uang</a></li>
        <li  class="active"><a href="{{ route('Tabungan.viewRiwayat') }}">Data Riwayat</a></li>
      </ul>
    </div>

    <div class="main-content">
    <div class="header">
        <h2>Data Riwayat</h2>
      <div class="export">
        <h3>Export Data</h3>
        <a href="{{ route('Export.export') }}">
          <button type="submit" class="btn btn-secondary">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
              <polyline points="7 10 12 15 17 10"></polyline>
              <line x1="12" y1="15" x2="12" y2="3"></line>
            </svg>
          </button>
        </a>
      </div>
    </div>

    <div class="summary">
        <div class="summary-card">
            <p>Total Uang Tabungan</p>
            <h2 style="color:  #3B82F6">{{ number_format($totalTabungan, 0 , ',', '.') }}</h2>
        </div>
    </div>

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
              @if ($historyTabungan->isEmpty())
                <td colspan="7" style="color: grey">Maaf Data Belum Ada</td>
              @endif
              @foreach ($historyTabungan as $item)
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
                  <form action="{{ route('Tabungan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin akan menghapus data ini?')">
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