<x-layout>
    @include('partials._nav')
    <div class="bg-black bg-pattern-2 py-10">
        <div class="container">
            <div class="row justify-content-center align-items-center my-5">
                <div class="col-10">
                    <a href="/user/create" class="btn btn-primary mb-3">
                        Add new client
                    </a>
                    <div class="bg-white p-3 rounded">
                        <form>
                            <label for="search" class="form-label">Search</label>
                            <input class="form-control" type="text" name="search"
                                placeholder="Search by name or email...">
                            <button type="submit" class="btn btn-info mt-2">
                                Search clients
                            </button>
                        </form>
                        <table class="table table-sm table-striped mt-3">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Client</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="ps-3">
                                            <i class="fas fa-user"></i>
                                        </td>
                                        <td>
                                            <a href="/user/{{ $user->id }}">
                                                {{ $user->name }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="/user/{{ $user->id }}" class="btn btn-primary px-2 py-0">
                                                View profile
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
