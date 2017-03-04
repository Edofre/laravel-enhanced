@if(session()->has('flash_message'))
    <div class="alert alert-{{session('flash_message_level')}} alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="{{ trans('common.close') }}"><span aria-hidden="true">&times;</span></button>
        <strong>{{ucfirst(session('flash_message_level'))}}</strong> <i class="fa fa-arrow-circle-right" aria-hidden="true"></i> {{ session('flash_message')  }}
    </div>
@endif