@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Contacts</h1>
        <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addContactModal">
            Add Contact
        </button>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $contact)
                        <tr>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->phone_number }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>
                                <!-- View Button triggering Modal -->
                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewContactModal{{ $contact->id }}">
                                    View
                                </button>

                                <!-- Edit Button triggering Modal -->
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editContactModal{{ $contact->id }}">
                                    Edit
                                </button>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editContactModal{{ $contact->id }}" tabindex="-1" aria-labelledby="editContactModalLabel{{ $contact->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('contacts.update', $contact->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')

                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editContactModalLabel{{ $contact->id }}">Edit Contact</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="name{{ $contact->id }}" class="form-label">Name:</label>
                                                        <input type="text" class="form-control" name="name" id="name{{ $contact->id }}" value="{{ $contact->name }}" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="phone_number{{ $contact->id }}" class="form-label">Phone Number:</label>
                                                        <input type="text" class="form-control" name="phone_number" id="phone_number{{ $contact->id }}" value="{{ $contact->phone_number }}" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email{{ $contact->id }}" class="form-label">Email:</label>
                                                        <input type="email" class="form-control" name="email" id="email{{ $contact->id }}" value="{{ $contact->email }}">
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- View Modal -->
                                <div class="modal fade" id="viewContactModal{{ $contact->id }}" tabindex="-1" aria-labelledby="viewContactModalLabel{{ $contact->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="viewContactModalLabel{{ $contact->id }}">View Contact</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                <p><strong>Name:</strong> {{ $contact->name }}</p>
                                                <p><strong>Phone Number:</strong> {{ $contact->phone_number }}</p>
                                                <p><strong>Email:</strong> {{ $contact->email }}</p>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Button -->
                                <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirmDelete()">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this contact?');
        }
    </script>

    <!-- Add Contact Modal -->
    <div class="modal fade" id="addContactModal" tabindex="-1" aria-labelledby="addContactModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('contacts.store') }}" method="POST">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title" id="addContactModalLabel">Add Contact</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Phone Number:</label>
                            <input type="text" class="form-control" name="phone_number" id="phone_number" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" name="email" id="email">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add Contact</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this contact?');
        }
    </script>
@endsection
