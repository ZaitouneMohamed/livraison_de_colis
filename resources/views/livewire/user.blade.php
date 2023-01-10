<div class="container">
    <form wire:submit.prevent="add_user">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">full name :</label>
            <input type="text" class="form-control" wire:model="name">
            @error('name') <span class="test text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">email :</label>
            <input type="text" class="form-control" wire:model="email">
            @error('email') <span class="test text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">password :</label>
            <input type="text" class="form-control" wire:model="password">
            @error('password') <span class="test text-danger">{{ $message }}</span> @enderror
        </div>
        @if ($editing)
            <button type="button" wire:click="update_user()" class="btn btn-warning"><i class="fa-sharp fa-solid fa-pen-to-square"></i></button>
            <button type="button" wire:click="cancel()" class="btn btn-danger"><i class="fa-sharp fa-solid fa-ban"></i></button>
        @else
            <button type="submit" wire:click="" class="btn btn-primary">submit</button>
        @endif
    </form>
    <ul class="list-group">
        @foreach ($users as $user)
            <li class="list-group-item d-flex justify-content-evenly">
                <div>
                    <i class="fa-solid fa-user"></i>{{$user->name}}
                </div>
                <div>
                    <i class="fa-solid fa-phone"></i>{{$user->email}}
                </div>
                <div>
                    <button wire:click="getuser({{$user->id}})" class="btn btn-warning"><i class="fa-sharp fa-solid fa-pen-to-square"></i></button>
                    <button wire:click="delete_user({{$user->id}})" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                </div>
            </li>
        @endforeach
</div>
