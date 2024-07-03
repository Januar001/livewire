@push('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

@endpush

<div>
    <div class="d-flex justify-content-center mt-5">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card">
                    @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Berhasil!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title text-center">User Form</h5>
                        <form wire:submit="submitForm">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" wire:model="name"
                                    placeholder="Enter your name">
                                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" wire:model="email"
                                    placeholder="Enter your email">
                                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" wire:model="password"
                                    placeholder="Enter your password">
                                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    wire:model="password_confirmation" placeholder="Confirm your password">
                                @error('password_confirmation') <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button wire:target="submitForm" wire:loading.attr="disabled" type="submit"
                                class="btn btn-primary">
                                <div wire:loading wire:target="submitForm">
                                    Processing...
                                </div> <span wire:loading.remove wire:target="submitForm">Submit</span>
                            </button>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-center">User List</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $data)
                                <tr>
                                    <th scope="row">{{ $data->id }}</th>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td><button wire:click="delete({{ $data->id }})"
                                            wire:target="delete({{ $data->id }})"
                                            wire:confirm="Kamu ingin menghapus {{$data->name}}?"
                                            class="btn btn-danger btn-sm text-right"><i class="fas fa-trash"
                                                wire:loading.remove wire:target="delete({{ $data->id }})"></i>
                                            <div wire:target="delete({{ $data->id }})" wire:loading
                                                class="spinner-border spinner-border-sm" role="status">
                                            </div>
                                        </button></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('livewire:initialized', () => {
        @this.on('swal', (event) => {
            const data = event
            swal.fire({
                icon: data[0]['icon'],
                title: data[0]['title'],
                text: data[0]['text'],
            })
        })
    })
</script>
{{-- @if(Session::has('success'))
<script type="text/javascript">
    function massge() {
  Swal.fire(
            'Good job!',
            'Successfully Saved!',
            'success'
        );
  }

  window.onload = massge;
</script>
@endif --}}

@endpush