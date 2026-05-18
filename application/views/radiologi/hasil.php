<form method="POST"
enctype="multipart/form-data">

<div class="form-group">

<label>Hasil Radiologi</label>

<textarea
name="hasil"
class="form-control"
rows="6"
required><?= $detail->hasil ?></textarea>

</div>

<div class="form-group">

<label>Upload File</label>

<input type="file"
name="file_hasil"
class="form-control">

</div>

<button type="submit"
class="btn btn-success">

Simpan Hasil

</button>

</form>