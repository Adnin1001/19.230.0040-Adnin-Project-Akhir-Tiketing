<!-- Create Modal -->
<div class="modal fade" id="modal-create-tiket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create a Tiket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-create-tiket" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="text" class="form-control" name="nama" placeholder="Nama of tiket">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" name="nohp" placeholder="No HP of tiket">
                    </div>
                    <div class="form-group">
                        <input type="date" class="form-control" name="tglberangkat">
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="sel1">Pilih Armada :</label>
                            <select class="form-control" name="kelasarmada" id="kelasarmada">
                                <option>-</option>
                                <option value="Executive">Executive</option>
                                <option value="Travel Hiace">Travel Hiace</option>
                                <option value="Micro Bus">Micro Bus</option>
                                <option value="Pariwisata">Pariwisata</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="sel1">Pilih Kota Tujuan :</label>
                            <select class="form-control" name="kotatujuan" id="kotatujuan">
                                <option>-</option>
                                <option value="Bandung">Bandung</option>
                                <option value="Jakarta">Jakarta</option>
                                <option value="Semarang">Semarang</option>
                                <option value="Tegal">Tegal</option>
                                <option value="Purwokerto">Purwokerto</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="sel1">Pilih Tiket :</label>
                            <select class="form-control" name="tiket" id="tiket">
                                <option>-</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <select class="form-control select2" id="status" name="status_id">
                            <option value="" disabled selected>--Choose Status--</option>
                            <option id="publish" value="1">Publish</option>
                            <option id="pending" value="2">Pending</option>
                            <option id="draft" value="3">Draft</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-sm" id="btn-save-tiket">Save Tiket</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="modal-edit-tiket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit a Tiket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-edit-tiket" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" id="tiket_id">
                    <div class="form-group">
                        <input type="text" class="form-control" name="nama" placeholder="Nama of tiket">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" name="nohp" placeholder="No HP of tiket">
                    </div>
                    <div class="form-group">
                        <input type="date" class="form-control" name="tglberangkat">
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="sel1">Pilih Armada :</label>
                            <select class="form-control" name="kelasarmada" id="kelasarmada">
                                <option>-</option>
                                <option value="Executive">Executive</option>
                                <option value="Travel Hiace">Travel Hiace</option>
                                <option value="Micro Bus">Micro Bus</option>
                                <option value="Pariwisata">Pariwisata</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="sel1">Pilih Kota Tujuan :</label>
                            <select class="form-control" name="kotatujuan" id="kotatujuan">
                                <option>-</option>
                                <option value="Bandung">Bandung</option>
                                <option value="Jakarta">Jakarta</option>
                                <option value="Semarang">Semarang</option>
                                <option value="Tegal">Tegal</option>
                                <option value="Purwokerto">Purwokerto</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="sel1">Pilih Tiket :</label>
                            <select class="form-control" name="tiket" id="tiket">
                                <option>-</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <select class="form-control select2" id="status" name="status_id">
                            <option id="publish" value="1">Publish</option>
                            <option id="pending" value="2">Pending</option>
                            <option id="draft" value="3">Draft</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-sm" id="btn-update-tiket">Update Tiket</button>
            </div>
        </div>
    </div>
</div>
