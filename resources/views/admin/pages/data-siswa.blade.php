@extends('admin.layouts.main')

@section('content')
<h4 class="fw-bold">
  <span class="text-muted fw-light">Admin /</span> Data Siswa
</h4>
<button type="button" class="btn btn-primary mb-4" id="btnModal" data-bs-toggle="modal" data-bs-target="#modalForm">
  <span class="tf-icons bx bx-plus-circle"></span>&nbsp; Tambah Siswa
</button>

<div class="card">
  <h5 class="card-header">List Data Siswa</h5>
  <div class="table-responsive text-nowrap">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>No.</th>
          <th></th>
          <th>NIS</th>
          <th>Nama</th>
          <th>Kelas</th>
          <th>Angkatan</th>
          <th>Lokasi</th>
          <th>#</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @forelse($dataSiswa as $key=>$siswa)
        <tr>
          <td>{{ $dataSiswa->firstItem()+$key }}</td>
          <td><img src="{{ asset('foto-siswa/'.$siswa->foto) }}" width="40px"></td>
          <td>{{ $siswa->nis }}</td>
          <td>{{ $siswa->nama }}</td>
          <td>{{ $siswa->kelas }}</td>
          <td>{{ $siswa->angkatan }}</td>
          <td>{{ $siswa->lokasi }}</td>
          <td>
            <div class="dropdown">
            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="#" id="siswa-edit-{{ $siswa->id }}" onClick="dataSiswaEdit(this)" data-id="{{ base64_encode($siswa->id) }}"><i class="bx bx-edit-alt me-1 text-primary"></i> Edit</a>
                <a class="dropdown-item" href="#" id="siswa-del-{{ $siswa->id }}" onClick="dataSiswaDel(this)" data-id="{{ base64_encode($siswa->id) }}"><i class="bx bx-trash me-1 text-danger"></i> Hapus</a>
              </div>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="5">Data tidak ditemukan.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
    <div class="demo-inline-spacing">
      <nav aria-label="Page navigation">
        {{ $dataSiswa->links('pagination::bootstrap-5') }}
      </nav>
    </div>
  </div>

  {{-- TOAST NOTIFIKASI --}}
  <div style="display:none">
    <select id="selectTypeOpt" class="form-select color-dropdown">
        @if(Session::get('siswaTambah') == 'ok')
            <option value="bg-success">Success</option>
        @endif
        
        @if(Session::get('nisAlready') == 'ok')
            <option value="bg-warning">Warning</option>
        @endif
        
        @if(Session::get('siswaEdit') == 'ok')
            <option value="bg-success">Success</option>
        @endif

        @if(Session::get('siswaDelete') == 'ok')
            <option value="bg-success">Success</option>
        @endif
        
        @if(Session::get('siswaError') == 'ok')
        <option value="bg-danger">Danger</option>
        @endif
    </select>
    <select class="form-select placement-dropdown" id="selectPlacement">
      <option value="top-0 end-0">Top right</option>
    </select>
    <button id="showToastPlacement" class="btn btn-primary d-block">Show Toast</button>
  </div>

  <div class="bs-toast toast toast-placement-ex m-2" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
    <div class="toast-header">
      @if(Session::get('siswaError') == 'ok')
      <i class='bx bx-error-alt me-2'></i>
      <div class="me-auto fw-semibold"> Error</div>
      @else
      <i class='bx bx-check me-2'></i>
      <div class="me-auto fw-semibold">Sukses</div>
      @endif
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      @if(Session::get('siswaTambah') == 'ok')
        Siswa baru berhasil ditambahkan.
      @endif
      
      @if(Session::get('nisAlready') == 'ok')
        NIS telah tersedia, mohon cek kembali.
      @endif
      
      @if(Session::get('siswaEdit') == 'ok')
        Data siswa berhasil diubah.
      @endif
      
      @if(Session::get('siswaDelete') == 'ok')
        Data siswa berhasil dihapus.
      @endif
      
      @if(Session::get('siswaError') == 'ok')
        Terjadi kesalahan, silahkan ulangi proses.
      @endif
    </div>
  </div>
</div>

<!-- Modal Add -->
<div class="modal fade" id="modalForm" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="label-modal">Tambah Data Siswa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="javascript:window.location.reload()"></button>
      </div>
      <form id="modal-form" action="{{ url('/data-siswa/add') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('post')
        <div class="modal-body">
            <div class="row">
              <div class="col col-lg-12">
                <div id="imgSiswa"></div>
              </div>
            </div>
            <div class="row">
              <div class="col col-lg-12">
                  <div class="row">
                      <div class="col col-lg-6 mb-3">
                          <label for="nameBasic" class="form-label">Nama Siswa</label>
                          <input type="hidden" name="id" id="id-siswa">
                          <input type="text" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama Siswa" id="nama-siswa" name="nama" value="{{ old('nama') }}">
                          @error('nama')
                              <div class="form-text text-danger">{{ $message }}</div>
                          @enderror
                      </div>
                  
                      <div class="col col-lg-6 mb-3">
                          <label for="nameBasic" class="form-label">NIS Siswa</label>
                          <input type="text" class="form-control @error('nis') is-invalid @enderror" placeholder="NIS Siswa" id="nis-siswa" name="nis" value="{{ old('nis') }}">
                          @error('nis')
                              <div class="form-text text-danger">{{ $message }}</div>
                          @enderror
                      </div>
                  </div>
              </div>
            </div>

            <div class="row">
              <div class="col col-lg-12">
                  <div class="row">
                      <div class="col mb-3">
                          <label for="emailBasic" class="form-label">Kelas</label>
                          <select class="form-select" aria-label="Default select example" id="kelas-siswa" name="kelas">
                              <option selected="">Pilih Kelas</option>
                              @foreach ($dataKelas as $kelas)
                                <option value="{{ $kelas->kelas }}">{{ $kelas->kelas }}</option>
                              @endforeach
                          </select>
                      </div>
                  
                      <div class="col mb-3">
                          <label for="nameBasic" class="form-label">Angkatan</label>
                          <input type="text" class="form-control @error('angkatan') is-invalid @enderror" placeholder="Angkatan" id="angkatan-siswa" name="angkatan" value="{{ old('angkatan') }}">
                          @error('angkatan')
                              <div class="form-text text-danger">{{ $message }}</div>
                          @enderror
                      </div>
                  </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col col-lg-12">
                  <div class="row">
                      <div class="col mb-3">
                          <label for="nameBasic" class="form-label">Telepon/HP</label>
                          <input type="text" class="form-control @error('telp') is-invalid @enderror" placeholder="Telepon/HP" id="telp-siswa" name="telp" value="{{ old('telp') }}">
                          @error('telp')
                              <div class="form-text text-danger">{{ $message }}</div>
                          @enderror
                      </div>
                  
                      <div class="col mb-3">
                          <label for="emailBasic" class="form-label">Lokasi Absen</label>
                          <select class="form-select" aria-label="Default select example" id="lokasi-absen" name="lokasi">
                              <option selected="">Pilih Lokasi</option>
                              @foreach ($dataLokasi as $lokasi)
                                <option value="{{ $lokasi->nama }}">{{ $lokasi->nama }}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>
              </div>
            </div>
            
            <div class="row">
            <div class="col col-lg-12">
                  <div class="row">
                      <div class="col mb-3">
                          <label for="nameBasic" class="form-label">Foto Siswa</label>
                          <div class="input-group">
                          <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto-siswa" name="foto">
                          <input type="hidden" name="oldImage" id="oldImage">
                          </div>
                          @error('foto')
                          <div class="form-text text-danger">{{ $message }}</div>
                          @enderror
                      </div>
                  
                      <div class="col mb-3">
                          <label for="nameBasic" class="form-label">Alamat</label>
                          <input type="text" class="form-control @error('alamat') is-invalid @enderror" placeholder="Alamat" id="alamat-siswa" name="alamat" value="{{ old('alamat') }}">
                          @error('alamat')
                              <div class="form-text text-danger">{{ $message }}</div>
                          @enderror
                      </div>
                  </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col col-lg-12">
                  <div class="row">
                      <div class="col mb-3">
                          <label for="nameBasic" class="form-label">Tgl. Lahir</label>
                          <input class="form-control" type="date" name="tgl_lahir" id="ttl-siswa">
                          @error('tgl_lahir')
                              <div class="form-text text-danger">{{ $message }}</div>
                          @enderror
                      </div>
                  
                      <div class="col mb-3">
                          <label for="emailBasic" class="form-label">Jenis Kelamin</label>
                          <select class="form-select" aria-label="Default select example" id="jk-siswa" name="jk">
                              <option selected="">Pilih Jenis Kelamin</option>
                              <option value="Pria">Pria</option>
                              <option value="Wanita">Wanita</option>
                          </select>
                      </div>
                  </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col col-lg-12">
                  <div class="row">
                      <div class="col mb-3">
                          <label for="nameBasic" class="form-label">Username</label>
                          <input class="form-control" type="text" name="username" id="username-siswa" placeholder="Username" value="{{ old('username') }}">
                          @error('username')
                              <div class="form-text text-danger">{{ $message }}</div>
                          @enderror
                      </div>
                      
                      <div class="col mb-3">
                          <label for="nameBasic" class="form-label">Password</label>
                          <input class="form-control" type="text" name="password" id="password-siswa" placeholder="Password" value="{{ old('password') }}">
                          @error('password')
                              <div class="form-text text-danger">{{ $message }}</div>
                          @enderror
                      </div>
                  </div>
              </div>
            </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" onclick="javascript:window.location.reload()">Batal</button>
          <button type="submit" id="btn-modal" class="btn btn-primary">Tambahkan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Delete Siswa -->
<div class="modal fade" id="modalHapus" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content" style="text-align:center;">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/data-siswa/delete" method="post">
        @csrf
        @method('delete')
        <div class="modal-body">
          <div class="row">
            <div class="col mb-3">
              <label for="nameBasic">Yakin akan hapus data siswa <strong id="label-del"></strong>?</label>
              <input type="hidden" id="id-del" name="id_del">
              <input type="hidden" name="oldImageDel" id="oldImageDel">
            </div>
          </div>

          <div class="row">
            <div class="col mb-3">
              <button type="button" class="btn btn-outline-secondary mt-2" data-bs-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-danger mt-2">Hapus</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('admin/assets/js/ui-toasts.js') }}"></script>

    @if (count($errors) > 0)
    <script type="text/javascript">
      $(document).ready(function(){
          $("#btnModal").trigger("click");
      });
    </script>
    @endif

    @if(Session::get('siswaTambah') == 'ok')
    <script>
      window.onload = function() {
        $("#showToastPlacement").click();
        }
    </script>
    @endif
    
    @if(Session::get('nisAlready') == 'ok')
    <script>
      window.onload = function() {
        $("#showToastPlacement").click();
        }
    </script>
    @endif

    @if(Session::get('siswaEdit') == 'ok')
    <script>
      window.onload = function() {
        $("#showToastPlacement").click();
        }
    </script>
    @endif

    @if(Session::get('siswaDelete') == 'ok')
    <script>
      window.onload = function() {
        $("#showToastPlacement").click();
        }
    </script>
    @endif

    @if(Session::get('siswaError') == 'ok')
    <script>
      window.onload = function() {
        $("#showToastPlacement").click();
        }
    </script>
    @endif

    <script>
        function dataSiswaEdit(element) {
          var id = $(element).attr('data-id');
          $.ajax({
            url: "/get-data-siswa/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
              var imgElement = $('#imgSiswa');
					    imgElement.empty();

              let {
                dataSiswa,
                dataKelas,
                dataLokasi,
              } = data
              $('#modal-form').attr('action','{{ url("/data-siswa/edit") }}');
              $('#id-siswa').val(dataSiswa.id);
              $('#nama-siswa').val(dataSiswa.nama);
              $('#nis-siswa').val(dataSiswa.nis);
              $('#nis-siswa').prop('readonly', true);
              
              var selectElementKelas = $('#kelas-siswa')
              selectElementKelas.empty();
              for (kel of dataKelas) {
                selectElementKelas.append(`
                  <option value="${kel.kelas}">${kel.kelas}</option>
                `)
                if (kel.kelas == dataSiswa.kelas) {
                  $("#kelas-siswa option[value='" + kel.kelas + "']").attr("selected", "selected");
                }
              }

              $('#angkatan-siswa').val(dataSiswa.angkatan);
              $('#telp-siswa').val(dataSiswa.telp);

			  var selectElementLokasi = $('#lokasi-absen')
              selectElementLokasi.empty();
              for (lok of dataLokasi) {
                selectElementLokasi.append(`
                  <option value="${lok.nama}">${lok.nama}</option>
                `)
                if (lok.nama == dataSiswa.lokasi) {
                  $("#lokasi-absen option[value='" + lok.nama + "']").attr("selected", "selected");
                }
              }

              $('#oldImage').val(dataSiswa.foto);
              $('#alamat-siswa').val(dataSiswa.alamat);
              $('#ttl-siswa').val(dataSiswa.tgl_lahir);

              var selectElementJk = $('#jk-siswa')   
              selectElementJk.empty();
              selectElementJk.append(`
              <option>Pilih Jenis Kelamin</option>
              <option value="Pria">Pria</option>
              <option value="Wanita">Wanita</option>
              `)
              $("#jk-siswa option[value='" + dataSiswa.jk + "']").attr("selected", "selected");

              $('#username-siswa').val(dataSiswa.username);
              $('#username-siswa').prop('readonly', true);

              $('#modalForm').modal('show');
              $('#label-modal').text('Edit Data Siswa');
              $('#btn-modal').text('Update Data');
              $('#imgSiswa').css("display","block");

              var imgs = dataSiswa.foto;
              var elem = document.createElement("img");
              elem.setAttribute("src", "/foto-siswa/" + imgs);
              elem.className="rounded-circle avatar avatar-xl pull-up mb-2";
              document.getElementById("imgSiswa").appendChild(elem);
            }
          });
        }
      
        function dataSiswaDel(element) {
          var id = $(element).attr('data-id');
          $.ajax({
            url: "/get-data-siswa/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
              let {dataSiswa} = data
              $('#id-del').val(dataSiswa.id);
              $('#label-del').text(dataSiswa.nama);
              $('#oldImageDel').val(dataSiswa.foto);
              $('#modalHapus').modal('show');
            }
          });
        }
    </script>
@endpush