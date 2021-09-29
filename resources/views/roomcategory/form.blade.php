@csrf
<div>
    <section>
        <div class="row">

            <div class="col-lg-6 mb-2">
                <div class="form-group">
                    <label class="text-label">{{trans('layout.item_name')}}*</label>
                    <input value="{{old('name')?old('name'):(isset($roomcategory)?$roomcategory->name:'')}}" type="text" name="name"
                           class="form-control" placeholder="Ex: Towel">
                </div>
            </div>
            <div class="col-lg-6 mb-2">
                <div class="form-group">
                    <label class="text-label">{{trans('layout.status')}}*</label>
                    <select name="status" class="form-control">
                        <option {{isset($roomcategory) && $roomcategory->status=='active'?'selected':''}} value="active">Active</option>
                        <option {{isset($roomcategory) && $roomcategory->status=='inactive'?'selected':''}} value="inactive">Inactive</option>
                    </select>
                </div>
            </div>

        </div>
    </section>

</div>
