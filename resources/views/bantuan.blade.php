<!DOCTYPE html>
<html>
<head>
    <title>Data Bantuan Sosial</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800">

    <div class="max-w-4xl mx-auto mt-10 bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-4">{{ $bantuan['nama_program'] }}</h1>
        <p class="mb-2"><strong>Deskripsi:</strong> {{ $bantuan['deskripsi'] }}</p>
        <p class="mb-6"><strong>Periode:</strong> {{ $bantuan['periode'] }}</p>

        <h2 class="text-xl font-semibold mb-3">Daftar Penerima Manfaat</h2>
        <table class="w-full border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="py-2 px-4 border">No</th>
                    <th class="py-2 px-4 border">Nama</th>
                    <th class="py-2 px-4 border">Alamat</th>
                    <th class="py-2 px-4 border">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($penerima as $index => $item)
                <tr class="{{ $loop->even ? 'bg-gray-50' : '' }}">
                    <td class="py-2 px-4 border text-center">{{ $index + 1 }}</td>
                    <td class="py-2 px-4 border">{{ $item['nama'] }}</td>
                    <td class="py-2 px-4 border">{{ $item['alamat'] }}</td>
                    <td class="py-2 px-4 border text-center">
                        @if($item['status'] == 'Aktif')
                            <span class="text-green-600 font-semibold">{{ $item['status'] }}</span>
                        @else
                            <span class="text-red-600 font-semibold">{{ $item['status'] }}</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>
