<div class="modal fade custom-modal" id="addDistrictModal" tabindex="-1" aria-labelledby="addDistrictModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add District</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" id="closeModal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div >
                        <div >
                            <h6>Division Name</h6>
                        </div>
                        <div class="mb-3 form-group text-secondary">
                            <select name="division_id" id="division_id" class="form-select">
                                <option></option>
                                @foreach($divisions as $division)
                                    <option value="{{ $division->id }}">{{ $division->division_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div >
                        <div >
                            <h6>District Name</h6>
                        </div>
                        <div class="mb-3 form-group text-secondary">
                            <input type="text" id="district_name" class="form-control "  value="" required />
                        </div>
                    </div>

                    <div class="row">
                        <div ></div>
                        <div class="text-secondary">
                            <input type="submit" class="btn btn-primary px-4" value="Add District" onclick="addDistrict()"/>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>

