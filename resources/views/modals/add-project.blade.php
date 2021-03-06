@extends('modals.generic')

@section('modal-id')
addProjectModal
@overwrite

@section('modal-title')
    New Project
@overwrite

@section('modal-body')
<form id="addProjectForm" method="post" enctype="multipart/form-data" action="{{ auth()->user()->getUsername() . '/projects' }}">
    @csrf

    <div class="projectPreviewWrapper">
        <img id="projectPreviewAdd" class="d-block mx-auto" src="{{ \Storage::url('project_image/default.png') }}" alt="{{ 'Project image' }}">
    </div>
    <div class="form-group">

        <label  for="image">Project Image</label>
        <input type="file" name="image" accept=".png, .jpg, .jpeg" class="form-control-file {{ (session('source') == 'add' && $errors->has('image')) ? ' is-invalid' : '' }}" id="projectImage"
        onchange="document.getElementById('projectPreviewAdd').src = window.URL.createObjectURL(this.files[0])"
        >
        <small class="form-text text-muted">max. 1MB and max. 1000x1000</small>
        
        @if (session('source') == 'add' && $errors->has('image'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('image') }}</strong>
        </span>
        @endif
    
    </div>

    <div class="form-group">
        <label for="title">Project title&nbsp;<small class="text-muted">(required)</small></label>
        <input type="text" class="form-control {{ (session('source') == 'add' && $errors->has('title')) ? ' is-invalid' : '' }}"  name="title" placeholder="The title of your project" value="{{ old('title') }}" required>
        @if (session('source') == 'add' && $errors->has('title'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('title') }}</strong>
        </span>
        @endif
    
    </div>

   

    <div class="form-group">
            <label for="description">Description&nbsp;<small class="text-muted">(required)</small></label>
           <textarea name="description" class="form-control {{ (session('source') == 'add' && $errors->has('description')) ? ' is-invalid' : '' }}" placeholder="A short description" rows="4" required>{{ old('description') }}</textarea>
           @if (session('source') == 'add' && $errors->has('description'))
           <span class="invalid-feedback">
               <strong>{{ $errors->first('description') }}</strong>
           </span>
           @endif
    </div>
   

    <div class="form-group">
        <label for="link">Link</label>
        <input type="url" class="form-control {{ (session('source') == 'add' && $errors->has('link')) ? ' is-invalid' : '' }}"   name="link" placeholder="Link to your project" value="{{  old('link') }}">
        @if (session('source') == 'add' && $errors->has('link'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('link') }}</strong>
        </span>
        @endif
    </div>

    <div class="form-group">
            <label for="tags">Tag(s)</label>
            <input type="text" class="form-control {{ (session('source') == 'add' && $errors->has('tags')) ? ' is-invalid' : '' }}" id="tags" name="tags" placeholder="Comma separated tags e.g: creative, mobile, ..." value="{{ old('tags') }}">
            <small class="text-muted">Comma separated tags</small>
            @if (session('source') == 'add' && $errors->has('tags'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('tags') }}</strong>
            </span>
        
            @endif
          
        </div>

</form>
@overwrite

@section('modal-footer')
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-success" onclick="sendForm('addProjectForm', this)">Save</button>
             
         @if( session('source') == 'add' && $errors->any()  )
            <script>
                $(document).ready(function(){
                    $('#addProjectModal').modal('show');
                    
                });
                
            </script>
         @endif

@overwrite
