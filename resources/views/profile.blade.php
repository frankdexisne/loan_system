@extends('layouts.ace_master')

@section('style')
<link rel="stylesheet" href="{{asset('/ace-master')}}/css/bootstrap-datepicker3.min.css" />
<link rel="stylesheet" href="{{asset('/ace-master')}}/css/bootstrap-editable.min.css" />
@endsection

@section('content-header')
<!-- <div class="nav-search" id="nav-search">
    <form class="form-search">
        <span class="input-icon">
            <input type="date" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" value="{{date('Y-m-d')}}"/>
            <i class="ace-icon fa fa-search nav-search-icon"></i>
        </span>
    </form>
</div>  -->
@endsection

@section('content')

<div>
    <div id="user-profile-1" class="user-profile row">
        <div class="col-xs-12 col-sm-3 center">
            <div>
                <span class="profile-picture">
                    <img id="avatar" class="editable img-responsive" alt="Alex's Avatar" src="{{asset('ace-master')}}/images/avatars/profile-pic.jpg" />
                </span>

                <div class="space-4"></div>

                <div class="width-100 label label-info label-xlg arrowed-in arrowed-in-right">
                    <div class="inline position-relative">
                        <a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
                            <span class="white">{{Auth::user()->name}}</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="hr hr12 dotted"></div>

            <div class="clearfix">
                <div class="grid2">
                    <span class="bigger-175 blue">25</span>

                    <br />
                    Role
                </div>

                <div class="grid2">
                    <span class="bigger-175 blue">12</span>

                    <br />
                    Permissions
                </div>
            </div>

            <div class="hr hr16 dotted"></div>
        </div>

        <div class="col-xs-12 col-sm-9">
            <div class="center">
                <span class="btn btn-app btn-sm btn-light no-hover">
                    <span class="line-height-1 bigger-170 blue"> 1,411 </span>

                    <br />
                    <span class="line-height-1 smaller-90"> Client </span>
                </span>

                <span class="btn btn-app btn-sm btn-yellow no-hover">
                    <span class="line-height-1 bigger-170"> 32 </span>

                    <br />
                    <span class="line-height-1 smaller-90"> Target </span>
                </span>

                <span class="btn btn-app btn-sm btn-pink no-hover">
                    <span class="line-height-1 bigger-170"> 4 </span>

                    <br />
                    <span class="line-height-1 smaller-90"> Collected </span>
                </span>

                <span class="btn btn-app btn-sm btn-grey no-hover">
                    <span class="line-height-1 bigger-170"> 23 </span>

                    <br />
                    <span class="line-height-1 smaller-90"> Progress </span>
                </span>
            </div>

            <div class="space-12"></div>

            <div class="profile-user-info profile-user-info-striped">
                <div class="profile-info-row">
                    <div class="profile-info-name"> Lastname </div>

                    <div class="profile-info-value">
                        <input type="text" class="form-group" name="lname" id="lname" required>
                    </div>
                </div>

                <div class="profile-info-row">
                    <div class="profile-info-name"> Location </div>

                    <div class="profile-info-value">
                        <i class="fa fa-map-marker light-orange bigger-110"></i>
                        <span class="editable" id="country">Netherlands</span>
                        <span class="editable" id="city">Amsterdam</span>
                    </div>
                </div>

                <div class="profile-info-row">
                    <div class="profile-info-name"> Age </div>

                    <div class="profile-info-value">
                        <span class="editable" id="age">38</span>
                    </div>
                </div>

                <div class="profile-info-row">
                    <div class="profile-info-name"> Joined </div>

                    <div class="profile-info-value">
                        <span class="editable" id="signup">2010/06/20</span>
                    </div>
                </div>

                <div class="profile-info-row">
                    <div class="profile-info-name"> Last Online </div>

                    <div class="profile-info-value">
                        <span class="editable" id="login">3 hours ago</span>
                    </div>
                </div>

                <div class="profile-info-row">
                    <div class="profile-info-name"> About Me </div>

                    <div class="profile-info-value">
                        <span class="editable" id="about">Editable as WYSIWYG</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@section('scripts')

<script src="{{asset('ace-master')}}/js/bootstrap-editable.min.js"></script>
<script src="{{asset('ace-master')}}/js/ace-editable.min.js"></script>
<script src="{{asset('ace-master')}}/js/jquery.maskedinput.min.js"></script>

<script>
    $(document).ready(function(){
        $.fn.editable.defaults.mode = 'inline';
        $.fn.editableform.loading = "<div class='editableform-loading'><i class='ace-icon fa fa-spinner fa-spin fa-2x light-blue'></i></div>";
        $.fn.editableform.buttons = '<button type="submit" class="btn btn-info editable-submit"><i class="ace-icon fa fa-check"></i></button>'+
                                    '<button type="button" class="btn editable-cancel"><i class="ace-icon fa fa-times"></i></button>';

        // *** editable avatar *** //
        try {//ie8 throws some harmless exceptions, so let's catch'em

            //first let's add a fake appendChild method for Image element for browsers that have a problem with this
            //because editable plugin calls appendChild, and it causes errors on IE at unpredicted points
            try {
                document.createElement('IMG').appendChild(document.createElement('B'));
            } catch(e) {
                Image.prototype.appendChild = function(el){}
            }

            var last_gritter
            $('#avatar').editable({
                type: 'image',
                name: 'avatar',
                value: null,
                //onblur: 'ignore',  //don't reset or hide editable onblur?!
                image: {
                    //specify ace file input plugin's options here
                    btn_choose: 'Change Avatar',
                    droppable: true,
                    maxSize: 110000,//~100Kb

                    //and a few extra ones here
                    name: 'avatar',//put the field name here as well, will be used inside the custom plugin
                    on_error : function(error_type) {//on_error function will be called when the selected file has a problem
                        if(last_gritter) $.gritter.remove(last_gritter);
                        if(error_type == 1) {//file format error
                            last_gritter = $.gritter.add({
                                title: 'File is not an image!',
                                text: 'Please choose a jpg|gif|png image!',
                                class_name: 'gritter-error gritter-center'
                            });
                        } else if(error_type == 2) {//file size rror
                            last_gritter = $.gritter.add({
                                title: 'File too big!',
                                text: 'Image size should not exceed 100Kb!',
                                class_name: 'gritter-error gritter-center'
                            });
                        }
                        else {//other error
                        }
                    },
                    on_success : function() {
                        $.gritter.removeAll();
                    }
                },
                url: function(params) {
                    // ***UPDATE AVATAR HERE*** //
                    //for a working upload example you can replace the contents of this function with
                    //examples/profile-avatar-update.js

                    var deferred = new $.Deferred

                    var value = $('#avatar').next().find('input[type=hidden]:eq(0)').val();
                    if(!value || value.length == 0) {
                        deferred.resolve();
                        return deferred.promise();
                    }


                    //dummy upload
                    setTimeout(function(){
                        if("FileReader" in window) {
                            //for browsers that have a thumbnail of selected image
                            var thumb = $('#avatar').next().find('img').data('thumb');
                            if(thumb) $('#avatar').get(0).src = thumb;
                        }

                        deferred.resolve({'status':'OK'});

                        if(last_gritter) $.gritter.remove(last_gritter);
                        last_gritter = $.gritter.add({
                            title: 'Avatar Updated!',
                            text: 'Uploading to server can be easily implemented. A working example is included with the template.',
                            class_name: 'gritter-info gritter-center'
                        });

                        } , parseInt(Math.random() * 800 + 800))

                    return deferred.promise();

                    // ***END OF UPDATE AVATAR HERE*** //
                },

                success: function(response, newValue) {
                }
            })
        }catch(e) {}
    })
</script>
@endsection

