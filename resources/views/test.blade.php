@extends('adminlte::page')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<section class="content" data-select2-id="52">
  <div class="container-fluid" data-select2-id="51">
    <!-- SELECT2 EXAMPLE -->
    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">Select2 (Default Theme)</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
          <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <div class="col-md-6" data-select2-id="29">
            <div class="form-group">
              <label>Minimal</label>
              <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                <option selected="selected" data-select2-id="3">Alabama</option>
                <option data-select2-id="30">Alaska</option>
                <option data-select2-id="31">California</option>
                <option data-select2-id="32">Delaware</option>
                <option data-select2-id="33">Tennessee</option>
                <option data-select2-id="34">Texas</option>
                <option data-select2-id="35">Washington</option>
              </select><span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" data-select2-id="2" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-7yh1-container"><span class="select2-selection__rendered" id="select2-7yh1-container" role="textbox" aria-readonly="true" title="Alaska">Alaska</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
            </div>
            <!-- /.form-group -->
            <div class="form-group">
              <label>Disabled</label>
              <select class="form-control select2 select2-hidden-accessible" disabled="" style="width: 100%;" data-select2-id="4" tabindex="-1" aria-hidden="true">
                <option selected="selected" data-select2-id="6">Alabama</option>
                <option>Alaska</option>
                <option>California</option>
                <option>Delaware</option>
                <option>Tennessee</option>
                <option>Texas</option>
                <option>Washington</option>
              </select><span class="select2 select2-container select2-container--default select2-container--disabled" dir="ltr" data-select2-id="5" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-disabled="true" aria-labelledby="select2-icpx-container"><span class="select2-selection__rendered" id="select2-icpx-container" role="textbox" aria-readonly="true" title="Alabama">Alabama</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
            </div>
            <!-- /.form-group -->
          </div>
          <!-- /.col -->
          <div class="col-md-6">
            <div class="form-group">
              <label>Multiple</label>
              <select class="select2 select2-hidden-accessible" multiple="" data-placeholder="Select a State" style="width: 100%;" data-select2-id="7" tabindex="-1" aria-hidden="true">
                <option>Alabama</option>
                <option>Alaska</option>
                <option>California</option>
                <option>Delaware</option>
                <option>Tennessee</option>
                <option>Texas</option>
                <option>Washington</option>
              </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="8" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-disabled="false"><ul class="select2-selection__rendered"><li class="select2-search select2-search--inline"><input class="select2-search__field" type="search" tabindex="0" autocomplete="off" autocorrect="off" autocapitalize="none" spellcheck="false" role="searchbox" aria-autocomplete="list" placeholder="Select a State" style="width: 769.5px;"></li></ul></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
            </div>
            <!-- /.form-group -->
            <div class="form-group">
              <label>Disabled Result</label>
              <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="9" tabindex="-1" aria-hidden="true">
                <option selected="selected" data-select2-id="11">Alabama</option>
                <option>Alaska</option>
                <option disabled="disabled">California (disabled)</option>
                <option>Delaware</option>
                <option>Tennessee</option>
                <option>Texas</option>
                <option>Washington</option>
              </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="10" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-09sq-container"><span class="select2-selection__rendered" id="select2-09sq-container" role="textbox" aria-readonly="true" title="Alabama">Alabama</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
            </div>
            <!-- /.form-group -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <h5>Custom Color Variants</h5>
        <div class="row">
          <div class="col-12 col-sm-6">
            <div class="form-group">
              <label>Minimal (.select2-danger)</label>
              <select class="form-control select2 select2-danger select2-hidden-accessible" data-dropdown-css-class="select2-danger" style="width: 100%;" data-select2-id="12" tabindex="-1" aria-hidden="true">
                <option selected="selected" data-select2-id="14">Alabama</option>
                <option>Alaska</option>
                <option>California</option>
                <option>Delaware</option>
                <option>Tennessee</option>
                <option>Texas</option>
                <option>Washington</option>
              </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="13" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-afba-container"><span class="select2-selection__rendered" id="select2-afba-container" role="textbox" aria-readonly="true" title="Alabama">Alabama</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
            </div>
            <!-- /.form-group -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6">
            <div class="form-group">
              <label>Multiple (.select2-purple)</label>
              <div class="select2-purple">
                <select class="select2 select2-hidden-accessible" multiple="" data-placeholder="Select a State" data-dropdown-css-class="select2-purple" style="width: 100%;" data-select2-id="15" tabindex="-1" aria-hidden="true">
                  <option>Alabama</option>
                  <option>Alaska</option>
                  <option>California</option>
                  <option>Delaware</option>
                  <option>Tennessee</option>
                  <option>Texas</option>
                  <option>Washington</option>
                </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="16" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-disabled="false"><ul class="select2-selection__rendered"><li class="select2-search select2-search--inline"><input class="select2-search__field" type="search" tabindex="0" autocomplete="off" autocorrect="off" autocapitalize="none" spellcheck="false" role="searchbox" aria-autocomplete="list" placeholder="Select a State" style="width: 769.5px;"></li></ul></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
              </div>
            </div>
            <!-- /.form-group -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
        the plugin.
      </div>
    </div>
    <!-- /.card -->

    <!-- SELECT2 EXAMPLE -->
    <div class="card card-default" data-select2-id="50">
      <div class="card-header">
        <h3 class="card-title">Select2 (Bootstrap4 Theme)</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
          <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body" data-select2-id="49">
        <div class="row" data-select2-id="48">
          <div class="col-md-6" data-select2-id="65">
            <div class="form-group">
              <label>Minimal</label>
              <select class="form-control select2bs4 select2-hidden-accessible" style="width: 100%;" data-select2-id="17" tabindex="-1" aria-hidden="true">
                <option selected="selected" data-select2-id="19">Alabama</option>
                <option data-select2-id="66">Alaska</option>
                <option data-select2-id="67">California</option>
                <option data-select2-id="68">Delaware</option>
                <option data-select2-id="69">Tennessee</option>
                <option data-select2-id="70">Texas</option>
                <option data-select2-id="71">Washington</option>
              </select><span class="select2 select2-container select2-container--bootstrap4 select2-container--below" dir="ltr" data-select2-id="18" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-voi0-container"><span class="select2-selection__rendered" id="select2-voi0-container" role="textbox" aria-readonly="true" title="Alaska">Alaska</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
            </div>
            <!-- /.form-group -->
            <div class="form-group">
              <label>Disabled</label>
              <select class="form-control select2bs4 select2-hidden-accessible" disabled="" style="width: 100%;" data-select2-id="20" tabindex="-1" aria-hidden="true">
                <option selected="selected" data-select2-id="22">Alabama</option>
                <option>Alaska</option>
                <option>California</option>
                <option>Delaware</option>
                <option>Tennessee</option>
                <option>Texas</option>
                <option>Washington</option>
              </select><span class="select2 select2-container select2-container--bootstrap4 select2-container--disabled" dir="ltr" data-select2-id="21" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-disabled="true" aria-labelledby="select2-7qua-container"><span class="select2-selection__rendered" id="select2-7qua-container" role="textbox" aria-readonly="true" title="Alabama">Alabama</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
            </div>
            <!-- /.form-group -->
          </div>
          <!-- /.col -->
          <div class="col-md-6" data-select2-id="47">
            <div class="form-group" data-select2-id="46">
              <label>Multiple</label>
              <select class="select2bs4 select2-hidden-accessible" multiple="" data-placeholder="Select a State" style="width: 100%;" data-select2-id="23" tabindex="-1" aria-hidden="true">
                <option data-select2-id="37">Alabama</option>
                <option data-select2-id="38">Alaska</option>
                <option data-select2-id="39">California</option>
                <option data-select2-id="40">Delaware</option>
                <option data-select2-id="41">Tennessee</option>
                <option data-select2-id="42">Texas</option>
                <option data-select2-id="43">Washington</option>
              </select><span class="select2 select2-container select2-container--bootstrap4 select2-container--below" dir="ltr" data-select2-id="24" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-disabled="false"><ul class="select2-selection__rendered"><li class="select2-selection__choice" title="Alaska" data-select2-id="60"><span class="select2-selection__choice__remove" role="presentation">×</span>Alaska</li><li class="select2-selection__choice" title="Delaware" data-select2-id="61"><span class="select2-selection__choice__remove" role="presentation">×</span>Delaware</li><li class="select2-selection__choice" title="Tennessee" data-select2-id="62"><span class="select2-selection__choice__remove" role="presentation">×</span>Tennessee</li><li class="select2-search select2-search--inline"><input class="select2-search__field" type="search" tabindex="0" autocomplete="off" autocorrect="off" autocapitalize="none" spellcheck="false" role="searchbox" aria-autocomplete="list" placeholder="" style="width: 0.75em;"></li></ul></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
            </div>
            <!-- /.form-group -->
            <div class="form-group">
              <label>Disabled Result</label>
              <select class="form-control select2bs4 select2-hidden-accessible" style="width: 100%;" data-select2-id="25" tabindex="-1" aria-hidden="true">
                <option selected="selected" data-select2-id="27">Alabama</option>
                <option>Alaska</option>
                <option disabled="disabled">California (disabled)</option>
                <option>Delaware</option>
                <option>Tennessee</option>
                <option>Texas</option>
                <option>Washington</option>
              </select><span class="select2 select2-container select2-container--bootstrap4" dir="ltr" data-select2-id="26" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-zly0-container"><span class="select2-selection__rendered" id="select2-zly0-container" role="textbox" aria-readonly="true" title="Alabama">Alabama</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
            </div>
            <!-- /.form-group -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
        the plugin.
      </div>
    </div>
    <!-- /.card -->

    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">Bootstrap Duallistbox</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
          <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <label>Multiple</label>
              <div class="bootstrap-duallistbox-container row moveonselect moveondoubleclick"> <div class="box1 col-md-6">   <label for="bootstrap-duallistbox-nonselected-list_" style="display: none;"></label>   <span class="info-container">     <span class="info">Showing all 6</span>     <button type="button" class="btn btn-sm clear1" style="float:right!important;">show all</button>   </span>   <input class="form-control filter" type="text" placeholder="Filter">   <div class="btn-group buttons">     <button type="button" class="btn moveall btn-outline-secondary" title="Move all">&gt;&gt;</button>        </div>   <select multiple="multiple" id="bootstrap-duallistbox-nonselected-list_" name="_helper1" style="height: 102px;"><option>Alaska</option><option>California</option><option>Delaware</option><option>Tennessee</option><option>Texas</option><option>Washington</option></select> </div> <div class="box2 col-md-6">   <label for="bootstrap-duallistbox-selected-list_" style="display: none;"></label>   <span class="info-container">     <span class="info">Showing all 1</span>     <button type="button" class="btn btn-sm clear2" style="float:right!important;">show all</button>   </span>   <input class="form-control filter" type="text" placeholder="Filter">   <div class="btn-group buttons">          <button type="button" class="btn removeall btn-outline-secondary" title="Remove all">&lt;&lt;</button>   </div>   <select multiple="multiple" id="bootstrap-duallistbox-selected-list_" name="_helper2" style="height: 102px;"><option selected="">Alabama</option></select> </div></div><select class="duallistbox" multiple="multiple" style="display: none;">
                <option selected="">Alabama</option>
                <option>Alaska</option>
                <option>California</option>
                <option>Delaware</option>
                <option>Tennessee</option>
                <option>Texas</option>
                <option>Washington</option>
              </select>
            </div>
            <!-- /.form-group -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
        the plugin.
      </div>
    </div>
    <!-- /.card -->

    <div class="row">
      <div class="col-md-6">

        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">Input masks</h3>
          </div>
          <div class="card-body">
            <!-- Date dd/mm/yyyy -->
            <div class="form-group">
              <label>Date masks:</label>

              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                </div>
                <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false">
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->

            <!-- Date mm/dd/yyyy -->
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                </div>
                <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask="" im-insert="false">
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->

            <!-- phone mask -->
            <div class="form-group">
              <label>US phone mask:</label>

              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-phone"></i></span>
                </div>
                <input type="text" class="form-control" data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;" data-mask="" im-insert="true">
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->

            <!-- phone mask -->
            <div class="form-group">
              <label>Intl US phone mask:</label>

              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-phone"></i></span>
                </div>
                <input type="text" class="form-control" data-inputmask="'mask': ['999-999-9999 [x99999]', '+099 99 99 9999[9]-9999']" data-mask="" im-insert="true">
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->

            <!-- IP mask -->
            <div class="form-group">
              <label>IP mask:</label>

              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-laptop"></i></span>
                </div>
                <input type="text" class="form-control" data-inputmask="'alias': 'ip'" data-mask="" im-insert="true">
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->

          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Color &amp; Time Picker</h3>
          </div>
          <div class="card-body">
            <!-- Color Picker -->
            <div class="form-group">
              <label>Color picker:</label>
              <input type="text" class="form-control my-colorpicker1 colorpicker-element" data-colorpicker-id="1" data-original-title="" title="">
            </div>
            <!-- /.form group -->

            <!-- Color Picker -->
            <div class="form-group">
              <label>Color picker with addon:</label>

              <div class="input-group my-colorpicker2 colorpicker-element" data-colorpicker-id="2">
                <input type="text" class="form-control" data-original-title="" title="">

                <div class="input-group-append">
                  <span class="input-group-text"><i class="fas fa-square"></i></span>
                </div>
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->

            <!-- time Picker -->
            <div class="bootstrap-timepicker">
              <div class="form-group">
                <label>Time picker:</label>

                <div class="input-group date" id="timepicker" data-target-input="nearest">
                  <input type="text" class="form-control datetimepicker-input" data-target="#timepicker">
                  <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="far fa-clock"></i></div>
                  </div>
                  </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

      </div>
      <!-- /.col (left) -->
      <div class="col-md-6">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Date picker</h3>
          </div>
          <div class="card-body">
            <!-- Date range -->
            <div class="form-group">
              <label>Date range:</label>

              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="far fa-calendar-alt"></i>
                  </span>
                </div>
                <input type="text" class="form-control float-right" id="reservation">
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->

            <!-- Date and time range -->
            <div class="form-group">
              <label>Date and time range:</label>

              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="far fa-clock"></i></span>
                </div>
                <input type="text" class="form-control float-right" id="reservationtime">
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->

            <!-- Date and time range -->
            <div class="form-group">
              <label>Date range button:</label>

              <div class="input-group">
                <button type="button" class="btn btn-default float-right" id="daterange-btn">
                  <i class="far fa-calendar-alt"></i> Date range picker
                  <i class="fas fa-caret-down"></i>
                </button>
              </div>
            </div>
            <!-- /.form group -->

          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- iCheck -->
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">iCheck Bootstrap - Checkbox &amp; Radio Inputs</h3>
          </div>
          <div class="card-body">
            <!-- Minimal style -->
            <div class="row">
              <div class="col-sm-6">
                <!-- checkbox -->
                <div class="form-group clearfix">
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="checkboxPrimary1" checked="">
                    <label for="checkboxPrimary1">
                    </label>
                  </div>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="checkboxPrimary2">
                    <label for="checkboxPrimary2">
                    </label>
                  </div>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="checkboxPrimary3" disabled="">
                    <label for="checkboxPrimary3">
                      Primary checkbox
                    </label>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <!-- radio -->
                <div class="form-group clearfix">
                  <div class="icheck-primary d-inline">
                    <input type="radio" id="radioPrimary1" name="r1" checked="">
                    <label for="radioPrimary1">
                    </label>
                  </div>
                  <div class="icheck-primary d-inline">
                    <input type="radio" id="radioPrimary2" name="r1">
                    <label for="radioPrimary2">
                    </label>
                  </div>
                  <div class="icheck-primary d-inline">
                    <input type="radio" id="radioPrimary3" name="r1" disabled="">
                    <label for="radioPrimary3">
                      Primary radio
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <!-- Minimal red style -->
            <div class="row">
              <div class="col-sm-6">
                <!-- checkbox -->
                <div class="form-group clearfix">
                  <div class="icheck-danger d-inline">
                    <input type="checkbox" checked="" id="checkboxDanger1">
                    <label for="checkboxDanger1">
                    </label>
                  </div>
                  <div class="icheck-danger d-inline">
                    <input type="checkbox" id="checkboxDanger2">
                    <label for="checkboxDanger2">
                    </label>
                  </div>
                  <div class="icheck-danger d-inline">
                    <input type="checkbox" disabled="" id="checkboxDanger3">
                    <label for="checkboxDanger3">
                      Danger checkbox
                    </label>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <!-- radio -->
                <div class="form-group clearfix">
                  <div class="icheck-danger d-inline">
                    <input type="radio" name="r2" checked="" id="radioDanger1">
                    <label for="radioDanger1">
                    </label>
                  </div>
                  <div class="icheck-danger d-inline">
                    <input type="radio" name="r2" id="radioDanger2">
                    <label for="radioDanger2">
                    </label>
                  </div>
                  <div class="icheck-danger d-inline">
                    <input type="radio" name="r2" disabled="" id="radioDanger3">
                    <label for="radioDanger3">
                      Danger radio
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <!-- Minimal red style -->
            <div class="row">
              <div class="col-sm-6">
                <!-- checkbox -->
                <div class="form-group clearfix">
                  <div class="icheck-success d-inline">
                    <input type="checkbox" checked="" id="checkboxSuccess1">
                    <label for="checkboxSuccess1">
                    </label>
                  </div>
                  <div class="icheck-success d-inline">
                    <input type="checkbox" id="checkboxSuccess2">
                    <label for="checkboxSuccess2">
                    </label>
                  </div>
                  <div class="icheck-success d-inline">
                    <input type="checkbox" disabled="" id="checkboxSuccess3">
                    <label for="checkboxSuccess3">
                      Success checkbox
                    </label>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <!-- radio -->
                <div class="form-group clearfix">
                  <div class="icheck-success d-inline">
                    <input type="radio" name="r3" checked="" id="radioSuccess1">
                    <label for="radioSuccess1">
                    </label>
                  </div>
                  <div class="icheck-success d-inline">
                    <input type="radio" name="r3" id="radioSuccess2">
                    <label for="radioSuccess2">
                    </label>
                  </div>
                  <div class="icheck-success d-inline">
                    <input type="radio" name="r3" disabled="" id="radioSuccess3">
                    <label for="radioSuccess3">
                      Success radio
                    </label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            Many more skins available. <a href="https://bantikyan.github.io/icheck-bootstrap/">Documentation</a>
          </div>
        </div>
        <!-- /.card -->

        <!-- Bootstrap Switch -->
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">Bootstrap Switch</h3>
          </div>
          <div class="card-body">
            <div class="bootstrap-switch-on bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-animate" style="width: 88px;"><div class="bootstrap-switch-container" style="width: 129px; margin-left: 0px;"><span class="bootstrap-switch-handle-on bootstrap-switch-primary" style="width: 43px;">ON</span><span class="bootstrap-switch-label" style="width: 43px;">&nbsp;</span><span class="bootstrap-switch-handle-off bootstrap-switch-default" style="width: 43px;">OFF</span><input type="checkbox" name="my-checkbox" checked="" data-bootstrap-switch=""></div></div>
            <div class="bootstrap-switch-on bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-animate" style="width: 88px;"><div class="bootstrap-switch-container" style="width: 129px; margin-left: 0px;"><span class="bootstrap-switch-handle-on bootstrap-switch-success" style="width: 43px;">ON</span><span class="bootstrap-switch-label" style="width: 43px;">&nbsp;</span><span class="bootstrap-switch-handle-off bootstrap-switch-danger" style="width: 43px;">OFF</span><input type="checkbox" name="my-checkbox" checked="" data-bootstrap-switch="" data-off-color="danger" data-on-color="success"></div></div>
          </div>
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col (right) -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
    
@endsection

@section('content')
    <div class="row">
      <div class="col-md-6">

        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">Input masks</h3>
          </div>
          <div class="card-body">
            <!-- Date dd/mm/yyyy -->
            <div class="form-group">
              <label>Date masks:</label>

              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                </div>
                <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false">
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->

            <!-- Date mm/dd/yyyy -->
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                </div>
                <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask="" im-insert="false">
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->

            <!-- phone mask -->
            <div class="form-group">
              <label>US phone mask:</label>

              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-phone"></i></span>
                </div>
                <input type="text" class="form-control" data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;" data-mask="" im-insert="true">
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->

            <!-- phone mask -->
            <div class="form-group">
              <label>Intl US phone mask:</label>

              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-phone"></i></span>
                </div>
                <input type="text" class="form-control" data-inputmask="'mask': ['999-999-9999 [x99999]', '+099 99 99 9999[9]-9999']" data-mask="" im-insert="true">
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->

            <!-- IP mask -->
            <div class="form-group">
              <label>IP mask:</label>

              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-laptop"></i></span>
                </div>
                <input type="text" class="form-control" data-inputmask="'alias': 'ip'" data-mask="" im-insert="true">
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->

          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Color &amp; Time Picker</h3>
          </div>
          <div class="card-body">
            <!-- Color Picker -->
            <div class="form-group">
              <label>Color picker:</label>
              <input type="text" class="form-control my-colorpicker1 colorpicker-element" data-colorpicker-id="1" data-original-title="" title="">
            </div>
            <!-- /.form group -->

            <!-- Color Picker -->
            <div class="form-group">
              <label>Color picker with addon:</label>

              <div class="input-group my-colorpicker2 colorpicker-element" data-colorpicker-id="2">
                <input type="text" class="form-control" data-original-title="" title="">

                <div class="input-group-append">
                  <span class="input-group-text"><i class="fas fa-square"></i></span>
                </div>
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->

            <!-- time Picker -->
            <div class="bootstrap-timepicker">
              <div class="form-group">
                <label>Time picker:</label>

                <div class="input-group date" id="timepicker" data-target-input="nearest">
                  <input type="text" class="form-control datetimepicker-input" data-target="#timepicker">
                  <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="far fa-clock"></i></div>
                  </div>
                  </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

      </div>
      <!-- /.col (left) -->
      <div class="col-md-6">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Date picker</h3>
          </div>
          <div class="card-body">
            <!-- Date range -->
            <div class="form-group">
              <label>Date range:</label>

              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="far fa-calendar-alt"></i>
                  </span>
                </div>
                <input type="text" class="form-control float-right" id="reservation">
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->

            <!-- Date and time range -->
            <div class="form-group">
              <label>Date and time range:</label>

              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="far fa-clock"></i></span>
                </div>
                <input type="text" class="form-control float-right" id="reservationtime">
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->

            <!-- Date and time range -->
            <div class="form-group">
              <label>Date range button:</label>

              <div class="input-group">
                <button type="button" class="btn btn-default float-right" id="daterange-btn">
                  <i class="far fa-calendar-alt"></i> Date range picker
                  <i class="fas fa-caret-down"></i>
                </button>
              </div>
            </div>
            <!-- /.form group -->

          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- iCheck -->
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">iCheck Bootstrap - Checkbox &amp; Radio Inputs</h3>
          </div>
          <div class="card-body">
            <!-- Minimal style -->
            <div class="row">
              <div class="col-sm-6">
                <!-- checkbox -->
                <div class="form-group clearfix">
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="checkboxPrimary1" checked="">
                    <label for="checkboxPrimary1">
                    </label>
                  </div>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="checkboxPrimary2">
                    <label for="checkboxPrimary2">
                    </label>
                  </div>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="checkboxPrimary3" disabled="">
                    <label for="checkboxPrimary3">
                      Primary checkbox
                    </label>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <!-- radio -->
                <div class="form-group clearfix">
                  <div class="icheck-primary d-inline">
                    <input type="radio" id="radioPrimary1" name="r1" checked="">
                    <label for="radioPrimary1">
                    </label>
                  </div>
                  <div class="icheck-primary d-inline">
                    <input type="radio" id="radioPrimary2" name="r1">
                    <label for="radioPrimary2">
                    </label>
                  </div>
                  <div class="icheck-primary d-inline">
                    <input type="radio" id="radioPrimary3" name="r1" disabled="">
                    <label for="radioPrimary3">
                      Primary radio
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <!-- Minimal red style -->
            <div class="row">
              <div class="col-sm-6">
                <!-- checkbox -->
                <div class="form-group clearfix">
                  <div class="icheck-danger d-inline">
                    <input type="checkbox" checked="" id="checkboxDanger1">
                    <label for="checkboxDanger1">
                    </label>
                  </div>
                  <div class="icheck-danger d-inline">
                    <input type="checkbox" id="checkboxDanger2">
                    <label for="checkboxDanger2">
                    </label>
                  </div>
                  <div class="icheck-danger d-inline">
                    <input type="checkbox" disabled="" id="checkboxDanger3">
                    <label for="checkboxDanger3">
                      Danger checkbox
                    </label>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <!-- radio -->
                <div class="form-group clearfix">
                  <div class="icheck-danger d-inline">
                    <input type="radio" name="r2" checked="" id="radioDanger1">
                    <label for="radioDanger1">
                    </label>
                  </div>
                  <div class="icheck-danger d-inline">
                    <input type="radio" name="r2" id="radioDanger2">
                    <label for="radioDanger2">
                    </label>
                  </div>
                  <div class="icheck-danger d-inline">
                    <input type="radio" name="r2" disabled="" id="radioDanger3">
                    <label for="radioDanger3">
                      Danger radio
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <!-- Minimal red style -->
            <div class="row">
              <div class="col-sm-6">
                <!-- checkbox -->
                <div class="form-group clearfix">
                  <div class="icheck-success d-inline">
                    <input type="checkbox" checked="" id="checkboxSuccess1">
                    <label for="checkboxSuccess1">
                    </label>
                  </div>
                  <div class="icheck-success d-inline">
                    <input type="checkbox" id="checkboxSuccess2">
                    <label for="checkboxSuccess2">
                    </label>
                  </div>
                  <div class="icheck-success d-inline">
                    <input type="checkbox" disabled="" id="checkboxSuccess3">
                    <label for="checkboxSuccess3">
                      Success checkbox
                    </label>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <!-- radio -->
                <div class="form-group clearfix">
                  <div class="icheck-success d-inline">
                    <input type="radio" name="r3" checked="" id="radioSuccess1">
                    <label for="radioSuccess1">
                    </label>
                  </div>
                  <div class="icheck-success d-inline">
                    <input type="radio" name="r3" id="radioSuccess2">
                    <label for="radioSuccess2">
                    </label>
                  </div>
                  <div class="icheck-success d-inline">
                    <input type="radio" name="r3" disabled="" id="radioSuccess3">
                    <label for="radioSuccess3">
                      Success radio
                    </label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            Many more skins available. <a href="https://bantikyan.github.io/icheck-bootstrap/">Documentation</a>
          </div>
        </div>
        <!-- /.card -->

        <!-- Bootstrap Switch -->
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">Bootstrap Switch</h3>
          </div>
          <div class="card-body">
            <div class="bootstrap-switch-on bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-animate" style="width: 92px;"><div class="bootstrap-switch-container" style="width: 135px; margin-left: 0px;"><span class="bootstrap-switch-handle-on bootstrap-switch-primary" style="width: 45px;">ON</span><span class="bootstrap-switch-label" style="width: 45px;">&nbsp;</span><span class="bootstrap-switch-handle-off bootstrap-switch-default" style="width: 45px;">OFF</span><input type="checkbox" name="my-checkbox" checked="" data-bootstrap-switch=""></div></div>
            <div class="bootstrap-switch-on bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-animate" style="width: 92px;"><div class="bootstrap-switch-container" style="width: 135px; margin-left: 0px;"><span class="bootstrap-switch-handle-on bootstrap-switch-success" style="width: 45px;">ON</span><span class="bootstrap-switch-label" style="width: 45px;">&nbsp;</span><span class="bootstrap-switch-handle-off bootstrap-switch-danger" style="width: 45px;">OFF</span><input type="checkbox" name="my-checkbox" checked="" data-bootstrap-switch="" data-off-color="danger" data-on-color="success"></div></div>
          </div>
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col (right) -->
    </div>
    
@stop
