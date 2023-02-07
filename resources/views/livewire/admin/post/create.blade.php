<div class="card">
    <div class="card-header p-0">
        <h3 class="card-title">{{ __('CreateTitle', ['name' => __('Post') ]) }}</h3>
        <div class="px-2 mt-4">
            <ul class="breadcrumb mt-3 py-3 px-4 rounded" style="background-color: #e9ecef!important;">
                <li class="breadcrumb-item"><a href="@route(getRouteName().'.home')" class="text-decoration-none">{{ __('Dashboard') }}</a></li>
                <li class="breadcrumb-item"><a href="@route(getRouteName().'.post.read')" class="text-decoration-none">{{ __(\Illuminate\Support\Str::plural('Post')) }}</a></li>
                <li class="breadcrumb-item active">{{ __('Create') }}</li>
            </ul>
        </div>
    </div>

    <form class="form-horizontal" wire:submit.prevent="create" enctype="multipart/form-data">

        <div class="card-body">
            
            <!-- Name Input -->
            <div class='form-group'>
                <label for='inputname' class='col-sm-2 control-label'> {{ __('Name') }}</label>
                <input type='text' wire:model.lazy='name' class="form-control @error('name') is-invalid @enderror" id='inputname'>
                @error('name') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
            
            <!-- Desc Input -->
            <div class='form-group'>
                <label for='inputdesc' class='col-sm-2 control-label'> {{ __('Desc') }}</label>
                <textarea wire:model.lazy='desc' class="form-control @error('desc') is-invalid @enderror"></textarea>
                @error('desc') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
             <!-- type Input -->
             <div class='form-group'>
                <label for='inputposttype' class='col-sm-2 control-label'> {{ __('posttype') }}</label>
                <textarea wire:model.lazy='posttype' class="form-control @error('posttype') is-invalid @enderror"></textarea>
                @error('posttype') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
            
            
               <!-- type Input -->
               <div class='form-group'>
                <label for='inputistop' class='col-sm-2 control-label'> {{ __('istop') }}</label>
                <textarea wire:model.lazy='istop' class="form-control @error('istop') is-invalid @enderror"></textarea>
                @error('istop') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
            
            <!-- Image Input -->
            <div class='form-group' >
                <label for='inputimages' class='col-sm-2 control-label'>الصور</label>
                <input type='file' wire:model='images' class="form-control-file @error('images') is-invalid @enderror" id='inputimages' accept = "image/*" multiple>
                @if($images and !$errors->has('images') and $images instanceof \Livewire\TemporaryUploadedFile and (in_array( $images->guessExtension(), ['png', 'jpg', 'gif', 'jpeg'])))
                    <a href="{{ $images->temporaryUrl() }}"><img width="200" height="200" class="img-fluid shadow" src="{{ $images->temporaryUrl() }}" alt=""></a>
                @endif
                @error('images') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
             
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info ml-4">{{ __('Create') }}</button>
            <a href="@route(getRouteName().'.post.read')" class="btn btn-default float-left">{{ __('Cancel') }}</a>
        </div>
    </form>
</div>
