@extends('layouts.customer')

@section('content')
    <h1 class="text-center mb-5">Beli Barang</h1>

    {{-- list keranjang --}}
    <section>
        <h2 class="text-center">My Cart</h2>
        <div class="table-responsive">
            <table class="table" id="keranjang">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Nomor</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Total</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr id="placeholder">
                        <td colspan="6" class="text-center">List keranjang masih kosong</td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- button beli --}}
        <div class="d-flex justify-content-center">
            <button class="btn btn-primary" onclick="beliBarang()">Beli</button>
        </div>
    </section>


    {{-- list beli barang --}}
    <section>
        <h2 class="text-center">You Might Interest...</h2>

        {{-- search --}}
        <form action="{{ route('customer.beli.index') }}" method="GET" class="mb-5">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search..." name="search"
                    value="{{ request('search') }}">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </form>

        <div class="row justify-content-center g-3">
            @foreach ($barang as $item)
                <div class="col-10 col-sm-6 col-md-4">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title text-center">{{ $item->nama }}</h5>
                            <p class="card-text">
                                Harga : Rp {{ number_format($item->harga, 0, ',', '.') }}<br>
                                Stock : {{ $item->stock }}
                            </p>
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-outline-primary rounded-5" data-bs-toggle="modal"
                                    data-bs-target="#modalBeli" data-nama="{{ $item->nama }}"
                                    data-harga="{{ $item->harga }}" data-stock="{{ $item->stock }}"
                                    data-id="{{ $item->id }}">
                                    <i class="bi bi-bag-plus-fill"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- pagination --}}
        <div class="d-flex justify-content-center mt-5">
            {{ $barang->links() }}
        </div>
    </section>
@endsection

@section('extras')
    {{-- modal beli --}}
    <div class="modal fade" id="modalBeli" tabindex="-1" data-id="0">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalBeli">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>
                        Nama Barang : <span id="nama"></span><br>
                        Harga : <span id="harga"></span><br>
                        Stock : <span id="stock"></span>
                    </p>

                    {{-- input number --}}
                    <div class="form-floating">
                        <input min="10" max="20" type="number" id="quantity" class="form-control" />
                        <label class="form-label" for="quantity">Quantity</label>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="addToCart()">Add To
                        Cart</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/beli.js') }}"></script>
    <script>
        function beliBarang() {
            // cek keranjang dari local storage
            let keranjang = JSON.parse(localStorage.getItem('cart'));
            console.log(keranjang);
            if (keranjang == null || keranjang.length == 0) {
                alert('Keranjang masih kosong');
                return;
            }
            else {
                // redirect ke halaman beli
                window.location.href = '{{ route('customer.beli.create') }}';
            }
        }
    </script>
@endsection