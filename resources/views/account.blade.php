@extends('layouts.app')

@section('pagespecificstyles')
<style>
    /* Style the tab */
.tab {
  /* overflow: hidden; */
  
  color: #f02429;
  background-color: #fff;
    box-shadow: none;
    display: flex;
    font-size: 16px;
    height: 48px;
    margin: 0 auto;
    overflow-x: auto;
    overflow-y: hidden;
    position: relative;
    white-space: nowrap;
    width: 100%;
}

/* Style the buttons that are used to open the tab content */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  width: 25%;
}

/* Change background color of buttons on hover */
.tab button:hover {
  border-bottom: #f02429 2px solid;
}

/* Create an active/current tablink class */
.tab button.active {
    border-bottom: #f02429 2px solid;
}

/* Style the tab content */
.tabcontent {
    background-color: #fff;
    display: none;
    padding: 6px 12px;
    border-top: none;
    margin-top:5px;
}
</style>
@endsection

@section('content')
@include('layouts.nav')

<main>
   
    <div class="container">
        
        <h1>Account</h1>
        @if($errors->any())
            <div style="color: #f02429; ">{{ implode('', $errors->all(':message')) }}</div>
        @endif
        <div class="account section">
            <!-- Tab links -->
        <div class="tab">
            <button class="tablinks" onclick="openCity(event, 'Profile')" id="defaultOpen">Profile</button>
            <button class="tablinks" onclick="openCity(event, 'Contact')">Contact</button>
            <button class="tablinks" onclick="openCity(event, 'Tools')">Tools</button>
            {{-- <button class="tablinks" onclick="openCity(event, 'Workstation')">Workstation</button> --}}
            <button class="tablinks" onclick="openCity(event, 'Password')">Password</button>
            <button class="tablinks" onclick="openCity(event, 'CreditLog')">Credit Log</button>
        </div>
  
        <!-- Tab content -->
        <div id="Profile" class="tabcontent">
            <div class="form-pad">
            <h4 class="m-b-lg">Billing Information</h4>
            <label class="account-label">Status</label>
            <input type="text" readonly value="{{ ucfirst( Auth::user()->status) }}">

            <label class="account-label">Country</label>
            <input type="text" readonly value="{{ code_to_country( Auth::user()->country) }}">

            <label class="account-label">Company Name</label>
            <input type="text" readonly value="{{ Auth::user()->company_name }}">

            <label class="account-label">Company trade register identification number</label>
            <input type="text" readonly value="{{ Auth::user()->company_id }}">

            <label class="account-label">Name:</label>
            <input type="text" readonly value="{{ Auth::user()->name }}">

            <label class="account-label">Address</label>
            <input type="text" readonly value="{{ Auth::user()->address }}">

            <label class="account-label">Zip Code</label>
            <input type="text" readonly value="{{ Auth::user()->zip }}">

            <label class="account-label">City</label>
            <input type="text" readonly value="{{ Auth::user()->city }}">

            <label class="account-label">Phone</label>
            <input type="text" readonly value="{{ Auth::user()->phone }}">
            </div>
        </div>
        
        <div id="Contact" class="tabcontent">
            <div class="form-pad">
                <label class="account-label">Application Language</label>
                <input type="text" readonly value="{{ ucfirst( Auth::user()->language) }}">

                <label class="account-label">Email</label>
                <input type="text" readonly value="{{ Auth::user()->email }}">
            </div>

            <div class="form-pad">
                <h4 class="m-b-lg" style="display:inline-block;">Spoken Languages</h4>
                <button id="addLangBtn" class="btn btn-red waves-effect waves-light m-sm create-language right" data-toggle="modal" data-target="#modalCreateLanguage">Add language</button>
                <p class="red-olsx-text">Warning : languages you have selected means that you may receive messages in that language.</p>
                                                    
                @if(count($languages) == 0)
                                <div>No Language Added.</div>
                        @else   
                <table class="table"> 
                    <thead>
                        <tr>
                            <th data-type="html">Language</th>
                            <th data-type="html">Mastery</th>
                            <th data-type="html" data-filterable="false">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($languages as $language)
                                <tr>
                                    <td>{{$language->language}}</td>
                                    <td>{{$language->mastery}} <i class="fa fa-star"></i></td>
                                    <td>
                                        <a href="{{ route('edit-language', $language->id); }}" class="btn-white tooltipped edit-language">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <button type="button" data-id="{{$language->id}}" class="btn-white tooltipped delete-language">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>  
                            @endforeach                                
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
        
        <div id="Tools" class="tabcontent">
            <div class="form-pad">
                <form method="POST" action="{{ route('update-tools'); }}">
                    @csrf
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                    <div class="input-field col s12">
                        <div class="select-wrapper form-control">
                        <select name="master_tools[]" id="master_tools" class="select-dropdown" multiple>
                            <option value="status" selected disabled>Select Master Tools You Use *</option>
                            <option value="Abrites" @if(in_array('Abrites',$masterTools)) selected @endif>Abrites</option>
                            <option value="Autotuner" @if(in_array('Autotuner',$masterTools)) selected @endif>Autotuner</option>
                            <option value="Bflash" @if(in_array('Bflash',$masterTools)) selected @endif>Bflash</option>
                            <option value="BitBox" @if(in_array('BitBox',$masterTools)) selected @endif>BitBox</option>
                            <option value="Bytehooter" @if(in_array('Bytehooter',$masterTools)) selected @endif>Bytehooter</option>
                            <option value="CMD" @if(in_array('CMD',$masterTools)) selected @endif>CMD</option>
                            <option value="Dataman" @if(in_array('Dataman',$masterTools)) selected @endif>Dataman (eprom reader)</option>
                            <option value="Dimsport_New_Genius" @if(in_array('Dimsport_New_Genius',$masterTools)) selected @endif>Dimsport New Genius</option>
                            <option value="Dimsport_Trasdata" @if(in_array('Dimsport_Trasdata',$masterTools)) selected @endif>Dimsport Trasdata</option>
                            <option value="ECUx" @if(in_array('ECUx',$masterTools)) selected @endif>ECUx</option>
                            <option value="Femto" @if(in_array('Femto',$masterTools)) selected @endif>Femto</option>
                            <option value="Flex" @if(in_array('Flex',$masterTools)) selected @endif>Flex (magic)</option>
                            <option value="Galetto" @if(in_array('Galetto',$masterTools)) selected @endif>Galetto</option>
                            <option value="HPturners" @if(in_array('HPturners',$masterTools)) selected @endif>HPturners</option>
                            <option value="IO_Terminal" @if(in_array('IO_Terminal',$masterTools)) selected @endif>I/O Terminal</option>
                            <option value="K_tag" @if(in_array('K_tag',$masterTools)) selected @endif>K-tag</option>
                            <option value="Kess_V2" @if(in_array('Kess_V2',$masterTools)) selected @endif>Kess V2</option>
                            <option value="Kess_V3" @if(in_array('Kess_V3',$masterTools)) selected @endif>Kess V3</option>
                            <option value="Magic_MAGPro2" @if(in_array('Magic_MAGPro2',$masterTools)) selected @endif>Magic MAGPro2</option>
                            <option value="MHD" @if(in_array('MHD',$masterTools)) selected @endif>MHD</option>
                            <option value="MMC_flasher" @if(in_array('MMC_flasher',$masterTools)) selected @endif>MMC flasher</option>
                            <option value="MPPS" @if(in_array('MPPS',$masterTools)) selected @endif>MPPS</option>
                            <option value="PCM_Flash" @if(in_array('PCM_Flash',$masterTools)) selected @endif>PCM Flash</option>
                            <option value="Powergate" @if(in_array('Powergate',$masterTools)) selected @endif>Powergate</option>
                            <option value="Tactrix" @if(in_array('Tactrix',$masterTools)) selected @endif>Tactrix</option>
                            <option value="TGflash" @if(in_array('TGflash',$masterTools)) selected @endif>TGflash</option>
                        </select>
                        </div>
                    </div>

                    <div class="input-field col s12">
                        <div class="select-wrapper form-control">
                        <select name="slave_tools[]" id="slave_tools" class="select-dropdown" multiple>
                            <option value="status" selected disabled>Select Master Tools You Use *</option>
                            <option value="Autotuner" @if(in_array('Autotuner',$slaveTools)) selected @endif>Autotuner</option>
                            <option value="Bflash" @if(in_array('Bflash',$slaveTools)) selected @endif>Bflash</option>
                            <option value="CMD" @if(in_array('CMD',$slaveTools)) selected @endif>CMD</option>
                            <option value="EVC_BDM100" @if(in_array('EVC_BDM100',$slaveTools)) selected @endif>EVC BDM100</option>
                            <option value="Flex" @if(in_array('Flex',$slaveTools)) selected @endif>Flex (magic)</option>
                            <option value="K_tag" @if(in_array('K_tag',$slaveTools)) selected @endif >K-tag</option>
                            <option value="Kess_V2" @if(in_array('Kess_V2',$slaveTools)) selected @endif>Kess V2</option>
                            <option value="Kess_V3" @if(in_array('Kess_V3',$slaveTools)) selected @endif>Kess V3</option>
                        </select>
                        </div>
                    </div>
                    <button type="submit">Update</button>
                </form>
            </div>
        </div>
        {{-- <div id="Workstation" class="tabcontent">
            <div class="form-pad">
                <h4 class="m-b-lg">Add Workstation</h4>
            </div>
        </div> --}}
        <div id="Password" class="tabcontent">
            <form name="" method="post" action="{{ route('change-password') }}">
                @csrf
                <div class="form-pad">
                    <h4 class="m-b-lg">Change Password</h4>
                    <label class="account-label">Current Password</label>
                    <input type="password" name="current_password">

                    <label class="account-label">New Password</label>
                    <input type="password" name="new_password">

                    <label class="account-label">Confirm Password</label>
                    <input type="password" name="confirm_password">
                    <button type="reset" id="language_create_form_Cancel"  class="waves-effect waves-light btn modal-action modal-close">Cancel</button>
                    <button type="submit" id="language_create_form_Save"  class="btn btn-red waves-effect waves-light m-sm">Confirm</button>
                </div>
            </form>
        </div>
        <div id="CreditLog" class="tabcontent">
            
                <div class="container">
                    <div class="row m-t-lg">
                        {{-- <div class="col s12">
                            <input type="checkbox" class="cgv-checkbox" id="postiveCreditLog" name="postiveCreditLog" checked="checked" data-com.bitwarden.browser.user-edited="yes">
                            <label for="postiveCreditLog">
                                Display positive transactions
                            </label>
                            <br>
                            <input type="checkbox" class="cgv-checkbox" id="negativeCreditLog" name="negativeCreditLog" checked="checked" data-com.bitwarden.browser.user-edited="yes">
                            <label for="negativeCreditLog">
                                Display negative transactions
                            </label>
                        </div> --}}
                        <table id="credit-log-table" class="admin-history file-history responsive-table highlight">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Date</th>
                                <th></th>
                                <th>Credits</th>
                                <th>Total credits</th>
                                <th></th>
                                <th>Vehicle</th>
                                <th>Invoice Ref.</th>
                                <th>Amount</th>
                            </tr>
                            </thead>
                            <tbody> 
                                @php $total = 0; @endphp
                                @foreach($credits as $credit) 
                                    @php $total += $credit->credits; @endphp                                                                                                                
                                    <tr @if($credit->file_id) class="redirect-click  @if($credit->credits < 0) minus @else plus @endif" href="#" data-redirect="{{route('file', $credit->file_id)}}" @else class="@if($credit->credits < 0) minus @else plus @endif" @endif>
                                        <td></td>
                                        <td>{{$credit->created_at->format('Y-m-d')}}</td>
                                        <td><strong>
                                            User
                                        </strong></td>
                                        <td>
                                            @if($credit->credits < 0)
                                                <label class="label label-credit-admin red">{{$credit->credits}}</label>
                                            @else
                                                <label class="label label-credit-admin green">{{$credit->credits}}</label>
                                            @endif
                                        </td>
                                        <td> 
                                            @if($credit->credits > 0)
                                                <label class="label label-credit-admin grey">{{$total}}</label>
                                            @endif
                                        </td>
                                        <td>
                                            @if($credit->credits < 0)
                                                <img alt="" class="img-circle-car-history" height="30px" src="{{ get_image_from_brand($credit->file->brand) }}">
                                            @endif
                                        </td>
                                        <td>
                                            @if($credit->credits < 0)
                                                {{$credit->file->vehicle()->Name}} {{ $credit->file->engine }} {{ $credit->file->vehicle()->TORQUE_standard }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($credit->credits > 0)
                                                {{ $credit->invoice_id }}
                                            @endif    
                                        </td>            
                                        <td>@if($credit->credits > 0)  {{ $credit->price_payed.'€' }} @endif</td>
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
</main>
<div id="modalCreateLanguage" class="modal" style="z-index: 1011;opacity: 1; transform: scaleX(1); top: 10%;">
    <div class="modal-content">
        <form name="" method="post" action="{{ route('create-language') }}">
        @csrf
        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
        <h4 id="modalAddTitle">Add language</h4>
        
        <div>
            <label for="mastery_level">Language :</label>
            <div class="input-field col s12">
                <div class="select-wrapper form-control">
                <select name="language" id="language" class="select-dropdown">
                    <option value="English">English</option>
                    <option value="French">French</option>
                  </select>
                </div>
            </div>
            <label for="mastery_level">Mastery :</label>
            <div class="level-container">
                <input type="hidden" id="language_create_form_masteryLevel" name="mastery" value="4">
                <i class="fa level-star star-nb-1 fa-star" data-level="1"></i>
                <i class="fa level-star star-nb-2 fa-star" data-level="2"></i>
                <i class="fa level-star star-nb-3 fa-star" data-level="3"></i>
                <i class="fa level-star star-nb-4 fa-star-o" data-level="4"></i>
                <i class="fa level-star star-nb-5 fa-star-o" data-level="5"></i>
            </div>
        </div>
        <button type="reset" id="language_create_form_Cancel"  class="waves-effect waves-light btn modal-action modal-close" data-dismiss="modal" aria-label="Close">Cancel</button>
        <button type="submit" id="language_create_form_Save"  class="btn btn-red waves-effect waves-light m-sm">Confirm</button>
    </div>
</div>
<div class="modal-overlay" style="z-index: 1010; opacity: 0.5;"></div>
@endsection

@section('pagespecificscripts')

<script type="text/javascript">

$( document ).ready(function(event) {

    $( document ).ready(function(event) {
        $('.redirect-click').click(function() {
            window.location.href = $(this).data('redirect');
            return false;
        });

        $('table').DataTable({"ordering": false,});
    });

    $(document).on('click','.delete-language', function(e){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
            if (result.isConfirmed) {
                    $.ajax({
                        url: "/delete_language",
                        type: "POST",
                        data: {
                            id: $(this).data('id')
                        },
                        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                        success: function(response) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your row has been deleted.",
                                type: "success",
                                timer: 3000
                            });

                            location.reload();
                        }
                    });            
                }
            });
        });

    $(document).on('click','#addLangBtn', function(e){
       console.log('btn clicked');
       $('.modal-overlay').css({display: "block"});
   });

   $('.level-star').click(function(e){
        // e.preventdefault;
        let level = $(this).data('level');
        $('.level-star').removeClass('fa-star-o');
        $('.level-star').removeClass('fa-star');
        $('.level-star').each(function(i, obj) {
            let inner_level = $(obj).data('level');
            if( inner_level <= level ){
                $(this).addClass('fa-star');
            }
            else {
                $(this).addClass('fa-star-o');
            }
        });

        $('#language_create_form_masteryLevel').val(level);
       
   });

   $(document).on('click','#language_create_form_Cancel', function(e){
    if($('.modal-overlay').css('display') == 'block'){
        console.log('closed');
        $('.modal-overlay').css("display", "none");
     }
   });
});

function openCity(evt, cityName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";

    }
document.getElementById("defaultOpen").click();

</script>

@endsection