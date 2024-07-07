{{--Company--}}
<div class="col-md-6 col-sm-6">
    <label class="col-form-label label-align" for="comBranch">
        {{trans('app.company')}} <span class="required">*</span>
    </label>
    <div class="item form-group">
        <select  id="companyBranch" class="form-control" name="comBranch" @if(is_admin_group()) onchange="getBranch()" @endif>
            <option value="">{{trans('app.select')}}</option>
            @foreach(get_companies() as $key => $value)
                <option value="{{ $key }}" >{{ $value }}</option>
            @endif
        </select>
    </div>
</div>

{{--Company--}}
