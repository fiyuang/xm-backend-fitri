<div class="modal fade" id="ModalFormHR" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data HR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="FormHR" name="FormHR">
                <div class="modal-body">
                    <div class="alert alert-danger" style="display:none"></div>
                    <div class="form-group col">
                        <label for="name">Nama HR</label>
                        <input type="text" name="name" id="name" class="form-control" value="" placeholder="Nama Lengkap">
                    </div>

                    <div class="form-group col">
                        <label for="name">Email</label>
                        <input type="text" name="email" id="email" class="form-control" value="" placeholder="">
                    </div>

                    <div class="form-group col">
                        <label for="mobile_number">No Telepon</label>
                        <input type="text" name="mobile_number" id="mobile_number" class="form-control" value="" placeholder="contoh: 0878xxxx">
                    </div>

                    <div class="form-group col">
                        <label for="dob">Tanggal Lahir</label>
                        <input type="date" name="dob" id="dob" class="form-control">
                    </div>

                    <div class="form-group col">
                        <label for="education">Pendidikan Terakhir</label>
                            <select class="form-control" name="education">
                                <option value="" disabled selected> Pilih </option>
                                <option value="1"> SD</option>
                                <option value="2"> SMP</option>
                                <option value="3"> SMP</option>
                                <option value="4"> DIPLOMA</option>
                                <option value="5"> SARJANA</option>
                            </select>
                    </div>

                    <div class="form-group col">
                        <label for="profile_picture">Upload Profile Picture</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="profile_picture" name="profile_picture">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                    </div>

                    <div class="form-group col">
                        <label for="cv">Upload CV</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="cv" name="cv">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                    </div>

                    <div class="form-group col">
                        <label for="industries">Industri</label>
                        <div class="custom-file">
                            <select class="js-example-basic-multiple form-control" name="industries[]" id="industries" multiple="multiple" style="width: 100%">
                                @foreach ($industries as $industry)
                                <option value="{{ $industry->id }}"> {{ $industry->name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm save-data">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>