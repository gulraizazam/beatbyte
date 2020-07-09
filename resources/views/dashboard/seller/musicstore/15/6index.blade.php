@extends('dashboard.layouts.default')
@section('content')
	<div class="container-fluid">
		<div class="content-heading">
  		HTML5 Stores
  		<div class="sub-menu-wrapper hidden-sm hidden-xs">
        <div class="sub-menu hidden-sm hidden-xs">
            <div class="sub-menu__item active">
                <a class="sub-menu__link" href="#"><i class="fa fa-list"></i> Music Store</a>
            </div>
            <!--  <div class="sub-menu__item ">
              <a class="sub-menu__link" data-toggle="modal" href="#add-collection"><i class="fa fa-plus"></i> Add Store</a>
                
            </div> -->
        </div>
  		</div>
		</div>
      	<hr>
      	<div class="container">
          <div class="col-md-12">
            @if(session()->has('success'))

                <div class="alert alert-success">

                    {{ session()->get('success') }}

                </div>

            @endif
          </div>
          <div class="row">
                <div class="html5-config-page__banner">
                    <div class="html5-config-page__banner--shape">
                        <img src="https://app.airbit.com/img/dashboard/infinity-banner/shape1.svg" class="html5-config-page__banner--shape-1">
                    </div>

                    <div class="html5-config-page__banner--wrapper col-md-12">
                        <div class="col-md-6 html5-config-page__banner--wrapper-header">
                            <img src="/public/images/beat-bytes-logo.png" alt="" class="html5-config-page__banner--wrapper-logo">
                            <h1>
                                Hey, have you tried our Beat Byte Store?
                            </h1>
                        </div>
                        <div class="col-md-6">
                            <img src="https://app.airbit.com/img/infinity/devices.png" class="html5-config-page__banner--wrapper-preview">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="html5-config-page col-xs-12" id="html5-config-page">
                  <div align="center" id="preview-container">
                    <?php
                    $user = Auth::user()->id;
                    $getstore = \App\Music_store::where('user_id',$user)->latest('created_at')->first();
                    ?>
                    @if(!is_null($defaultConfig))
                    <iframe id="preview" src="https://beatbyte.co/widgets/html5/{{explode('-',$defaultConfig->uid)[0]}}/{{$defaultConfig->id}}" frameborder="0" width="{{$defaultConfig->width}}" height="{{$defaultConfig->height}}"></iframe>
                    @endif
                  </div>
                </div>

            </div> 
            <div class="dimension-options-wrapper">
                <div class="width-option">
                    <label>Width
                         @if(!is_null($defaultConfig))
                            <input type="text" class="form-control" size="5" maxlength="4" value="{{$defaultConfig->width}}">
                        @else
                            <input type="text" class="form-control" size="5" maxlength="4" value="820" >
                        @endif
                    </label>
                    <label class="responsive-option checkbox">
                        <input type="checkbox" name="responsive">
                        Responsive
                    </label>
                </div>

                <label class="height-option">Height
                    @if(!is_null($defaultConfig))
                        <input type="text" class="form-control" size="5" maxlength="4" value="{{$defaultConfig->height}}">
                    @else
                        <input type="text" class="form-control" size="5" maxlength="4" value="820">
                    @endif
                </label>

                <a class="size-guidelines" href="#" data-toggle="modal" data-target="#size-guidelines-modal"><i class="fa fa-fw fa-info"></i>Size Guidelines</a>
            </div>
        </div>
        <p class="text-center">
            <a data-toggle="modal" href="#config-explained"><i class="fa fa-info-circle"></i> What's a configuration?</a>
        </p>
        <div class="row">
            <div class="offset-sm-2 col-sm-8">
                <p class="text-center">
                        <button class="btn btn-lg btn-success" data-toggle="modal" href="#new-configuration"><i class="fa fa-plus"></i> Create a new configuration</button>
                </p>
                <p class="text-center">or</p>
                <select class="form-control select-config">
                    @foreach($configs as $config)
                    <option value="{{$config->id}}" type="submit">{{$config->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-5 mb-5">
                <form method="POST" action="{{URL::to('store/config/update')}}" id="update-configuration" novalidate="novalidate">
                    @csrf
                    <div class="col-md-8 offset-md-2">
                        <!-- TAB NAVIGATION -->
                        <input type="hidden" name="configid" id="configid">
                        <input type="hidden" name="uid" id="uid">
                        <input type="hidden" name="width" id="widget_width">
                        <input type="hidden" name="height" id="widget_height">
                        <ul class="html5-settings-tabs nav nav-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link active" href="#tab1" role="tab" data-toggle="tab" aria-selected="false">General Settings</a></li>
                            <li  class="nav-item"><a class="nav-link" href="#tab3" role="tab" data-toggle="tab" aria-selected="false">Embed Code</a></li>
                        </ul>
                        <!-- TAB CONTENT -->
                        <div class="tab-content p0 b0">
                            <div class="active tab-pane" id="tab1">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <label for="config-name" id="config-name-label">Name</label>
                                        <input class="form-control" type="text" name="name" maxlength="30">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab3">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Embed Code</h3>
                                    </div>
                                    <div class="panel-body">
                                        <p align="center" style="display: none;" class="code-loading loading">Loading</p>

                                        <textarea name="players-html5-code" rows="3" class="form-control"><iframe id="mfs_html5" src="http://beatbyte.co/stores/html5?uid=460750&config=916797" width="720" height="520" frameborder="0" scrolling="no"></iframe></textarea>
                                        <span class="help-block">This code is used to embed the player onto your website. Please note you cannot embed our HTML5 player on your Soundclick profile, you can only embed our Flash stores.</span>

                                        <p>&nbsp;</p>

                                        <label class="control-label">Your Player Direct URL</label>
                                        <input type="text" id="direct-url" class="form-control">
                                        <span class="help-block">If you want your users to have the best personalised experience on their mobile device, it's good to link directly to your player which will take up the whole browser screen.</span>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div align="center">
                            <button type="submit" class="save-config-btn btn btn-success btn-lg">
                                <i class="fa fa-floppy-o"></i>
                                
                                Save Configuration
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
       <!-- <div class="modal fade" id="add-collection">

            <form method="POST" action="{{route('store.add')}}" enctype="multipart/form-data">

                @csrf

                <input type="hidden" name="userid" value="{{Auth::user()->id}}">

                <div class="modal-dialog">

                    <div class="modal-content">

                        <div class="modal-header">

                            

                            <h4 class="modal-title">Add Store</h4>

                        </div>

                        <div class="modal-body">

                            <div class="new-collection-wrapper">

                                <fieldset>

                                    <label for="new-collection-type">Store Name</label>
                                    <input type="text" name="storename" class="form-control">


                                </fieldset>
                                <fieldset>
                                    <label for="new-collection-type">Store Url</label>
                                   
                                    <textarea class="form-control" name="storeurl" placeholder="Paste Url"></textarea>

                                    <span class="select2 select2-container select2-container--bootstrap" dir="ltr" style="width: auto;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-new-collection-type-container"><span class="select2-selection__rendered" id="select2-new-collection-type-container"><span class="select2-selection__placeholder">Paste Url Of Store here</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span>

                                    </span><span class="dropdown-wrapper" aria-hidden="true"></span></span>

                                </fieldset>
                                

                            </div>

                        </div>

                        <div class="modal-footer">

                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                            <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Save</button>

                        </div>

                    </div>

                    <!-- /.modal-content -->

                </div>

                <!-- /.modal-dialog -->

            </form>
        </div> -->
        <div class="modal fade" id="size-guidelines-modal" tabindex="1" role="dialog" aria-hidden="true" aria-labelledby="size-guidelines-modal-title">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="size-guidelines-modal-title">
                            HTML5 Player Size Guidelines
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="size-guidelines-modal-body modal-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <img src="https://app.airbit.com/img/dashboard/stores/flatui-large.jpg">
                            </div>
                            <div class="col-sm-6">
                                This player is suitable for desktop and larger screens. The cart is always visible on the left
                                side of the player.
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <img src="https://app.airbit.com/img/dashboard/stores/flatui-medium.jpg">
                            </div>
                            <div class="col-sm-6">
                                This player is suitable for desktop but the cart is hidden which also makes it suitable for
                                smaller screens sizes such as tablets.
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <img src="https://app.airbit.com/img/dashboard/stores/flatui-small.jpg">
                            </div>
                            <div class="col-sm-6">
                                This player is suitable for mobile display. The cart is hidden and the controls area is
                                rearranged to make it suitable for smaller screen sizes.
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="responsive-title">
                                    Responsive - Width : 100%
                                </div>
                                <p>
                                    This player will display the full width of the screen or its container. It will
                                    automatically resize depending on the width of the screen.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="config-explained">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">What's a configuration?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <p>A configuration is a collection of settings for the HTML5 store. This means you can configure a store with different settings, then save those settings as a configuration.</p>

                        <p>Once you embed the HTML5 store on your website and you want to change something on it, you only need to change your configuration settings and save them and it will automatically update on your website. No
                            need to embed
                            the code on your website again.</p>

                        <p>You can create as many configurations as you want, and you can use the same configuration on many different pages. </p>

                        <p>You have two default configurations for your Airbit profile and your Facebook page.</p>

                        <p>The only thing that doesn't update using a configuration is the width and height of the store; this has to be done in the embed code.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Got It!</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>
        <form method="POST" action="{{URL::to('store/config/new')}}" id="new-configuration-form" novalidate="novalidate">
            @csrf
            <div class="modal fade" id="new-configuration">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Create New Configuration</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <p>Give your configuration a unique name so you can easily select in the future. Once your configuration
                            is created, select it from the drop down to edit your configuration options.</p>
                            <div class="form-group"><label class="control-label control-label-required" for="name">Configuration Name</label><input type="text" name="name" id="name" class="form-control" required="required" aria-required="true"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </form>
    </div>
       
@stop

@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        var config = $('.select-config option:selected').text();
        var allconfigs = '<?php echo json_encode($configs) ?>';
        var configs = JSON.parse(allconfigs);
        for (var i = 0; i < configs.length; i++) {
            if (configs[i].name == config) {
                $('#configid').val(configs[i].id);
                $('#uid').val(configs[i].uid.split('-')[0]);
                $('#tab1 input[name="name"]').val(configs[i].name);
                $('textarea[name="players-html5-code"]').val('<iframe id="mfs_html5" src="http://beatbyte.co/widgets/html5/'+configs[i].uid.split('-')[0]+'/'+configs[i].id+'" width="'+configs[i].width+'" height="'+configs[i].height+'" frameborder="0" scrolling="no"></iframe>');
                $('#direct-url').val('http://beatbyte.co/widgets/html5/'+configs[i].uid.split('-')[0]+'/'+configs[i].id);
            }
        }
    });

    $('.select-config').on('change',function(){
        var config = $('.select-config option:selected').text();
        var allconfigs = '<?php echo json_encode($configs) ?>';
        var configs = JSON.parse(allconfigs);
        for (var i = 0; i < configs.length; i++) {
            if (configs[i].name == config) {
                $('#configid').val(configs[i].id);
                $('#uid').val(configs[i].uid.split('-')[0]);
                $('#tab1 input[name="name"]').val(configs[i].name);
                $('textarea[name="players-html5-code"]').val('<iframe id="mfs_html5" src="http://beatbyte.co/widgets/html5/'+configs[i].uid.split('-')[0]+'/'+configs[i].id+'" width="'+configs[i].width+'" height="'+configs[i].height+'" frameborder="0" scrolling="no"></iframe>');
                $('#direct-url').val('http://beatbyte.co/widgets/html5/'+configs[i].uid.split('-')[0]+'/'+configs[i].id);
                $('.dimension-options-wrapper .width-option input.form-control').val(configs[i].width);
                $('.dimension-options-wrapper .height-option input').val(configs[i].height);
                $('#preview').width(configs[i].width);
                $('#preview').height(configs[i].height);
                $('#mfs_html5').width(configs[i].width);
                $('#mfs_html5').height(configs[i].height);

            }
        }

    });
    $('#update-configuration').on('submit',function(){
        var defaultwidth = $('.dimension-options-wrapper .width-option input.form-control').val();
        var height = $('.dimension-options-wrapper .height-option input').val();
        $('#widget_width').val(defaultwidth);
        $('#widget_height').val(height);
    });
</script>
@stop

