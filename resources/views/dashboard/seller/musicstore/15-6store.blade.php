@extends('dashboard.layouts.default')
@section('content')
	<div class="container-fluid">
		<div class="content-heading">
  		Music Store
  		<div class="sub-menu-wrapper hidden-sm hidden-xs">
        <div class="sub-menu hidden-sm hidden-xs">
            <div class="sub-menu__item active">
                <a class="sub-menu__link" href="#"><i class="fa fa-list"></i> Music Store</a>
            </div>
        </div>
  		</div>
		</div>
      	<hr>
      	<div class="container">
          <div class="row">
            <div class="col-xs-12">
            </div>
            <div class="col-xs-12" style="margin-bottom: 20px;">
            </div>
            <div class="html5-config-page col-xs-12" id="html5-config-page">
              <div align="center" id="preview-container">
                <iframe id="preview" src="http://beatbyte.co/categories/3 preview=true" frameborder="0" width="750" height="510"></iframe>
              </div>
             
              <p class="text-center">
                  <a data-toggle="modal" href="#config-explained"><i class="fa fa-info-circle"></i> What's a configuration?</a>
              </p>
              <p>&nbsp;</p>
              <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <p class="text-center">
                        <button class="btn btn-lg btn-success" data-toggle="modal" href="#new-configuration"><i class="fa fa-plus"></i> Create a new configuration</button>
                    </p>
                </div>
              </div>
              <p>&nbsp;</p>
              <div class="row">
                  <form method="POST" action="#" id="update-configuration">
                      <input type="hidden" name="_token" value="u71acBpwIPZNcs7D4rjvzF5kh0MijJpBGx3N5Klo">
                      <input type="hidden" name="_method" value="PATCH">

                  </form>
              </div>
            </div>
          </div> 
        </div>
        <div class="modal fade" id="size-guidelines-modal" tabindex="1" role="dialog" aria-hidden="true" aria-labelledby="size-guidelines-modal-title">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                      <h4 class="modal-title" id="size-guidelines-modal-title">
                          HTML5 Player Size Guidelines
                      </h4>
                  </div>
                  <div class="size-guidelines-modal-body modal-body">
                      <div class="row">
                          <div class="col-sm-6">
                              <img src="https://app.airbit.com/img/dashboard/stores/flatui-large.jpg">
                          </div>
                          <div class="col-sm-6">
                              This player is suitable for desktop and larger screens. The cart is always visible on the left side of the player.
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-sm-6">
                              <img src="https://app.airbit.com/img/dashboard/stores/flatui-medium.jpg">
                          </div>
                          <div class="col-sm-6">
                              This player is suitable for desktop but the cart is hidden which also makes it suitable for smaller screens sizes such as tablets.
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-sm-6">
                              <img src="https://app.airbit.com/img/dashboard/stores/flatui-small.jpg">
                          </div>
                          <div class="col-sm-6">
                              This player is suitable for mobile display. The cart is hidden and the controls area is rearranged to make it suitable for smaller screen sizes.
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-sm-12">
                              <div class="responsive-title">
                                  Responsive - Width : 100%
                              </div>
                              <p>
                                  This player will display the full width of the screen or its container. It will automatically resize depending on the width of the screen.
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
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">What's a configuration?</h4>
                    </div>
                    <div class="modal-body">
                        <p>A configuration is a collection of settings for the HTML5 store. This means you can configure a store with different settings, then save those settings as a configuration.</p>

                        <p>Once you embed the HTML5 store on your website and you want to change something on it, you only need to change your configuration settings and save them and it will automatically update on your website. No need to embed the code on your website again.</p>

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
        
@stop