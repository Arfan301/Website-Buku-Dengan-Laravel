<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between">
            <h1>Book List</h1>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Search Bar -->
        <form class="d-flex my-2 my-lg-0 mb-4" action="{{ route('bukus.search') }}" method="GET">
            <input class="form-control me-2" type="search" name="query" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>

        <!-- Add New Book Section -->
        <div class="col-md-4 d-flex mb-4 mt-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Tambah Buku</h5>
                    <a href="{{ route('buku.create') }}" class="btn btn-primary" style="min-width: 100%">Add New Book</a>
                </div>
            </div>
        </div>

        <!-- Books Section -->
        @if($books->isEmpty())
            <p class="text-muted">No books found matching your search criteria.</p>
        @else
            <div class="row mt-4">
                @foreach($books as $book)
                    <div class="col-12 mb-3">
                        <div class="card shadow-sm">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <!-- Book Data -->
                                <div>
                                    <h5 class="mb-1">{{ $book->judul }}</h5>
                                    <p class="mb-0">Pengarang: {{ $book->pengarang }}</p>
                                    <p class="mb-0">Tahun: {{ $book->tahun }}</p>
                                </div>
                                <!-- Buttons -->
                                <div class="d-flex">
                                    <a href="{{ route('buku.edit', $book->id) }}" class="btn btn-warning me-2">Edit</a>
                                    <form action="{{ route('buku.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this book?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination Links -->
            <div class="d-flex justify-content-center mt-4">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <!-- Previous Page Link -->
                        @if($books->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">Previous</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $books->previousPageUrl() }}" aria-label="Previous">Previous</a>
                            </li>
                        @endif

                        <!-- Page Numbers -->
                        @foreach ($books->links()->elements[0] as $page => $url)
                            @if ($page == $books->currentPage())
                                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach

                        <!-- Next Page Link -->
                        @if($books->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $books->nextPageUrl() }}" aria-label="Next">Next</a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link">Next</span>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
