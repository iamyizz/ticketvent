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
        .mb-3 input {
            background-color: #2a2a2a;
        }
        .mb-3 input:focus {
            background-color: #2a2a2a;
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
                                <button type="button" class="btn btn-outline-primary m-2" data-bs-toggle="modal" data-bs-target="#addTicketModal">
                                    Tambah Ticket
                                </button>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama Ticket</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col">Kuantitas</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($dt) > 0)
                                            @foreach ($dt as $p)
                                                @if($p->event)
                                                    <tr>
                                                        <th scope="row">{{ $loop->iteration }}</th>
                                                        <td>{{ $p->event->name }}</td>
                                                        <td>{{ $p->type }}</td>
                                                        <td>{{ 'Rp' . number_format($p->price, 0, ',', '.') }}</td>
                                                        <td>{{ $p->quantity }}</td>
                                                        <td>
                                                            <button type="button" class="btn btn-outline-warning m-2 btn-edit" data-id="{{ $p->id }}" data-event="{{ $p->event->id }}" data-type="{{ $p->type }}" data-price="{{ $p->price }}" data-quantity="{{ $p->quantity }}" data-bs-toggle="modal" data-bs-target="#editTicketModal">Edit</button>
                                                            <a onclick="confirmation(event)" href="{{ url('delete_ticket', $p->id) }}">
                                                                <button type="button" class="btn btn-outline-danger m-2">Hapus</button>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6" class="text-center">No tickets available</td>
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

            <!-- Add Modal Start -->
            <div class="modal fade" id="addTicketModal" tabindex="-1" aria-labelledby="addTicketModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content bg-dark text-light">
                        <form action="{{ url('add_ticket') }}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="addTicketModalLabel">Tambah Ticket</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="event_id" class="form-label">Event</label>
                                    <select class="form-select" id="event_id" name="event_id" required>
                                        @foreach ($events as $event)
                                            <option value="{{ $event->id }}">{{ $event->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="type" class="form-label">Type</label>
                                    <select class="form-select" name="type" id="type" required>
                                        <option value="Reguler">Reguler</option>
                                        <option value="VIP">VIP</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="price" class="form-label">Harga</label>
                                    <input type="text" class="form-control" id="price" name="price" required>
                                </div>
                                <div class="mb-3">
                                    <label for="quantity" class="form-label">Kuantitas</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Add Modal End -->

            <!-- Edit Modal Start -->
<div class="modal fade" id="editTicketModal" tabindex="-1" aria-labelledby="editTicketModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-light">
            <form id="editTicketForm" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="editTicketModalLabel">Edit Ticket</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_event_id" class="form-label">Event</label>
                        <select class="form-select" id="edit_event_id" name="event_id" required>
                            @foreach ($events as $event)
                                <option value="{{ $event->id }}">{{ $event->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_type" class="form-label">Type</label>
                        <select class="form-select" name="type" id="edit_type" required>
                            <option value="Reguler">Reguler</option>
                            <option value="VIP">VIP</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_price" class="form-label">Harga</label>
                        <input type="text" class="form-control" id="edit_price" name="price" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_quantity" class="form-label">Kuantitas</label>
                        <input type="number" class="form-control" id="edit_quantity" name="quantity" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Edit Modal End -->




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
        // Event listener untuk tombol edit
        document.querySelectorAll('.btn-edit').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const eventId = this.getAttribute('data-event');
                const type = this.getAttribute('data-type');
                const price = this.getAttribute('data-price');
                const quantity = this.getAttribute('data-quantity');

                // Set action form
                const form = document.getElementById('editTicketForm');
                form.action = `{{ url('edit_ticket') }}/${id}`;

                // Set nilai input
                document.getElementById('edit_event_id').value = eventId;
                document.getElementById('edit_type').value = type;
                document.getElementById('edit_price').value = price;
                document.getElementById('edit_quantity').value = quantity;
            });
        });

        // JavaScript untuk memformat input harga
        document.querySelectorAll('input[name="price"]').forEach(input => {
            input.addEventListener('input', function (e) {
                let value = e.target.value;
                value = value.replace(/[^,\d]/g, '').toString();
                let split = value.split(',');
                let sisa = split[0].length % 3;
                let rupiah = split[0].substr(0, sisa);
                let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                if (ribuan) {
                    let separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
                e.target.value = rupiah ? 'Rp' + rupiah : '';
            });
        });
    });
    </script>    
</body>

</html>
