<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin1.template.head')
    <style>
        .custom-input {
            border: 2px solid #00f; /* Warna border */
            background-color: #333; /* Warna background */
            color: #fff; /* Warna teks */
        }

        .custom-input:focus {
            border-color: #f00; /* Warna border saat focus */
            background-color: #444; /* Warna background saat focus */
        }

        .form-control:read-only {
            background-color: #2a2a2a;
            color: #fff;
        }
        .mb-3 input {
            background-color: #2a2a2a;
            color: #fff;
        }
        .mb-3 input:focus {
            background-color: #2a2a2a;
            color: #fff;
        }
        .mb-3 select {
            background-color: #2a2a2a;
            color: #fff;
        }
        .mb-3 select:focus {
            background-color: #2a2a2a;
        }
    </style>
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        @include('admin1.template.spinner')
        <!-- Spinner End -->

        <!-- Sidebar Start -->
        @include('admin1.template.sidebar')
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            @include('admin1.template.navbar')
            <!-- Navbar End -->

            <!-- Table Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <button type="button" class="btn btn-outline-primary m-2" data-bs-toggle="modal" data-bs-target="#addOrderModal">
                                    Tambah Order
                                </button>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama Customer</th>
                                            <th scope="col">Event</th>
                                            <th scope="col">QTY</th>
                                            <th scope="col">Total Harga</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($dt) > 0)
                                            @foreach ($dt as $p)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ optional($p->user)->name }}</td>
                                                    <td>{{ optional(optional($p->ticket)->event)->name }}</td>
                                                    <td>{{ $p->quantity }}</td>
                                                    <td>{{ 'Rp' . number_format($p->total_harga, 0, ',', '.') }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-outline-warning m-2 btn-edit" data-id="{{ $p->id }}" data-event="{{ $p->ticket->event->id }}" data-type="{{ $p->type }}" data-price="{{ $p->price }}" data-quantity="{{ $p->quantity }}" data-bs-toggle="modal" data-bs-target="#editTicketModal">Edit</button>
                                                        <a onclick="confirmation(event)" href="{{ url('delete_ticket', $p->id) }}">
                                                            <button type="button" class="btn btn-outline-danger m-2">Hapus</button>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6" class="text-center">No Orders available</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table End -->

            <!-- Add Order Modal -->
            <div class="modal fade" id="addOrderModal" tabindex="-1" aria-labelledby="addOrderModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content bg-dark text-light">
                        <form id="addOrderForm" action="{{ url('add_order') }}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="addOrderModalLabel">Tambah Order</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="user" class="form-label">Nama Customer</label>
                                    <select class="form-select" id="user" name="user_id" required>
                                        @foreach($user as $u)
                                            <option value="{{ $u->id }}">{{ $u->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="ticket" class="form-label">Event</label>
                                    <select class="form-select" id="ticket" name="ticket_id" required>
                                        @foreach($ticket as $t)
                                            <option value="{{ $t->id }}" data-price="{{ $t->price }}">{{ $t->event->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="quantity" class="form-label">Quantity</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
                                </div>
                                <div class="mb-3">
                                    <label for="total_harga" class="form-label">Total Harga</label>
                                    <input type="text" class="form-control" id="total_harga" name="total_harga" readonly>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            

            <!-- Footer Start -->
            @include('admin1.template.footer')
            <!-- Footer End -->
        </div>
        <!-- Content End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    @include('admin1.template.script')
    <!-- Include Bootstrap JS and dependencies -->
    <script type="text/javascript">
        function confirmation(ev) {
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');
            console.log(urlToRedirect);
            swal({
                    title: "Apakah kamu yakin?",
                    text: "Menghapus ini akan permanen",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willCancel) => {
                    if (willCancel) {
                        window.location.href = urlToRedirect;
                    }
                });
        }

        document.addEventListener('DOMContentLoaded', function () {
            const ticketSelect = document.getElementById('ticket');
            const quantityInput = document.getElementById('quantity');
            const totalHargaInput = document.getElementById('total_harga');

            function updateTotalHarga() {
                const selectedTicket = ticketSelect.options[ticketSelect.selectedIndex];
                const price = parseFloat(selectedTicket.getAttribute('data-price')) || 0;
                const quantity = parseInt(quantityInput.value) || 0;
                const totalHarga = price * quantity;
                totalHargaInput.value = 'Rp' + totalHarga.toLocaleString('id-ID');
            }

            ticketSelect.addEventListener('change', updateTotalHarga);
            quantityInput.addEventListener('input', updateTotalHarga);
        });
    </script>    
</body>

</html>
