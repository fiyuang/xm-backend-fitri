<!-- Delete Popup Confirmation -->
<div class="modal fade" id="remove-data-popup" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered mt-0" role="document">
    <div class="modal-content bg-danger">
      <div class="modal-body">
        <h3 class="mb-4 py-4 text-center" style="color: white;">Anda yakin ingin hapus data? Semua jadwal periksa dengan dokter tersebut akan hilang.</h3>

        <div class="row justify-content-center">
          <div class="col-8 text-center">
            <form action="" method="POST">
              @csrf
              <button type="submit" name="button" class="btn btn-warning"><i class="fas fa-trash fa-fw"></i> Hapus</button>
              <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fas fa-times fa-fw"></i> Tutup</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>